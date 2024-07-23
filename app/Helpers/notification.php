<?php

use App\Models\DataPengiriman;
use App\Models\PengeluaranCash;
use Illuminate\Support\Facades\Session;

if (! function_exists('getNotification')) {
    function getNotification() {
        $jumlah = DataPengiriman::where('status_pembayaran', 2)->count();
        if (Session::get('user_level') == 2) {
            $text = 'Terdapat '.$jumlah. ' Data Pengiriman Yang Belum Diapprove';
        } elseif (Session::get('user_level') == 1) {
            $text = 'Terdapat '.$jumlah. ' Data Pengiriman Yang Masih Berstatus Pending';
        }elseif (Session::get('user_level') == 4) {
            $text = 'Selamat Datang';
        }
        
        
        $data['jumlah'] = $jumlah;
        $data['text_notif'] = $text;

        return $data;
    }
}

if (! function_exists('getNotifPengeluaran')) {
    function getNotifPengeluaran() {
        $jumlah = PengeluaranCash::where('status', false)->count();
        if (Session::get('user_level') == 2) {
            $text = 'Terdapat '.$jumlah. ' Data Pengeluaran Cash Yang Belum Diapprove';
        } elseif (Session::get('user_level') == 1) {
            $text = 'Terdapat '.$jumlah. ' Data Pengeluaran Cash Yang Masih Berstatus Pending';
        }elseif (Session::get('user_level') == 4) {
            $text = 'Selamat Datang';
        }
        
        
        $data['jumlah'] = $jumlah;
        $data['text_notif'] = $text;

        return $data;
    }
}