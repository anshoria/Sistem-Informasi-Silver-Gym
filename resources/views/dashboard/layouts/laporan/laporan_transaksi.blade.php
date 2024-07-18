@extends('dashboard/layouts/main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Laporan Transaksi</h1>
    </div>

    @if (isset($tanggal_awal) && isset($tanggal_akhir))
        <h3 class="text-muted" id="periodeTanggal">
            Periode Tanggal <b>{{ date('d-m-Y', strtotime($tanggal_awal)) }}</b> s/d
            <b>{{ date('d-m-Y', strtotime($tanggal_akhir)) }}</b>
        </h3>
    @else
        <h3 class="text-muted" id="periodeTanggal">
            Periode Tanggal s/d
        </h3>
    @endif

    <div class="card shadow mb-5">
        <div class="card-body">
            <form action="/dashboard/laporan-transaksi" method="post">
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
                                data-bs-target="#mymodal"> Laporan transaksi</a>
                            <a href="/dashboard/cetak-transaksi" class="btn btn-success btn-sm bi bi-printer-fill mt-1"
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Laporan Transaksi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Total transaksi : <b>Rp {{ $formatted_total_harga }}</b></p>
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
                            <th>Tanggal</th>
                            <th>Nama Transaksi</th>
                            <th>Nomor Member</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
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
