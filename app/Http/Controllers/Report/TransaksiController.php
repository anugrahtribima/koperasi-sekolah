<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use PDF;
use App\Transaksi;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    public function all()
    {
        $transaksi = Transaksi::all();

        $pdf = PDF::loadView('cetak.transaksi.all', compact('transaksi'))->setPaper('a3', 'landscape');
        return $pdf->stream('laporan_all_transaksi.pdf');
    }
}
