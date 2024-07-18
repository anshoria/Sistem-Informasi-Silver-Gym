@extends('layouts/main')
@section('konten')
    @include('partial/navbar-member')
    <div class="py-5 mt-5">
        @if (session()->has('Sukses'))
            <div class="alert alert-2  alert-success alert-dismissible fade show mb-3" role="alert">
                <div class="bi bi-check-circle-fill"> {{ session('Sukses') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="container">
            <div class="card profil-card shadow mb-1">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl-3 col-md-3 col-12">
                            <div class="profil-img mt-4">
                                @if (auth()->user()->gambar)
                                    <img src="{{ asset('storage/' . auth()->user()->gambar) }}" alt=""
                                        class="">
                                @else
                                    <img src="/img/profile.png" alt="" class="">
                                @endif
                            </div>
                            <div class="text-center text-white mt-3">
                                <p class="my-1">{{ auth()->user()->nama }}</p>
                                <a href="/profil/{{ auth()->user()->id }}/edit" class="btn btn-primary btn-sm mt-1">Edit
                                    Profil</a>
                            </div>
                        </div>
                        <div class="col-xxl-8 col-md-8 col-12 mt-3 text-white">
                            @if (!auth()->user()->email)
                                <div class="alert alert-light alert-dismissible fade show mb-3" role="alert">
                                    <div><span class="text-warning bi bi-exclamation-circle"></span> Lengkapi data diri.
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="card mb-1">
                                <div class="card-body text-white">
                                    @if (auth()->user()->no_member == null)
                                        <p class="my-1">Nomor Member : <i class="text-secondary">Nomor member belum
                                                terdaftar</i></p>
                                    @else
                                        <p class="my-1">Nomor Member : {{ auth()->user()->no_member }}</p>
                                    @endif
                                    <p class="my-1">Email : {{ auth()->user()->email }}</p>
                                    <p class="my-1">Nomor HP : {{ auth()->user()->nohp }}</p>
                                    <p class="my-1">Alamat : {{ auth()->user()->alamat }}</p>
                                </div>
                            </div>
                            <div class="card mb-1">
                                <div class="card-body text-white">
                                    <p class="my-1">Kategori : {{ auth()->user()->Kategori->nama }}
                                        {{ auth()->user()->Kategori->masaaktif }}</p>
                                    <p class="my-1">Mulai tanggal
                                        {{ auth()->user()->FormatTanggalMember }}
                                        sampai
                                        @if (auth()->user()->tanggal_berakhir == null)
                                            -
                                        @else
                                            {{ auth()->user()->FormatTanggalBerakhir }}
                                        @endif
                                    </p>
                                    @if (session()->has('info_hari'))
                                        <div class="alert border-merah alert-dismissible fade show mb-3" role="alert">
                                            <div class=""><span
                                                    class="bi text-warning bi-exclamation-triangle"></span>
                                                {{ session('info_hari') }}</div>
                                            <button type="button" class="btn-close bg-danger" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card mb-1">
                                <div class="card-body">
                                    <h6 class="text-white">Menjadi member mulai tanggal
                                        {{ auth()->user()->FormatTanggal }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow">
                {{-- <div class="card-header text-center" style="background-color:inherit"><span
                        class="text-light">Presensi</span></div> --}}
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <a href="/presensi-minggu"
                                class="presensi {{ Request::is('presensi-minggu') ? 'active' : '' }} btn btn-outline-danger">Minggu
                                ini</a>

                            <a href="/presensi-bulan"
                                class="presensi {{ Request::is('presensi-bulan') ? 'active' : '' }} btn btn-outline-danger">Bulan
                                ini</a>

                            <a href="/presensi-tahun"
                                class="presensi {{ Request::is('presensi-tahun') ? 'active' : '' }} btn btn-outline-danger">Tahun
                                ini</a>

                            <a href="/presensi-semua"
                                class="presensi {{ Request::is('presensi-semua') ? 'active' : '' }} btn btn-outline-danger">Semua</a>
                        </div>
                        {{-- <canvas id="gymProgressChart" width="400" height="200"></canvas> --}}
                    </div>
                    <div class="card bg-dark">
                        <div class="card-body">
                            @yield('presensi')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
