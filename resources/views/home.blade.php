@extends('layouts.app')

@section('content')
<div class="mt-4 col-lg-8 mx-auto rounded">
    <div class="card card-user">
        <div class="image">
            <img src="{{ asset('asset/img/newbg.png') }}" class="rounded-top" width="100%" alt="...">
        </div>
        <div class="content text-center">
            <div class="author">
                <img src="{{ asset('asset/img/avatar.jpg') }}" width="120px" height="auto" alt="..." class="avatar border-white rounded-circle shadow my-3">
                <h4 class="title font-weight-bolder">
                    {{ Auth::user()->name }} <br>
                    <a href="#" class="text-muted">
                        <small>{{Auth::user()->email}}</small>
                    </a>
                </h4>
                <small>{{Auth::user()->created_at->diffForHumans()}}</small>
            </div>
        </div>
        <div class="text-center pb-5 mt-5 bg-light d-flex justify-content-center">
            <div class="row m-0 p-3" style="width: 100%">
                @role('anggota')
                    <div class="home-menu col-md-4 mt-4 border">
                        <div class="card rounded shadow p-2">
                            <h5>
                                Rp.{{number_format(auth()->user()->totalSaldo(), 2)}}
                            </h5>
                            <small class="text-muted">Saldo Simpanan</small>
                        </div>
                    </div>
                    @else
                    <div class="home-menu col-md-4 mt-4 border">
                        <div class="card rounded shadow p-2">
                            <h5>Rp.{{number_format($savings->sum('saldo'), 2)}}</h5>
                            <small>Tabungan</small>
                        </div>
                    </div>
                @endrole
                @role('anggota')
                    <div class="home-menu col-md-4 mt-4 border">
                        <div class="card rounded shadow p-2">
                            <h5>
                                {{auth()->user()->dataPinjaman()->count()}}
                            </h5>
                            <small class="text-muted">Data Pinjaman</small>
                        </div>
                    </div>
                    @else
                    <div class="home-menu col-md-4 mt-4 border">
                        <div class="card rounded shadow p-2">
                            <h5>
                                {{$pengajuan->where('terverifikasi', true)->count()}}
                            </h5>
                            <small>Data Pinjaman</small>
                        </div>
                    </div>
                @endrole
                @role('anggota')
                <div class="home-menu col-md-4 mt-4 border">
                    <div class="card rounded shadow p-2">
                        <h5>
                            Rp.{{number_format(auth()->user()->totalPinjaman(), 2)}}
                        </h5>
                        <small class="text-muted">Total Pinjaman</small>
                    </div>
                </div>
                @else
                <div class="home-menu col-md-4 mt-4 border">
                    <div class="card rounded shadow p-2">
                        <h5>
                            Rp.{{number_format($pengajuan->where('terverifikasi', true)->sum('jumlah_pinjaman'), 2)}}
                        </h5>
                        <small>Total Pinjaman</small>
                    </div>
                </div>
                @endrole
                @role('anggota')
                <div class="home-menu col-md-4 mt-4 border">
                    <div class="card rounded shadow p-2">
                        <h5>
                            {{auth()->user()->pengajuanPinjaman()->count()}}
                        </h5>
                        <small class="text-muted">Pengajuan pinjaman</small>
                    </div>
                </div>
                @else
                <div class="home-menu col-md-4 mt-4 border-4">
                    <div class="card rounded shadow p-2">
                        <h5>
                            {{$pengajuan->where('terverifikasi', false)->count()}}
                        </h5>
                        <small class="text-muted">Pengajuan pinjaman</small>
                    </div>
                </div>
                @endrole
                @role('anggota')
                <div class="home-menu col-md-4 mt-4 border">
                    <div class="card rounded shadow p-2">
                        <h5>{{$penarikan}}</h5>
                        <a href="{{route('penarikan')}}">
                            <small class="text-muted">Penarikan</small>
                        </a>
                    </div>
                </div>
                @else
                <div class="home-menu col-md-4 mt-4 border">
                    <div class="card rounded shadow p-2">
                        <h5>{{$pengajuan->where('terverifikasi', false)->count()}}</h5>
                        <a href="{{route('penarikan')}}">
                            <small class="text-muted">Penarikan</small>
                        </a>
                    </div>
                </div>
                @endrole
            </div>
        </div>
    </div>
</div>
@endsection
