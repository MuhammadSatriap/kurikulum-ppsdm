<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('elemen_kompetensi', function (Blueprint $table) {
            $table->string('kode_elemen', 15)->primary();
            $table->string('kode_kompetensi', 15);
            $table->string('judul_elemen', 255);
            $table->decimal('teori_jp', 3, 2);
            $table->decimal('praktik_jp', 3, 2);

            // Relasi ke tabel 'kompetensi'
            $table->foreign('kode_kompetensi')
                  ->references('kode_kompetensi')->on('kompetensi')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elemen_kompetensi');
    }
};
