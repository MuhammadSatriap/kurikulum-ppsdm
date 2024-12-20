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
        Schema::create('elemen_kode', function (Blueprint $table) {
            $table->string('kode_kuk', 17)->primary();
            $table->string('kode_elemen', 15);

            // Relasi ke tabel 'elemen_kompetensi'
            $table->foreign('kode_elemen')
                  ->references('kode_elemen')->on('elemen_kompetensi')
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
        Schema::dropIfExists('elemen_kode');
    }
};
