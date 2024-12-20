<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ElemenKompetensi extends Model
{
    use HasFactory;


    protected $table = "elemen_kompetensi";

    protected $primaryKey = 'kode_elemen';

    public $incrementing = false; // Jika kunci utama bukan auto-increment
    protected $keyType = 'string'; // Jika kunci utama adalah string

    protected $fillable = ['kode_kompetensi','kode_elemen', 'teori_jp', 'praktik_jp'];

    public function kompetensi()
    {
        return $this->belongsTo(Kompetensi::class, 'kode_kompetensi', 'kode_kompetensi');
    }

    public function elemenkode()
    {
        return $this->hasMany(ElemenKode::class, 'kode_elemen', 'kode_elemen');
    }

    public function pelatihan()
{
    return $this->hasOneThrough(
        Pelatihan::class,   // Model tujuan
        Kompetensi::class,  // Model perantara
        'kode_kompetensi',  // Kunci asing di model Kompetensi
        'kode_diklat',      // Kunci asing di model Pelatihan
        'kode_kompetensi',  // Kunci lokal di model ElemenKompetensi
        'kode_diklat'       // Kunci lokal di model Kompetensi
    );
}

}
