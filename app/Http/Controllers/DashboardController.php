<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\View\View;
use App\Models\Kompetensi;
use Illuminate\Http\Request;
use App\Models\ElemenKompetensi;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        $jumlahKurikulum = Pelatihan::count(); // Hitung jumlah row di tabel 'kurikulum'
        $jumlahKompetensi = Kompetensi::count(); // Hitung jumlah row di tabel 'kompetensi'
        $jumlahElemen = ElemenKompetensi::count(); // Hitung jumlah row di tabel 'elemen_kompetensi'

        return view('dashboard.index', compact('jumlahKurikulum', 'jumlahKompetensi', 'jumlahElemen'));
    }





}
