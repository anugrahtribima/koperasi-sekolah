<?php

namespace App\Http\Controllers\Installments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Loan;
use App\Installment;
use Nexmo\Laravel\Facade\Nexmo;

class InstallmentController extends Controller
{
    public function index()
    {   
        $data = ['loans' => Loan::with('user', 'type')->where('terverifikasi', true)->get()];
        return view('installments.index', $data);
    }

    public function show(Loan $loan)
    {   
        $this->authorize('show', $loan);

        return view('installments.show', compact('loan'));
    }

    public function create(Loan $loan)
    {   
        $this->authorize('create', Loan::class);

        $data = [
            'loan' => $loan,
            'angsuran_ke' => $loan->installments()->count() + 1,
        ];

        return view('installments.create', $data);
    }

    public function store(Loan $loan, Request $request)
    {
        $this->authorize('create', Loan::class);

        if($request->get('angsuran_ke') > $loan->lama_angsuran){
            flash('Mohon maaf angsuran tersebut sudah lunas dan tidak dapat diangsur kembali!')->error();
            return redirect()->route('installments.show', $loan->id);
        }

        Installment::create([
            'loan_id'   => $loan->id,
            'jumlah_bayar'  => $request->get('jumlah_angsuran'),
            'angsuran_ke'   => $request->get('angsuran_ke'),
            'tanggal_bayar' => now(),
        ]);

        Nexmo::message()->send([
            'to'   => '+62' . $loan->user->phone,
            'from' => 'KOPERASI TAMAN SISWA',
            'text' => 'Assallamualaikum wr.wb kami dari smk taman siswa ingin memberitahukan mengenai rincian angsuran pinjaman anda'
                . 'Nama Peminjam ' . $loan->user->name
                . 'Jumlah Pembayaran ' . $loan->jumlah_bayar
                . 'Angsuran ke- ' . $request->get('angsuran_ke')
                . 'Tanggal Pembayaran ' . now()
                . 'terimakasih '
                . 'PENGURUS KOPERASI TAMAN SISWA'
        ]);
        flash('Angsuran anda berhasil disimpan')->success();
        return redirect()->route('installments.show', $loan->id);
    }

}