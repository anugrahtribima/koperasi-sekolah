<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaction = "";
        return view('transaksi.index', compact('transaction'));
    }
}
