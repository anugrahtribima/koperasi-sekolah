<?php

namespace App\Http\Controllers\Installments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Installment;

class InstallmentController extends Controller
{
    public function index()
    {   
        $data = Installment::all();
        return view('installments.index', compact('data'));
    }
}