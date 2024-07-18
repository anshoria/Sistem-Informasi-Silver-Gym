@extends('dashboard/layouts/main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Admin</h1>
    </div>
    @if (session()->has('Sukses'))
        <div class="alert alert-1 alert-success alert-dismissible fade show mb-3" role="alert">
            <div><span class="text-success bi bi-check-circle-fill"></span> {{ session('Sukses') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session()->has('error'))
        <div style="width: 400px !important;" class="alert alert-1 alert-danger alert-dismissible fade show mb-3"
            role="alert">
            <div><span class="text-warning bi bi-exclamation-circle"></span> {{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <a href="/dashboard/admin/create" class="btn btn-primary mb-3 btn-sm">Tambah admin</a>
    <div class="card shadow mb-5">
        <div class="card-body">
            <div class="table-responsive py-2">
                <table class="table table-hover table-striped py-2" id="dataTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Nomor HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $admin)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $admin->nama }}</td>
                                <td>{{ $admin->nohp }}</td>
                                <td class="aksi">
                                    <a href="#" class="text-primary bi bi-eye-fill mx-2" data-bs-toggle="modal"
                                        data-bs-target="#mymodal{{ $admin->id }}"></a>
                                    <form action="/dashboard/admin/{{ $admin->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="border-0 bg-transparent text-danger bi bi-trash-fill"
                                            onclick="return confirm('Apakah anda yakin?')"></button>
                                    </form>
                                </td>
                            </tr>
                            <!-- modal -->
                            <div class="modal fade" id="mymodal{{ $admin->id }}" data-bs-backdrop="static"
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
                                                <div class="detail col-12 col-lg-5 col-xxl-5">
                                                    <img src="{{ asset('storage/' . $admin->gambar) }}" alt="Foto-admin"
                                                        class="img-fluid img-thumbnail">
                                                </div>
                                                <div class="col-12 col-lg-7 col-xxl-7">
                                                    <p class="my-0">Username : {{ $admin->nama }}</p>
                                                    <p>Nomor HP : {{ $admin->nohp }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="d-flex gap-1">
                                                <form action="/dashboard/admin/{{ $admin->id }}" method="post"
                                                    class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm bg-danger border-0 text-white"
                                                        onclick="return confirm('Apakah anda yakin?')"><span
                                                            class="bi bi-trash-fill"></span>
                                                        Hapus</button>
                                                </form>
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
