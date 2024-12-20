<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kompetensi extends Model
{
    use HasFactory;

    protected $table = 'kompetensi';

    protected $primaryKey = 'kode_kompetensi';

    public $incrementing = false; // Jika kunci utama bukan auto-increment
    protected $keyType = 'string'; // Jika kunci utama adalah string

    protected $fillable = ['kode_diklat', 'sub_diklat', 'judul', 'kode_kompetensi'];


    public function elemenkompetensi()
    {
        return $this->hasMany(Elemenkompetensi::class, 'kode_kompetensi', 'kode_kompetensi')
                    ->onDelete('cascade');
    }


    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class, 'kode_diklat', 'kode_diklat');
    }




}
