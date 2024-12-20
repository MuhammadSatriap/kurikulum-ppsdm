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
        Schema::create('pelatihan', function (Blueprint $table) {
            $table->string('kode_diklat', 11)->primary();
            $table->string('judul', 255);
            $table->text('tujuan');
            $table->text('unit_kompetensi');
            $table->text('prasyarat');
            $table->decimal('total_jp', 4, 2);
            $table->decimal('teori_jp', 4, 2);
            $table->decimal('praktik_jp', 4, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihan');
    }
};
