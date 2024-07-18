@extends('dashboard/layouts/main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Admin <span class="bi bi-chevron-right fs-5"></span> Tambah Admin</h1>
    </div>
    <a href="/dashboard/admin" class="btn btn-sm text-light btn-primary bi bi-arrow-return-left mb-3"
        style="font-size: 1rem"></a>
    <form action="/dashboard/admin" method="post">
        @csrf
        <div class="col-12 col-xxl-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nama">Username</label>
                        <input type="text" name="nama" id="nama"
                            class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nohp">Nomor HP</label>
                        <input type="number" name="nohp" class="form-control @error('nohp') is-invalid @enderror"
                            value="{{ old('nohp') }}" id="nohp" required>
                        @error('nohp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <button class="btn shadow btn-primary" type="submit">Simpan</button>
    </form>
@endsection
