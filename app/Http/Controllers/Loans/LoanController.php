<?php

namespace App\Http\Controllers\Loans;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Nexmo\Laravel\Facade\Nexmo;
use App\Loan;
use App\Type;
use PDF;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('loans.index')->with(['loans' => Loan::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Type $type)
    {
        //
        return view('loans.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Type $type, Request $request)
    {
        //
        Loan::create([
            'user_id'           => auth()->user()->id,
            'type_id'           => $type->id,
            'jumlah_pinjaman'   => $request->jumlah_pinjaman,
            'jumlah_angsuran'   => $request->jumlah_angsuran,
            'lama_angsuran'     => $request->lama_angsuran,
            'tanggal_pengajuan' => now(),
        ]);

        flash('Pinjaman berhasil di ajukan')->success();
        return redirect()->route('submissions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $loan = Loan::findOrFail($id);

        Nexmo::message()->send([
            'to' => '+62' . $loan->user->phone,
            'from' => 'KOPERASI TAMAN BURUNG',
            'text' => 'Assalamualaikum wr.wb, kami dari smk taman burung inign memberitahukan bahwa pengajuan peminjaman anda telah kami tidak dapat disetujui'
        ]);

        $loan->delete($request->all());

        flash('Pengajuan berhasil ditolak');
        return redirect()->route('submissions');
    }

    public function kalkulasi(Type $type, Request $request)
    {
        $request->validate([
            // gte:value & lte:value = ambil minimum sesuai dengan Type yang dipilih
            'jumlah_pinjaman' => 'required|numeric|gte:minimum_jumlah_pinjaman|lte:maksimum_jumlah_pinjaman',
            'lama_angsuran'   => 'required|numeric|gte:minimum_lama_angsuran|lte:maksimum_lama_angsuran',
        ]);

        // persen = bunga dibagi 100 
        $persen = $type->bunga / 100;

        // cicilan pokok = jumlah pinjaman dibagi lama angsuran
        $cicilan_pokok = $request->jumlah_pinjaman / $request->lama_angsuran;

        // bunga = jumlah pinjaman dikali persen dibagi lama angsuran
        $bunga = $request->jumlah_pinjaman * $persen / $request->lama_angsuran;

        // angsuran = cicilan pokok ditambah bunga
        $angsuran = $cicilan_pokok + $bunga;

       return view('loans.kalkulasi', compact('type','request','angsuran'));
    }

    public function cetak(Request $request)
    {
        $this->authorize('cetak', Loan::class);

        if ($request->has('dari_tgl')) {
            $loans = Loan::with('user','type')->whereBetWeen('tanggal_persetujuan',[request('dari_tgl'), request('sampai_tgl')])->get();
        } else {
            $loans = Loan::with('user','type')->where('terverifikasi', true)->get();
        }

        $pdf = PDF::loadView('cetak.loans', compact('loans'))->setPaper('a4', 'landscape');

        return $pdf->stream('laporan_pinjaman.pdf');
    }

}
