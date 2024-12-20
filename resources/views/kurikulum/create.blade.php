
@extends('layouts.app')

@section('body')

<div class="container-fluid cstm_con mb-4">
    <ol class="breadcrumb p-3 rounded border">
        <li class="breadcrumb-item">
            <a href="{{ route('index') }}" class="text-dark text-decoration-none">Beranda</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kurikulum.create') }}" class="text-dark text-decoration-none">Tambah Kurikulum</a>
        </li>
    </ol>
</div>

<div class="container mb-4">
    <div class="row mb-4">
        <div class="col">
            <h2 class="mb-0">Tambah Kurikulum</h2>
        </div>
        <div class="col text-end">
            <div class="button">
                <a href="{{ route('index') }}" class="btn btn-warning">Back</a>
            </div>
        </div>
    </div>
    <hr />
</div>

<div class="container">
    <div class="mb-4 rounded bg-white p-4">
        <form action="{{ route('kurikulum.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col mb-3">
                    <label for="kode_diklat" class="form-label"> Kode Diklat</label>
                    <input type="text" name="kode_diklat" class="form-control" placeholder="Kode Diklat" required>
                </div>
                <div class="col">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" placeholder="Judul" required>
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="tujuan" class="form-label"> Tujuan</label>
                    <textarea name="tujuan" class="form-control" placeholder="Tujuan" rows="3" required></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="unit_kompetensi" class="form-label">Unit Kompetensi</label>
                    <textarea name="unit_kompetensi" class="form-control summernote" placeholder="Unit Kompetensi" rows="3" required></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="prasyarat" class="form-label">Prasyarat</label>
                    <textarea name="prasyarat" class="form-control summernote" placeholder="Prasyarat" rows="3" required></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="total_jp" class="form-label">Total JP</label>
                    <input type="number" step="0.01" name="total_jp" class="form-control" placeholder="Total JP" required>
                </div>
                <div class="col mb-3">
                    <label for="teori_jp" class="form-label">Teori JP</label>
                    <input type="number" step="0.01" name="teori_jp" class="form-control" placeholder="Teori JP" required>
                </div>
                <div class="col mb-3">
                    <label for="praktik_jp" class="form-label">JP Praktik</label>
                    <input type="number" step="0.01" name="praktik_jp" class="form-control" placeholder="Praktik JP" required>
                </div>
            </div>

            <div class="row">
                <div class="d-grid">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>



@endsection
