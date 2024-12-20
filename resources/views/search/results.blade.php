@extends('layouts.app')

@section('body')

<div class="container-fluid cstm_con mb-4">
    <ol class="breadcrumb p-3 rounded border">
        <li class="breadcrumb-item">
            <a href="{{ route('index') }}" class="text-dark text-decoration-none">Beranda</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('index') }}" class="text-dark text-decoration-none">Hasil Pencarian</a>
        </li>
    </ol>
</div>




<div class="container">
    <!-- Header -->
    <div class="col text-center mb-4">
        <h1 class="fw-bold">Hasil Pencarian</h1>
    </div>

    <!-- Search Bar -->
    <div class="search-bar bg-light p-4 rounded shadow-sm d-flex align-items-center">
        <form method="GET" action="{{ route('search') }}" class="d-flex w-100">
            <input type="text"
                   name="query"
                   class="form-control me-3"
                   placeholder="{{ request('query') ? request('query') : 'Keyword: [Kode Diklat] [Judul] [Kompetensi] [Elemen Kompetensi]' }}"
                   style="height: 50px; font-size: 1.2rem; font-weight: 300; font-style: italic;">
            <button type="submit" class="btn btn-outline-light ms-2" style="height: 50px; font-size: 1.2rem;">🔍</button>
        </form>
    </div>

    <!-- Divider -->
    <hr class="my-4">
</div>




<div class="container">


    <!-- Tabel Kurikulum -->
    <div class="bg-white rounded p-3 mb-4">
        <div class="container mb-3">
            <h2>Kurikulum</h2>
        </div>
        <div class="container">
            <div class="table-responsive rounded">
                <table class="table table-bordered">
                    <thead class="table-active">
                        <tr>
                            <th style="width: 20%;">Kode Diklat</th>
                            <th style="width: 65%;">Judul</th>
                            <th style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelatihan as $item)
                            <tr>
                                <td>{{ $item->kode_diklat }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>
                                <a href="{{ route('kurikulum.show', $item->kode_diklat) }} " class="text-dark text-decoration-none" >
                                Lihat Detail
                                </a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data untuk Pelatihan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <!-- Tabel Kompetensi -->
    <div class="bg-white rounded p-3 mb-4">
        <div class="container mb-3">
            <h2>Kompetensi</h2>
        </div>
        <div class="container">
            <div class="table-responsive rounded">
                <table class="table table-bordered">
                    <thead class="table-active">
                        <tr>
                            <th>Kode Diklat</th>
                            <th>Kode Kompetensi</th>
                            <th style="width: 60%">Judul</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kompetensi as $item)
                            <tr>
                                <td>{{ $item->kode_diklat }}</td>
                                <td>{{ $item->kode_kompetensi }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>
                                    <a href="{{ route('kompetensi.show', [$item->kode_diklat , $item->kode_kompetensi]) }} " class="text-dark text-decoration-none" >
                                    Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data untuk Kompetensi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Tabel Elemen Kompetensi -->
    <div class="bg-white rounded p-3 mb-4">
        <div class="container mb-3">
            <h2>Elemen Kompetensi</h2>
        </div>
        <div class="container">
            <div class="table-responsive rounded">
                <table class="table table-bordered">
                    <thead class="table-active">
                        <tr>
                            <th>Kode Elemen</th>
                            <th>Judul Elemen</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($elemenKompetensi as $item)
                            <tr>
                                <td>{{ $item->kode_elemen }}</td>
                                <td>{{ $item->judul_elemen }}</td>
                                <td>
                                    <a href="{{ route('kriteria.show', [$item->pelatihan->kode_diklat , $item->kode_kompetensi, $item->kode_elemen]) }} " class="text-dark text-decoration-none" >
                                        Lihat Detail
                                        </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">Tidak ada data untuk Elemen Kompetensi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Tombol Kembali -->
    <a href="{{ route('index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>


@endsection
