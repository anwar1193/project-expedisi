<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $perPage = request('perPage', 10);
        $page = request('page', 1);
        $search = request('search');

        $users = User::select(
                'users.id', 
                'users.kode_satker', 
                'users.nama_satker',
                'users.nama',
                'users.nip',
                'users.username',
                'users.email',
                'levels.level',
                'users.foto'
                )
                ->join('levels', 'levels.kode_level', '=', 'users.user_level')
                ->orderBy('users.id', 'ASC');

                if ($search) {
                    $users->where('users.nama', 'LIKE', "%$search%");
                }

        $users = $users->paginate($perPage, ['*'], 'page', $page);

        try {
            return response()
                ->json([
                        "status" => 200,
                        "message" => "List Data User",
                        "data" => $users ? $users : (object)[],
                        // 'current_page' => $users->currentPage(),
                        // 'total_pages' => $users->lastPage(),
                        // 'total_records' => $users->total()
                    ], 200);
        } catch (\Throwable $th) {
            $res = array(
                "status" => 500,
                "message" => "Terjadi Kesalahan Pada Server"
            );
            return response()->json($res, 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'kode_satker' => 'required',
                'nama_satker' => 'required',
                'nama' => 'required',
                'nip' => 'required',
                'username' => 'required',
                'email' => 'required',
                'user_level' => 'required',
                'password' => 'required|confirmed',
                'status' => 'required',
                'tgl_kadaluarsa' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $email = User::where('email', $request->email)->count();
            $username = User::where('username', $request->username)->count();

            if ($email + $username > 0) {
                $res = array(
                    "status" => 403,
                    "message" => "Email Atau Username Sudah Terdaftar"
                );
                return response()->json($res, 403);
            } elseif (isAdmin() == false) {
                $res = array(
                    "status" => 403,
                    "message" => "User Tidak Memiliki Akses"
                );
                return response()->json($res, 403);
            }
    
            $foto = $request->file('foto');
    
            if($foto != ''){
                $foto->storeAs('public/foto_profil', $foto->hashName());
            }
    
            $validateData['foto'] = ($foto != '' ? $foto->hashName() : '');
            $validateData['password'] = Hash::make($request->password);
    
            User::create($validateData);

            $res = array(
                "status" => 201,
                "message" => "Data User Berhasil Ditambahkan"
            );
            return response()->json($res, 201);
        } catch (\Throwable $th) {
            $res = array(
                "status" => 500,
                "message" => "Gagal Menambahkan User, Silahkan Tambahkan Ulang"
            );
            return response()->json($res, 500);
        }      
    }

    public function detail($id)
    {
        $user = User::select('users.*', 'levels.level AS nama_level')
                ->join('levels', 'levels.kode_level', '=', 'users.user_level')
                ->where('users.id', '=', $id)
                ->first();

        $res = array(
            "status" => 200,
            "message" => "Detail Data {$user->nama}",
            "data" => $user
        );
        return response()->json($res, 200);
    }

    public function update($id, Request $request)
    {
        dd($request->kode_satker);
        try {
            $validateData = $request->validate([
                'kode_satker' => 'required',
                'nama_satker' => 'required',
                'nama' => 'required',
                'nip' => 'required',
                'username' => 'required',
                'email' => 'required',
                'user_level' => 'required',
                'status' => 'required',
                'kadaluarsa' => 'required'
            ]);

            $user = User::where('id', $id)->first();

            if(!$user) {
                $res = array(
                    "status" => 404,
                    "message" => "Data User Tidak Ditemuakn"
                );
                return response()->json($res, 404);
            } elseif (isAdmin() == false) {
                $res = array(
                    "status" => 403,
                    "message" => "User Tidak Memiliki Akses"
                );
                return response()->json($res, 403);
            }

            $foto = $request->file('foto');

            $getImage = User::find($id);

            if($foto != ''){
                Storage::delete('public/foto_profil/'.$getImage->foto);
                $foto->storeAs('public/foto_profil', $foto->hashName());
            }

            $validateData['foto'] = ($foto != '' ? $foto->hashName() : '');

            User::where('id', '=', $id)->update([
                'kode_satker' => $request->kode_satker,
                'nama_satker' => $request->nama_satker,
                'nama' => $request->nama,
                'nip' => $request->nip,
                'username' => $request->username,
                'email' => $request->email,
                'user_level' => $request->user_level,
                'status' => $request->status,
                'tgl_kadaluarsa' => $request->kadaluarsa,
                'foto' => ($foto != '' ? $foto->hashName() : $request->old_foto)
            ]);

            $res = array(
                "status" => 200,
                "message" => "Data User Berhasil Diperabrui"
            );
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            $res = array(
                "status" => 500,
                "message" => "Data User Gagal Diperbarui"
            );
            return response()->json($res, 500);
        }
    }

    public function delete($id)
    {
        $getImage = User::find($id);

        if (isAdmin()) {
            if ($getImage) {
                if (Storage::exists('public/foto_profil/' . $getImage->foto)) {
                    Storage::delete('public/foto_profil/' . $getImage->foto);
                }
        
                User::where('id', $id)->delete();
        
                $res = array(
                    "status" => 200,
                    "message" => "Data User Berhasil Dihapus"
                );
                return response()->json($res, 200);
            } else {
                $res = array(
                    "status" => 404,
                    "message" => "Data User Tidak Ditemukan"
                );
                return response()->json($res, 404);
            }

        } else {
            $res = array(
                "status" => 403,
                "message" => "User Tidak Memiliki Akses"
            );
            return response()->json($res, 403);
        }
    }
}
