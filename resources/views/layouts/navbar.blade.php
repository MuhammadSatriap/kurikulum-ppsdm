<!-- resources/views/navbar.blade.php -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container-fluid px-5">
        <!-- Logo di sebelah kiri -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('index') }}">
            <img src="{{ asset('dashboard')}}/images/favicon.png" alt="Logo" height="80" class="me-2">
            <div>
                <span class="d-block">

                    <h6 class="mb-0">STANDAR KURIKULUM</h6>
                    <h6 class="mb-0">KEMENTERIAN ENERGI DAN SUMBER DAYA MINERAL</h6>
                    <h6 class="mb-0">PUSAT PENGEMBANGAN SUMBER DAYA MANUSIA APARATUR</h6>

                </span>
            </div>
        </a>

        <!-- Navbar Collapse -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar Items -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('depan.kurikulum') }}">Kurikulum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('depan.kompetensi') }}">Kompetensi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('depan.elemenkompetensi') }}">Elemen Kompetensi</a>
                </li>

                <!-- Pencarian -->
                {{-- <li class="nav-item">
                    <form method="GET" action="{{ route('search') }}" class="d-flex">
                        <input type="text" name="query" class="form-control" placeholder="Cari sesuatu..." value="{{ request('query') }}">
                        <button type="submit" class="btn btn-outline-secondary ms-2">Cari</button>
                    </form>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
