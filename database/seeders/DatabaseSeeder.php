<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder secara berurutan: skema terlebih dahulu karena peserta bergantung pada skema.
        $this->call([
            SkemaSeeder::class,
            PesertaSeeder::class,
        ]);
    }
}
