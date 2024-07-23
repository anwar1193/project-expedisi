<?php

use Illuminate\Support\Facades\Session;

if (! function_exists('isAdmin')) {
    function isAdmin() {
        return auth()->check() && auth()->user()->user_level == 1;
    }
}

if (! function_exists('isOwner')) {
    function isOwner() {
        return auth()->check() && auth()->user()->user_level == 2;
    }
}

if (! function_exists('isCustomer')) {
    function isCustomer() {
        return auth()->check() && auth()->user()->user_level == 3;
    }
}