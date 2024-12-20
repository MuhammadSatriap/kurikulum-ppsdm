@extends('layouts.app')

@section('body')

<div class="container-fluid cstm_con mb-4">
    <ol class="breadcrumb p-3 rounded border">
        <li class="breadcrumb-item">
            <a href="{{ route('index') }}" class="text-dark text-decoration-none">Beranda</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kurikulum.show', $pelatihan->kode_diklat) }}" class="text-dark text-decoration-none">Kurikulum</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kompetensi.show', [$kompetensi->kode_diklat, $kompetensi->kode_kompetensi]) }}" class="text-dark text-decoration-none">Kompetensi</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kompetensi.create', $pelatihan->kode_diklat) }}" class="text-dark text-decoration-none">Tambah Elemen Kompetensi</a>
        </li>
    </ol>
</div>

<div class="container mb-4">
    <div class="row mb-4">
        <div class="col">
           <h2>Tambah Elemen Kompetensi</h2>
        </div>
        <div class="col text-end">
            <div class="button">
                <a href="{{ route('kompetensi.show', [$kompetensi->kode_diklat, $kompetensi->kode_kompetensi]) }}" class="btn btn-warning">Back</a>
            </div>
        </div>
    </div>
    <hr />
</div>

<div class="container">
    <div class="mb-4 rounded bg-white p-4">
        <form action="{{ route('elemen_kompetensi.store', [$pelatihan->kode_diklat, $kompetensi->kode_kompetensi]) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="judul_elemen" class="form-label">Judul Elemen</label>
                <input type="text" class="form-control" id="judul_elemen" name="judul_elemen" required>
            </div>

            <!-- Input untuk teori_jp -->
            <div class="mb-3">
                <label for="teori_jp" class="form-label">Teori JP</label>
                <input type="number" class="form-control" id="teori_jp" name="teori_jp" step="any" required>
            </div>

            <!-- Input untuk praktik_jp -->
            <div class="mb-3">
                <label for="praktik_jp" class="form-label">Praktik JP</label>
                <input type="number" class="form-control" id="praktik_jp" name="praktik_jp" step="any" required>
            </div>

            <!-- Submit Button -->
            <div class="row">
                <div class="d-grid">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
