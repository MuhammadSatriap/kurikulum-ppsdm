<?php

namespace App\Http\Controllers;

use App\Models\ElemenKode;
use App\Models\Kompetensi;
use Illuminate\Http\Request;
use App\Models\ElemenKompetensi;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\Kompetensi;
use App\Models\ElemenKompetensi;
use Illuminate\Http\Request;

class ElemenKompetensiController extends Controller
{

    public function index(Request $request)
    {
        // Ambil query pencarian
        $searchTerm = $request->get('search');

        // Query Elemen Kompetensi dengan relasi Kurikulum dan Kompetensi
        $query = ElemenKompetensi::with(['pelatihan', 'kompetensi']);

        // Jika ada parameter pencarian, tambahkan filter
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(kode_elemen) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                    ->orWhereRaw('LOWER(nama_elemen) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                    ->orWhereHas('pelatihan', function ($q) use ($searchTerm) {
                        $q->whereRaw('LOWER(judul) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
                    })
                    ->orWhereHas('kompetensi', function ($q) use ($searchTerm) {
                        $q->whereRaw('LOWER(judul) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
                    });
            });
        }

        // Ambil data dengan pagination
        $elemenKompetensi = $query->paginate(10);

        // Kirim data ke view
        return view('elemenkompetensi.index', compact('elemenKompetensi'));
    }


    public function create($id_pelatihan, $kode_kompetensi)
    {
        // Cek apakah pelatihan dan kompetensi yang diberikan ada
        $pelatihan = Pelatihan::findOrFail($id_pelatihan);
        $kompetensi = Kompetensi::where('kode_kompetensi', $kode_kompetensi)
                                ->where('kode_diklat', $id_pelatihan)
                                ->firstOrFail();

        // Tampilkan form create dengan data pelatihan dan kompetensi
        return view('elemenkompetensi.create', compact('pelatihan', 'kompetensi'));
    }

    public function store(Request $request, $id_pelatihan, $kode_kompetensi)
    {
        // Validasi input
        $request->validate([
            'judul_elemen' => 'required|string|max:255',
            'teori_jp' => 'required|numeric',
            'praktik_jp' => 'required|numeric',
        ]);

        // Cari kompetensi yang sesuai
        $kompetensi = Kompetensi::where('kode_kompetensi', $kode_kompetensi)
                                ->where('kode_diklat', $id_pelatihan)
                                ->firstOrFail();

        // Ambil elemen-elemen yang sudah ada untuk kode kompetensi ini
        $existingElemen = ElemenKompetensi::where('kode_kompetensi', $kode_kompetensi)
            ->pluck('kode_elemen')
            ->map(function ($item) use ($kode_kompetensi) {
                // Ekstrak angka urutan dari kode elemen
                return (int) substr($item, strrpos($item, '-') + 1);
            })
            ->toArray();

        // Cari angka terkecil yang belum digunakan
        $nextNumber = 1;
        while (in_array($nextNumber, $existingElemen)) {
            $nextNumber++;
        }

        // Buat kode elemen baru
        $kodeElemen = $kode_kompetensi . '-' . $nextNumber;

        // Simpan data elemen kompetensi
        $elemenKompetensi = new ElemenKompetensi();
        $elemenKompetensi->kode_kompetensi = $kompetensi->kode_kompetensi;
        $elemenKompetensi->kode_elemen = $kodeElemen; // Kode otomatis
        $elemenKompetensi->judul_elemen = $request->judul_elemen;
        $elemenKompetensi->teori_jp = $request->teori_jp;
        $elemenKompetensi->praktik_jp = $request->praktik_jp;
        $elemenKompetensi->save();

        // Redirect ke halaman kompetensi dengan pesan sukses
        return redirect()->route('kompetensi.show', [$id_pelatihan, $kode_kompetensi])
                        ->with('success', 'Elemen Kompetensi berhasil ditambahkan.');
    }


    public function edit($id_pelatihan, $kode_kompetensi, $kode_elemen)
    {
        $elemenKompetensi = ElemenKompetensi::where('kode_elemen', $kode_elemen)
                                            ->where('kode_kompetensi', $kode_kompetensi)
                                            ->firstOrFail();

        $pelatihan = Pelatihan::findOrFail($id_pelatihan);
        $kompetensi = Kompetensi::where('kode_kompetensi', $kode_kompetensi)->firstOrFail();

        return view('elemenkompetensi.edit', compact('pelatihan', 'kompetensi', 'elemenKompetensi'));
    }


    public function update(Request $request, $id_pelatihan, $kode_kompetensi, $kode_elemen)
    {
        $request->validate([
            'judul_elemen' => 'required|string|max:255',
            'teori_jp' => 'required|numeric',
            'praktik_jp' => 'required|numeric',
        ]);

        $elemenKompetensi = ElemenKompetensi::where('kode_elemen', $kode_elemen)
                                            ->where('kode_kompetensi', $kode_kompetensi)
                                            ->firstOrFail();

        $elemenKompetensi->judul_elemen = $request->judul_elemen;
        $elemenKompetensi->teori_jp = $request->teori_jp;
        $elemenKompetensi->praktik_jp = $request->praktik_jp;
        $elemenKompetensi->save();

        return redirect()->route('kompetensi.show', [$id_pelatihan, $kode_kompetensi])
                        ->with('success', 'Elemen Kompetensi berhasil diperbarui.');
    }

    public function destroy($id_pelatihan, $kode_kompetensi, $kode_elemen)
    {
        // Cari elemen kompetensi berdasarkan kode_elemen dan kode_kompetensi
        $elemenKompetensi = ElemenKompetensi::where('kode_elemen', $kode_elemen)
                                            ->where('kode_kompetensi', $kode_kompetensi)
                                            ->firstOrFail();

        // Hapus elemen kompetensi
        $elemenKompetensi->delete();

        // Redirect ke halaman show kompetensi dengan pesan sukses
        return redirect()->route('kompetensi.show', [$id_pelatihan, $kode_kompetensi])
                        ->with('success', 'Elemen Kompetensi berhasil dihapus.');
    }



}

