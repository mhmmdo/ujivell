<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\Http\Request;

/**
 * Controller untuk mengelola data peserta sertifikasi.
 * Menangani operasi CRUD, pencarian berdasarkan nama/nomor peserta,
 * serta filter berdasarkan skema sertifikasi yang dipilih.
 */
class PesertaController extends Controller
{
    /**
     * Menampilkan daftar peserta dengan dukungan pencarian dan filter.
     * Pencarian dilakukan pada kolom `nama_lengkap` dan `nomor_peserta`.
     * Filter berdasarkan `skema_id` menggunakan dropdown.
     */
    public function index(Request $request)
    {
        $query = Peserta::with('skema');

        // Filter berdasarkan skema yang dipilih.
        if ($request->filled('skema_id')) {
            $query->where('skema_id', $request->skema_id);
        }

        // Pencarian berdasarkan nama lengkap atau nomor peserta.
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nomor_peserta', 'like', "%{$search}%");
            });
        }

        $pesertas = $query->orderBy('created_at', 'desc')->get();
        $skemas   = Skema::orderBy('nama_skema')->get();

        return view('peserta.index', compact('pesertas', 'skemas'));
    }

    /**
     * Menampilkan form untuk menambah peserta baru.
     */
    public function create()
    {
        $skemas = Skema::orderBy('nama_skema')->get();

        return view('peserta.create', compact('skemas'));
    }

    /**
     * Menyimpan data peserta baru ke database.
     * Melakukan validasi terhadap seluruh field sebelum penyimpanan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_peserta' => 'required|string|unique:pesertas,nomor_peserta',
            'nama_lengkap'  => 'required|string|max:255',
            'skema_id'      => 'required|exists:skemas,id',
            'status'        => 'required|in:Terdaftar,Proses,Kompeten,Belum Kompeten',
            'tanggal_uji'   => 'required|date',
        ], [
            'nomor_peserta.required' => 'Nomor peserta wajib diisi.',
            'nomor_peserta.unique'   => 'Nomor peserta sudah digunakan.',
            'nama_lengkap.required'  => 'Nama lengkap wajib diisi.',
            'skema_id.required'      => 'Skema sertifikasi wajib dipilih.',
            'skema_id.exists'        => 'Skema yang dipilih tidak valid.',
            'status.required'        => 'Status wajib dipilih.',
            'status.in'              => 'Status yang dipilih tidak valid.',
            'tanggal_uji.required'   => 'Tanggal uji wajib diisi.',
            'tanggal_uji.date'       => 'Format tanggal uji tidak valid.',
        ]);

        Peserta::create($validated);

        return redirect()->route('peserta.index')
            ->with('success', 'Data peserta berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu peserta berdasarkan ID.
     */
    public function show(Peserta $peserta)
    {
        $peserta->load('skema');

        return view('peserta.show', compact('peserta'));
    }

    /**
     * Menampilkan form edit untuk data peserta yang sudah ada.
     */
    public function edit(Peserta $peserta)
    {
        $skemas = Skema::orderBy('nama_skema')->get();

        return view('peserta.edit', compact('peserta', 'skemas'));
    }

    /**
     * Memperbarui data peserta yang sudah ada di database.
     * Pengecualian validasi unique diterapkan pada nomor_peserta milik sendiri.
     */
    public function update(Request $request, Peserta $peserta)
    {
        $validated = $request->validate([
            'nomor_peserta' => 'required|string|unique:pesertas,nomor_peserta,' . $peserta->id,
            'nama_lengkap'  => 'required|string|max:255',
            'skema_id'      => 'required|exists:skemas,id',
            'status'        => 'required|in:Terdaftar,Proses,Kompeten,Belum Kompeten',
            'tanggal_uji'   => 'required|date',
        ], [
            'nomor_peserta.required' => 'Nomor peserta wajib diisi.',
            'nomor_peserta.unique'   => 'Nomor peserta sudah digunakan.',
            'nama_lengkap.required'  => 'Nama lengkap wajib diisi.',
            'skema_id.required'      => 'Skema sertifikasi wajib dipilih.',
            'skema_id.exists'        => 'Skema yang dipilih tidak valid.',
            'status.required'        => 'Status wajib dipilih.',
            'status.in'              => 'Status yang dipilih tidak valid.',
            'tanggal_uji.required'   => 'Tanggal uji wajib diisi.',
            'tanggal_uji.date'       => 'Format tanggal uji tidak valid.',
        ]);

        $peserta->update($validated);

        return redirect()->route('peserta.index')
            ->with('success', 'Data peserta berhasil diperbarui.');
    }

    /**
     * Menghapus data peserta dari database.
     * Mengarahkan ulang ke halaman daftar peserta dengan pesan sukses.
     */
    public function destroy(Peserta $peserta)
    {
        $peserta->delete();

        return redirect()->route('peserta.index')
            ->with('success', 'Data peserta berhasil dihapus.');
    }
}
