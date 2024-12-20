@extends('layouts.app')  <!-- Pastikan Anda menyesuaikan dengan layout yang digunakan -->

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
            <a href="{{ route('kompetensi.show', [$kompetensi->kode_diklat, $kompetensi->kode_kompetensi]) }}" class="text-dark text-decoration-none">Kompetensi</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kriteria.show', [$pelatihan->kode_diklat, $kompetensi->kode_kompetensi, $elemenKode->kode_elemen]) }}" class="text-dark text-decoration-none">Elemen Kompetensi dan Kriteria</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kriteria.edit', [$pelatihan->kode_diklat, $kompetensi->kode_kompetensi, $elemenKode->kode_elemen, $elemenKode->kode_kuk]) }}" class="text-dark text-decoration-none">Edit Kriteria</a>
        </li>
    </ol>
</div>

<div class="container mb-4">
    <div class="row mb-2">
        <div class="col">
            <h2>Edit Kriteria</h2>
        </div>
        <div class="col text-end">
            <div class="button">
                <a href="{{ route('kriteria.show', [$pelatihan->kode_diklat, $kompetensi->kode_kompetensi, $elemenKode->kode_elemen]) }}" class="btn btn-warning">Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <p>Elemen: {{ $elemenKode->elemenkompetensi->judul_elemen }}</p>
    </div>
    <hr />
</div>

<div class="container">
    <div class="mb-4 rounded bg-white p-4">
        <form action="{{ route('kriteria.update', [$pelatihan->kode_diklat, $kompetensi->kode_kompetensi, $elemenKode->kode_elemen, $kriteria->kode_kuk]) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="kode_kuk">Kode KUK</label>
                <input type="text" name="kode_kuk" id="kode_kuk" class="form-control" value="{{ $kriteria->kode_kuk }}">
            </div>

            <div class="form-group mb-3">
                <label for="kriteria_kerja">Kriteria Kerja</label>
                <textarea name="kriteria_kerja" id="kriteria_kerja" class="form-control">{{ $kriteria->kriteria_kerja }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="teori_jp">Teori JP</label>
                <input type="text" name="teori_jp" id="teori_jp" class="form-control" value="{{ $kriteria->teori_jp }}">
            </div>

            <div class="form-group mb-3">
                <label for="praktik_jp">Praktik JP</label>
                <input type="text" name="praktik_jp" id="praktik_jp" class="form-control" value="{{ $kriteria->praktik_jp }}">
            </div>

            <div class="form-group mb-3">
                <label for="media_alat_bahan">Media & Alat Bahan</label>
                <textarea name="media_alat_bahan" id="media_alat_bahan" class="form-control summernote">{{ $kriteria->media_alat_bahan }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="elearning_met">Metode Elearning</label>
                <textarea name="elearning_met" id="elearning_met" class="form-control summernote">{{ $kriteria->elearning_met }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="klasikal_met">Metode Klasikal</label>
                <textarea name="klasikal_met" id="klasikal_met" class="form-control summernote" >{{ $kriteria->klasikal_met }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="sikap_pem">Sikap Pemahaman</label>
                <textarea name="sikap_pem" id="sikap_pem" class="form-control summernote">{{ $kriteria->sikap_pem }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="pengetahuan_pem">Pengetahuan Pemahaman</label>
                <textarea name="pengetahuan_pem" id="pengetahuan_pem" class="form-control summernote">{{ $kriteria->pengetahuan_pem }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="keterampilan_pem">Keterampilan Pemahaman</label>
                <textarea name="keterampilan_pem" id="keterampilan_pem" class="form-control summernote">{{ $kriteria->keterampilan_pem }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="indikator">Indikator</label>
                <textarea name="indikator" id="indikator" class="form-control summernote">{{ $kriteria->indikator }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Kriteria</button>
                <a href="{{ route('kriteria.show', [$pelatihan->kode_diklat, $kompetensi->kode_kompetensi, $elemenKode->kode_elemen, $kriteria->kode_kuk]) }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection
