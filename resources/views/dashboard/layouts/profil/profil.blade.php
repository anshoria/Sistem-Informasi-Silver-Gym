@extends('dashboard/layouts/main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Profil</h1>
    </div>
    {{-- alert eror input --}}
    @if ($errors->any())
        <div class="alert alert-1 alert-danger alert-dismissible fade show mb-3" role="alert">
            <div><span class="text-danger bi bi-exclamation-triangle-fill"></span>
                Data gagal diubah.</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- alert --}}
    @if (session()->has('Sukses'))
        <div class="alert alert-1 alert-success alert-dismissible fade show mb-3" role="alert">
            <div><span class="text-success bi bi-check-circle-fill"></span> {{ session('Sukses') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-xxl-7">
        @if (!auth()->user()->email)
            <div class="alert alert-light alert-dismissible fade show mb-3" role="alert">
                <div><span class="text-warning bi bi-exclamation-circle"></span> Lengkapi data diri.</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="card col-xxl-7">
        <div class="card-body">
            <div class="row py-3">
                <div class="profil-admin-tengah d-flex align-items-center">
                    <div class="col-xxl-4 col-md-3 col-12">
                        <div class="profil-img">
                            @if (auth()->user()->gambar)
                                <img src="{{ asset('storage/' . auth()->user()->gambar) }}" alt="" class="">
                            @else
                                <img src="/img/profile.png" alt="" class="">
                            @endif
                        </div>
                    </div>
                    <div class="col-xxl-8 col-md-9 col-12">
                        <p class="my-2">Username : {{ auth()->user()->nama }}</p>
                        <p class="my-2">Nomor HP : {{ auth()->user()->nohp }}</p>
                        <p class="my-2">Email : {{ auth()->user()->email }}</p>
                        <div class="mt-3">
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#mymodal{{ auth()->user()->id }}">Edit
                                Profil</a>
                            <a href="/dashboard/ubah-password" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#mymodal2">Ubah
                                Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal edit profil -->
    <div class="modal fade" id="mymodal{{ auth()->user()->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content rounded-6 shadow">
                <div class="modal-body p-5">
                    <div class="profil-img">
                        <img src="/img/profile.png" alt="Preview Foto" id="preview">
                    </div>
                    <form action="/dashboard/profil/{{ auth()->user()->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="Nama">Username</label>
                            <input id="Nama" name="nama" type="text"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', auth()->user()->nama) }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nohp">Nomor HP</label>
                            <input type="number" name="nohp" id="nohp"
                                class="form-control @error('nohp') is-invalid @enderror"
                                value="{{ old('nohp', auth()->user()->nohp) }}">
                            @error('nohp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', auth()->user()->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="foto">Foto Profil</label>
                            <input type="hidden" name="oldImage" value="{{ auth()->user()->gambar }}">
                            <input type="file" name="gambar" id="foto"
                                class="form-control @error('gambar') is-invalid @enderror" onchange="previewImage()">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-2 w-100">Simpan</button>
                    </form>
                    <button type="button" class="btn btn-secondary mt-2 w-100" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal ubah password -->
    <div class="modal fade" id="mymodal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content rounded-6 shadow">
                <div class="modal-body p-5">
                    <div class="text-center mb-2">
                        <span class="bi bi-key fs-1"></span>
                    </div>
                    <form action="/dashboard/update-password" method="post">
                        @csrf
                        @method('put')
                        <div class="py-3">
                            <div class="mb-1">
                                <label for="password_lama">Password Lama</label>
                                <input type="password" name="password_lama" id=""
                                    class="form-control @error('password_lama') is-invalid @enderror" required>
                                @error('password_lama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="password">Password Baru</label>
                                <input type="password" name="password" id=""
                                    class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="password_confirmation">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" id=""
                                    class="form-control @error('password_confirmation') is-invalid @enderror" required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2 w-100">Simpan</button>
                    </form>
                    <button type="button" class="btn btn-secondary mt-2 w-100" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
