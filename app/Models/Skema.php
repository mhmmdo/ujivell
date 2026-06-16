<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Skema merepresentasikan skema sertifikasi yang tersedia dalam sistem.
 * Setiap Skema dapat memiliki banyak Peserta yang terdaftar di dalamnya.
 */
class Skema extends Model
{
    /**
     * Nama tabel yang digunakan oleh model ini.
     */
    protected $table = 'skemas';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'kode_skema',
        'nama_skema',
        'jenis',
    ];

    /**
     * Relasi one-to-many: satu skema memiliki banyak peserta.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function peserta()
    {
        return $this->hasMany(Peserta::class);
    }
}
