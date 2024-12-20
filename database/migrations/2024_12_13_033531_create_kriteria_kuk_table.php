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
        Schema::create('kriteria_kuk', function (Blueprint $table) {
            $table->string('kode_kuk', 17)->primary();
            $table->string('kriteria_kerja', 255);
            $table->decimal('teori_jp', 3, 2);
            $table->decimal('praktik_jp', 3, 2);
            $table->text('media_alat_bahan');
            $table->text('elearning_met');
            $table->text('klasikal_met');
            $table->text('sikap_pem');
            $table->text('pengetahuan_pem');
            $table->text('keterampilan_pem');
            $table->text('indikator');

            // Relasi ke tabel 'elemen_kode'
            $table->foreign('kode_kuk')
                  ->references('kode_kuk')->on('elemen_kode')
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
        Schema::dropIfExists('kriteria_kuk');
    }
};
