<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi tabel data peserta sertifikasi.
     * Tabel ini menyimpan data lengkap peserta yang terdaftar dalam skema sertifikasi tertentu.
     */
    public function up(): void
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_peserta')->unique();
            $table->string('nama_lengkap');
            $table->foreignId('skema_id')->constrained('skemas')->cascadeOnDelete();
            $table->enum('status', ['Terdaftar', 'Proses', 'Kompeten', 'Belum Kompeten']);
            $table->date('tanggal_uji');
            $table->timestamps();
        });
    }

    /**
     * Kembalikan perubahan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
