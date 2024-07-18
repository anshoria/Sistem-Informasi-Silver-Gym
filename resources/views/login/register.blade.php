@extends('layouts/main')
@section('konten')
    @include('partial/navbar')
    <section class="padding-atas pt-3">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="mb-md-3 pt-lg-2 pb-3">
                        <div class="text-center mb-5 mt-5">
                            <img src="/img/logo2.png" width="100" alt="">
                        </div>
                        <form action="/Register" method="post">
                            @csrf
                            <div class="form-register mb-4">
                                <div class="form-floating">
                                    <input class="form-control rounded-top @error('nama') is-invalid @enderror"
                                        type="text" placeholder="Nama" name="nama" id="nama"
                                        value="{{ old('nama') }}" autofocus required>
                                    <label for="nama">Nama</label>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-floating">
                                    <input class="form-control @error('email') is-invalid @enderror" type="email"
                                        placeholder="Email" name="email" id="Email" value="{{ old('email') }}"
                                        required>
                                    <label for="Email">Email</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-floating">
                                    <input class="form-control @error('nohp') is-invalid @enderror" type="number"
                                        placeholder="Nomor HP" name="nohp" id="NomorHP" value="{{ old('nohp') }}"
                                        required>
                                    <label for="NomorHP">Nomor HP</label>
                                    @error('nohp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-floating">
                                    <input class="form-control @error('alamat') is-invalid @enderror" type="text"
                                        placeholder="Alamat" name="alamat" id="Alamat" value="{{ old('alamat') }}"
                                        required>
                                    <label for="Alamat">Alamat</label>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-floating">
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                        placeholder="Password" name="password" id="Password" required>
                                    <label for="Password">Password</label>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-1">
                                    <select
                                        class="form-control rounded-bottom py-3 @error('kategori_id') is-invalid @enderror"
                                        name="kategori_id" id="Kategori" required>
                                        <option selected disabled>Pilih Kategori
                                        </option>
                                        @foreach ($Kategori as $kt)
                                            <option value="{{ $kt->id }}">{{ $kt->nama }}
                                                {{ $kt->masaaktif }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn border-merah btn-lg w-50" type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                    <div class="text-center text-white">
                        <p class="mb-5">Sudah daftar? <a href="/login" class="text-white-50 fw-bold">Login
                            </a>
                        </p>
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection
