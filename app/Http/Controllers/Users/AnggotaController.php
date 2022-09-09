<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = User::role('anggota')->get();
        return view('users.anggota.index', compact('anggotas'));
    }
}
