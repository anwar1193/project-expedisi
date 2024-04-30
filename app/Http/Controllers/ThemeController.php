<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\User;

class ThemeController extends Controller
{
    public function index(Request $request) {
        $currentTheme = Session::get("tema");
        $userId = Session::get("id");

        $user = User::where("id", $userId)->first();
    
        $newTheme = $currentTheme == "dark" ? "light" : "dark";

        $user->tema = $newTheme;
        $user->save();

        Session::put("tema", $newTheme);
    
        return back();
    }
        
}
