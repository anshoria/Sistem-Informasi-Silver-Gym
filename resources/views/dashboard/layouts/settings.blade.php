@extends('dashboard/layouts/main')

@section('content')
    @if (session()->has('Sukses'))
        <div class="alert alert-1 alert-success alert-dismissible fade show mb-3" role="alert">
            <div><span class="text-success bi bi-check-circle-fill"></span> {{ session('Sukses') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session()->has('required'))
        <div class="alert alert-1 alert-danger alert-dismissible fade show mb-3" role="alert">
            <div><span class="text-warning bi bi-exclamation-circle-fill"></span> {{ session('required') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Settings</h1>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <h5>Pricelist</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Masa Aktif</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $pricelist)
                            <tr>
                                <td>{{ $pricelist->nama }}</td>
                                <td>{{ $pricelist->masaaktif }}</td>
                                <td>{{ $pricelist->harga }}</td>
                                <td>{{ $pricelist->keterangan }}</td>
                                <td class="aksi">
                                    <a href="{{ $pricelist->id }}" class="text-success bi bi-pencil-square mx-1"
                                        data-bs-toggle="modal" data-bs-target="#mymodal3{{ $pricelist->id }}"></a>
                                </td>
                            </tr>
                            <!-- modal edit pricelist -->
                            <div class="modal fade" id="mymodal3{{ $pricelist->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content rounded-6 shadow">
                                        <div class="modal-body p-5">
                                            <div class="text-center mb-2">
                                                <span class="bi bi-tags fs-1"></span>
                                            </div>
                                            <form action="/dashboard/settings/edit/{{ $pricelist->id }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="harga mb-2">
                                                    <input type="text"
                                                        class="form-control @error('harga') is-invalid @enderror"
                                                        name="harga" value="{{ $pricelist->harga }}" placeholder="harga">
                                                    @error('harga')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="keterangan mb-2">
                                                    <input type="text"
                                                        class="form-control @error('keterangan') is-invalid @enderror"
                                                        name="keterangan" value="{{ $pricelist->keterangan }}"
                                                        placeholder="keterangan">
                                                    @error('keterangan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-primary mt-3 w-100">Simpan</button>
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

    <div class="card mb-5">
        <div class="card-header">
            <h5>Gallery</h5>
        </div>
        <div class="card-body">
            <div class="tombol-gallery text-center mt-2 mb-3">
                <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#mymodal">Tambah
                    Gambar</a>
                <a href="" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#mymodal2">Hapus</a>

                <!-- modal tambah gallery -->
                <div class="modal fade" id="mymodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md">
                        <div class="modal-content rounded-6 shadow">
                            <div class="modal-body p-5">
                                <div class="text-center mb-2">
                                    <span class="bi bi-images fs-1"></span>
                                </div>
                                <form action="/dashboard/gallery" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="gallery mb-2">
                                        <input type="file" class="form-control @error('gambar.*') is-invalid @enderror"
                                            placeholder="Tambahkan tanggal bergabung" name="gambar[]" required multiple>
                                        @error('gambar.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary mt-3 w-100">Simpan</button>
                                </form>
                                <button type="button" class="btn btn-secondary mt-2 w-100"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal hapus gallery -->
                <div class="modal fade" id="mymodal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content rounded-6 shadow">
                            <div class="modal-body p-5">
                                <div class="text-center mb-2">
                                    <span class="bi bi-images fs-1"></span>
                                </div>
                                <form action="/dashboard/gallery/delete" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="gambar container">
                                        @foreach ($gambar as $gallery)
                                            <div class="box">
                                                <input type="checkbox" class="form-check-input border-dark"
                                                    name="selected_images[]" value="{{ $gallery->id }}">
                                                <img src="{{ asset('storage/Gallery/' . $gallery->gambar) }}"
                                                    alt="gallery">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-danger mt-2 w-100">Hapus yang Dipilih</button>
                                </form>
                                <button type="button" class="btn btn-secondary mt-2 w-100"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="gallery mt-3">
                <div class="gambar container mb-3">
                    @foreach ($gambar as $gallery)
                        <div class="box">
                            <img src="{{ asset('storage/Gallery/' . $gallery->gambar) }}" alt="gallery">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
