@extends('dashboard/layouts/main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Personal Trainer</h1>
    </div>
    @if (session()->has('Sukses'))
        <div class="alert alert-1 alert-success alert-dismissible fade show mb-3" role="alert">
            <div><span class="text-success bi bi-check-circle-fill"></span> {{ session('Sukses') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <a href="/dashboard/personal_trainer/create" class="btn btn-primary mb-3 btn-sm">Tambah Personal Trainer</a>
    <div class="card shadow mb-5">
        <div class="card-body">
            <div class="table-responsive py-2">
                <table class="table table-hover table-striped py-2" id="dataTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Nomor HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personal_trainer as $pt)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pt->nama }}</td>
                                <td>{{ $pt->kategori }}</td>
                                <td>{{ $pt->nohp }}</td>
                                <td class="aksi">
                                    <a href="#" class="text-primary bi bi-eye-fill mx-2" data-bs-toggle="modal"
                                        data-bs-target="#mymodal{{ $pt->id }}"></a>
                                    <a href="/dashboard/personal_trainer/{{ $pt->id }}/edit"
                                        class="text-success bi bi-pencil-square mx-1"></a>
                                    <form action="/dashboard/personal_trainer/{{ $pt->id }}" method="post"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="border-0 bg-transparent text-danger bi bi-trash-fill"
                                            onclick="return confirm('Apakah anda yakin?')"></button>
                                    </form>
                                </td>
                            </tr>
                            <!-- modal -->
                            <div class="modal fade" id="mymodal{{ $pt->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content rounded-6 shadow">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="detail col-12 col-lg-6 col-xxl-6">
                                                    <img src="{{ asset('storage/' . $pt->foto) }}"
                                                        alt="Foto-personal-trainer" class="img-fluid img-thumbnail">
                                                </div>
                                                <div class="col-12 col-lg-6 col-xxl-6">
                                                    <p>Nama : {{ $pt->nama }}</p>
                                                    <p>Kategori : {{ $pt->kategori }}</p>
                                                    <p>Nomor HP : {{ $pt->nohp }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="d-flex gap-1">
                                                <form action="/dashboard/personal_trainer/{{ $pt->id }}"
                                                    method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm bg-danger border-0 text-white"
                                                        onclick="return confirm('Apakah anda yakin?')"><span
                                                            class="bi bi-trash-fill"></span>
                                                        Hapus</button>
                                                </form>
                                                <a href="/dashboard/personal_trainer/{{ $pt->id }}/edit"
                                                    class="btn btn-sm btn-success"><span class="bi bi-pencil-square"></span>
                                                    Edit
                                                </a>
                                                <button type="button" class="btn btn-sm btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- tombol scrolldown --}}
    <button id="scrollToTopBtn"><span class="bi bi-arrow-up"></span></button>
@endsection
