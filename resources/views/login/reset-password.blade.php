@extends('layouts/main')
@section('konten')
    @include('partial/navbar')
    <section class="pt-3">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="text-white" style="border-radius: 1rem;">

                        <div class="mb-md-5 pb-3">

                            <div class="text-center mb-4"><img src="/img/logo2.png" width="150" alt="">
                            </div>
                            @if (session()->has('status'))
                                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                    <div><span class="text-danger bi bi-exclamation-triangle-fill"></span>
                                        {{ session('status') }}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @elseif (session()->has('gagal'))
                                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                    <div><span class="text-danger bi bi-exclamation-triangle-fill"></span>
                                        {{ session('gagal') }}
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="/reset-password" method="post">
                                @csrf
                                <input type="hidden" name="token" value="{{ request()->token }}">
                                <div class="form-login mb-3">
                                    <div class="email mb-3">
                                        <label for="email">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                                            name="email" id="email" value="{{ request()->email }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-login mb-3">
                                    <div class="password mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control @error('password') is-invalid @enderror" type="password"
                                            name="password" id="password" value="{{ old('password') }}" autofocus required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-login mb-3">
                                    <div class="password_confirmation mb-3">
                                        <label for="password_confirmation">Konfirmasi Password</label>
                                        <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                            type="password" name="password_confirmation" id="password_confirmation"
                                            value="{{ old('password_confirmation') }}" required>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn border-merah btn-lg px-5 btn-sm" type="submit">Reset
                                        Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
