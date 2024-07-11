<?php

namespace App\Helpers;

use App\Models\Bank;
use App\Models\Customer;
use App\Models\LogActivity;
use App\Models\MasterMenu;
use App\Models\MenuPermission;
use App\Models\Level;
use App\Models\Barang;
use App\Models\Jasa;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class Helper
{

    public static function getModule()
    {
      $user_level = Session::get('user_level');
      $module = [
        // 'menu' => MasterMenu::where('parent_id', 0)
        //     ->where('status', 1)
        //     ->orderBy('position', 'ASC')
        //     ->get(),

        'menu' => MenuPermission::select('menu_permissions.*', 'master_menus.menu', 'master_menus.url','master_menus.icon','master_menus.is_dropdown','master_menus.id')
            ->join('master_menus', 'master_menus.id', '=', 'menu_permissions.menu_id')
            ->where('menu_permissions.level_id', '=', $user_level)
            ->where('master_menus.parent_id', 0)
            ->where('master_menus.status', 1)
            ->orderBy('master_menus.position', 'ASC')
            ->get(),
      ];

      return $module;
    }

    public static function getSubModule($parent_id)
    {
      $user_level = Session::get('user_level');
      $sub_module = [
        // 'sub_menu' => MasterMenu::where('parent_id', $parent_id)
        //     ->where('status', 1)
        //     ->orderBy('position', 'ASC')
        //     ->get(),
        'sub_menu' => MenuPermission::select('menu_permissions.*', 'master_menus.menu', 'master_menus.url','master_menus.icon','master_menus.is_dropdown')
            ->join('master_menus', 'master_menus.id', '=', 'menu_permissions.menu_id')
            ->where('menu_permissions.level_id', '=', $user_level)
            ->where('master_menus.parent_id', $parent_id)
            ->where('master_menus.status', 1)
            ->orderBy('master_menus.position', 'ASC')
            ->get(),

      ];

      return $sub_module;
    }

    public static function cekModule($menu_id, $level_id)
    {
      // $user_level = Session::get('user_level');
      $cek = MenuPermission::where('level_id', '=', $level_id)
              ->where('menu_id', '=', $menu_id)
              ->count();
            
      return $cek;
    }

    public static function logActivity($activity) 
    {
        // Date Time Setting ....................................
        date_default_timezone_set("Asia/Jakarta");

        // Get IP Address .......................................
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        // Get Browser Client ....................................
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";
      
        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
          $platform = 'linux';
        }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
          $platform = 'mac';
        }elseif (preg_match('/windows|win32/i', $u_agent)) {
          $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
            $bname = 'Internet Explorer';
            $ub = "MSIE";
          }elseif(preg_match('/Firefox/i',$u_agent)){
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
          }elseif(preg_match('/OPR/i',$u_agent)){
            $bname = 'Opera';
            $ub = "Opera";
          }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
            $bname = 'Google Chrome';
            $ub = "Chrome";
          }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
            $bname = 'Apple Safari';
            $ub = "Safari";
          }elseif(preg_match('/Netscape/i',$u_agent)){
            $bname = 'Netscape';
            $ub = "Netscape";
          }elseif(preg_match('/Edge/i',$u_agent)){
            $bname = 'Edge';
            $ub = "Edge";
          }elseif(preg_match('/Trident/i',$u_agent)){
            $bname = 'Internet Explorer';
            $ub = "MSIE";
          }

        // Save Log Activities ....................................
        $data = new LogActivity();
        $data->username = Session::get('username');
        $data->log_time = date("Y-m-d H:i:s");
        $data->activity = $activity;
        $data->ip_address = $ipaddress;
        $data->browser = $bname . ' on ' . $platform; 
        $data->save();
    }

    public static function level($id_level)
    {
      $data = Level::find($id_level);
      return $data->level;
    }

    public static function validateFormattedData($formattedData)
    {
        $rules = [
            '*.no_resi' => 'required|unique:data_pengirimen',
            '*.tgl_transaksi' => 'required|date',
            // '*.kode_customer' => 'required',
            '*.nama_pengirim' => 'required',
            '*.nama_penerima' => 'required',
            '*.kota_tujuan' => 'required',
            '*.no_hp_pengirim' => 'required',
            '*.no_hp_penerima' => 'required',
            '*.berat_barang' => 'required|numeric',
            '*.ongkir' => 'required|numeric',
            '*.komisi' => 'required|numeric',
            '*.metode_pembayaran' => 'required',
            '*.bank' => 'nullable',
            '*.bukti_pembayaran' => 'nullable',
            '*.jenis_pengiriman' => 'required',
            '*.bawa_sendiri' => 'required',
            '*.status_pengiriman' => 'required',
            '*.keterangan' => 'nullable',
        ];

        $validator = Validator::make($formattedData, $rules);

        return $validator;
    }

    public static function customValidasi($datas)
    {
        $errors = [];

        foreach ($datas as $key => $data) {
            if (is_array($data)) {
                if ($data['metode_pembayaran'] == 'Transfer' && empty($data['bank'])) {
                    $errors[] = 'Bank Wajib Diisi Ketika Metode Pembayaran = Transfer';
                }

                if ($data['metode_pembayaran'] != 'Transfer' && !empty($data['bank'])) {
                    $errors[] = 'Kolom Bank Harus Dikosongkan Ketika Metode Pembayaran Bukan Transfer';
                }

                if ($data['metode_pembayaran'] == 'Transfer') {
                    if (empty($data['bukti_pembayaran'])) {
                        $errors[] = 'Bukti Pembayaran Wajib Diisi Ketika Metode Pembayaran = Transfer';
                    }

                    $bankTerdaftar = Bank::where('bank', $data['bank'])->exists();
                    if (!$bankTerdaftar) {
                        $errors[] = 'Bank yang anda input tidak tersedia di sistem!';
                    }
                }

                if ($data['metode_pembayaran'] != 'Transfer' && !empty($data['bukti_pembayaran'])) {
                    $errors[] = 'Kolom Bukti Pembayaran Harus Dikosongkan Ketika Metode Pembayaran Bukan Transfer';
                }

                if ($data['metode_pembayaran'] == 'Kredit') {
                    $customerTerdaftar = Customer::where('kode_customer', $data['kode_customer'])->exists();
                    if (!$customerTerdaftar && $data['kode_customer'] != '') {
                        $errors[] = 'Metode pembayaran kredit hanya berlaku untuk customer terdaftar atau kosongkan kolom customer!';
                    }
                }

                $tanggalSekarang = date('Y-m-d');
                $diff = strtotime($tanggalSekarang) - strtotime($data['tgl_transaksi']);
                $jarakHari = abs(round($diff / 86400));

                if ($jarakHari > 7) {
                    $errors[] = 'Tanggal transaksi tidak boleh mundur lebih dari 7 hari!';
                }
            } else {
                $errors[] = 'Invalid data format.';
            }
        }

        // Check if there are errors, redirect back with errors if any
        if (!empty($errors)) {
            // return redirect()->back()->with("error", $errors);
            return redirect()->route('data-pengiriman')->withErrors($errors)->with('error', 'Silahkan Ulangi Import Data');
        }

        // Return null if no errors (optional)
        return null;
    }

    public static function getTimeOfDay()
    {
        date_default_timezone_set("Asia/Jakarta");
        $hour = date('H');

        if ($hour >= 5 && $hour < 12) {
            return 'Selamat Pagi';
        } elseif ($hour >= 12 && $hour < 18) {
            return 'Selamat Siang';
        } else {
            return 'Selamat Malam';
        }
    }

    public static function namaBarang($id)
    {
        $data = Barang::where('id', $id)->first();
        $nama_barang = $data->nama_barang;
        return $nama_barang;
    }

    public static function namaJasa($id)
    {
        $data = Jasa::where('id', $id)->first();
        $nama_jasa = $data->nama_jasa;
        return $nama_jasa;
    }

}
