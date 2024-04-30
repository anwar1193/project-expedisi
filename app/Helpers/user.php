<?php

use Illuminate\Support\Facades\Session;

if (! function_exists('isAdmin')) {
    function isAdmin() {
        return auth()->check() && auth()->user()->user_level == 1;
    }
}