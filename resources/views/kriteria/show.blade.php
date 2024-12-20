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
    </ol>
</div>


<!-- Header dengan Judul dan Tombol Kembali -->
<div class="container mb-4">
    <div class="row">
        <div class="col">
            <h2>Elemen Kompetensi</h2>
        </div>
        <div class="col text-end">
            <a href="{{ route('kompetensi.show', [$pelatihan->kode_diklat, $kompetensi->kode_kompetensi]) }}" class="btn btn-warning">Back</a>
        </div>
    </div>
    <hr />
</div>



<!-- Detail Pelatihan dan Kompetensi -->
<div class="container mb-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Detail</h5>
        </div>
        <div class="card-body">
            <p><strong>Kode Pelatihan:</strong> {{ $pelatihan->kode_diklat }}</p>
            <p><strong>Judul Pelatihan:</strong> {{ $pelatihan->judul }}</p>

            <hr>

            <p><strong>Judul Kompetensi:</strong> {{ $kompetensi->judul }}</p>
            <p><strong>Judul Elemen Kompetensi:</strong> {{ $elemenkompetensi->judul_elemen }}</p>

            <hr>

            <p><strong>Waktu:</strong></p>
            <p><strong>Teori:</strong> {{ $elemenkompetensi->teori_jp }} jam</p>
            <p><strong>Praktik:</strong> {{ $elemenkompetensi->praktik_jp }} jam</p>
        </div>
    </div>
</div>
<div class="container">
    <hr />
</div>


<!-- Tabel Kriteria -->
<div class="container mb-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Kriteria Untuk Kerja</h4>
            <a href="{{ route('kriteria.create', [$pelatihan, $kompetensi, $elemenkompetensi]) }}" class="btn btn-primary">Tambah Kriteria</a>
        </div>

        <div class="card-body">
            <div class="table">
                <table class="table table-bordered text-center" style="max-width: 100%; font-size: 14px;">
                    <thead>
                        <tr>
                            <th rowspan="2" style="width: 5%;">No</th>
                            <th rowspan="2" style="width: 20%;">Kriteria Unjuk Kerja</th>
                            <th colspan="2" style="width: 10%;">Waktu (JP)</th>
                            <th rowspan="2" style="width: 15%;">Media, Alat dan Bahan</th>
                            <th colspan="2" style="width: 10%;">Metode</th>
                            <th colspan="3" style="width: 15%;">Pembelajaran</th>
                            <th rowspan="2" style="width: 15%;">Indikator Keberhasilan</th>
                            <th rowspan="2" style="width: 10%;">Action</th>
                        </tr>
                        <tr>
                            <th style="width: 5%;">T</th>
                            <th style="width: 5%;">P</th>
                            <th style="width: 5%;">E Learning</th>
                            <th style="width: 5%;">Klasikal</th>
                            <th style="width: 5%;">Sikap</th>
                            <th style="width: 5%;">Pengetahuan</th>
                            <th style="width: 5%;">Keterampilan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($kriteria->count() > 0)
                            @foreach($kriteria as $rs)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="text-align: justify;">{!! $rs->kriteria_kerja !!}</td>
                                    <td style="text-align: justify;">{{ $rs->teori_jp }}</td>
                                    <td style="text-align: justify;">{{ $rs->praktik_jp }}</td>
                                    <td style="text-align: justify;">{!! $rs->media_alat_bahan !!}</td>
                                    <td style="text-align: justify;">{!! $rs->elearning_met !!}</td>
                                    <td style="text-align: justify;">{!! $rs->klasikal_met !!}</td>
                                    <td style="text-align: justify;">{!! $rs->sikap_pem !!}</td>
                                    <td style="text-align: justify;">{!! $rs->pengetahuan_pem !!}</td>
                                    <td style="text-align: justify;">{!! $rs->keterampilan_pem !!}</td>
                                    <td style="text-align: justify;">{!! $rs->indikator !!}</td>
                                    <td>
                                        <a href="{{ route('kriteria.edit', [$pelatihan, $kompetensi, $elemenkompetensi, $rs->kode_kuk]) }}" class="btn"><i class="fas fa-edit" ></i></a>
                                        <form action="{{ route('kriteria.destroy', [$pelatihan, $kompetensi, $elemenkompetensi, $rs->kode_kuk]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn" onclick="return confirm('Apakah Anda yakin ingin menghapus kriteria ini?')"><i class="fas fa-trash-alt" style="color: #dc3545"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="12">Kriteria tidak ditemukan</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
