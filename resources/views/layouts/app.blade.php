<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIM-PESERTA') — Sistem Informasi Manajemen Peserta Sertifikasi</title>

    {{-- Google Fonts: Outfit untuk heading, Inter untuk body --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,400..700;1,14..32,400..700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">

    {{-- Stylesheet kustom --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    {{-- Navigasi utama --}}
    <header class="navbar">
        <div class="container navbar-inner">
            <a href="{{ route('peserta.index') }}" class="navbar-brand">
                <span class="brand-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                        <path d="M6 12v5c0 2 4 3 6 3s6-1 6-3v-5"/>
                    </svg>
                </span>
                <span class="brand-text">SIM-PESERTA</span>
            </a>
            <nav class="navbar-nav">
                <a href="{{ route('peserta.index') }}" class="nav-link {{ request()->routeIs('peserta.index') ? 'nav-link-active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    Data Peserta
                </a>
                <a href="{{ route('peserta.create') }}" class="nav-link {{ request()->routeIs('peserta.create') ? 'nav-link-active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <line x1="19" y1="8" x2="19" y2="14"/>
                        <line x1="22" y1="11" x2="16" y2="11"/>
                    </svg>
                    Tambah Peserta
                </a>
            </nav>
        </div>
    </header>

    {{-- Konten utama --}}
    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} SIM-PESERTA — Sistem Informasi Manajemen Peserta Sertifikasi</p>
        </div>
    </footer>

    {{-- JavaScript kustom --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
