<?php

namespace Database\Seeders;

use App\Models\Skema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * Seeder untuk mengisi data awal skema sertifikasi.
 * Data mencakup skema wajib dan pilihan yang umum digunakan dalam sertifikasi kompetensi.
 */
class SkemaSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $skemas = [
            [
                'kode_skema' => 'SKM-001',
                'nama_skema' => 'Junior Web Developer',
                'jenis'      => 'wajib',
            ],
            [
                'kode_skema' => 'SKM-002',
                'nama_skema' => 'Junior Graphic Designer',
                'jenis'      => 'wajib',
            ],
            [
                'kode_skema' => 'SKM-003',
                'nama_skema' => 'Junior Network Administrator',
                'jenis'      => 'wajib',
            ],
            [
                'kode_skema' => 'SKM-004',
                'nama_skema' => 'Digital Marketing',
                'jenis'      => 'pilihan',
            ],
            [
                'kode_skema' => 'SKM-005',
                'nama_skema' => 'Database Administrator',
                'jenis'      => 'pilihan',
            ],
        ];

        foreach ($skemas as $skema) {
            Skema::create($skema);
        }
    }
}
