<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Peserta merepresentasikan data peserta sertifikasi.
 * Setiap Peserta terdaftar dalam satu Skema sertifikasi tertentu.
 */
class Peserta extends Model
{
    /**
     * Nama tabel yang digunakan oleh model ini.
     */
    protected $table = 'pesertas';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'nomor_peserta',
        'nama_lengkap',
        'skema_id',
        'status',
        'tanggal_uji',
    ];

    /**
     * Relasi many-to-one: setiap peserta hanya terdaftar pada satu skema.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function skema()
    {
        return $this->belongsTo(Skema::class);
    }
}
