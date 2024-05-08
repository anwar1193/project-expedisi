<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $next_year = date('Y-m-d H:i:s', strtotime('+1 year'));
        
        try {
            $auth = Socialite::driver('google')->user();

            $user = User::where('id', $auth->getId())->first();

            if (!$user) {
                $new_user = User::create([
                    'nama' => $auth->getName(),
                    'username' => $auth->getName(),
                    'email' => $auth->getEmail(),
                    'google_id' => $auth->getId(),
                    'user_level' => 2,
                    'password' => Hash::make('password'),
                    'tgl_kadaluarsa' => $next_year,
                    'last_login' => $datetime,
                    'status' => 1
                ]);

                Auth::login($new_user);

                return redirect()->route("dashboard");
            } else {
                Auth::login($user);
                return redirect()->route("dashboard");
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()->withErrors(["login" => $th->getMessage()])->withInput();
        }
    }
}
