@extends('layouts.app')

@section('title', 'Tambah Peserta Baru')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Tambah Peserta Baru</h1>
            <p class="page-subtitle">Daftarkan peserta sertifikasi baru ke dalam sistem.</p>
        </div>
        <a href="{{ route('peserta.index') }}" class="btn btn-secondary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"/>
                <polyline points="12 19 5 12 12 5"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="card form-card">
        <form action="{{ route('peserta.store') }}" method="POST" class="custom-form">
            @csrf

            <div class="form-grid">
                {{-- Nomor Peserta --}}
                <div class="form-group">
                    <label for="nomor_peserta" class="form-label">Nomor Peserta</label>
                    <input
                        type="text"
                        name="nomor_peserta"
                        id="nomor_peserta"
                        class="form-input @error('nomor_peserta') is-invalid @enderror"
                        value="{{ old('nomor_peserta') }}"
                        placeholder="Contoh: PSR-2026-011"
                        autofocus
                    >
                    @error('nomor_peserta')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Nama Lengkap --}}
                <div class="form-group">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input
                        type="text"
                        name="nama_lengkap"
                        id="nama_lengkap"
                        class="form-input @error('nama_lengkap') is-invalid @enderror"
                        value="{{ old('nama_lengkap') }}"
                        placeholder="Masukkan nama lengkap peserta"
                    >
                    @error('nama_lengkap')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Skema Sertifikasi --}}
                <div class="form-group">
                    <label for="skema_id" class="form-label">Skema Sertifikasi</label>
                    <select name="skema_id" id="skema_id" class="form-select @error('skema_id') is-invalid @enderror">
                        <option value="">— Pilih Skema —</option>
                        @foreach ($skemas as $skema)
                            <option value="{{ $skema->id }}" {{ old('skema_id') == $skema->id ? 'selected' : '' }}>
                                {{ $skema->nama_skema }} ({{ $skema->kode_skema }}) — {{ ucfirst($skema->jenis) }}
                            </option>
                        @endforeach
                    </select>
                    @error('skema_id')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="form-group">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="">— Pilih Status —</option>
                        <option value="Terdaftar" {{ old('status') == 'Terdaftar' ? 'selected' : '' }}>Terdaftar</option>
                        <option value="Proses" {{ old('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Kompeten" {{ old('status') == 'Kompeten' ? 'selected' : '' }}>Kompeten</option>
                        <option value="Belum Kompeten" {{ old('status') == 'Belum Kompeten' ? 'selected' : '' }}>Belum Kompeten</option>
                    </select>
                    @error('status')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Tanggal Uji --}}
                <div class="form-group">
                    <label for="tanggal_uji" class="form-label">Tanggal Uji</label>
                    <input
                        type="date"
                        name="tanggal_uji"
                        id="tanggal_uji"
                        class="form-input @error('tanggal_uji') is-invalid @enderror"
                        value="{{ old('tanggal_uji') }}"
                    >
                    @error('tanggal_uji')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                        <polyline points="17 21 17 13 7 13 7 21"/>
                        <polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Simpan Data
                </button>
                <a href="{{ route('peserta.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
