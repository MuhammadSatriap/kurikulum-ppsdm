<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\View\View;
use App\Models\Kompetensi;
use Illuminate\Http\Request;
use App\Models\Elemenkompetensi;

class KompetensiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil query pencarian dari request
        $searchTerm = $request->get('search');

        // Inisialisasi query untuk mengambil semua kompetensi
        $query = Kompetensi::query();

        // Jika ada parameter pencarian, terapkan filter pencarian
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(kode_kompetensi) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                    ->orWhereRaw('LOWER(judul) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
            });
        }

        // Ambil data kompetensi yang dipaginasi (10 per halaman)
        $kompetensi = $query->paginate(10);

        // Kirim data ke view
        return view('kompetensi.index', compact('kompetensi'));
    }

    public function create($id_pelatihan)
    {
        // Cek apakah pelatihan dengan id_pelatihan ada
        $pelatihan = Pelatihan::findOrFail($id_pelatihan);

        // Menampilkan view create dengan data pelatihan
        return view('kompetensi.create', compact('pelatihan'));
    }

    public function show($id_pelatihan, $kode_kompetensi)
    {
        // Ambil data pelatihan berdasarkan kode pelatihan
        $pelatihan = Pelatihan::where('kode_diklat', $id_pelatihan)->firstOrFail();

        // Ambil data kompetensi berdasarkan kode kompetensi
        $kompetensi = Kompetensi::where('kode_kompetensi', $kode_kompetensi)->firstOrFail();

        $elemenkompetensi = Elemenkompetensi::where('kode_kompetensi', $kode_kompetensi)->get();

        // Return view dengan data yang diperlukan
        return view('kompetensi.show', compact('kompetensi', 'pelatihan', 'elemenkompetensi'));
    }


    public function store(Request $request, $id_pelatihan)
    {
        // Validasi input (judul wajib diisi, kode_kompetensi otomatis)
        $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        // Cari pelatihan berdasarkan id_pelatihan
        $pelatihan = Pelatihan::findOrFail($id_pelatihan);

        // Ambil kode_diklat dari pelatihan
        $kodeDiklat = $pelatihan->kode_diklat;

        // Ambil semua kode kompetensi terkait kode_diklat ini
        $existingKompetensi = Kompetensi::where('kode_diklat', $kodeDiklat)
            ->pluck('kode_kompetensi')
            ->map(function ($item) use ($kodeDiklat) {
                // Ekstrak angka urutan dari kode kompetensi
                return (int) substr($item, strrpos($item, '-') + 1);
            })
            ->toArray();

        // Cari angka terkecil yang belum digunakan
        $nextNumber = 1;
        while (in_array($nextNumber, $existingKompetensi)) {
            $nextNumber++;
        }

        // Buat kode kompetensi baru
        $kodeKompetensi = $kodeDiklat . '-' . $nextNumber;

        // Simpan data kompetensi
        $kompetensi = new Kompetensi();
        $kompetensi->kode_kompetensi = $kodeKompetensi; // Kode otomatis
        $kompetensi->judul = $request->judul;
        $kompetensi->kode_diklat = $kodeDiklat; // Hubungkan kompetensi dengan pelatihan
        $kompetensi->save();

        // Redirect ke halaman detail pelatihan atau halaman yang diinginkan
        return redirect()->route('kurikulum.show', [$pelatihan->kode_diklat])
            ->with('success', 'Kompetensi berhasil ditambahkan.');
    }


    public function edit($id_pelatihan, $kode_kompetensi)
    {
        // Cari pelatihan dan kompetensi yang ingin diedit
        $pelatihan = Pelatihan::where('kode_diklat', $id_pelatihan)->firstOrFail();
        $kompetensi = Kompetensi::where('kode_kompetensi', $kode_kompetensi)->firstOrFail();

        // Kirim data ke view untuk ditampilkan dalam form edit
        return view('kompetensi.edit', compact('pelatihan', 'kompetensi'));
    }
    public function update(Request $request, $id_pelatihan, $kode_kompetensi)
    {

        $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        // Cari data berdasarkan kedua kolom (id_pelatihan dan kode_kompetensi)
        $kompetensi = Kompetensi::where('kode_kompetensi', $kode_kompetensi)
                                ->where('kode_diklat', $id_pelatihan)
                                ->firstOrFail();

        // Perbarui data
        $kompetensi->judul = $request->judul;
        $kompetensi->save();

        // Redirect ke halaman detail
        return redirect()->route('kompetensi.show', [$id_pelatihan, $kode_kompetensi])
                     ->with('success', 'Kompetensi berhasil diperbarui.');
    }


    public function destroy($id_pelatihan, $kode_kompetensi)
    {
        // Hapus elemen yang terkait dengan kompetensi
        Elemenkompetensi::where('kode_kompetensi', $kode_kompetensi)->delete();

        // Hapus data kompetensi
        $kompetensi = Kompetensi::where('kode_kompetensi', $kode_kompetensi)
                                ->where('kode_diklat', $id_pelatihan)
                                ->firstOrFail();
        $kompetensi->delete();

        // Redirect kembali ke halaman pelatihan
        return redirect()->route('depan.show', ['id' => $id_pelatihan])
                        ->with('success', 'Kompetensi dan elemen terkait berhasil dihapus.');
    }




}
