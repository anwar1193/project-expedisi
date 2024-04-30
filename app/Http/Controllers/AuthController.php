<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Helpers\Helper;

use App\Models\User;

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

        if(Hash::check($request->password, $user->password) === FALSE) {
            return back()->withErrors(["login" => "Password salah"])->withInput();
        }

        if (date('Y-m-d') > $user->tgl_kadaluarsa) {
            return back()->withErrors(["login" => "Akun Pengguna Telah Kadaluarsa"])->withInput();
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
}
