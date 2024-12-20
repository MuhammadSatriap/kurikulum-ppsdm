<?php
namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\Kompetensi;
use Illuminate\Http\Request;
use App\Models\ElemenKompetensi;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Ambil kata kunci pencarian
        $query = $request->get('query');

        // Jika tidak ada kata kunci, arahkan kembali ke halaman utama
        if (!$query) {
            return redirect()->route('index');
        }

        // Ubah query pencarian menjadi huruf kecil
        $query = strtolower($query);

        // Pisahkan kata kunci berdasarkan spasi
        $keywords = explode(' ', $query);

        // Pencarian di tabel Kompetensi
        $kompetensi = Kompetensi::where(function($q) use ($keywords) {
            foreach ($keywords as $keyword) {
                $q->orWhereRaw('LOWER(kode_diklat) LIKE ?', ['%' . strtolower($keyword) . '%'])
                ->orWhereRaw('LOWER(kode_kompetensi) LIKE ?', ['%' . strtolower($keyword) . '%'])
                ->orWhereRaw('LOWER(judul) LIKE ?', ['%' . strtolower($keyword) . '%']);
            }
        })->get();

        // Pencarian di tabel Pelatihan
        $pelatihan = Pelatihan::where(function($q) use ($keywords) {
            foreach ($keywords as $keyword) {
                $q->orWhereRaw('LOWER(kode_diklat) LIKE ?', ['%' . strtolower($keyword) . '%'])
                ->orWhereRaw('LOWER(judul) LIKE ?', ['%' . strtolower($keyword) . '%'])
                ->orWhereRaw('LOWER(tujuan) LIKE ?', ['%' . strtolower($keyword) . '%'])
                ->orWhereRaw('LOWER(prasyarat) LIKE ?', ['%' . strtolower($keyword) . '%']);
            }
        })->get();

        // Pencarian di tabel ElemenKompetensi
        $elemenKompetensi = ElemenKompetensi::with(['pelatihan', 'kompetensi'])->where(function($q) use ($keywords) {
            foreach ($keywords as $keyword) {
                $q->orWhereRaw('LOWER(kode_elemen) LIKE ?', ['%' . strtolower($keyword) . '%'])
                ->orWhereRaw('LOWER(judul_elemen) LIKE ?', ['%' . strtolower($keyword) . '%']);
            }
        })->get();

        // Kirim data ke view
        return view('search.results', compact('kompetensi', 'pelatihan', 'elemenKompetensi'));
    }


}
