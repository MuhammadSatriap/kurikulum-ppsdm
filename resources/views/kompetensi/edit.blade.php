@extends('layouts.app')

@section('body')

<div class="container-fluid cstm_con mb-4">
    <ol class="breadcrumb p-3 rounded border">
        <li class="breadcrumb-item">
            <a href="{{ route('index') }}" class="text-dark text-decoration-none">Beranda</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kurikulum.show', $kompetensi->kode_diklat) }}" class="text-dark text-decoration-none">Kurikulum</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kompetensi.show', [$kompetensi->kode_diklat, $kompetensi->kode_kompetensi]) }}" class="text-dark text-decoration-none">Edit Kompetensi</a>
        </li>
    </ol>
</div>


<div class="container mb-4">
    <div class="row mb-4">
        <div class="col">
            <h2>Edit Kompetensi</h2>
        </div>
        <div class="col text-end">
            <div class="button">
                <a href="{{ route('kurikulum.show', $pelatihan->kode_diklat) }}" class="btn btn-warning">Back</a>
            </div>
        </div>
    </div>
    <hr />
</div>

<div class="container">
    <div class="mb-4 rounded bg-white p-4">
        <form action="{{ route('kompetensi.update', ['id_pelatihan' => $pelatihan->kode_diklat, 'kode_kompetensi' => $kompetensi->kode_kompetensi]) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Input untuk kode kompetensi (readonly karena biasanya kode unik tidak diubah) -->
            <div class="mb-3">
                <label for="kode_kompetensi" class="form-label">Kode Kompetensi</label>
                <input type="text" class="form-control" id="kode_kompetensi" name="kode_kompetensi" value="{{ $kompetensi->kode_kompetensi }}" readonly>
            </div>
            <!-- Input untuk judul kompetensi -->
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Kompetensi</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ $kompetensi->judul }}" required>
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
