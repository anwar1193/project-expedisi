<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\HistoryLimit;
use App\Models\KonversiPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->get();
        foreach ($customers as $item) {
            $point = KonversiPoint::orderBy('id', 'asc')->first();
            $history = HistoryLimit::where('customer_id', $item->id)->orderBy('id', 'DESC')->limit(5)->get();

            $item->points = round($item->limit_credit / $point->nominal);
            $item->history = $history;
        }

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $next_year = date('Y-m-d H:i:s', strtotime('+1 year'));

        try {
        
            // Kode Customer Otomatis ----------
            $kode_query = DB::select('select MAX(MID(kode_customer, 4, 3)) AS kodee from customers');

            if($kode_query[0]->kodee == NULL){
                $no = '001';
            }else{
                $kodee = $kode_query[0]->kodee;
                $n = ((int)$kodee + 1);
                $no = sprintf("%'.03d", $n);
            }

            $kode_customer = 'LP-'.$no;
            // END Kode Customer Otomatis -------

            $this->validate($request, [
                'nama' => 'required',
                'email' => 'required|email|unique:customers,email|unique:users,email',
                'no_wa' => 'required|regex:/^\+?[0-9]+$/|unique:customers,no_wa|unique:users,nomor_telepon',
                'alamat' => 'required',
                'perusahaan' => 'required',
            ]);

            $request['kode_customer'] = $kode_customer;

            Customer::create($request->all());

            if (($request->username) && ($request->addUser == 'on')) {
                User::create([
                    'nama' => $request->nama,
                    'username' => $request->username,
                    'email' => $request->email,
                    'nomor_telepon' => $request->no_wa,
                    'user_level' => 3,
                    'password' => Hash::make($request->password),
                    'status' => 1
                ]);
            }

            Helper::logActivity('Data Customer ' . $request->nama . ' berhasil ditambahkan');
            return redirect()->route('customers.index')->with('success', 'Data Customer berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        if (!$customer) {
            return view('errors.404');
        }
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        try {
        
            $customer = Customer::findOrFail($id);
            $user = User::where('username', $customer->username)->first();

            $this->validate($request, [
                'nama' => 'required',
                'email' => 'required',
                'no_wa' => 'required|regex:/^\+?[0-9]+$/|unique:customers,no_wa,' . $id.'|unique:users,nomor_telepon,' . $id,
                'alamat' => 'required',
            ]);

            $fieldsToUpdate = ['nama', 'username', 'email', 'no_wa'];

            foreach ($fieldsToUpdate as $field) {
                $userField = $field === 'no_wa' ? 'nomor_telepon' : $field;
                if ($request->$field != $customer->$field) {
                    $user->$userField = $request->$field;
                }
            }

            $customer->update($request->all());
            $user->save();

            Helper::logActivity('Data Customer ' . $request->nama . ' berhasil diupdate');

            return redirect()->route('customers.index')->with('success', 'Data Customer berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        if ($customer->username) {
            $user = User::where('username', $customer->username)->first();
            $user->delete();
        }
        $customer->delete();

        Helper::logActivity('Data Customer ' . $customer->nama . ' berhasil dihapus');
        return redirect()->route('customers.index')->with('success', 'Data Customer berhasil dihapus');
    }

    public function addCredit(Request $request)
    {
        $id = $request->id;
        $tambahan_kredit = $request->nominal_kredit;

        $data_existing = Customer::find($id);
        
        $kredit_sebelumnya = $data_existing->limit_credit;
        $kredit_update = $kredit_sebelumnya + $tambahan_kredit;

        $data_existing->update([
            'limit_credit' => $kredit_update
        ]);

        HistoryLimit::create([
            'customer_id' => $id,
            'limit_kredit' => $tambahan_kredit
        ]);

        return redirect()->route('customers.index')->with('success', 'Limit Kredit Berhasil Ditambahkan');
    }

    public function history_limit($id) 
    {
        $customer = Customer::find($id);
        $data = HistoryLimit::where('customer_id', $id)->orderBy('history_limits.id', 'DESC')->get();

        return view('customers.history-limit', compact('customer', 'data'));
    }

    public function addDiskon(Request $request)
    {
        $id = $request->id;
        $diskon = $request->diskon;

        Customer::where('id', $id)->update([
            'diskon' => $diskon
        ]);

        return redirect()->route('customers.index')->with('success', 'Diskon Customer Berhasil Ditambahkan');
    }
    
}
