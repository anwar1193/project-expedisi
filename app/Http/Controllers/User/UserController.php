<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Level;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Session;
use PDF;
use App\Exports\UserExport;
use App\Models\Customer;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index(Request $request) {
        $users = User::select('users.*', 'levels.level AS level_user')
                    ->join('levels', 'levels.id', '=', 'users.user_level')
                    ->orderBy('users.id', 'ASC')
                    ->get();

        $data['users'] = $users;

        return view("admin.master.users.users", $data);
    }

    public function create(Request $request) {
        $levels = Level::where('level', '!=', 'user')->get();
        $data['levels'] = $levels;

        return isAdmin() ? view("admin.master.users.create", $data) : back()->with('error', 'Anda Tidak Memiliki Akses'); 
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required',
            'nomor_telepon' => 'required',
            'user_level' => 'required',
            'password' => 'required|confirmed',
            // 'password_confirmation' => 'required',
            'status' => 'required',
            'foto' => 'required'
        ]);

        $foto = $request->file('foto');

        if($foto != ''){
            $foto->storeAs('public/foto_profil', $foto->hashName());
        }

        $validateData['foto'] = ($foto != '' ? $foto->hashName() : '');
        $validateData['password'] = Hash::make($request->password);

        User::create($validateData);

        Helper::logActivity('Simpan data pengguna dengan username : '.$request->username);

        return redirect('/users')->with('success', 'Data Berhasil Disimpan');

    }

    public function edit($id)
    {
        $levels = Level::all();
        $user = User::find($id);

        $data['levels'] = $levels;
        $data['user'] = $user;

        return isAdmin() ? view("admin.master.users.edit", $data) : back()->with('error', 'Anda Tidak Memiliki Akses');  
    }

    public function update(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required',
            'nomor_telepon' => 'required',
            // 'user_level' => 'required',
            'status' => 'required',
            'password_baru' => 'confirmed'
        ]);

        $foto = $request->file('foto');

        $getImage = User::find($request->id);

        if($foto != ''){
            Storage::delete('public/foto_profil/'.$getImage->foto);
            $foto->storeAs('public/foto_profil', $foto->hashName());
        }

        $validateData['foto'] = ($foto != '' ? $foto->hashName() : '');

        User::where('id', '=', $request->id)->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'user_level' => $request->user_level,
            'status' => $request->status,
            'foto' => ($foto != '' ? $foto->hashName() : $request->old_foto),
            'password' => Hash::make($request->password_baru)
        ]);

        Helper::logActivity('Update data pengguna dengan username : '.$request->username);

        return redirect('/users')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $getImage = User::find($id);

        if (isAdmin()) {
            if(Storage::exists('public/foto_profil/'. $getImage->foto)){
                Storage::delete('public/foto_profil/'. $getImage->foto);
            }
    
            Helper::logActivity('Hapus data pengguna dengan username : '.$getImage->username);
    
            User::where('id', $id)->delete();
    
            return redirect()->route('users')->with('delete', 'Data pengguna berhasil dihapus');
        } else {
            return back()->with('error', 'Anda Tidak Memiliki Akses');
        }
    }

    public function listLevel() {
        $level = Level::get()->toarray();

        return response()->json($level, 200);
    }

    public function gantiPassword()
    {
        return view("admin.master.users.ganti-password");
    }

    public function gantiPasswordProses(Request $request)
    {
        $validateData = $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|confirmed'
        ]);

        $idUser = Session::get('id');
        $passwordLama = $request->password_lama;
        
        $dataUser = User::find($idUser);

        if(Hash::check($passwordLama, $dataUser->password) === FALSE) {
            // return back()->withErrors(["login" => "Password salah"])->withInput();
            return back()->with('failed', 'Password lama yang anda masukan salah!');
        }

        User::find($idUser)->update([
            'password' => Hash::make($request->password_baru)
        ]);

        return back()->with('success', 'Password berhasil diubah');
    }

    public function detail($id)
    {
        $user = User::select('users.*', 'levels.level AS nama_level')
            ->join('levels', 'levels.id', '=', 'users.user_level')
            ->where('users.id', '=', $id)
            ->first();
            
        $data['user'] = $user;

        return view("admin.master.users.detail", $data);
    }

    public function profile()
    {
        $id = Session::get('id');

        $user = User::select('users.*', 'levels.level AS nama_level')
            ->join('levels', 'levels.id', '=', 'users.user_level')
            ->where('users.id', '=', $id)
            ->first();

        $data['user'] = $user;

        return view("admin.master.users.profile", $data);
    }

    public function update_profile(Request $request)
    {
        $user = User::where('id', '=', $request->id)->first();
        $customer = Customer::where('username', $user->username)->first();

        User::where('id', '=', $request->id)->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email
        ]);
        
        if ($customer) {
            $customer->nama = $request->nama;
            $customer->username = $request->username;
            $customer->email = $request->email;
            $customer->save();
        }

        Helper::logActivity('Ubah profile pengguna dengan username : '.$request->username);

        $customer = Session::get('user_level') == 3;
        
        if ($customer) {
            return back()->with('success', 'Profile Berhasil Diupdate');
        }
        return redirect()->route('profile')->with('success', 'Profile Berhasil Diupdate');
    }

    public function update_foto(Request $request)
    {
        $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $foto = $request->file('foto');

        $getImage = User::find($request->id);

        if ($foto) {
            if ($getImage->foto) {
                Storage::delete('public/foto_profil/' . $getImage->foto);
            }

            $fotoName = $foto->storeAs('public/foto_profil', $foto->hashName());

            $getImage->update(['foto' => $foto->hashName()]);

            Session::put('foto', $foto->hashName());

            Helper::logActivity('Update data foto profil: ' . $getImage->username);

            return back()->with('success', 'Foto profil berhasil diubah');
        }

        return back()->withErrors(['error' => 'Tidak ada file yang diunggah']);
    }

    public function hak_akses() 
    {
        $user = User::select('users.*', 'levels.level AS nama_level')
            ->join('levels', 'levels.id', '=', 'users.user_level')
            ->orderBy('users.id', 'ASC')
            ->get();

        $levels = Level::all();

        $data['user'] = $user;
        $data['levels'] = $levels;

        return view("admin.master.users.hak-akses", $data);
    }

    public function updateHakAkses(Request $request)
    {
        $validateData = $request->validate([
            'user_level' => 'required',
        ]);

        $user = User::where('id', '=', $request->id)->first();

        User::where('id', '=', $request->id)->update([
            'user_level' => $request->user_level,
        ]);

        Helper::logActivity('Update hak akses pengguna dengan username : '.$request->username);

        return back()->with('success', 'Hak Akses ' . $user->nama . ' Berhasil Diupdate');
    }

    public function export_pdf()
    {
        date_default_timezone_set("Asia/Jakarta");
        $users = User::select('users.*', 'levels.level AS level_user')
                    ->join('levels', 'levels.id', '=', 'users.user_level')
                    ->orderBy('users.id', 'ASC')
                    ->get();

        $waktuCetak = date('d-m-Y H:i:s');

        $data['users'] = $users;
        $data['waktu_cetak'] = $waktuCetak;

        $pdf = PDF::loadView('admin.master.users.pdf', $data);
        return $pdf->download('Users.pdf');
    }

    public function export_excel()
    {
        return Excel::download(new UserExport, 'users.xlsx');
    }
}
