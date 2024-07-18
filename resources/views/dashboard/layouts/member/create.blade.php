@extends('dashboard/layouts/main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Member <span class="bi bi-chevron-right fs-5"></span> Tambah Member</h1>
    </div>
    <a href="/dashboard/member" class="btn btn-sm text-light btn-primary bi bi-arrow-return-left mb-3"
        style="font-size: 1rem"></a>
    <form action="/dashboard/member" method="post">
        @csrf
        <div class="row">
            <div class="col-12 col-xxl-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="tanggal_bergabung">Mulai Tanggal</label>
                            <input type="date" name="tanggal_bergabung" id="tanggal_bergabung"
                                class="form-control @error('tanggal_bergabung') is-invalid @enderror"
                                value="{{ old('tanggal_bergabung') }}" autofocus required>
                            @error('tanggal_bergabung')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nomember">Nomor member</label>
                            <input type="number" name="no_member" id="nomember"
                                class="form-control @error('no_member') is-invalid @enderror" value="{{ old('no_member') }}"
                                autofocus required>
                            @error('no_member')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama"
                                class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}"
                                required>
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
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                value="{{ old('alamat') }}" id="alamat" required>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kategori">Kategori</label>
                            <select name="kategori_id" id="kategori"
                                class="form-control @error('kategori_id') is-invalid @enderror" required>
                                @foreach ($kategori as $kt)
                                    @if (old('kategori_id') == $kt->id)
                                        <option value="{{ $kt->id }}" selected>{{ $kt->nama }}
                                            {{ $kt->masaaktif }}</option>
                                    @else
                                        <option value="{{ $kt->id }}">{{ $kt->nama }} {{ $kt->masaaktif }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xxl-6">
                <div class="card mb-2">
                    <div class="card-body">
                        <h4>Buat Akun Member</h4>
                        <hr>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn shadow btn-primary mb-5" type="submit">Simpan</button>
    </form>
@endsection
