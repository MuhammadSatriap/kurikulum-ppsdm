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
            <a href="{{ route('kompetensi.create', $pelatihan->kode_diklat) }}" class="text-dark text-decoration-none">Tambah Kompetensi</a>
        </li>
    </ol>
</div>

<div class="container mb-4">
    <div class="row mb-4">
        <div class="col">
            <h2>Tambah Kompetensi</h2>
        </div>
        <div class="col text-end">
            <div class="button">
                <a href="{{ route('kurikulum.show', $pelatihan->kode_diklat) }}" class="btn btn-warning">Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <p>Pelatihan : {{ $pelatihan->judul }}</p>
    </div>
    <hr />
</div>




<div class="container">
    <div class="mb-4 rounded bg-white p-4">
        <form action="{{ route('kompetensi.store', $pelatihan->kode_diklat) }}" method="POST">
            @csrf

            <!-- Input untuk judul kompetensi -->
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Kompetensi</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>

            <!-- Hidden field untuk menyimpan id_pelatihan -->
            <input type="hidden" name="id_pelatihan" value="{{ $pelatihan->kode_diklat }}">
            <div class="row">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Simpan Kompetensi</button>
                </div>
            </div>

        </form>
    </div>
</div>


@endsection
