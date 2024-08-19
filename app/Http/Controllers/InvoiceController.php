<?php

namespace App\Http\Controllers;

use App\Mail\Invoice as MailInvoice;
use App\Models\Bank;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\DataPengiriman;
use App\Models\Invoice;
use App\Models\Pesan;
use App\Models\TransaksiInvoice;
use App\Models\TransaksiPembayaran;
use App\Models\InvoiceBank;
use App\Models\SettingWa;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class InvoiceController extends Controller
{
    public function index() {
        return view('invoice.index');
    }

    public function export_pdf()
    {
        $picture = public_path('assets/lionparcel.png');
        $pdf = Pdf::loadView('invoice.pdf', compact('picture'));
        return $pdf->stream('Invoice.pdf');
    }
    
    public function bukti_terima_pdf()
    {
        $picture = public_path('assets/lionparcel.png');
        $customPaper = array(0, 0, 350, 700);
        $pdf = Pdf::loadView('invoice.bukti-terima-pdf', compact('picture'))->setPaper($customPaper, 'landscape');
        return $pdf->stream('Bukti-Terima.pdf');
    }

    public function createInvoice()
    {
        $data['customer'] = Customer::orderBy('id')->get();
        return view('invoice.create', $data);
    }

    public function generateInvoice(Request $request)
    {
        $customer_id = $request->customer;
        if (!$customer_id) {
            return back()->with('error', 'Pilih Customer terlebih Dahulu');
        }

        $customer = Customer::find($customer_id);
        if (!$customer) {
            return back()->with('error', 'Customer tidak ditemukan');
        }

        $data = DataPengiriman::select('data_pengirimen.*')
                ->leftJoin('transaksi_invoices', 'data_pengirimen.id', '=', 'transaksi_invoices.data_pengiriman_id')
                ->where('data_pengirimen.kode_customer', $customer->kode_customer)
                // ->where('data_pengirimen.status_pembayaran', DataPengiriman::STATUS_PENDING)
                ->whereNot('data_pengirimen.status_pembayaran', DataPengiriman::STATUS_LUNAS)
                ->whereNull('transaksi_invoices.data_pengiriman_id')
                ->orderBy('id', 'DESC')->get();
        foreach ($data as $item) {
            $transaksi = TransaksiInvoice::where('data_pengiriman_id', $item->id)
                    ->orderBy('id', 'ASC')->get();
            $item->transaksi = $transaksi;
        }

        if ($data->isEmpty()) {
            return back()->with('error', 'Customer Belum Memiliki Riwayat Transaksi');
        }

        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        $count_invoice = Invoice::whereMonth('created_at', $month)->count() + 1;
        $no_invoice = "{$count_invoice}/INV/LP/{$year}";

        $invoice = Invoice::create([
            'customer_id' => $customer_id,
            'invoice_no' => $no_invoice
        ]);

        return redirect()->route('invoices.detail', ['id' => $customer_id]);
    }

    public function detail($id)
    {
        $customer = Customer::find($id);
        $data = DataPengiriman::select('data_pengirimen.*')
                ->leftJoin('transaksi_invoices', 'data_pengirimen.id', '=', 'transaksi_invoices.data_pengiriman_id')
                ->where('data_pengirimen.kode_customer', $customer->kode_customer)
                // ->where('data_pengirimen.status_pembayaran', DataPengiriman::STATUS_PENDING)
                ->whereNot('data_pengirimen.status_pembayaran', DataPengiriman::STATUS_LUNAS)
                ->whereNull('transaksi_invoices.data_pengiriman_id')
                ->orderBy('id', 'DESC')->get();
        foreach ($data as $item) {
            $transaksi = TransaksiInvoice::where('data_pengiriman_id', $item->id)
                    ->orderBy('id', 'ASC')->get();
            $item->transaksi = $transaksi;
        }

        $invoice = Invoice::where('customer_id', $id)->orderBy('id', 'DESC')->first();

        $total = DataPengiriman::selectRaw('SUM(ongkir) AS total')
                ->leftJoin('transaksi_invoices', 'data_pengirimen.id', '=', 'transaksi_invoices.data_pengiriman_id')
                ->where('status_pembayaran', DataPengiriman::STATUS_PENDING)
                ->whereNull('transaksi_invoices.invoice_id')
                ->where('kode_customer', $customer->kode_customer)->first();

        $totalBersih = round($total->total * $customer->diskon / 100);

        $exist = TransaksiInvoice::where('invoice_id', $invoice->id)->exists();

        $today = date('Y-m-d');

        $bank = Bank::all();

        return view('invoice.hasil', compact('data', 'customer', 'today', 'total', 'invoice', 'exist', 'bank', 'totalBersih'));
    }

    public function all_invoices(Request $request)
    {
        $tanggal = $request->tanggal;
        $customer = $request->customer_id;
        $status = $request->status;
        $customers = Customer::all();

        $data = Invoice::select('invoices.invoice_no', 'invoices.created_at', 'invoices.id AS invoiceId', 'invoices.diskon', 'invoices.status', 'customers.id', 'customers.kode_customer', 'customers.nama', 'customers.diskon AS diskon_customer')
                ->join('customers', 'customers.id', '=', 'invoices.customer_id')
                ->when($customer, function ($query, $customer) {
                    return $query->where('customers.id', $customer);
                })
                ->when($tanggal, function ($query, $tanggal) {
                    return $query->WhereDate('invoices.created_at', $tanggal);
                })
                ->orderBy('invoices.id', 'DESC')
                ->get();
                
            foreach ($data as $item) {
                $total = DataPengiriman::selectRaw('SUM(ongkir) AS total')
                ->join('transaksi_invoices', 'transaksi_invoices.data_pengiriman_id', '=', 'data_pengirimen.id')
                ->where('kode_customer', $item->kode_customer)
                ->where('invoice_id', $item->invoiceId)
                ->first();

                $nominal = TransaksiPembayaran::selectRaw('SUM(nominal) AS total')
                            ->where('invoice_id', $item->invoiceId)->first();

                $diskon = round($total->total * $item->diskon_customer / 100);

                $totalBersih = round($total->total - $item->diskon - $diskon);

                if ($nominal) {
                    $item->sisa = round($totalBersih - $nominal->total);
                } else {
                    $item->sisa = $totalBersih;
                }

                $item->totalBersih = $totalBersih;
            }

            $data = $data->filter(function ($item) use ($status) {
                if ($status == '1') {
                    return $item->sisa == 0;
                } elseif ($status == '0') {
                    return $item->sisa != 0;
                }
                return true;
            });
                    
            $data = $data->values();
                
        return view('invoice.all', compact('data', 'customers'));
    }

    public function handleInvoiceTransactions(Request $request, $id, $invoiceId)
    {
        $id_pengiriman = $request->id_pengiriman;
        $bank_id = $request->bank_id;

        // $diskon = $request->diskon ?? 0;
        if ($request->diskon != 0) {
            $diskon = $request->diskon;
        } elseif ($request->diskon_persen != 0) {
            $diskon = round(($request->total * $request->diskon_persen / 100));
        } else {
            $diskon = 0;
        }

        $customer = Customer::select('customers.id', 'customers.kode_customer', 'customers.nama', 'customers.alamat', 'invoices.invoice_no', 'invoices.id AS invoiceId', 'invoices.diskon')
                    ->join('invoices', 'invoices.customer_id', '=', 'customers.id')
                    ->where('customers.id', $id)
                    ->where('invoices.id', $invoiceId)
                    ->first();

        if (!isCustomer()) {
            if ($id_pengiriman == NULL) {
                return back()->with('error', 'Belum Ada Data Dipilih');
            } elseif ($bank_id == NULL) {
                return back()->with('error', 'Belum Ada Data Bank Yang Dipilih');
            }
    
            foreach ($id_pengiriman as $pengiriman_id) {
                $exist = TransaksiInvoice::where('data_pengiriman_id', $pengiriman_id)->exists();
                if (!$exist) {
                    TransaksiInvoice::create([
                        'invoice_id' => $customer->invoiceId,
                        'data_pengiriman_id' => $pengiriman_id
                    ]);
                }
            }
            

            foreach($bank_id as $id_bank){
                InvoiceBank::create([
                    'id_invoice' => $customer->invoiceId,
                    'id_bank' => $id_bank
                ]);
            }
    
            Invoice::find($customer->invoiceId)->update([
                'diskon' => $diskon
            ]); 
        }

        return redirect()->route('invoice.hasil-transaksi', ['id' => $customer->id, 'invoiceId' => $customer->invoiceId])->with("success", "Generate Invoice Berhasil");
    }

    public function generateInvoicePdf($id, $invoiceId)
    {
        $customer = Customer::select('customers.id', 'customers.diskon AS diskon_customer', 'customers.kode_customer', 'customers.nama', 'customers.alamat', 'customers.perusahaan', 'invoices.invoice_no', 'invoices.invoice_name', 'invoices.id AS invoiceId', 'invoices.diskon', 'invoices.created_at', 'invoices.status')
                    ->join('invoices', 'invoices.customer_id', '=', 'customers.id')
                    ->where('customers.id', $id)
                    ->where('invoices.id', $invoiceId)
                    ->first();

        $data = DataPengiriman::join('transaksi_invoices', 'transaksi_invoices.data_pengiriman_id', '=', 'data_pengirimen.id')
                ->where('kode_customer', $customer->kode_customer)
                ->where('invoice_id', $invoiceId)
                ->orderBy('data_pengirimen.id', 'DESC')->get();
                
        $total = DataPengiriman::selectRaw('SUM(ongkir) AS total')
                ->join('transaksi_invoices', 'transaksi_invoices.data_pengiriman_id', '=', 'data_pengirimen.id')
                ->where('kode_customer', $customer->kode_customer)
                ->where('invoice_id', $invoiceId)
                ->first();

        $diskon = round($total->total * $customer->diskon_customer / 100);

        $totalBersih = round($total->total - $customer->diskon - $diskon);

        $bank = InvoiceBank::select('invoice_banks.*', 'banks.bank', 'banks.nomor_rekening', 'banks.atas_nama', 'banks.cabang')
                ->join('banks', 'banks.id', '=', 'invoice_banks.id_bank')
                ->where('invoice_banks.id_invoice', $invoiceId)
                ->get();

        if ($customer->status == 0) {
            return back()->with('error', 'Invoice Belum Diapprove Oleh Owner');
        }

        $notEmpty = $data->isNotEmpty();
        $waktuCetak = date('d-m-Y H:i:s');
        $picture = public_path('assets/lionparcel.png');
        $customerName = str_replace(' ', '', $customer->nama);

        ini_set('max_execution_time', 300);
        ini_set("memory_limit","512M");
        
        $pdf = Pdf::loadView('invoice.hasil-pdf', compact('customer', 'data' ,'picture', 'waktuCetak', 'total', 'notEmpty', 'bank', 'diskon', 'totalBersih', 'bank'));
        $pdfContent = $pdf->output();

        if (!Storage::exists('public/invoices/Invoice-'.$customer->invoice_name.'.pdf')) {
            // Simpan ke storage
            $name_invoice = $customerName.date("YmdHis"); 
            Storage::put('public/invoices/Invoice-'.$name_invoice.'.pdf', $pdfContent);

           Invoice::find($customer->invoiceId)->update([
                'invoice_name' => $name_invoice
            ]);             
        }
        
        return $pdf->stream('Invoice-'.$customerName.'.pdf');
    }

    public function send_wa_invoice(Request $request)
    {
        $id = $request->id;
        $invoiceId = $request->invoice_id;
        $customer = Customer::find($id);
        $invoice = Invoice::where('id', $invoiceId)->where('customer_id', $customer->id)->first();
        $customerName = str_replace(' ', '', $customer->nama);
        $pesan = Pesan::find(Pesan::INV);

        if ($invoice->status == 0) {
            return back()->with('error', 'Invoice Belum Diapprove Oleh Owner');
        }

        if (!Storage::exists('public/invoices/Invoice-'.$invoice->invoice_name.'.pdf')) {
            return back()->with("error", "Silahkan Cetak invoice Terlebih Dahulu");
        }

        // $dataSending = sendWaText($customer->no_wa, $pesan->isi_pesan);
        $url = SettingWa::select('url_media AS url')->latest()->first();
        $dataSendings = sendWaUrl($customer->no_wa, $pesan->isi_pesan,  URL::to('/'). "/storage/invoices/Invoice-".$invoice->invoice_name.".pdf");
    
        try {
            $responses = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url->url, $dataSendings);
            // ])->post('https://api.watzap.id/v1/send_file_url', $dataSendings);
    
            if ($responses->successful()) {
               return redirect()->route("invoices.index")->with("success", "Invoice Berhasil Dikirim Ke WhatsApp " .$customer->nama);
            } else {
                return redirect()->route("invoices.index")->with("error", "Invoice Gagal Dikirim Ke WhatsApp " .$customer->nama);
            }
        } catch (\Throwable $e) {
            // return redirect()->route("invoices.index")->with("error", "Koneksi ke watzap.id gagal");
            return redirect()->route("invoices.index")->with("success", "Proses Pengiriman Invoice Kepada ".$customer->nama." Berhasil");
        }
    }

    public function send_email_invoice(Request $request)
    {
        $id = $request->id;
        $invoiceId = $request->invoice_id;
        $pesan = Pesan::find(Pesan::INV);
        $invoice = Customer::select('customers.id', 'customers.diskon AS diskon_customer', 'customers.kode_customer', 'customers.nama', 'customers.email', 'customers.alamat', 'invoices.invoice_no', 'invoices.invoice_name', 'invoices.id AS invoiceId', 'invoices.diskon', 'invoices.created_at', 'invoices.status')
                    ->join('invoices', 'invoices.customer_id', '=', 'customers.id')
                    ->where('invoices.id', $invoiceId)
                    ->where('customers.id', $id)
                    ->first();

        if ($invoice->status == 0) {
            return back()->with('error', 'Invoice Belum Diapprove Oleh Owner');
        }

        $invoice->customerName = str_replace(' ', '', $invoice->nama);
        $invoice->isi_pesan = $pesan->isi_pesan;
        if (!Storage::exists('public/invoices/Invoice-'.$invoice->invoice_name.'.pdf')) {
            return back()->with("error", "Silahkan Cetak invoice Terlebih Dahulu");
        }
                                       //natiboh@mailinator.com 
        Mail::to($invoice->email)->send(new MailInvoice($invoice));

        return redirect()->route("invoices.index")->with("success", "Invoice Berhasil Dikirim Ke Email " .$invoice->nama);
    }

    public function hasil_transaksi($id, $invoiceId)
    {
        $customer = Customer::select('customers.id', 'customers.diskon AS diskon_customer', 'customers.kode_customer', 'customers.nama', 'customers.alamat', 'customers.perusahaan', 'invoices.invoice_no', 'invoices.invoice_name', 'invoices.id AS invoiceId', 'invoices.diskon', 'invoices.created_at')
                    ->join('invoices', 'invoices.customer_id', '=', 'customers.id')
                    ->where('customers.id', $id)
                    ->where('invoices.id', $invoiceId)
                    ->first();

        $data = DataPengiriman::join('transaksi_invoices', 'transaksi_invoices.data_pengiriman_id', '=', 'data_pengirimen.id')
                ->where('kode_customer', $customer->kode_customer)
                ->where('invoice_id', $invoiceId)
                ->orderBy('data_pengirimen.id', 'DESC')->get();
                
        $total = DataPengiriman::selectRaw('SUM(ongkir) AS total')
                ->join('transaksi_invoices', 'transaksi_invoices.data_pengiriman_id', '=', 'data_pengirimen.id')
                ->where('kode_customer', $customer->kode_customer)
                ->where('invoice_id', $invoiceId)
                ->first();

        $diskon = round($total->total * $customer->diskon_customer / 100);

        $totalBersih = round($total->total - $customer->diskon - $diskon);

        $bank = InvoiceBank::select('invoice_banks.*', 'banks.bank', 'banks.nomor_rekening', 'banks.atas_nama', 'banks.cabang')
                ->join('banks', 'banks.id', '=', 'invoice_banks.id_bank')
                ->where('invoice_banks.id_invoice', $invoiceId)
                ->get();

        return view('invoice.hasil-transaksi', compact('customer', 'data', 'total', 'diskon', 'totalBersih', 'bank'));
    }

    public function pembayaran_invoice(Request $request)
    {
        $validateData = $request->validate([
            'invoice_id' => 'required|numeric',
            'nominal' => 'required|numeric',
            'tanggal_bayar' => 'required',
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $foto = $request->file('bukti_bayar');

        if ($request->nominal > $request->total_tagihan) {
            return back()->with('error', 'Nominal Yang Anda Masukan Melebihi Total Sisa Tagihan');
        }

        if($foto != ''){
            $foto->storeAs('public/invoice-bukti-bayar', $foto->hashName());
        }

        $validateData['bukti_bayar'] = ($foto != '' ? $foto->hashName() : '');

        TransaksiPembayaran::create($validateData);

        // Proses Pelunasan Data Pengiriman ----------------------------------------------------------
            // 1. Cari Total Kotor Nominal Invoice
            $transaksi_invoice = TransaksiInvoice::where('invoice_id', $request->invoice_id)->get();
            $total_nominal_invoice = 0;
            foreach($transaksi_invoice as $data){
                $data_pengiriman_id = $data->data_pengiriman_id;
                $data_pengiriman = DataPengiriman::find($data_pengiriman_id);
                $total_nominal_invoice += $data_pengiriman->ongkir;
            }

            // 2. Cari Persentase Diskon Dari Customer
            $invoice = Invoice::find($request->invoice_id);
            $id_customer = $invoice->customer_id;
            $customer = Customer::find($id_customer);
            $persentase_diskon = $customer->diskon;

            // 3. Total Bersih Nominal Invoice
            $total_bersih_invoice = $total_nominal_invoice - ($total_nominal_invoice * $persentase_diskon / 100);

            // 4. Cari Nominal yang Sudah Dibayar
            $invoice_sudah_bayar = TransaksiPembayaran::where('invoice_id', $request->invoice_id)->sum('nominal');

            // 5. Sisa Tagihan = Total Nominal - Nominal Sudah Dibayar
            $sisa_tagihan = $total_bersih_invoice - $invoice_sudah_bayar;

            // 6. Jika Sisa Tagihan = 0, maka looping data pengiriman dengan invoice_id diatas, lalu ubah status_pembayaran menjadi 1 (lunas)
            if($sisa_tagihan <= 0){
                foreach($transaksi_invoice as $data){
                    $data_pengiriman_id = $data->data_pengiriman_id;
                    DataPengiriman::find($data_pengiriman_id)->update([
                        'status_pembayaran' => DataPengiriman::STATUS_LUNAS
                    ]);
                }
            }
        // End Proses Pelunasan Data Pengiriman --------------------------------------------------------

        return redirect()->route('invoices.index')->with('success', 'Pembayaran Invoice Berhasil Ditambahkan');
    }

    public function detail_riwayat_invoices($invoiceId)
    {
        $datas = TransaksiPembayaran::select('transaksi_pembayarans.*', 'invoices.invoice_no')
                ->leftjoin('invoices', 'invoices.id', '=', 'transaksi_pembayarans.invoice_id')
                ->where('transaksi_pembayarans.invoice_id', $invoiceId)
                ->orderBy('transaksi_pembayarans.id', 'DESC')
                ->get();

        return view('invoice.riwayat-pembayaran', compact('datas'));
    }

    public function approve($id)
    {
        Invoice::find($id)->update([
            'status' => 1
        ]);

        return back()->with('success', 'Invoice Telah Di Approve');
    }

    public function approveSelected(Request $request)
    {
        $id_invoice = $request->id_invoice;

        if($id_invoice == NULL){
            return back()->with('error', 'Belum Ada Data Dipilih');
        }

        for($i=0; $i<sizeof($id_invoice); $i++){
            Invoice::find($id_invoice[$i])->update([
                'status' => 1
            ]);
        }

        return back()->with('success', 'Invoice Telah Di Approve');
    }

    public function cancel_approve($id)
    {
        Invoice::find($id)->update([
            'status' => 9
        ]);

        return back()->with('success', 'Invoice Telah Di Approve');
    }

    public function cancel_approveSelected(Request $request)
    {
        $id_invoice = $request->id_invoice;

        if($id_invoice == NULL){
            return back()->with('error', 'Belum Ada Data Dipilih');
        }

        for($i=0; $i<sizeof($id_invoice); $i++){
            Invoice::find($id_invoice[$i])->update([
                'status' => 0
            ]);
        }

        return back()->with('success', 'Invoice Telah Di Approve');
    }

    public function delete_invoice($id)
    {
        if (!isOwner()) {
            return back()->with('error', "Anda Tidak memiliki hak akses");
        }
        $invoice = Invoice::find($id);
        $invoice_banks = InvoiceBank::where('id_invoice', $id)->get();
        $transaksi_invoices = TransaksiInvoice::where('invoice_id', $id)->get();
        $pembayarans = TransaksiPembayaran::where('invoice_id', $id)->get();

        DB::beginTransaction();

        try {
            if ($invoice) {
                $invoice->delete();
            }
        
            foreach ($transaksi_invoices as $transaksi_invoice) {
                Storage::delete('public/invoices/invoice-' . $transaksi_invoice->invoice_name . '.pdf');
                $transaksi_invoice->delete();
            }
        
            foreach ($invoice_banks as $invoice_bank) {
                $invoice_bank->delete();
            }
        
            foreach ($pembayarans as $pembayaran) {
                $pembayaran->delete();
            }
        
            DB::commit();
            return back()->with('delete', 'Invoice Berhasil Dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal Menghapus Data Invoice');
        }

    }
}