@extends('layouts.app')

@section('title', 'Detail Peserta: ' . $peserta->nama_lengkap)

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Detail Peserta</h1>
            <p class="page-subtitle">Informasi lengkap data peserta sertifikasi.</p>
        </div>
        <a href="{{ route('peserta.index') }}" class="btn btn-secondary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"/>
                <polyline points="12 19 5 12 12 5"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="card detail-card">
        <div class="detail-grid">
            <div class="detail-item">
                <span class="detail-label">Nomor Peserta</span>
                <span class="detail-value font-mono">{{ $peserta->nomor_peserta }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Nama Lengkap</span>
                <span class="detail-value">{{ $peserta->nama_lengkap }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Skema Sertifikasi</span>
                <span class="detail-value">
                    @if ($peserta->skema)
                        {{ $peserta->skema->nama_skema }}
                        <span class="skema-badge skema-badge-{{ $peserta->skema->jenis }}">
                            {{ ucfirst($peserta->skema->jenis) }}
                        </span>
                    @else
                        <span class="text-muted">Skema tidak ditemukan</span>
                    @endif
                </span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Kode Skema</span>
                <span class="detail-value font-mono">{{ $peserta->skema?->kode_skema ?? '—' }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Status</span>
                <span class="detail-value">
                    <span class="badge badge-{{ strtolower(str_replace(' ', '-', $peserta->status)) }}">
                        {{ $peserta->status }}
                    </span>
                </span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Tanggal Uji</span>
                <span class="detail-value">{{ \Carbon\Carbon::parse($peserta->tanggal_uji)->isoFormat('dddd, D MMMM Y') }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Terdaftar Sejak</span>
                <span class="detail-value">{{ \Carbon\Carbon::parse($peserta->created_at)->isoFormat('D MMMM Y, HH:mm') }} WIB</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Terakhir Diperbarui</span>
                <span class="detail-value">{{ \Carbon\Carbon::parse($peserta->updated_at)->isoFormat('D MMMM Y, HH:mm') }} WIB</span>
            </div>
        </div>

        <div class="detail-footer">
            <a href="{{ route('peserta.edit', $peserta) }}" class="btn btn-warning">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                Edit Data
            </a>
            <button
                type="button"
                class="btn btn-danger"
                onclick="confirmDelete('{{ $peserta->nama_lengkap }}', '{{ route('peserta.destroy', $peserta) }}')"
            >
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                </svg>
                Hapus
            </button>
        </div>
    </div>

@endsection
