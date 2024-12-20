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
    </ol>
</div>



<div class="container mb-4">
    <div class="row">
        <div class="col">
            <h2>Kompetensi</h2>
        </div>
        <div class="col text-end">
                <a href="{{ route('kurikulum.show', $pelatihan->kode_diklat) }}" class="btn btn-warning">Back</a>
        </div>
    </div>
    <hr />
</div>



<div class="container mb-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Detail</h5>
        </div>
        <div class="card-body">
            <p><strong>Kode Pelatihan:</strong> {{ $pelatihan->kode_diklat }}</p>
            <p><strong>Judul Pelatihan:</strong> {{ $pelatihan->judul }}</p>
            <p><strong>Judul Kompetensi:</strong> {{ $kompetensi->judul }}</p>
        </div>
    </div>
</div>


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container mb-4">
    <div class="row">
        <div class="col">
            <h2 class="mb-0">List Elemen Kompetensi</h2>
        </div>
        <div class="col text-end">
            <a href="{{ route('elemen_kompetensi.create', [$pelatihan->kode_diklat, $kompetensi->kode_kompetensi]) }}" class="btn btn-primary">Tambah Elemen</a>
        </div>
    </div>
    <hr />
</div>



<div class="container">
    <div class="table-responsive rounded">
        <table class="table table-bordered">
            <thead class="table-active">
                <tr>
                    <th class="text-center" style="width: 5%;">#</th>
                    <th class="text-center" style="width: 20%;">Kode</th>
                    <th style="width: 40%;">Judul Elemen Kompetensi</th>
                    <th class="text-center" style="width: 35%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($elemenkompetensi->count() > 0)
                    @foreach($elemenkompetensi as $rs)

                        <tr>
                            <td class="align-middle text-center">{{ $loop->iteration }}</td>
                            <td class="align-middle text-center">{{ $rs->kode_elemen }}</td>
                            <td class="align-middle">{{ $rs->judul_elemen }}</td>
                            <td class="align-middle text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('kriteria.show', [$pelatihan->kode_diklat, $kompetensi->kode_kompetensi, $rs->kode_elemen]) }}" class="btn"><i class="fas fa-eye"></i></a>

                                    <a href="{{ route('elemen_kompetensi.edit', [$pelatihan->kode_diklat, $kompetensi->kode_kompetensi, $rs->kode_elemen]) }}"
                                        class="btn"><i class="fas fa-edit" ></i></a>
                                    <form action="{{ route('elemen_kompetensi.destroy', [$pelatihan->kode_diklat, $kompetensi->kode_kompetensi, $rs->kode_elemen]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn" onclick="return confirm('Apakah Anda yakin ingin menghapus elemen ini?')"><i class="fas fa-trash-alt" style="color: #dc3545"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="4">Kompetensi tidak ditemukan</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>


@endsection
