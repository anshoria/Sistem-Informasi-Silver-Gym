@extends('dashboard/layouts/main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Laporan Member</h1>
    </div>

    @if (isset($tanggal_awal) && isset($tanggal_akhir))
        <h3 class="text-muted" id="periodeTanggal">
            Periode langganan member mulai tanggal <b>{{ date('d-m-Y', strtotime($tanggal_awal)) }}</b>
            s/d
            <b>{{ date('d-m-Y', strtotime($tanggal_akhir)) }}</b>
        </h3>
    @else
        <h3 class="text-muted" id="periodeTanggal">
            Periode langganan member mulai tanggal s/d
        </h3>
    @endif

    <div class="card shadow mb-5">
        <div class="card-body">
            <form action="/dashboard/laporan-member" method="post">
                @csrf
                <div class="row mt-2">
                    <div class="col-5 col-xxl-2">
                        <input type="date" class="form-control" name="tanggal_awal" id="tanggalAwal" required>
                    </div>
                    <div class="col-5 col-xxl-2">
                        <input type="date" class="form-control @error('tanggal_akhir') is-invalid @enderror"
                            name="tanggal_akhir" id="tanggalAkhir" required>
                        @error('tanggal_akhir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="tombol-laporan col-12 col-xxl-4">
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-primary btn-sm mt-1" type="submit">
                                Tampilkan
                            </button>
                            <a href="#" class="btn btn-secondary btn-sm bi bi-info-circle mt-1" data-bs-toggle="modal"
                                data-bs-target="#mymodal"> Laporan Member</a>

                            <a href="/dashboard/cetak-member" class="btn btn-success btn-sm bi bi-printer-fill mt-1"
                                target="_blank">
                                Cetak</a>
                        </div>
                    </div>
                </div>
            </form>


            <!-- Modal -->
            <div class="modal fade" id="mymodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Laporan Member</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Total member : <b>{{ $total_user }}</b></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            {{-- tabel --}}
            <div class="table-responsive mb-3 mt-4">
                <table class="table table-hover table-striped py-2" id="dataTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>No Member</th>
                            <th>Nomor HP</th>
                            <th>Alamat</th>
                            <th>Tanggal Bergabung</th>
                            <th>Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $member)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $member->nama }}
                                </td>
                                <td>{{ $member->no_member }}</td>
                                <td>{{ $member->nohp }}</td>
                                <td>{{ $member->alamat }}</td>
                                <td>{{ $member->FormatTanggalMember }}</td>
                                <td>{{ $member->Kategori->masaaktif }}</td>
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
