@extends('layouts.app')

@section('body')

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mb-0">List Kompetensi</h1>
        </div>
    </div>
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <hr />
</div>

<div class="container">
    <form method="GET" action="{{ route('depan.kompetensi') }}" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search by Kode Kompetensi or Judul" name="search" value="{{ request()->query('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>
</div>


<!-- Tabel Data Pelatihan -->
<div class="container">
    <div class="table-responsive rounded">
        <table class="table table-bordered">
            <thead class="table-active">
                <tr>
                    <th class="text-center" style="width: 5%;">No</th>
                    <th class="text-center" style="width: 20%;">Kode Diklat</th>
                    <th style="width: 40%;">Judul</th>
                    <th class="text-center" style="width: 35%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($kompetensi->count() > 0)
                    @foreach($kompetensi as $ds)
                        <tr>
                            <td class="align-middle text-center">{{ $loop->iteration }}</td>
                            <td class="align-middle text-center">{{ $ds->kode_kompetensi }}</td>
                            <td class="align-middle">{{ $ds->judul }}</td>
                            <td class="align-middle text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('kompetensi.show', [$ds->kode_diklat, $ds->kode_kompetensi]) }}" class="btn" type="button" class="btn">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('kompetensi.edit', [$ds->kode_diklat, $ds->kode_kompetensi]) }}" class="btn" type="button" class="btn">
                                        <i class="fas fa-edit" ></i>
                                    </a>
                                    <form action="{{ route('kompetensi.destroy', ['id_pelatihan' => $ds->kode_diklat, 'kode_kompetensi' => $ds->kode_kompetensi]) }}" method="POST" onsubmit="return confirm('Hapus data?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn ">
                                            <i class="fas fa-trash-alt" style="color: #dc3545"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="5">Product not found</td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>
</div>




<!-- Pagination -->
<div class="d-flex justify-content-center">
    {{ $kompetensi->links('pagination::bootstrap-4') }}
</div>

@endsection
