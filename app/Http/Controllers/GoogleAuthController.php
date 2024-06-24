<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $datetime = date('Y-m-d H:i:s');
        // $next_year = date('Y-m-d H:i:s', strtotime('+1 year'));

        $auth = Socialite::driver('google')->stateless()->user();
        $user = User::where('google_id', $auth->getId())->first();

        Session::regenerate();
        // Session::put('id', $user->id ?? $auth->getId());
        Session::put('nama', $auth->getName());
        Session::put('username', $auth->getName());
        Session::put('email', $auth->getEmail());
        Session::put('user_level', 3);
        Session::put('tema', $user->tema ?? 'dark');

        try {
            if (!$user) {
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

                Customer::create([
                    'kode_customer' => $kode_customer,
                    'nama' => $auth->getName(),
                    'email' => $auth->getEmail(),
                    'no_wa' => "0801010101010",
                    'alamat' => 'Indonesia',
                    'username' => $auth->getName()
                ]);

                $new_user = User::create([
                    'nama' => $auth->getName(),
                    'username' => $auth->getName(),
                    'email' => $auth->getEmail(),
                    'google_id' => $auth->getId(),
                    'user_level' => 3,
                    'password' => Hash::make('password'),
                    'last_login' => $datetime,
                    'status' => 1
                ]);

                Session::put('id', $new_user->id);

                Auth::login($new_user);

                return redirect()->route("dashboard.customer");
            } else {
                Session::put('id', $user->id);
                Auth::login($user);
                return redirect()->route("dashboard.customer");
            }
        } catch (\Throwable $th) {
            return redirect()->route("login")->withErrors(["login" => $th->getMessage()])->withInput();
        }
    }
}