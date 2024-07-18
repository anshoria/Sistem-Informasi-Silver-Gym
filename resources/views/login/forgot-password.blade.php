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
                            @if (session()->has('Gagal'))
                                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                    <div><span class="text-danger bi bi-exclamation-triangle-fill"></span>
                                        {{ session('Gagal') }}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @elseif (session()->has('status'))
                                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                                    <div><span class="text-success bi-check-circle-fill"></span> {{ session('status') }}
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="/forgot-password" method="post">
                                @csrf
                                <div class="form-login mb-3">
                                    <div class="email mb-3">
                                        <label for="email">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="text"
                                            name="email" id="email" value="{{ old('email') }}" autofocus required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn border-merah btn-lg px-5 btn-sm" type="submit">Kirim Link Reset
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
