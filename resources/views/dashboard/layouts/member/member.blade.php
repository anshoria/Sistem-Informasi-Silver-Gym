@extends('dashboard/layouts/main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Member</h1>
    </div>
    @if (session()->has('Sukses'))
        <div class="alert alert-1 alert-success alert-dismissible fade show mb-3" role="alert">
            <div><span class="text-success bi bi-check-circle-fill"></span> {{ session('Sukses') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <a href="/dashboard/member/create" class="btn btn-primary mb-3 btn-sm">Tambah member</a>
    @if (session()->has('alert'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            <div><span class="text-warning bi bi-exclamation-triangle"></span> {{ session('alert') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card shadow mb-5">
        <div class="card-body">
            <div class="table-responsive py-2">
                <table class="table table-hover table-striped py-2" id="dataTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>No Member</th>
                            <th>Nomor HP</th>
                            <th>Alamat</th>
                            <th>Mulai Tanggal</th>
                            <th>Tanggal Berakhir</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $member)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($member->password == null)
                                        {{ $member->nama }}<span class="text-danger">*</span>
                                    @else
                                        {{ $member->nama }}
                                    @endif
                                </td>
                                <td>{{ $member->no_member }}</td>
                                <td>{{ $member->nohp }}</td>
                                <td>{{ $member->alamat }}</td>
                                <td>{{ $member->FormatTanggalMember }}</td>
                                <td>{{ $member->FormatTanggalBerakhir }}</td>
                                <td>{{ $member->Kategori->masaaktif }}</td>
                                <td class="aksi">
                                    <a href="#" class="text-primary bi bi-eye-fill mx-2" data-bs-toggle="modal"
                                        data-bs-target="#mymodal{{ $member->id }}"></a>
                                    <a href="/dashboard/member/{{ $member->id }}/edit"
                                        class="text-success bi bi-pencil-square mx-1"></a>
                                    <form action="/dashboard/member/{{ $member->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="border-0 bg-transparent text-danger bi bi-trash-fill"
                                            onclick="return confirm('Apakah anda yakin?')"></button>
                                    </form>
                                </td>
                            </tr>
                            <!-- modal -->
                            <div class="modal fade" id="mymodal{{ $member->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content rounded-6 shadow">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($member->password == null)
                                                <div class="alert alert-light alert-dismissible fade show mb-3"
                                                    role="alert">
                                                    <div><span class="text-warning bi bi-exclamation-circle"></span>
                                                        {{ $member->nama }} belum mempunyai akun</div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif
                                            <div class="row">
                                                <div class="detail col-12 col-lg-4 col-xxl-4">
                                                    <img src="{{ asset('storage/' . $member->gambar) }}" alt="Foto-member"
                                                        class="img-fluid img-thumbnail">
                                                </div>
                                                <div class="col-12 col-lg-8 col-xxl-8">
                                                    <div class="card shadow">
                                                        <div class="card-body">
                                                            <p class="my-1">Nama : {{ $member->nama }}</p>
                                                            <p class="my-1">Nomor Member : {{ $member->no_member }}</p>
                                                            @if ($member->email == null)
                                                                <p class="my-1">Email : <i class="text-secondary">Tidak
                                                                        ada
                                                                        data</i></p>
                                                            @else
                                                                <p class="my-1">Email : {{ $member->email }}</p>
                                                            @endif
                                                            <p class="my-1">Nomor HP : {{ $member->nohp }}</p>
                                                            <p class="my-1">Alamat : {{ $member->alamat }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="card shadow">
                                                        <div class="card-body">
                                                            <p class="my-1">Kategori : {{ $member->Kategori->nama }}
                                                                {{ $member->Kategori->masaaktif }}
                                                            </p>
                                                            <p class="my-1">Mulai tanggal
                                                                {{ $member->FormatTanggalMember }} sampai
                                                                @if ($member->tanggal_berakhir == null)
                                                                    -
                                                                @else
                                                                    {{ $member->FormatTanggalBerakhir }}
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="card shadow">
                                                        <div class="card-body">
                                                            <p class="my-1">Bergabung menjadi member mulai tanggal
                                                                {{ $member->FormatTanggal }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="d-flex gap-1">
                                                <form action="/dashboard/member/{{ $member->id }}" method="post"
                                                    class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm bg-danger border-0 text-white"
                                                        onclick="return confirm('Apakah anda yakin?')"><span
                                                            class="bi bi-trash-fill"></span>
                                                        Hapus</button>
                                                </form>
                                                <a href="/dashboard/member/{{ $member->id }}/edit"
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
