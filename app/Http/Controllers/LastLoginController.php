<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LastLoginController extends Controller
{
    public function index()
    {
        $users = User::select('users.*', 'levels.level AS level_user')
                    ->join('levels', 'levels.id', '=', 'users.user_level')
                    ->orderBy('users.last_login', 'DESC')
                    ->get();

        $data['users'] = $users;

        return view("admin.master.users.last_login", $data);
    }
}
