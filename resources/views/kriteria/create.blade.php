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
            <a href="{{ route('kompetensi.show', [$kompetensi->kode_diklat, $kompetensi->kode_kompetensi]) }}" class="text-dark text-decoration-none">Kompetensi</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kriteria.show', [$pelatihan->kode_diklat, $kompetensi->kode_kompetensi, $elemenkompetensi->kode_elemen]) }}" class="text-dark text-decoration-none">Elemen Kompetensi dan Kriteria</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kriteria.create', [$pelatihan->kode_diklat, $kompetensi->kode_kompetensi, $elemenkompetensi->kode_elemen]) }}" class="text-dark text-decoration-none">Tambah Kriteria</a>
        </li>
    </ol>
</div>

<div class="container mb-4">
    <div class="row mb-2">
        <div class="col">
            <h2>Tambah Kriteria </h2>
        </div>
        <div class="col text-end">
            <div class="button">
                <a href="{{ route('kriteria.show', [$pelatihan->kode_diklat, $kompetensi->kode_kompetensi, $elemenkompetensi->kode_elemen]) }}" class="btn btn-warning">Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <p>Elemen: {{ $elemenkompetensi->judul_elemen }}</p>
    </div>

    <hr />
</div>


<div class="container">
    <div class="mb-4 rounded bg-white p-4">
        <form action="{{ route('kriteria.store', ['id_pelatihan' => $pelatihan->kode_diklat, 'kode_kompetensi' => $kompetensi->kode_kompetensi, 'kode_elemen' => $elemenkompetensi->kode_elemen]) }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="kriteria_kerja">Kriteria Kerja</label>
                <textarea name="kriteria_kerja" id="kriteria_kerja" class="form-control" placeholder="Masukkan kriteria kerja"></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="teori_jp">Teori JP</label>
                <input type="number" step="any" name="teori_jp" id="teori_jp" class="form-control" placeholder="Masukkan teori JP">


            </div>

            <div class="form-group mb-3">
                <label for="praktik_jp">Praktik JP</label>
                <input type="number" step="any" name="praktik_jp" id="praktik_jp" class="form-control" placeholder="Masukkan praktik JP">
            </div>

            <div class="form-group mb-3">
                <label for="media_alat_bahan">Media & Alat Bahan</label>
                <textarea name="media_alat_bahan" id="media_alat_bahan" class="form-control summernote" placeholder="Masukkan media dan alat bahan"></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="elearning_met">Metode Elearning</label>
                <textarea name="elearning_met" id="elearning_met" class="form-control summernote" placeholder="Masukkan metode elearning"></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="klasikal_met">Metode Klasikal</label>
                <textarea name="klasikal_met" id="klasikal_met" class="form-control summernote" placeholder="Masukkan metode klasikal"></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="sikap_pem">Sikap Pemahaman</label>
                <textarea name="sikap_pem" id="sikap_pem" class="form-control summernote" placeholder="Masukkan sikap pemahaman"></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="pengetahuan_pem">Pengetahuan Pemahaman</label>
                <textarea name="pengetahuan_pem" id="pengetahuan_pem" class="form-control summernote" placeholder="Masukkan pengetahuan pemahaman"></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="keterampilan_pem">Keterampilan Pemahaman</label>
                <textarea name="keterampilan_pem" id="keterampilan_pem" class="form-control summernote" placeholder="Masukkan keterampilan pemahaman"></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="indikator">Indikator</label>
                <textarea name="indikator" id="indikator" class="form-control summernote" placeholder="Masukkan indikator"></textarea>
            </div>

            <div class="row">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Simpan Kriteria</button>
                </div>
            </div>

        </form>

    </div>
</div>

@endsection
