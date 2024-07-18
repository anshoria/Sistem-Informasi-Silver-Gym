@extends('layouts/main')
@section('konten')
    @include('partial/navbar')
    <section class="pt-5">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="text-white" style="border-radius: 1rem;">
                        <div class="mb-3 pb-3">
                            <div class="text-center mb-4 mt-5">
                                <img src="/img/logo2.png" width="150" alt="">
                            </div>
                            @if (session()->has('Gagal'))
                                <div class="alert alert-2 alert-danger alert-dismissible fade show mb-3" role="alert">
                                    <div><span class="text-danger bi bi-exclamation-triangle-fill"></span>
                                        {{ session('Gagal') }}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @elseif (session()->has('Sukses'))
                                <div style="width: 350px"
                                    class="alert alert-2 alert-success alert-dismissible fade show mb-3" role="alert">
                                    <div><span class="text-success bi-check-circle-fill"></span> {{ session('Sukses') }}
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @elseif (session()->has('status'))
                                <div style="width: 350px"
                                    class="alert alert-2 alert-success alert-dismissible fade show mb-3" role="alert">
                                    <div><span class="text-success bi-check-circle-fill"></span> {{ session('status') }}
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="/login" method="post">
                                @csrf
                                <div class="form-login mb-4">
                                    <div class="nama mb-3">
                                        <label for="no_member">Nomor Member</label>
                                        <input class="form-control @error('no_member') is-invalid @enderror" type="text"
                                            name="no_member" id="no_member" value="{{ old('no_member') }}" autofocus
                                            required>
                                        @error('no_member')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="password mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" name="password" id="password" required>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn border-merah btn-lg w-50" type="submit">Login</button>
                                </div>
                            </form>
                        </div>

                        <div class="text-center">
                            <p class="small pb-lg-2"><a class="text-white-50" href="/forgot-password">Forgot
                                    password?</a></p>
                            <p class="mb-0">Belum daftar? <a href="/Register" class="text-white-50 fw-bold">Register
                                    Now!</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
