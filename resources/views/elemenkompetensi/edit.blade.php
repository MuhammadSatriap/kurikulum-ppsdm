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
            <a href="{{ route('elemen_kompetensi.edit', [ $pelatihan->kode_diklat, $kompetensi->kode_kompetensi, $elemenKompetensi->kode_elemen]) }}" class="text-dark text-decoration-none">Tambah Elemen Kompetensi</a>
        </li>
    </ol>
</div>

<div class="container mb-4">
    <div class="row mb-4">
        <div class="col">
            <h2>Edit Elemen Kompetensi</h2>
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
        <form action="{{ route('elemen_kompetensi.update', [$pelatihan->kode_diklat, $kompetensi->kode_kompetensi, $elemenKompetensi->kode_elemen]) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Input Kode Elemen (Readonly) -->
            <div class="mb-3">
                <label for="kode_elemen" class="form-label">Kode Elemen</label>
                <input type="text" class="form-control" id="kode_elemen" name="kode_elemen" value="{{ $elemenKompetensi->kode_elemen }}" readonly>
            </div>

            <div class="mb-3">
                <label for="judul_elemen" class="form-label">Elemen Judul</label>
                <input type="text" class="form-control" id="judul_elemen" name="judul_elemen" value="{{ $elemenKompetensi->judul_elemen }}" >
            </div>


            <!-- Input Teori JP -->
            <div class="mb-3">
                <label for="teori_jp" class="form-label">Teori JP</label>
                <input type="number" class="form-control" id="teori_jp" name="teori_jp" value="{{ $elemenKompetensi->teori_jp }}" required>
            </div>

            <!-- Input Praktik JP -->
            <div class="mb-3">
                <label for="praktik_jp" class="form-label">Praktik JP</label>
                <input type="number" class="form-control" id="praktik_jp" name="praktik_jp" value="{{ $elemenKompetensi->praktik_jp }}" required>
            </div>

            <!-- Tombol Simpan -->
            <div class="d-grid">
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>



@endsection
