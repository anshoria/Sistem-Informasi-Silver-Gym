@extends('dashboard/layouts/main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Notifikasi Member Baru</h1>
    </div>
    {{-- alert eror input --}}
    @if ($errors->any())
        <div class="alert alert-1 alert-danger alert-dismissible fade show mb-3" role="alert">
            <div><span class="text-danger bi bi-exclamation-triangle-fill"></span>
                Data gagal dikonfirmasi.</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- alert --}}
    @if (session()->has('Sukses'))
        <div class="alert alert-1 alert-success alert-dismissible fade show mb-3" role="alert">
            <div><span class="text-success bi bi-check-circle-fill"></span> {{ session('Sukses') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-1 alert-danger alert-dismissible fade show mb-3" role="alert">
            <div><span class="text-danger bi bi-exclamation-triangle-fill"></span>
                {{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-12 col-md-12 col-lg-10 col-xxl-8 mb-5">
        <div class="card shadow mb-5">
            <div class="card-body">
                <div class="table-responsive py-2">
                    <table class="table table-hover table-striped py-2" id="dataTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Daftar</th>
                                <th>Nama</th>
                                <th>Nomor Member</th>
                                <th>Tanggal Bergabung</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unconfirmedUsers as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->FormatTanggal }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>
                                        -
                                    </td>
                                    <td>
                                        -
                                    </td>
                                    <td class="col-3">
                                        <button type="submit" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                            data-bs-target="#mymodal" style="display:inline">Confirm</button>
                                        <form action="/dashboard/notif-member/reject/{{ $user->id }}" method="post"
                                            style="display:inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah anda yakin?')">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- modal pricelist -->
                                <div class="modal fade" id="mymodal" data-bs-backdrop="static" data-bs-keyboard="false"
                                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-md">
                                        <div class="modal-content rounded-6 shadow">
                                            <div class="modal-body p-5">
                                                <div class="text-center mb-2">
                                                    <span class="bi bi-person-fill-add fs-1"></span>
                                                </div>
                                                <form action="/dashboard/notif-member/confirm/{{ $user->id }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="tanggal-bergabung mb-2">
                                                        <input type="date"
                                                            class="form-control @error('tanggal_bergabung') is-invalid @enderror"
                                                            placeholder="Tambahkan tanggal bergabung"
                                                            name="tanggal_bergabung" required>
                                                        @error('tanggal_bergabung')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="nomor-member">
                                                        <input type="number"
                                                            class="form-control @error('no_member') is-invalid @enderror"
                                                            placeholder="Tambahkan nomor member" name="no_member" required>
                                                        @error('no_member')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <button type="submit"
                                                        class="btn btn-sm btn-primary mt-3 w-100">Simpan</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary mt-2 w-100"
                                                    data-bs-dismiss="modal">Close</button>
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
    </div>

    {{-- tombol scrolldown --}}
    <button id="scrollToTopBtn"><span class="bi bi-arrow-up"></span></button>
@endsection
