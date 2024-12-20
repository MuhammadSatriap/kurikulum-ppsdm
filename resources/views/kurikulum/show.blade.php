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
    </ol>
</div>



<div class="container mb-4">
    <div class="row">
        <div class="col">
            <h2 class="mb-0">Kurikulum</h2>
        </div>
        <div class="col text-end">
                <a href="{{ route('depan.kurikulum') }}" class="btn btn-warning">Back</a>
        </div>
    </div>
    <hr />
</div>



<div class="container">
    <div class="mb-4 rounded bg-white p-4">
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label class="form-label">Kode</label>
                <input type="text" class="form-control" placeholder="Kode" value="{{ $kurikulum->kode_diklat }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Judul</label>
                <input type="text" class="form-control" placeholder="Judul" value="{{ $kurikulum->judul }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Tujuan</label>
                <textarea class="form-control" placeholder="Tujuan" readonly>{{ $kurikulum->tujuan }}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Unit Kompetensi</label>
                <div class="form-control" style="height: auto; white-space: pre-line;">
                    {!! $kurikulum->unit_kompetensi !!}
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Prasyarat</label>
                <div class="form-control" style="height: auto; white-space: pre-line;">
                    {!! $kurikulum->prasyarat !!}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 mb-3">
                <label class="form-label">Jam Pelajaran Teori</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Jam Pelajaran Teori" value="{{ floatval($kurikulum->teori_jp) }}" readonly id="teori_jp">
                    <span class="input-group-text">Jam</span>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Jam Pelajaran Praktik</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Jam Pelajaran Praktik" value="{{ floatval($kurikulum->praktik_jp) }}" readonly id="praktik_jp">
                    <span class="input-group-text">Jam</span>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Jam Pelajaran Total</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Jam Pelajaran Total" value="{{ floatval($kurikulum->total_jp) }}" readonly id="total_jp">
                    <span class="input-group-text">Jam</span>
                </div>
            </div>
        </div>

    </div>
</div>






<div class="container mb-4">
    <div class="row">
        <div class="col">
            <h2 class="mb-0">List Kompetensi</h2>
        </div>
        <div class="col text-end">
            <a href="{{ route('kompetensi.create', $kurikulum->kode_diklat) }}" class="btn btn-primary">Tambah kompetensi</a>
        </div>
    </div>
    <hr />
</div>

@if(session('success'))
<div class="container">
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
</div>

@endif

<div class="container">
    <div class="table-responsive rounded">
        <table class="table table-bordered">
            <thead class="table-active">
                <tr>
                    <th class="text-center" style="width: 5%;">No</th>
                    <th class="text-center" style="width: 20%;">Kode</th>
                    <th style="width: 40%;">Judul Kompetensi</th>
                    <th class="text-center" style="width: 35%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($kurikulum->kompetensi->count() > 0)
                    @foreach($kurikulum->kompetensi as $komp)

                        <tr>
                            <td class="align-middle text-center">{{ $loop->iteration }}</td>
                            <td class="align-middle text-center">{{ $komp->kode_kompetensi }}</td>
                            <td class="align-middle">{{ $komp->judul }}</td>
                            <td class="align-middle text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('kompetensi.show', [$kurikulum->kode_diklat, $komp->kode_kompetensi]) }}" class="btn"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('kompetensi.edit', [$kurikulum->kode_diklat, $komp->kode_kompetensi]) }}" class="btn"><i class="fas fa-edit" ></i></a>
                                    <form action="{{ route('kompetensi.destroy', ['id_pelatihan' => $komp->kode_diklat, 'kode_kompetensi' => $komp->kode_kompetensi]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" onclick="return confirm('Yakin ingin menghapus kompetensi ini?')">
                                            <i class="fas fa-trash-alt" style="color: #dc3545"></i>
                                        </button>
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
