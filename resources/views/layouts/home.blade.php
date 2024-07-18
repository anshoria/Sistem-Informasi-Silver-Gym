@extends('layouts/main')

@section('konten')
    @include('partial/navbar')

    @if (session()->has('Sukses'))
        <div class="alert alert-2 alert-success alert-dismissible fade show mb-3" role="alert">
            <div><span class="text-success bi bi-check-circle-fill"></span> {{ session('Sukses') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session()->has('Logout'))
        <div class="alert alert-2 bg-light alert-dismissible fade show mb-3" role="alert">
            <div><span class="text-primary bi bi-info-circle"></span> {{ session('Logout') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <main>
        @include('layouts/nonmember')
    @endsection