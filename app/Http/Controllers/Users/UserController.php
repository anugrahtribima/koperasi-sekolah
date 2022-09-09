<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function create()
    {
        $roles = User::all();
        return view('users.create', compact('roles'));
    }
}
