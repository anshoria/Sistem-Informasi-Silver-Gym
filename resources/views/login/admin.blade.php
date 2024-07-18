@extends('layouts/main')
@section('konten')
    <section class="login-admin">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    @if (session()->has('Gagal'))
                        <div class="alert alert-2 alert-danger alert-dismissible fade show mb-3" role="alert">
                            <div><span class="text-danger bi bi-exclamation-triangle-fill"></span>
                                {{ session('Gagal') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session()->has('Sukses'))
                        <div class="alert alert-2 alert-success alert-dismissible fade show mb-3" role="alert">
                            <div><span class="text-success bi bi-check-lg"></span> {{ session('Sukses') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session()->has('status'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            <div><span class="text-success bi bi-check-lg"></span> {{ session('status') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session()->has('gagal'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            <div><span class="text-success bi bi-check-lg"></span> {{ session('gagal') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h2 class="text-light bi bi-person-gear"> Login Admin</h2>
                        </div>
                        <div class="card-body mb-3">
                            <div class="text-white">
                                <form action="/admin" method="post">
                                    @csrf
                                    <div class="form-login mb-4">
                                        <div class="nama mb-3">
                                            <label for="nama">Username</label>
                                            <input class="form-control @error('nama') is-invalid @enderror" type="text"
                                                name="nama" id="nama" value="{{ old('nama') }}" autofocus
                                                required>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="password mb-3">
                                            <label for="password">Password</label>
                                            <input class="form-control" type="password" name="password" id="password"
                                                required>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn border-merah btn-lg w-50" type="submit">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="small pb-lg-2"><a class="text-white-50" href="/forgot-password">Forgot
                                    password?</a></p>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
