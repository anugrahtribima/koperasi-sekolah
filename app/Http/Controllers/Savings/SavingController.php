<?php

namespace App\Http\Controllers\Savings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class SavingController extends Controller
{
    public function index() {
        $users = User::all();
        return view('savings.index', compact('users'));
    }
}
