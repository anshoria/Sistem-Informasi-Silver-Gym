@extends('dashboard/layouts/main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Personal Trainer <span class="bi bi-chevron-right fs-5"></span> Tambah Personal Trainer</h1>
    </div>
    <a href="/dashboard/personal_trainer" class="btn btn-sm text-light btn-primary bi bi-arrow-return-left mb-3"
        style="font-size: 1rem"></a>
    <form action="/dashboard/personal_trainer" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-12 col-xxl-7 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama"
                            class="form-control @error('nama') is-invalid @enderror" autofocus required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kategori">Kategori</label>
                        <input type="text" name="kategori" id="kategori"
                            class="form-control @error('kategori') is-invalid @enderror" required>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nohp">Nomor HP</label>
                        <input type="number" name="nohp" class="form-control @error('nohp') is-invalid @enderror"
                            id="nohp" required>
                        @error('nohp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror"
                            onchange="previewImage()" id="foto" required>
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="col col-12 col-sm-6 col-lg-4 col-xxl-3 mt-3">
                            <div class="card" style="width: 20rem;">
                                <img class="img-thumbnail" alt="Foto-lama" id="preview"
                                    style="height: 24rem;
                                    overflow: hidden;
                                    object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button class="btn shadow btn-primary mb-5" type="submit">Simpan</button>
    </form>
    <script>
        function previewImage() {
            var input = document.getElementById('foto');
            var preview = document.getElementById('preview');

            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
