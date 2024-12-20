@extends('layouts.app')

@section('body')

<div class="container-fluid cstm_con mb-4">
    <ol class="breadcrumb p-3 rounded border">
        <li class="breadcrumb-item">
            <a href="{{ route('index') }}" class="text-dark text-decoration-none">Beranda</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('depan.kurikulum') }}" class="text-dark text-decoration-none">Kurikulum</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kurikulum.edit', $pelatihan->kode_diklat) }}" class="text-dark text-decoration-none">Edit Kurikulum</a>
        </li>
    </ol>
</div>

<div class="container mb-4">
    <div class="row">
        <div class="col">
            <h2 class="mb-0">Edit Kurikulum</h2>
        </div>
        <div class="col text-end">
                <a href="{{ route('depan.kurikulum') }}" class="btn btn-warning">Back</a>
        </div>
    </div>
    <hr />
</div>

<div class="container">
    <div class="mb-4 rounded bg-white p-4">
        <form action="{{ route('kurikulum.update', $pelatihan->kode_diklat) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col mb-3">
                    <label for="kode_diklat" class="form-label">Kode Diklat</label>
                    <input type="text" id="kode_diklat" name="kode_diklat" class="form-control"
                           placeholder="Kode Diklat" value="{{ $pelatihan->kode_diklat }}" required>
                </div>
                <div class="col mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" id="judul" name="judul" class="form-control"
                           placeholder="Judul Pelatihan" value="{{ $pelatihan->judul }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="tujuan" class="form-label">Tujuan</label>
                    <textarea id="tujuan" name="tujuan" class="form-control"
                              placeholder="Tujuan">{{ $pelatihan->tujuan }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="unit_kompetensi" class="form-label">Unit Kompetensi</label>
                    <textarea id="unit_kompetensi" name="unit_kompetensi" class="form-control summernote"
                              placeholder="Unit Lompetensi">{{ $pelatihan->unit_kompetensi }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="prasyarat" class="form-label">Prasyarat</label>
                    <textarea id="prasyarat" name="prasyarat" class="form-control summernote"
                              placeholder="Prasyarat">{{ $pelatihan->prasyarat }}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="total_jp" class="form-label">Total JP</label>
                    <input type="number" id="total_jp" name="total_jp" class="form-control"
                           placeholder="Total JP" value="{{ $pelatihan->total_jp }}" step="0.1">
                </div>
                <div class="col mb-3">
                    <label for="teori_jp" class="form-label">JP Teori</label>
                    <input type="number" id="teori_jp" name="teori_jp" class="form-control"
                           placeholder="JP Teori" value="{{ $pelatihan->teori_jp }}" step="0.1">
                </div>
                <div class="col mb-3">
                    <label for="praktik_jp" class="form-label">JP Praktik</label>
                    <input type="number" id="praktik_jp" name="praktik_jp" class="form-control"
                           placeholder="JP Praktik" value="{{ $pelatihan->praktik_jp }}" step="0.1">
                </div>
            </div>

            <div class="row">
                <div class="d-grid">
                    <button class="btn btn-warning">Update</button>
                </div>
            </div>
        </form>

    </div>


</div>


@endsection
