<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pelatihan;
use Illuminate\View\View;
use App\Models\ElemenKode;
use App\Models\Kompetensi;
use Illuminate\Http\Request;
use App\Models\Elemenkompetensi;

class KriteriaController extends Controller
{

    public function show($id_pelatihan, $kode_kompetensi, $kode_elemen)
    {
        // Ambil data pelatihan berdasarkan kode pelatihan
        $pelatihan = Pelatihan::where('kode_diklat', $id_pelatihan)->firstOrFail();

        // Ambil data kompetensi berdasarkan kode kompetensi
        $kompetensi = Kompetensi::where('kode_kompetensi', $kode_kompetensi)->firstOrFail();

        // Ambil elemen kompetensi yang terkait berdasarkan kode kompetensi dan kode elemen
        $elemenkompetensi = Elemenkompetensi::where('kode_kompetensi', $kode_kompetensi)
                                            ->where('kode_elemen', $kode_elemen)
                                            ->firstOrFail();

        // Ambil elemen kode terkait berdasarkan kode elemen
        $elemenkode = ElemenKode::where('kode_elemen', $kode_elemen)->get();

        // Ambil kode_kuk dari elemen kode yang sesuai untuk mencari data di kriteria
        $kode_kuk_values = $elemenkode->pluck('kode_kuk')->toArray();

        // Ambil data dari tabel kriteria menggunakan kode_kuk yang ada dalam elemen kode
        $kriteria = Kriteria::whereIn('kode_kuk', $kode_kuk_values)->get();

        // Return view dengan data yang diperlukan
        return view('kriteria.show', compact('kompetensi', 'pelatihan', 'elemenkompetensi', 'elemenkode', 'kriteria'));
    }

    public function create($id_pelatihan, $kode_kompetensi, $kode_elemen)
    {
       // Ambil data pelatihan berdasarkan kode pelatihan
        $pelatihan = Pelatihan::where('kode_diklat', $id_pelatihan)->firstOrFail();

        // Ambil data kompetensi berdasarkan kode kompetensi
        $kompetensi = Kompetensi::where('kode_kompetensi', $kode_kompetensi)->firstOrFail();

        // Ambil elemen kompetensi berdasarkan kode elemen
        $elemenkompetensi = Elemenkompetensi::where('kode_kompetensi', $kode_kompetensi)
                                            ->where('kode_elemen', $kode_elemen)
                                            ->firstOrFail();

        // Kirim data ke view
        return view('kriteria.create', compact('pelatihan', 'kompetensi', 'elemenkompetensi'));
    }

    // Fungsi store untuk menyimpan data kriteria baru
    public function store(Request $request, $id_pelatihan, $kode_kompetensi, $kode_elemen)
    {
        // Validasi data input (tanpa kode_kuk karena akan dibuat otomatis)
        $request->validate([
            'kriteria_kerja' => 'required|string',
            'teori_jp' => 'required|integer',
            'praktik_jp' => 'required|integer',
            'media_alat_bahan' => 'required|string',
            'elearning_met' => 'nullable|string',
            'klasikal_met' => 'nullable|string',
            'sikap_pem' => 'nullable|string',
            'pengetahuan_pem' => 'nullable|string',
            'keterampilan_pem' => 'nullable|string',
            'indikator' => 'required|string',
        ]);

        // Pastikan elemen kompetensi ada
        $elemenKompetensi = ElemenKompetensi::where('kode_elemen', $kode_elemen)
            ->whereHas('kompetensi', function ($query) use ($id_pelatihan, $kode_kompetensi) {
                $query->where('kode_kompetensi', $kode_kompetensi)
                    ->where('kode_diklat', $id_pelatihan);
            })
            ->firstOrFail();

        // Ambil semua kode KUK yang ada untuk elemen ini
        $existingKuk = ElemenKode::where('kode_elemen', $kode_elemen)
            ->pluck('kode_kuk')
            ->map(function ($item) use ($kode_elemen) {
                // Ekstrak angka urutan dari kode KUK
                return (int) substr($item, strrpos($item, '-') + 1);
            })
            ->toArray();

        // Cari nomor KUK berikutnya
        $nextKukNumber = 1;
        while (in_array($nextKukNumber, $existingKuk)) {
            $nextKukNumber++;
        }

        // Buat kode KUK baru
        $kodeKuk = $kode_elemen . '-' . $nextKukNumber;

        // Simpan ke tabel elemen_kode
        ElemenKode::create([
            'kode_elemen' => $kode_elemen,
            'kode_kuk' => $kodeKuk,
        ]);

        // Simpan ke tabel kriteria_kuk
        Kriteria::create([
            'kode_kuk' => $kodeKuk,
            'kriteria_kerja' => $request->kriteria_kerja,
            'teori_jp' => $request->teori_jp,
            'praktik_jp' => $request->praktik_jp,
            'media_alat_bahan' => $request->media_alat_bahan,
            'elearning_met' => $request->elearning_met,
            'klasikal_met' => $request->klasikal_met,
            'sikap_pem' => $request->sikap_pem,
            'pengetahuan_pem' => $request->pengetahuan_pem,
            'keterampilan_pem' => $request->keterampilan_pem,
            'indikator' => $request->indikator,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('kriteria.show', [$id_pelatihan, $kode_kompetensi, $kode_elemen])
            ->with('success', 'Kriteria dan Elemen Kode berhasil ditambahkan.');
    }



    public function edit($id_pelatihan, $kode_kompetensi, $kode_elemen, $id)
    {
        // Ambil data kriteria berdasarkan ID
        $kriteria = Kriteria::findOrFail($id);

        // Ambil data elemen kode yang terhubung dengan elemen kompetensi
        $elemenKode = ElemenKode::where('kode_elemen', $kode_elemen)
                                ->whereHas('kriteria', function ($query) use ($id) {
                                    $query->where('kode_kuk', $id);
                                })
                                ->firstOrFail();

        // Ambil data pelatihan
        $pelatihan = Pelatihan::findOrFail($id_pelatihan);

        // Ambil data kompetensi
        $kompetensi = Kompetensi::where('kode_kompetensi', $kode_kompetensi)->firstOrFail();

        // Kirim data ke view
        return view('kriteria.edit', compact('pelatihan', 'kompetensi', 'elemenKode', 'kriteria'));
    }



    public function update(Request $request, $id_pelatihan, $kode_kompetensi, $kode_elemen, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'kode_kuk' => 'required|string|max:255',
            'kriteria_kerja' => 'required|string|max:255',
            'teori_jp' => 'nullable|numeric',
            'praktik_jp' => 'nullable|numeric',
            'media_alat_bahan' => 'nullable|string',
            'elearning_met' => 'nullable|string',
            'klasikal_met' => 'nullable|string',
            'sikap_pem' => 'nullable|string',
            'pengetahuan_pem' => 'nullable|string',
            'keterampilan_pem' => 'nullable|string',
            'indikator' => 'nullable|string',
        ]);

        // Ambil data kriteria berdasarkan ID
        $kriteria = Kriteria::findOrFail($id);

        // Update data kriteria
        $kriteria->update($validated);

        // Redirect kembali ke halaman kriteria dengan pesan sukses
        return redirect()->route('kriteria.show', [$id_pelatihan, $kode_kompetensi, $kode_elemen, $id])
                        ->with('success', 'Kriteria berhasil diperbarui');
    }

    public function destroy($id_pelatihan, $kode_kompetensi, $kode_elemen, $id)
    {
        try {
            // Cari data kriteria berdasarkan ID
            $kriteria = Kriteria::findOrFail($id);

            // Simpan kode_kuk sebelum menghapus kriteria
            $kode_kuk = $kriteria->kode_kuk;

            // Hapus data kriteria
            $kriteria->delete();

            // Hapus data di tabel elemen_kode yang sesuai dengan kode_kuk
            ElemenKode::where('kode_kuk', $kode_kuk)->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('kriteria.show', [$id_pelatihan, $kode_kompetensi, $kode_elemen])
                            ->with('success', 'Kriteria dan elemen terkait berhasil dihapus.');
        } catch (\Exception $e) {
            // Jika terjadi error, redirect dengan pesan error
            return back()->with('error', 'Gagal menghapus kriteria: ' . $e->getMessage());
        }
    }





}
