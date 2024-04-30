<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $datetime = date('Y-m-d');

        $user = User::join("levels", 'levels.kode_level', '=', 'users.user_level')
                ->where('username', $request->username)
                ->first();

        if(!$user) {
            $res = array(
                "status" => 404,
                "message" => "Pengguna Tidak Ditemukan"
            );
            return response()->json($res, 404);
        }

        $userShow = (object)[
            "id" => $user->id,
            "kode_satker" => $user->kode_satker,
            "nama_satker" => $user->nama_satker,
            "nama" => $user->nama,
            "nip" => $user->nip,
            "username" => $user->username,
            "email" => $user->email,
            "level" => $user->level,
            "foto" => $user->foto
        ];

        try {    
            if ($request->username == null || $request->password == null) {
                $res = array(
                    "status" => 401,
                    "message" => "Silahkan masukkan username dan password"
                );
                return response()->json($res, 401);
            }
            
            if ($datetime > $user->tgl_kadaluarsa) {
                $res = array(
                    "status" => 403,
                    "message" => "Akun Pengguna Telah Kadaluarsa"
                );
                return response()->json($res, 403);
            }

            if(Hash::check($request->password, $user->password)) {
                $token = $user->createToken("auth_token")->plainTextToken;
                $auth_token = explode("|", $token)[1];
                return response()
                ->json([
                    "status" => 200,
                    "message" => "Halo {$user->nama}",
                    "data" => $userShow,
                    "access_token" => $auth_token,
                    ], 200);
            } else {
                return response()->json([
                    "status" => 401,
                    "message" => "Password Salah",
                    ], 401
                );
            }
        } catch (\Throwable $th) {
            $res = array(
                "status" => 400,
                "message" => "Terjadi Kesalahan Pada Proses Login"
            );
            return response()->json($res, 400);
        }
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => 200,
            'message' => 'User Berhasil Logout'
        ]);
    }
}
