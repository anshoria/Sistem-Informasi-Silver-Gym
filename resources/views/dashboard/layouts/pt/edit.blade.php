@extends('dashboard/layouts/main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Personal Trainer <span class="bi bi-chevron-right fs-5"></span> Edit Personal Trainer <span
                class="bi bi-chevron-right fs-5"></span> {{ $personal_trainer->nama }}</h1>
    </div>
    <div class="elemen-tombol mb-3">
        <a href="/dashboard/personal_trainer" class="btn btn-sm text-light btn-primary bi bi-arrow-return-left"
            style="font-size: 1rem"></a>
        <form action="/dashboard/personal_trainer/{{ $personal_trainer->id }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn bg-danger border-0 text-white btn-md" onclick="return confirm('Apakah anda yakin?')"><span
                    class="bi bi-trash-fill"></span> Hapus</button>
        </form>
    </div>
    <form action="/dashboard/personal_trainer/{{ $personal_trainer->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="col-12 col-xxl-7 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama"
                            class="form-control @error('nama') is-invalid @enderror" value="{{ $personal_trainer->nama }}"
                            required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kategori">Kategori</label>
                        <input type="text" name="kategori" id="kategori"
                            class="form-control @error('kategori') is-invalid @enderror"
                            value="{{ $personal_trainer->kategori }}" required>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nohp">Nomor HP</label>
                        <input type="number" name="nohp" class="form-control @error('nohp') is-invalid @enderror"
                            id="nohp" value="{{ $personal_trainer->nohp }}" required>
                        @error('nohp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto">Foto</label>
                        <input type="hidden" name="oldImage" value="{{ $personal_trainer->foto }}">
                        <input type="file" name="foto" class="mb-3 form-control @error('foto') is-invalid @enderror"
                            onchange="previewImage()" id="foto">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="col col-12 col-sm-6 col-lg-4 col-xxl-3">
                            <div class="card" style="width: 20rem">
                                <img src="{{ asset('storage/' . $personal_trainer->foto) }}" class="img-thumbnail"
                                    alt="Foto-lama" id="preview"
                                    style="height: 24rem;
                                    overflow: hidden;
                                    object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary mb-5" type="submit">Simpan</button>
    </form>
@endsection
