<?php

use App\Models\DaftarPengeluaran;
use App\Models\DataPengiriman;
use App\Models\PengeluaranCash;
use App\Models\SaldoCash;
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
        $jumlah = DaftarPengeluaran::where('status_pengeluaran', DaftarPengeluaran::STATUS_PENDING)->count();
        if (Session::get('user_level') == 2) {
            $text = 'Terdapat '.$jumlah. ' Data Pengeluaran Yang Belum Diapprove';
        } elseif (Session::get('user_level') == 1) {
            $text = 'Terdapat '.$jumlah. ' Data Pengeluaran Yang Masih Berstatus Pending';
        } elseif (Session::get('user_level') == 4) {
            $text = 'Selamat Datang';
        }
        
        
        $data['jumlah'] = $jumlah;
        $data['text_notif'] = $text;

        return $data;
    }
}

if (! function_exists('getNotifClosingSaldo')) {
    function getNotifClosingSaldo() {
        $lastSaldo = SaldoCash::where('is_approve', SaldoCash::STATUS_PENDING)->orderBy('id', 'DESC')->first();
        if ($lastSaldo) {
            if (Session::get('user_level') == 2) {
                $text = 'Terdapat Closingan Saldo Yang Belum Diapprove';
            } elseif (Session::get('user_level') == 1) {
                $text = 'Terdapat Closingan Saldo Yang Belum Diapprove';
            } elseif (Session::get('user_level') == 4) {
                $text = 'Terdapat Closingan Saldo Yang Belum Diapprove';
            }
        }

        $data['text_notif'] = $text ?? '-';

        return $data;
    }
}