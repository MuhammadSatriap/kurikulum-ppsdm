<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ElemenKode extends Model
{
    use HasFactory;

    protected $table = "elemen_kode";
    protected $fillable = ['kode_elemen','kode_kuk'];

    public function elemenkompetensi()
    {
        return $this->belongsTo(ElemenKompetensi::class, 'kode_elemen', 'kode_elemen');
    }

    public function kriteria()
    {
        return $this->hasMany(Kriteria::class, 'kode_kuk', 'kode_kuk');
    }

}
