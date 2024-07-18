@extends('layouts/main')
@section('konten')
    @include('partial/navbar-member')
    <div class="text-white py-5 mt-5">
        @if (session()->has('Sukses'))
            <div class="alert alert-2 alert-success alert-dismissible fade show mb-3" role="alert">
                <div class="bi bi-check-lg"> {{ session('Sukses') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="container">
            <div class="card profil-card shadow mb-3">
                <div class="card-body mb-3">
                    <div class="row">
                        <div class="col-xxl-3 col-md-3 col-12">
                            <div class="profil-img mt-4">
                                <img src="/img/profile.png" alt="Preview Foto" id="preview">
                            </div>
                            <div class="text-center text-white mt-3">
                                <p class="my-1">{{ auth()->user()->nama }}</p>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-9 col-12 text-white">
                            <form action="/profil/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="mb-2">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email', auth()->user()->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="nohp">Nomor HP</label>
                                    <input type="number" class="form-control @error('nohp') is-invalid @enderror"
                                        name="nohp" id="nohp" value="{{ old('nohp', auth()->user()->nohp) }}">
                                    @error('nohp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                        name="alamat" id="alamat" value="{{ old('alamat', auth()->user()->alamat) }}">
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-8">
                                        <label for="foto">Foto Profil</label>
                                        <input type="hidden" name="oldImage" value="{{ auth()->user()->gambar }}">
                                        <input type="file" name="gambar" id="foto"
                                            class="form-control @error('gambar') is-invalid @enderror"
                                            onchange="previewImage()">
                                        @error('gambar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <a href="/profil" class="btn btn-sm text-light btn-primary bi bi-arrow-return-left"
                                    style="font-size: 0.7rem"></a>
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
