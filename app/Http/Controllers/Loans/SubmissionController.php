<?php

namespace App\Http\Controllers\Loans;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Loan;
use Nexmo\Laravel\Facade\Nexmo;


class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Loan::with('user', 'type')->where('terverifikasi', false)->get();

        return view('submissions.index', compact('submissions'));
    }

    public function store(Loan $loan, Request $request)
    {
        $loan->update([
            'terverifikasi'         => true,
            'tanggal_persetujuan'    => now()
        ]);
        
        Nexmo::message()->send([
            'to' => '+62' . $loan->user->phone,
            'from' => 'KOPERASI TAMAN BURUNG',
            'text' => 'Assalamualaikum wr.wb, kami dari smk taman burung inign memberitahukan bahwa pengajuan peminjaman anda telah kami setujui berikut ini adalah perinciannya'. 'Nama peminjam ' . $loan->user->name . ' Jumlah pinjaman ' . $loan->jumlah_pinjaman . " Jumlah angsuran " . $loan->jumlah_angsuran . " Lama angsuran " . $loan->lama_angsuran . " Tanggal angsuran " . $loan->created_at->format('Y-m-d') . ' terima kasih ' . 'PENGURUS KOPERASI SMK TAMAN BURUNG'
        ]);

        flash('Pengajuan pinjaman berhasil di ajukan')->success();

        return redirect()->route('submissions');
    }

}
 