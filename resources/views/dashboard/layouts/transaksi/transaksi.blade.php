@extends('dashboard/layouts/main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Transaksi</h1>
    </div>
    @if (session()->has('Sukses'))
        <div class="alert alert-1 alert-success alert-dismissible fade show mb-3" role="alert">
            <div><span class="text-success bi bi-check-circle-fill"></span> {{ session('Sukses') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <a href="/dashboard/transaksi/create" class="btn btn-primary mb-3 btn-sm">Tambah transaksi</a>
    <div class="card shadow mb-5">
        <div class="card-body">
            <div class="table-responsive py-2">
                <table class="table table-hover table-striped py-2" id="dataTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nama Transaksi</th>
                            <th>Nomor Member</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $beli)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $beli->formatTanggal }}</td>
                                <td>{{ $beli->nama_transaksi }}</td>
                                @if ($beli->no_member == null)
                                    <td><i class="text-secunder">-</i></td>
                                @else
                                    <td>{{ $beli->no_member }}</td>
                                @endif
                                @if (optional($beli->User)->nama == null)
                                    <td><i class="text-secunder">-</i></td>
                                @else
                                    <td>{{ optional($beli->User)->nama }}</td>
                                @endif
                                <td>{{ $beli->kategori }}</td>
                                <td>Rp {{ number_format($beli->harga, 0, ',', '.') }}</td>
                                <td class="aksi">
                                    <a href="/dashboard/transaksi/{{ $beli->id }}/edit"
                                        class="text-success bi bi-pencil-square mx-1"></a>
                                    <form action="/dashboard/transaksi/{{ $beli->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="border-0 bg-transparent text-danger bi bi-trash-fill"
                                            onclick="return confirm('Apakah anda yakin?')"></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- tombol scrolldown --}}
    <button id="scrollToTopBtn"><span class="bi bi-arrow-up"></span></button>
@endsection
