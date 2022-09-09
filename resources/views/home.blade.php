@extends('layouts.app')

@section('content')
<div class="col-md-6 col-lg-6 mx-auto">
    <div class="card card-user">
        <div class="image">
            <img src="{{ asset('asset/img/newbg.png') }}" width="100%" alt="...">
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
        <hr>
        <div class="text-center">
            <div class="row">
                @role('anggota')
                    <div class="col-md-4 col-md-offset-1">
                        <h5>
                            Rp. 0
                            <br>
                            <small class="text-muted">Saldo Simpanan</small>
                        </h5>
                    </div>
                @else
                    <div class="col-md-4 col-md-offset-1">
                        <h5>Rp.0</h5>
                        <br>
                        <small>Tabungan</small>
                    </div>
                @endrole
                @role('anggota')
                    <div class="col-md-4">
                        <h5>
                            {{auth()->user()->dataPinjaman()->count()}}
                            <br>
                            <small class="text-center">Data Pinjaman</small>
                        </h5>
                    </div>
                @else
                    <div class="col-md-4">
                        <h5>
                            0
                        </h5>
                        <br>
                        <small>Data Pinjaman</small>
                    </div>
                @endrole
                @role('anggota')
                    <div class="col-md-4">
                        <h5>0</h5>
                        <small class="text-muted">Total Pinjaman</small>
                    </div>
                @else
                    <div class="col-md-4">
                        <h5>
                            Rp. 0
                        </h5>
                        <br>
                        <small>Total Pinjaman</small>
                    </div>
                @endrole
                @role('anggota')
                    <div class="col-md-4">
                        <h5>
                        {{auth()->user()->pengajuanPinjaman()->count()}}
                            <br>
                            <small class="text-muted">Pengajuan pinjaman</small>
                        </h5>
                    </div>
                @endrole
                @role('anggota')
                    <div class="col-md-4">
                        <h5>
                            0
                            {{--  {{$penarikan}}  --}}
                            <br>
                            <a href="#">
                                <small class="text-center">Penarikan</small>
                            </a>
                        </h5>
                    </div>
                @else
                    <div class="col-md-4">
                        <h5 class="mb-3">
                        </h5>
                        <a href="#">
                            <small class="text-muted">Penarikan</small>
                        </a>
                    </div>
                @endrole

            </div>
        </div>
    </div>
</div>
@endsection
