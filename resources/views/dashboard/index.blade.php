@extends('layouts.app')

@section('body')



<div class="container">
    <div class="search-bar bg-light p-4 rounded shadow-sm d-flex align-items-center" style="width: 100%; max-width: 900px; margin: 0 auto;">
        <form method="GET" action="{{ route('search') }}" class="d-flex w-100">
            <input type="text"
                    name="query"
                    class="form-control me-3"
                    placeholder="Keyword: [Kode Diklat] [Judul] [Kompetensi] [Elemen Kompetensi]"
                    style="height: 50px; font-size: 1.2rem; font-weight: 300; font-style: italic;">
            <button type="submit" class="btn btn-outline-light ms-2" style="height: 50px; font-size: 1.2rem;">🔍</button>
        </form>
    </div>


    <div class="row mt-4">
        <!-- Kurikulum -->
        <div class="col-md-6 mb-4">
            <a href="{{ route('depan.kurikulum') }}"
               class="info-box text-center p-4 shadow-sm rounded bg-white text-decoration-none d-block">
                <div class="mb-3" style="font-size: 2rem; color: #000;">
                    <i class="fas fa-book"></i>
                </div>
                <h5 class="fw-bold text-dark">Kurikulum</h5>
                <p class="text-muted">Total: {{ $jumlahKurikulum }} data</p>
            </a>
        </div>

        <!-- Kompetensi -->
        <div class="col-md-6 mb-4">
            <a href="{{ route('depan.kompetensi') }}"
               class="info-box text-center p-4 shadow-sm rounded bg-white text-decoration-none d-block">
                <div class="mb-3" style="font-size: 2rem; color: #000;">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h5 class="fw-bold text-dark">Kompetensi</h5>
                <p class="text-muted">Total: {{ $jumlahKompetensi }} data</p>
            </a>
        </div>

        <!-- Elemen Kompetensi -->
        <div class="col-md-12">
            <a href="{{ route('depan.elemenkompetensi') }}"
               class="info-box text-center p-4 shadow-sm rounded bg-white text-decoration-none d-block">
                <div class="mb-3" style="font-size: 2rem; color: #000;">
                    <i class="fas fa-tasks"></i>
                </div>
                <h5 class="fw-bold text-dark">Elemen Kompetensi</h5>
                <p class="text-muted">Total: {{ $jumlahElemen }} data</p>
            </a>
        </div>
    </div>


</div>



@endsection
