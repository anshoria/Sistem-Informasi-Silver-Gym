@extends('layouts/profil')
@section('presensi')
    <div class="table-responsive">
        <table class="table table-dark table-borderless table-striped" id="presensiTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Hari</th>
                    <th>Jam</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($presensi as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->FormatTanggal }}</td>
                        <td>{{ $data->FormatHari }}</td>
                        <td>{{ $data->FormatJam }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
