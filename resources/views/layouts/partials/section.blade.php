<div class="nav-scroller bg-white shadow-sm text-center pt-5">
  <nav class="nav nav-underline d-flex justify-content-center pt-1">
      @if (Route::has('login'))

          @auth
              <a href="{{route('home')}}" class="nav-link"> Home </a>
              {{-- mulai role ketua --}}
                  @role('bendahara')
                      <a class="nav-link" href="{{route('pegawai.index')}}">
                          Pegawai
                      </a>
                      <a class="nav-link" href="{{route('anggota.index')}}">Anggota</a>
                  @endrole
              {{-- selesai role ketua --}}
                      <a class="nav-link" href="{{route('loans')}}">Data Pinjaman</a>
                      <a class="nav-link" href="{{route('types.index')}}">Jenis Pinjaman</a>
                      <a class="nav-link" href="{{route('submissions')}}">Pengajuan Pinjaman</a>
                      <a class="nav-link" href="{{route('installments.index')}}">Data Angsuran</a>
                  {{-- start role ketua|bendahara|anggota --}}
                  @role('bendahara|ketua|anggota')
                      <a class="nav-link" href="{{route('savings.anggota')}}">Saldo</a>
                  @endrole
                  {{-- start role ketua|bendahara|anggota --}}
                  @role('bendahara|ketua')
                      <a class="nav-link" href="{{route('transaksi')}}">Pengambilan</a>
                  @endrole
           @endauth
      @endif

  </nav>
</div>