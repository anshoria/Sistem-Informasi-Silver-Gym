<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silver Gym</title>
    <link rel="icon" href="/img/logo3.png" type="image/x-icon">
    <!-- bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- My Style CSS -->
    <link rel="stylesheet" href="/css/style2.css">


</head>

<body>
    <div class="mx-3">
        <h1 class="text-center mt-4 mb-3">Laporan Member</h1>
        <h6 class="text-muted" id="periodeTanggal">Periode Tanggal s/d
            <b>{{ date('d-m-Y', strtotime($tanggal_awal)) }}</b>
            s/d <b>{{ date('d-m-Y', strtotime($tanggal_akhir)) }}</b>
        </h6>
        <h6>Total Member : {{ $total_user }}</h6>

        {{-- tabel --}}
        <div class="table-responsive mb-5 mt-3">
            <table class="table table-bordered border-dark py-2" id="dataTable">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<script type="text/javascript">
    window.print();
</script>
