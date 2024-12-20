<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\View\View;
use App\Models\Kompetensi;
use Illuminate\Http\Request;
use App\Models\Elemenkompetensi;

class KurikulumController extends Controller
{
    public function index(Request $request)
    {
       // Ambil query pencarian dan parameter sortir dari request
       $searchTerm = $request->get('search');
       $sortColumn = $request->get('sort_by', 'judul'); // Kolom default untuk sortir
       $sortDirection = $request->get('sort_order', 'asc'); // Urutan default: ascending

       // Inisialisasi query pada model Pelatihan
       $query = Pelatihan::query();

       // Filter pencarian jika ada search term
       if ($searchTerm) {
           $query->where(function($q) use ($searchTerm) {
               $q->whereRaw('LOWER(kode_diklat) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
               ->orWhereRaw('LOWER(judul) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
           });
       }

       // Tambahkan fitur sortir berdasarkan kolom dan urutan yang dipilih
       $query->orderBy($sortColumn, $sortDirection);

       // Ambil data yang dipaginasi (10 item per halaman)
       $dashboards = $query->paginate(10);

       // Kirim data ke view
       return view('kurikulum.index', compact('dashboards', 'sortColumn', 'sortDirection', 'searchTerm'));

    }

    public function create()
    {
        return view('kurikulum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_diklat' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'tujuan' => 'nullable|string',
            'unit_kompetensi' => 'nullable|string',
            'prasyarat' => 'nullable|string',
            'total_jp' => 'nullable|numeric',
            'teori_jp' => 'nullable|numeric',
            'praktik_jp' => 'nullable|numeric',
        ]);



        Pelatihan::create($request->all());

        return redirect()->route('depan.kurikulum')->with('success', 'Judul added successfully');
    }

    public function show(string $kode_diklat)
    {
        // Ambil data pelatihan berdasarkan kode diklat
        $kurikulum = Pelatihan::with('kompetensi')->where('kode_diklat', $kode_diklat)->firstOrFail();


        // Kirim kedua data ke view
        return view('kurikulum.show', compact('kurikulum'));
    }

    public function edit($kode_diklat)
    {
        // Ambil data pelatihan berdasarkan kode_diklat
        $pelatihan = Pelatihan::where('kode_diklat', $kode_diklat)->firstOrFail();

        // Kirim data ke view
        return view('kurikulum.edit', compact('pelatihan'));
    }

    public function update(Request $request, $kode_diklat)
    {
        // Validasi input
        $request->validate([
            'kode_diklat' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'tujuan' => 'nullable|string',
            'unit_kompetensi' => 'nullable|string',
            'prasyarat' => 'nullable|string',
            'total_jp' => 'nullable|numeric',
            'teori_jp' => 'nullable|numeric',
            'praktik_jp' => 'nullable|numeric',
        ]);

        // Cari data berdasarkan kode_diklat
        $pelatihan = Pelatihan::where('kode_diklat', $kode_diklat)->firstOrFail();

        // Update data
        $pelatihan->update($request->all());

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('depan.kurikulum')->with('success', 'Data updated successfully.');
    }



    public function destroy($kode_diklat)
    {
        // Pastikan mencari berdasarkan 'kode_diklat' dan bukan 'id'
        $item = Pelatihan::where('kode_diklat', $kode_diklat)->firstOrFail();
        $item->delete();

        return redirect()->route('depan.kurikulum')->with('success', 'Item deleted successfully.');
    }


}
