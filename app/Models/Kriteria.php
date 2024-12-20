<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = "kriteria_kuk";
    protected $primaryKey = 'kode_kuk';

    public $incrementing = false; // Jika kunci utama bukan auto-increment
    protected $keyType = 'string'; // Jika kunci utama adalah string
    protected $fillable = ['kode_kuk', 'kriteria_kerja', 'teori_jp',
                            'praktik_jp', 'media_alat_bahan', 'elearning_met',
                            'klasikal_met', 'sikap_pem', 'pengetahuan_pem',
                            'keterampilan_pem', 'indikator'];

    public function elemenkode()
    {
        return $this->belongsTo(ElemenKode::class, 'kode_kuk', 'kode_kuk');
    }
    // Di dalam model Kriteria.php
    public function getTeoriJpAttribute($value)
    {
        return floatval($value); // Menghapus trailing zero
    }


}
