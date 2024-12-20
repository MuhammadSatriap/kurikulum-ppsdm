<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kompetensi', function (Blueprint $table) {
            $table->string('kode_kompetensi', 15)->primary();
            $table->string('kode_diklat', 11);
            $table->string('judul', 255);

            // Foreign key untuk relasi ke tabel 'pelatihan'
            $table->foreign('kode_diklat')
                ->references('kode_diklat')->on('pelatihan')
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
        Schema::dropIfExists('kompetensi');
    }
};
