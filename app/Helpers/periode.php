<?php


if (! function_exists('getPastDates')) {
    function getPastDates() {
        $dates = [
            ['name' => '3 Hari Terakhir', 'value' => date('Y-m-d', strtotime('-3 day'))],
            ['name' => '7 Hari Terakhir', 'value' => date('Y-m-d', strtotime('-7 day'))],
            ['name' => '14 Hari Terakhir', 'value' => date('Y-m-d', strtotime('-14 day'))],
            ['name' => '30 hari Terakhir', 'value' => date('Y-m-d', strtotime('-30 day'))]
        ];
    
        return $dates;
    }
}