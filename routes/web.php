<?php

use App\Http\Controllers\PesertaController;
use Illuminate\Support\Facades\Route;

// Halaman utama diarahkan langsung ke daftar peserta.
Route::redirect('/', '/peserta');

// Resource route untuk seluruh operasi CRUD peserta.
// Parameter route dipaksa menjadi 'peserta' karena Laravel
// menghasilkan 'pesertum' dari aturan singularisasi Latin.
Route::resource('peserta', PesertaController::class)->parameters([
    'peserta' => 'peserta',
]);
