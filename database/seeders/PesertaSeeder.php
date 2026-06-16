<?php

namespace Database\Seeders;

use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * Seeder untuk mengisi data awal peserta sertifikasi.
 * Data mencakup peserta dengan berbagai status dan skema yang berbeda.
 */
class PesertaSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Pastikan data skema sudah tersedia sebelum membuat peserta.
        $skemaIds = Skema::pluck('id', 'kode_skema');

        $pesertas = [
            [
                'nomor_peserta' => 'PSR-2026-001',
                'nama_lengkap'  => 'Andi Pratama',
                'skema_id'      => $skemaIds['SKM-001'],
                'status'        => 'Kompeten',
                'tanggal_uji'   => '2026-05-15',
            ],
            [
                'nomor_peserta' => 'PSR-2026-002',
                'nama_lengkap'  => 'Bunga Permata Sari',
                'skema_id'      => $skemaIds['SKM-001'],
                'status'        => 'Belum Kompeten',
                'tanggal_uji'   => '2026-05-16',
            ],
            [
                'nomor_peserta' => 'PSR-2026-003',
                'nama_lengkap'  => 'Cahya Nugraha',
                'skema_id'      => $skemaIds['SKM-002'],
                'status'        => 'Kompeten',
                'tanggal_uji'   => '2026-05-20',
            ],
            [
                'nomor_peserta' => 'PSR-2026-004',
                'nama_lengkap'  => 'Dewi Anggraini',
                'skema_id'      => $skemaIds['SKM-002'],
                'status'        => 'Proses',
                'tanggal_uji'   => '2026-06-20',
            ],
            [
                'nomor_peserta' => 'PSR-2026-005',
                'nama_lengkap'  => 'Eko Saputra',
                'skema_id'      => $skemaIds['SKM-003'],
                'status'        => 'Terdaftar',
                'tanggal_uji'   => '2026-07-01',
            ],
            [
                'nomor_peserta' => 'PSR-2026-006',
                'nama_lengkap'  => 'Fitria Handayani',
                'skema_id'      => $skemaIds['SKM-003'],
                'status'        => 'Proses',
                'tanggal_uji'   => '2026-06-18',
            ],
            [
                'nomor_peserta' => 'PSR-2026-007',
                'nama_lengkap'  => 'Gilang Ramadhan',
                'skema_id'      => $skemaIds['SKM-004'],
                'status'        => 'Kompeten',
                'tanggal_uji'   => '2026-04-10',
            ],
            [
                'nomor_peserta' => 'PSR-2026-008',
                'nama_lengkap'  => 'Hana Maulida',
                'skema_id'      => $skemaIds['SKM-004'],
                'status'        => 'Belum Kompeten',
                'tanggal_uji'   => '2026-05-28',
            ],
            [
                'nomor_peserta' => 'PSR-2026-009',
                'nama_lengkap'  => 'Irfandi Yusuf',
                'skema_id'      => $skemaIds['SKM-005'],
                'status'        => 'Terdaftar',
                'tanggal_uji'   => '2026-08-05',
            ],
            [
                'nomor_peserta' => 'PSR-2026-010',
                'nama_lengkap'  => 'Juliana Putri',
                'skema_id'      => $skemaIds['SKM-005'],
                'status'        => 'Proses',
                'tanggal_uji'   => '2026-06-22',
            ],
        ];

        foreach ($pesertas as $peserta) {
            Peserta::create($peserta);
        }
    }
}
