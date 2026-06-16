<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi tabel skema sertifikasi.
     * Tabel ini menyimpan daftar skema sertifikasi yang tersedia (wajib atau pilihan).
     */
    public function up(): void
    {
        Schema::create('skemas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_skema')->unique();
            $table->string('nama_skema');
            $table->enum('jenis', ['wajib', 'pilihan']);
            $table->timestamps();
        });
    }

    /**
     * Kembalikan perubahan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('skemas');
    }
};
