@extends('dashboard/layouts/main')

@section('content')
    @if (session()->has('error'))
        <div class="alert alert-1 alert-danger alert-dismissible fade show mb-3" role="alert">
            <div><span class="text-danger bi bi-exclamation-triangle-fill"></span> {{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Presensi <span class="bi bi-chevron-right fs-5"></span> Tambah Presesnsi</h1>
    </div>
    <a href="/dashboard/presensi" class="btn btn-sm text-light btn-primary bi bi-arrow-return-left mb-3"
        style="font-size: 1rem"></a>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4 col-xxl-3">
            <form action="/dashboard/presensi" method="post">
                @csrf
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nomember">Nomor Member</label>
                            <div class="row">
                                <div class="col-9 col-md-9 col-xxl-9">
                                    <input type="number" name="no_member" id="nomember"
                                        class="form-control @error('no_member') is-invalid @enderror" autofocus required>
                                </div>
                                <div class="col-2 col-md-2 col-xxl-2">
                                    <a href="#" onclick="tampil()" class="btn btn-primary bi bi-card-list"></a>
                                </div>
                            </div>
                            @error('no_member')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button class="btn shadow btn-primary mb-3" type="submit">Simpan</button>
            </form>
        </div>
        <div class="col-12 col-xxl-7 mb-5">
            <div class="hidden card shadow" style="display: none">
                <div class="card-body">
                    <div class="table-responsive mb-3">
                        <table class="table table-stripped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nomor Member</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $member)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $member->no_member }}</td>
                                        <td>{{ $member->nama }}</td>
                                        <td><button class="btn btn-sm btn-primary"
                                                onclick="pilihMember('{{ $member->no_member }}')">Pilih</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function pilihMember(noMember) {
            document.getElementById('nomember').value = noMember;

            var hiddenElement = document.querySelector('.hidden');
            hiddenElement.style.display = 'none';
        }


        function tampil() {

            var hiddenElement = document.querySelector('.hidden');

            if (hiddenElement.style.display === 'none' || hiddenElement.style.display === '') {
                hiddenElement.style.display = 'block';
            } else {
                hiddenElement.style.display = 'none';
            }
        }
    </script>
@endsection
