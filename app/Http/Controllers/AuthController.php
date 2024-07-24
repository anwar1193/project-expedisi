<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    function index() {
        return view('admin.authentication.login-bs-tt-validation');
    }

    function login(Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $datetime = date('Y-m-d H:i:s');

        $request->validate([
            "username" => "required",
            "password" => "required|"
        ]);

        $credentials = $request->only('username', 'password');

        $user = User::where("username", $request->username)
                ->first();

        if ($request == null) {
            return back()->withErrors(["login" => "Silahkan masukkan username dan password"])->withInput();
        }

        if (!$user) {
            return back()->withErrors(["login" => "Username tidak ditemukan"])->withInput();
        }

        if ($user->status == 2) {
            return back()->withErrors(["login" => "Akun pengguna tidak aktif, silahkan hubungi admin."])->withInput();
        }

        if(Hash::check($request->password, $user->password) === FALSE) {
            return back()->withErrors(["login" => "Password salah"])->withInput();
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Session::put('id', $user->id);
            Session::put('kode_satker', $user->kode_satker);
            Session::put('nama_satker', $user->nama_satker);
            Session::put('nama', $user->nama);
            Session::put('nip', $user->nip);
            Session::put('username', $user->username);
            Session::put('email', $user->email);
            Session::put('user_level', $user->user_level);
            Session::put('foto', $user->foto);
            Session::put('tema', $user->tema);

            Helper::logActivity('Login aplikasi');

            // Update Last Login
            User::where('username', $request->username)->update([
                'last_login' => $datetime
            ]);

            if ($user->user_level == 3) {
                return redirect()->route("dashboard.customer");
            }
            return redirect()->route("dashboard");
        }

        return redirect()->back()->withInput($request->only('username'))->withErrors(['login' => 'Username atau password tidak cocok']);
    }

    public function logout()
    {
        Helper::logActivity('Logout aplikasi');
        Auth::logout();
        Session::flush();
        return redirect()->route("login");
    }

    public function register(Request $request)
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
                'no_wa_2' => 'regex:/^\+?[0-9]+$/|unique:customers,no_wa|unique:users,nomor_telepon',
                'no_wa_3' => 'regex:/^\+?[0-9]+$/|unique:customers,no_wa|unique:users,nomor_telepon',
                'alamat' => 'required',
            ]);

            $request['kode_customer'] = $kode_customer;
            $request['status'] = false;

            Customer::create($request->all());

            if (($request->username) && ($request->addUser == 'on')) {
                User::create([
                    'nama' => $request->nama,
                    'username' => $request->username,
                    'email' => $request->email,
                    'nomor_telepon' => $request->no_wa,
                    'user_level' => 3,
                    'password' => Hash::make($request->password),
                    'status' => 2
                ]);
            }

            return redirect()->route('login')->with('success', 'Register Berhasil, Silahkan Tunggu Approval Dari Admin');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
