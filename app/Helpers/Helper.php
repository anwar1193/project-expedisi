<?php

namespace App\Helpers;

use App\Models\LogActivity;
use App\Models\MasterMenu;
use App\Models\MenuPermission;
use Illuminate\Support\Facades\Session;

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
}
