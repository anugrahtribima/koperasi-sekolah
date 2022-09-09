@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="card shadow border-0">
            <div class="card-body rounded-lg">
              <p class="text-muted text-center mb-5">
                Formulir angsuran peminjaman                
              </p>
              <div class="d-flex justify-content-center">
                <div class="alert alert-info" role="alert">
                  Angsuran atas nama:
                  <strong class="text-danger">
                    {{ $loan->user->name }}
                  </strong>
                </div>
              </div>
              <form action="{{ route('installments.store', $loan->id) }}" method="post">
                @csrf
                <div class="input-group mb-4 shadow-sm">
                  <div class="input-group-prepend">
                    <div class="input-group-text border-0 bg-white">

                    </div>
                  </div>

                  <input type="text" name="jumlah_angsuran" id="jumlah_angsuran" class="form-control border-0 text-muted" value="Rp. {{ number_format($loan->jumlah_angsuran, 2) }}" required>
                  <input type="hidden" name="jumlah_angsuran" class="form-control" value="{{ $loan->jumlah_angsuran }}">
                </div>
                <div class="input-group mb-2 mt-3 shadow-sm">
                  <div class="input-group-prepend">
                    <div class="input-group-text border-0 bg-white">

                    </div>
                  </div>

                  <input type="number" name="angsuran_ke" id="angsuran_ke" class="form-control border-0 text-muted" value="{{ $angsuran_ke }}" required>
                  <input type="hidden" name="angsuran_ke" class="form-control" value="{{ $angsuran_ke }}">
                </div>
                <div class="d-flex justify-content-center pt-3 mb-3">
                  <button type="submit" class="btn btn-white mr-3 shadow-sm">
                    {{ __('Masukkan angsuran') }}
                  </button>

                  <a href="{{ route('installments.index') }}" class="btn btn-warning shadow-sm">{{ __('Cancel') }}</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection