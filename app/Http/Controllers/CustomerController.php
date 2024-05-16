<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->get();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $next_year = date('Y-m-d H:i:s', strtotime('+1 year'));

        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email',
            'no_wa' => 'required|regex:/^\+?[0-9]+$/',
            'alamat' => 'required',
        ]);

        Customer::create($request->all());

        if (($request->username) && ($request->addUser == 'on')) {
            User::create([
                'nama' => $request->nama,
                'username' => $request->username,
                'email' => $request->email,
                'nomor_telepon' => $request->no_wa,
                'user_level' => 3,
                'password' => Hash::make($request->password),
                'tgl_kadaluarsa' => $next_year,
                'status' => 1
            ]);
        }

        Helper::logActivity('Data Customer ' . $request->nama . ' berhasil ditambahkan');
        return redirect()->route('customers.index')->with('success', 'Data Customer berhasil ditambahkan');
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
        $customer = Customer::findOrFail($id);
        $user = User::where('username', $customer->username)->first();

        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email',
            'no_wa' => 'required|regex:/^\+?[0-9]+$/',
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
}
