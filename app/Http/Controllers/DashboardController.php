<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DaftarPengeluaran;
use App\Models\DataPengiriman;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\SurveilanceCar;
use App\Models\Perangkat;
use App\Models\LogActivity;
use App\Models\PemasukanLainnya;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tahun_terpilih = $request->input("tahun") ? $request->input("tahun") : Carbon::now()->year;

        $pengiriman = DataPengiriman::whereYear('created_at', $tahun_terpilih)
                        ->get()->count();

        $pemasukan = PemasukanLainnya::whereYear('created_at', $tahun_terpilih)            
                    ->get()
                    ->count();

        $pengeluaran = DaftarPengeluaran::whereYear('created_at', $tahun_terpilih)            
                        ->get()
                        ->count();

        $aktifitas = [];

        for ($i = 1; $i <= 12; $i++) {
            $jumlah = LogActivity::where('activity', 'Login aplikasi')
                        ->whereYear('created_at', $tahun_terpilih)
                        ->whereMonth('created_at', $i)
                        ->count();

            array_push($aktifitas, $jumlah);
        }

        if (isCustomer()) {
            return redirect()->route('dashboard.customer');
        }
        return view("admin.dashboard.default", compact(["aktifitas", "pengiriman", "pemasukan", "pengeluaran"]));
    }

    public function customer(Request $request)
    {
        $tahun_terpilih = $request->input("tahun") ? $request->input("tahun") : Carbon::now()->year;
        $data['statusLunas'] = DataPengiriman::STATUS_PENDING - 1;
        $data['statusPending'] = DataPengiriman::STATUS_PENDING;

        $data['customer'] = $this->data_customer();

        $data['pending'] = DataPengiriman::where('status_pembayaran', DataPengiriman::STATUS_PENDING)
                    ->where('kode_customer', '=', $data['customer']->kode_customer)
                    ->whereYear('created_at', $tahun_terpilih)
                    ->orderBy('id', 'DESC')
                    ->count();

        $data['lunas'] = DataPengiriman::where('status_pembayaran', '!=', DataPengiriman::STATUS_PENDING)
                    ->where('kode_customer', '=', $data['customer']->kode_customer)
                    ->whereYear('created_at', $tahun_terpilih)
                    ->orderBy('id', 'DESC')
                    ->count();

        $data['invoice'] = Invoice::join('customers', 'customers.id', '=', 'invoices.customer_id')
                    ->where('customer_id', $data['customer']->id)
                    ->whereYear('invoices.created_at', $tahun_terpilih)
                    ->orderBy('invoices.id', 'DESC')
                    ->count();

        $data['aktifitas'] = [];

        for ($i = 1; $i <= 12; $i++) {
            $data['jumlah'] = DataPengiriman::where('kode_customer', '=', $data['customer']->kode_customer)
                        ->whereYear('created_at', $tahun_terpilih)
                        ->whereMonth('created_at', $i)
                        ->count();

            array_push($data['aktifitas'], $data['jumlah']);
        }

        return view('dashboard-customer.index', $data);
    }

    public function dashboard_customer(Request $request) {
        $id = Session::get('id');
        $status = 2;
        $no_resi = $request->no_resi;

        $user = User::select('users.*', 'levels.level AS nama_level')
            ->join('levels', 'levels.id', '=', 'users.user_level')
            ->where('users.id', '=', $id)
            ->first();
            
        $customer = Customer::select('customers.*')
                ->join('users', 'users.username', '=', 'customers.username')
                ->where('users.id', $id)
                ->first();

        $tagihan = DataPengiriman::where('status_pembayaran', $status)
                    ->where('kode_customer', '=', $customer->kode_customer)
                    ->orderBy('id', 'DESC')->get();

        $totalTagihan = DataPengiriman::selectRaw('SUM(ongkir) AS total')
                        ->where('status_pembayaran', $status)
                        ->where('kode_customer', '=', $customer->kode_customer)->first();

        $resi =  DataPengiriman::join('status_pengirimen AS status', 'status.status_pengiriman', '=', 'data_pengirimen.status_pengiriman')
                ->where('no_resi', $no_resi)->first();

        $data = DataPengiriman::join('transaksi_invoices', 'transaksi_invoices.data_pengiriman_id', '=', 'data_pengirimen.id')
                ->where('kode_customer', $customer->kode_customer)
                ->orderBy('data_pengirimen.id', 'DESC')->get();

        $total = DataPengiriman::selectRaw('SUM(ongkir) AS total')
                ->join('transaksi_invoices', 'transaksi_invoices.data_pengiriman_id', '=', 'data_pengirimen.id')
                ->where('kode_customer', $customer->kode_customer)->first();

        $invoice = Invoice::select('invoices.invoice_no', 'invoices.id AS invoiceId', 'invoices.created_at', 'customers.id', 'customers.kode_customer', 'customers.nama')
                ->join('customers', 'customers.id', '=', 'invoices.customer_id')
                ->where('customer_id', $customer->id)
                ->orderBy('invoices.id', 'DESC')
                ->get();

        return view('customers.dashboard', compact('user', 'tagihan', 'totalTagihan', 'resi', 'data', 'customer', 'total', 'invoice'));
    }

    public function tagihan() 
    {
        $status = request('status') ? request('status') : DataPengiriman::STATUS_PENDING;

        $customer = $this->data_customer();

        $data = DataPengiriman::where('status_pembayaran', $status)
                    ->where('kode_customer', '=', $customer->kode_customer)
                    ->orderBy('id', 'DESC')->get();

        $total = $data->sum('ongkir');

        return view('tagihan-customer.index', compact('data', 'customer', 'total'));
    }

    public function lacak_resi()
    {
        $data['customer'] = $this->data_customer();
        $no_resi = request('no_resi');
        $data['data'] =  DataPengiriman::join('status_pengirimen AS status', 'status.status_pengiriman', '=', 'data_pengirimen.status_pengiriman')
                ->where('no_resi', $no_resi)->first();

        return view('lacak-resi.index', $data);
    }

    public function invoice()
    {
        $data['customer'] = $this->data_customer();

        $data['data'] = DataPengiriman::join('transaksi_invoices', 'transaksi_invoices.data_pengiriman_id', '=', 'data_pengirimen.id')
                ->where('kode_customer', $data['customer']->kode_customer)
                ->orderByDesc('data_pengirimen.id')
                ->get();

        $total['total'] = $data['data']->sum('ongkir');

        $data['invoice'] = Invoice::select('invoices.invoice_no', 'invoices.id AS invoiceId', 'invoices.created_at', 'customers.id', 'customers.kode_customer', 'customers.nama')
                ->join('customers', 'customers.id', '=', 'invoices.customer_id')
                ->where('customer_id', $data['customer']->id)
                ->orderBy('invoices.id', 'DESC')
                ->get();

        return view('invoice.customer', $data);
    }

    public function point()
    {
        $data['customer'] = $this->data_customer();

        $data['data'] = DataPengiriman::where('status_pembayaran', DataPengiriman::STATUS_PENDING)
                    ->where('kode_customer', '=', $data['customer']->kode_customer)
                    ->orderBy('id', 'DESC')
                    ->count();

        return view('point-customer.index', $data);
    }

    private function data_customer()
    {
        $id = Session::get('id');

        $customer = Customer::select('customers.*')
        ->join('users', 'users.username', '=', 'customers.username')
        ->where('users.id', $id)
        ->first();

        return $customer;
    }
}
