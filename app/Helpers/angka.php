<?php

if (! function_exists('terbilang')) {
    function terbilang($angka) {
        $angka = abs($angka);
        $baca = array("", "SATU", "DUA", "TIGA", "EMPAT", "LIMA", "ENAM", "TUJUH", "DELAPAN", "SEMBILAN", "SEPULUH", "SEBELAS");
        $terbilang = "";

        if ($angka < 12) {
            $terbilang = " " . $baca[$angka];
        } else if ($angka < 20) {
            $terbilang = terbilang($angka - 10) . " BELAS";
        } else if ($angka < 100) {
            $terbilang = terbilang($angka / 10) . " PULUH" . terbilang($angka % 10);
        } else if ($angka < 200) {
            $terbilang = " SERATUS" . terbilang($angka - 100);
        } else if ($angka < 1000) {
            $terbilang = terbilang($angka / 100) . " RATUS" . terbilang($angka % 100);
        } else if ($angka < 2000) {
            $terbilang = " SERIBU" . terbilang($angka - 1000);
        } else if ($angka < 1000000) {
            $terbilang = terbilang($angka / 1000) . " RIBU" . terbilang($angka % 1000);
        } else if ($angka < 1000000000) {
            $terbilang = terbilang($angka / 1000000) . " JUTA" . terbilang($angka % 1000000);
        }

        return $terbilang;
    }
}

if (! function_exists('formatTanggalIndonesia')) {
    function formatTanggalIndonesia($tanggal) {
        // Ubah format tanggal menjadi d F Y
        $tanggal_baru = date("d F Y", strtotime($tanggal));
    
        // Ubah bulan ke dalam bahasa Indonesia
        $bulan_inggris = array(
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        );
    
        $tanggal_indonesia = str_replace(array_keys($bulan_inggris), array_values($bulan_inggris), $tanggal_baru);
    
        return $tanggal_indonesia;
    }
}
