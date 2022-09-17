<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Saving;
use App\Loan;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'pengajuan' => Loan::with('user')->where('user_id', Auth::user()->id),
            'savings'   => Saving::with('user')->where('user_id', Auth::user()->id),
            'penarikan'   => Saving::with('withdrawals')->where('user_id', Auth::user()->id)->count(),
        ];

        return view('home', $data);
    }
}
