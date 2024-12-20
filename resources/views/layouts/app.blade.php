<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Standar Kurikulum</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="{{ secure_url(asset('dashboard/images/favicon.png')) }}" />



    <!-- Custom CSS -->

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body style="background-color: #f6f5fb;">
    <div class="text-center py-2" style="background-color: #fef501; font-size: 14px;">
        {{ Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
    </div>

    <div class="sticky-top">
        @include('layouts.navbar')
    </div>

    <div class="container py-5">
        @yield('body')
    </div>
TEST
    <div class="">
        @include('layouts.footer')
    </div>
</body>
</html>
