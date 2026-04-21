<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — OGAG Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .sidebar-link { transition: all 0.2s ease; }
        .sidebar-link:hover { transform: translateX(4px); }
    </style>
</head>
<body class="bg-gray-50">

<div class="flex h-screen overflow-hidden">

    {{-- ══ SIDEBAR ══ --}}
    <aside class="w-64 bg-gradient-to-b from-gray-900 via-gray-900 to-gray-800 text-white flex flex-col shadow-2xl">

        {{-- Logo --}}
        <div class="px-6 py-6 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-yellow-500 rounded-lg flex items-center justify-center">
                    <span class="text-gray-900 font-bold text-sm">OG</span>
                </div>
                <div>
                    <p class="text-white font-semibold text-sm leading-none">OGAG Hotel</p>
                    <p class="text-yellow-400 text-xs mt-0.5">Admin Panel</p>
                </div>
            </div>
        </div>

        {{-- Menu --}}
        <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto">

            <p class="text-gray-500 text-xs uppercase tracking-widest px-3 mb-2">Menu Utama</p>

            <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm
               {{ request()->routeIs('admin.dashboard') ? 'bg-yellow-500 text-gray-900 font-semibold shadow-lg' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <p class="text-gray-500 text-xs uppercase tracking-widest px-3 mt-4 mb-2">Reservasi</p>

            <a href="{{ route('admin.reservasi') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm
               {{ request()->routeIs('admin.reservasi*') ? 'bg-yellow-500 text-gray-900 font-semibold shadow-lg' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Manajemen Reservasi
                @php $pendingCount = \App\Models\Reservation::where('status','pending')->count(); @endphp
                @if($pendingCount > 0)
                <span class="ml-auto bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold">
                    {{ $pendingCount }}
                </span>
                @endif
            </a>

            <a href="{{ route('admin.kalender') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm
               {{ request()->routeIs('admin.kalender') ? 'bg-yellow-500 text-gray-900 font-semibold shadow-lg' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Kalender Tamu
            </a>

            <a href="{{ route('admin.laporan') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm
               {{ request()->routeIs('admin.laporan*') ? 'bg-yellow-500 text-gray-900 font-semibold shadow-lg' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Laporan
            </a>

            <p class="text-gray-500 text-xs uppercase tracking-widest px-3 mt-4 mb-2">Hotel</p>

            <a href="{{ route('admin.kamar') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm
               {{ request()->routeIs('admin.kamar') ? 'bg-yellow-500 text-gray-900 font-semibold shadow-lg' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Status Kamar
            </a>

        </nav>

        {{-- User & Logout --}}
        <div class="px-3 py-4 border-t border-white/10">
            <div class="flex items-center gap-3 px-3 py-2 mb-2">
                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center text-gray-900 font-bold text-xs">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <p class="text-white text-xs font-medium">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="text-gray-400 text-xs">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="sidebar-link flex items-center gap-3 px-3 py-2 rounded-xl text-sm text-gray-400 hover:bg-red-500/20 hover:text-red-400 transition w-full">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    {{-- ══ KONTEN UTAMA ══ --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- Topbar --}}
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between shadow-sm">
            <div>
                <h1 class="text-lg font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
                <p class="text-xs text-gray-400 mt-0.5">@yield('subtitle', 'OGAG Hotel Management System')</p>
            </div>
            <div class="flex items-center gap-4">
                @if(session('success'))
                <div class="flex items-center gap-2 text-xs text-green-700 bg-green-50 border border-green-200 px-4 py-2 rounded-full">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
                @endif
                <div class="text-right">
                    <p class="text-xs font-medium text-gray-600">{{ now()->isoFormat('dddd') }}</p>
                    <p class="text-xs text-gray-400">{{ now()->format('d M Y') }}</p>
                </div>
            </div>
        </header>

        {{-- Content --}}
        <main class="flex-1 overflow-y-auto p-8">
            @yield('content')
        </main>

    </div>
</div>

</body>
</html>