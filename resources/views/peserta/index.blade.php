@extends('layouts.app')

@section('title', 'Data Peserta Sertifikasi')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Data Peserta Sertifikasi</h1>
            <p class="page-subtitle">Kelola data peserta uji kompetensi dengan mudah dan cepat.</p>
        </div>
        <a href="{{ route('peserta.create') }}" class="btn btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Tambah Peserta
        </a>
    </div>

    {{-- Pesan flash sukses/gagal --}}
    @if (session('success'))
        <div class="alert alert-success" id="flash-alert">
            <div class="alert-content">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="alert-close" onclick="dismissAlert(this)" aria-label="Tutup notifikasi">&times;</button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error" id="flash-alert">
            <div class="alert-content">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="15" y1="9" x2="9" y2="15"/>
                    <line x1="9" y1="9" x2="15" y2="15"/>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
            <button type="button" class="alert-close" onclick="dismissAlert(this)" aria-label="Tutup notifikasi">&times;</button>
        </div>
    @endif

    {{-- Form pencarian dan filter --}}
    <div class="card search-card">
        <form action="{{ route('peserta.index') }}" method="GET" class="search-form">
            <div class="search-field">
                <label for="search" class="sr-only">Cari peserta</label>
                <div class="input-icon-wrapper">
                    <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <input
                        type="text"
                        name="search"
                        id="search"
                        class="form-input"
                        placeholder="Cari berdasarkan nama atau nomor peserta..."
                        value="{{ request('search') }}"
                    >
                </div>
            </div>
            <div class="filter-field">
                <label for="skema_id" class="sr-only">Filter skema</label>
                <select name="skema_id" id="skema_id" class="form-select">
                    <option value="">Semua Skema</option>
                    @foreach ($skemas as $skema)
                        <option value="{{ $skema->id }}" {{ request('skema_id') == $skema->id ? 'selected' : '' }}>
                            {{ $skema->nama_skema }} ({{ $skema->kode_skema }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="search-actions">
                <button type="submit" class="btn btn-primary btn-sm">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    Cari
                </button>
                <a href="{{ route('peserta.index') }}" class="btn btn-secondary btn-sm">Reset</a>
            </div>
        </form>
    </div>

    {{-- Tabel data peserta --}}
    <div class="card table-card">
        @if ($pesertas->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nomor Peserta</th>
                            <th>Nama Lengkap</th>
                            <th>Skema</th>
                            <th>Status</th>
                            <th>Tanggal Uji</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesertas as $peserta)
                            <tr>
                                <td>
                                    <span class="cell-label-mobile">Nomor Peserta</span>
                                    <span class="font-mono">{{ $peserta->nomor_peserta }}</span>
                                </td>
                                <td>
                                    <span class="cell-label-mobile">Nama Lengkap</span>
                                    <span class="font-medium">{{ $peserta->nama_lengkap }}</span>
                                </td>
                                <td>
                                    <span class="cell-label-mobile">Skema</span>
                                    @if ($peserta->skema)
                                        <span class="skema-badge skema-badge-{{ $peserta->skema->jenis }}">
                                            {{ $peserta->skema->nama_skema }}
                                        </span>
                                    @else
                                        <span class="skema-badge skema-badge-pilihan">—</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="cell-label-mobile">Status</span>
                                    <span class="badge badge-{{ strtolower(str_replace(' ', '-', $peserta->status)) }}">
                                        {{ $peserta->status }}
                                    </span>
                                </td>
                                <td>
                                    <span class="cell-label-mobile">Tanggal Uji</span>
                                    {{ \Carbon\Carbon::parse($peserta->tanggal_uji)->format('d M Y') }}
                                </td>
                                <td class="action-cell">
                                    <div class="action-buttons">
                                        <a href="{{ route('peserta.show', $peserta) }}" class="btn-icon btn-icon-info" title="Detail">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                                <circle cx="12" cy="12" r="3"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('peserta.edit', $peserta) }}" class="btn-icon btn-icon-warning" title="Edit">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                            </svg>
                                        </a>
                                        <button
                                            type="button"
                                            class="btn-icon btn-icon-danger"
                                            title="Hapus"
                                            onclick="confirmDelete('{{ $peserta->nama_lengkap }}', '{{ route('peserta.destroy', $peserta) }}')"
                                        >
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"/>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="empty-icon">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                <h3 class="empty-title">Tidak ada data peserta</h3>
                <p class="empty-description">Belum ada data peserta yang tersedia atau tidak ada hasil yang cocok dengan pencarian Anda.</p>
                <a href="{{ route('peserta.index') }}" class="btn btn-secondary btn-sm">Tampilkan Semua</a>
            </div>
        @endif
    </div>

@endsection
