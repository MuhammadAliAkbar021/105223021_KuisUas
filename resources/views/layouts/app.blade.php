<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Manajemen Kost')</title>
    
    {{-- CDN TAILWIND --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .nav-link.active {
            border-bottom: 2px solid white;
            color: white;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal flex flex-col min-h-screen">

    {{-- NAVBAR UTAMA (INDIGO) --}}
    <nav class="bg-indigo-700 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                
                {{-- 1. Logo / Brand --}}
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-xl font-bold text-white hover:text-indigo-100 transition">
                         KOST EXCLUSIVE
                    </a>
                </div>
                
                {{-- 2. Menu Desktop (Tampil di Layar Besar) --}}
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}" class="text-indigo-200 hover:text-white font-medium py-2 transition {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('kamar.index') }}" class="text-indigo-200 hover:text-white font-medium py-2 transition {{ request()->routeIs('kamar.*') ? 'active' : '' }}">Kamar</a>
                    <a href="{{ route('penyewa.index') }}" class="text-indigo-200 hover:text-white font-medium py-2 transition {{ request()->routeIs('penyewa.*') ? 'active' : '' }}">Penyewa</a>
                    <a href="{{ route('kontrak.index') }}" class="text-indigo-200 hover:text-white font-medium py-2 transition {{ request()->routeIs('kontrak.*') ? 'active' : '' }}">Kontrak</a>
                    <a href="{{ route('pembayaran.index') }}" class="text-indigo-200 hover:text-white font-medium py-2 transition {{ request()->routeIs('pembayaran.*') ? 'active' : '' }}">Pembayaran</a>
                </div>

                {{-- 3. Tombol Menu HP (Hamburger) - Tampil di Layar Kecil --}}
                <div class="md:hidden flex items-center">
                    <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="text-indigo-200 hover:text-white focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- 4. Menu Dropdown HP (Hidden by default) --}}
        <div id="mobile-menu" class="hidden md:hidden bg-indigo-800 border-t border-indigo-600">
            <a href="{{ route('dashboard') }}" class="block py-3 px-4 text-indigo-100 hover:bg-indigo-900 hover:text-white">Dashboard</a>
            <a href="{{ route('kamar.index') }}" class="block py-3 px-4 text-indigo-100 hover:bg-indigo-900 hover:text-white">Kamar</a>
            <a href="{{ route('penyewa.index') }}" class="block py-3 px-4 text-indigo-100 hover:bg-indigo-900 hover:text-white">Penyewa</a>
            <a href="{{ route('kontrak.index') }}" class="block py-3 px-4 text-indigo-100 hover:bg-indigo-900 hover:text-white">Kontrak</a>
            <a href="{{ route('pembayaran.index') }}" class="block py-3 px-4 text-indigo-100 hover:bg-indigo-900 hover:text-white">Pembayaran</a>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    <main class="flex-grow max-w-7xl mx-auto py-6 px-4 w-full">
        
        {{-- Flash Messages (Notifikasi) --}}
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm" role="alert">
                <p class="font-bold">Error!</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        {{-- Isi Halaman --}}
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-white border-t mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4">
            <p class="text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Sistem Manajemen Kost Exclusive.
            </p>
        </div>
    </footer>

</body>
</html>