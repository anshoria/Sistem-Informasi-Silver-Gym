@extends('dashboard/layouts/main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Presensi</h1>
    </div>
    @if (session()->has('Sukses'))
        <div class="alert alert-1 alert-success alert-dismissible fade show mb-3" role="alert">
            <div><span class="text-success bi bi-check-circle-fill"></span> {{ session('Sukses') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <a href="/dashboard/presensi/create" class="btn btn-primary mb-3 btn-sm">Tambah Presesnsi</a>
    <div class="card shadow mb-5">
        <div class="card-body">
            <div class="table-responsive py-2">
                <table class="table table-hover table-striped py-2" id="dataTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>No Member</th>
                            <th>Nama</th>
                            <th>Jam</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presensi as $kehadiran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kehadiran->no_member }}</td>
                                <td>{{ optional($kehadiran->User)->nama }}</td>
                                <td>{{ $kehadiran->formatJam }}</td>
                                <td>{{ $kehadiran->formatTanggal }}</td>
                                <td class="aksi">
                                    <form action="/dashboard/presensi/{{ $kehadiran->id }}" method="post" class="d-inline">
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
