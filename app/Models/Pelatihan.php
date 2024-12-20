<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelatihan extends Model
{
    use HasFactory;


    protected $table = "pelatihan";
    protected $fillable = ['kode_diklat','judul', 'tujuan', 'unit_kompetensi', 'prasyarat', 'total_jp', 'teori_jp', 'praktik_jp'];

    protected $primaryKey = 'kode_diklat';

    public $incrementing = false;

    public function kompetensi()
    {
        return $this->hasMany(Kompetensi::class, 'kode_diklat', 'kode_diklat');
    }

}
