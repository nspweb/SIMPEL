<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - SIMPEL BPVP Kendari</title>

    <!-- Tailwind CSS CDN (with full utilities & plugins) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0f7fb',
                            100: '#dceef6',
                            200: '#bedeef',
                            300: '#91c7e4',
                            400: '#5da9d4',
                            500: '#388dc2',
                            600: '#2770a3',
                            700: '#2C4C63', /* Navy SIMPEL Utama */
                            800: '#1e384b',
                            900: '#172e3e',
                            950: '#0e1d28',
                        },
                        amber: {
                            500: '#f59e0b',
                            600: '#d97706',
                        },
                        teal: {
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                        heading: ['Space Grotesk', 'Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Alpine.js & SweetAlert2 & Chart.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .glass-nav {
            background-color: rgba(44, 76, 99, 0.98);
            backdrop-filter: blur(12px);
        }
        /* Custom Clean Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
    @stack('styles')
</head>
<body class="h-full font-sans text-slate-800 antialiased flex flex-col min-h-screen bg-slate-50" x-data="{ mobileMenuOpen: false, year: '{{ request('year', 2026) }}' }">

    <!-- ========================================================================= -->
    <!-- UNIFIED HEADER & TOPBAR (STANDARDIZED ACROSS ALL PAGES) -->
    <!-- ========================================================================= -->
    <header class="glass-nav text-white sticky top-0 z-40 border-b border-brand-800/80 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                
                <!-- Left: Branding & Kemnaker Logo -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <img src="https://bpvpkendari.kemnaker.go.id/storage/upload/setting/11749712002.png" 
                             alt="Logo Kemnaker" 
                             class="h-10 w-10 object-contain rounded-xl p-1 bg-white ring-2 ring-white/20 shadow-xs transition-transform group-hover:scale-105">
                        <div class="flex flex-col">
                            <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-300">BPVP KENDARI &bull; KEMNAKER RI</span>
                            <span class="text-base sm:text-lg font-bold tracking-tight text-white font-heading">SIMPEL <span class="text-teal-300 font-normal">2026</span></span>
                        </div>
                    </a>
                </div>

                <!-- Middle: Desktop Navigation Bar -->
                <nav class="hidden xl:flex items-center space-x-1 text-sm font-medium">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" 
                       class="px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-brand-800 text-white font-semibold ring-1 ring-white/10' : 'text-slate-200 hover:bg-brand-800/60 hover:text-white' }}">
                        <i class="fa-solid fa-chart-pie mr-1.5 text-xs text-teal-300"></i> Dashboard
                    </a>

                    <!-- Pelatihan Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false" @mouseleave="open = false">
                        <button @click="open = !open" @mouseover="open = true" type="button" 
                                class="px-3 py-2 rounded-lg transition-colors flex items-center gap-1.5 {{ request()->routeIs('pelatihan.*') ? 'bg-brand-800 text-white font-semibold ring-1 ring-white/10' : 'text-slate-200 hover:bg-brand-800/60 hover:text-white' }}">
                            <i class="fa-solid fa-graduation-cap text-xs text-teal-300"></i>
                            <span>Pelatihan</span>
                            <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             x-cloak
                             class="absolute left-0 mt-1 w-56 rounded-xl bg-slate-900 border border-slate-700/80 shadow-2xl py-2 z-50">
                            <a href="{{ route('pelatihan.index') }}" class="flex items-center px-4 py-2.5 text-sm text-slate-200 hover:bg-brand-700 hover:text-white transition">
                                <i class="fa-solid fa-building-columns mr-2.5 text-teal-400 text-xs"></i>
                                <div>
                                    <p class="font-medium">Pelatihan UPTP</p>
                                    <p class="text-[11px] text-slate-400">Kelembagaan BPVP Kendari</p>
                                </div>
                            </a>
                            <a href="{{ route('pelatihan.uptd') }}" class="flex items-center px-4 py-2.5 text-sm text-slate-200 hover:bg-brand-700 hover:text-white transition border-t border-slate-800">
                                <i class="fa-solid fa-map-location-dot mr-2.5 text-amber-400 text-xs"></i>
                                <div>
                                    <p class="font-medium">Pelatihan UPTD</p>
                                    <p class="text-[11px] text-slate-400">5 BLK Daerah Binaan</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Sertifikasi -->
                    <a href="{{ route('sertifikasi.index') }}" 
                       class="px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('sertifikasi.*') ? 'bg-brand-800 text-white font-semibold ring-1 ring-white/10' : 'text-slate-200 hover:bg-brand-800/60 hover:text-white' }}">
                        <i class="fa-solid fa-certificate mr-1.5 text-xs text-amber-300"></i> Sertifikasi LSP
                    </a>

                    <!-- Penempatan -->
                    <a href="{{ route('penempatan.index') }}" 
                       class="px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('penempatan.*') ? 'bg-brand-800 text-white font-semibold ring-1 ring-white/10' : 'text-slate-200 hover:bg-brand-800/60 hover:text-white' }}">
                        <i class="fa-solid fa-briefcase mr-1.5 text-xs text-teal-300"></i> Penempatan
                    </a>

                    <!-- Produktivitas -->
                    <a href="{{ route('produktivitas.index') }}" 
                       class="px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('produktivitas.*') ? 'bg-brand-800 text-white font-semibold ring-1 ring-white/10' : 'text-slate-200 hover:bg-brand-800/60 hover:text-white' }}">
                        <i class="fa-solid fa-arrow-trend-up mr-1.5 text-xs text-teal-300"></i> Produktivitas
                    </a>

                    <!-- Umum & Pengadaan -->
                    <a href="{{ route('umum.index') }}" 
                       class="px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('umum.*') ? 'bg-brand-800 text-white font-semibold ring-1 ring-white/10' : 'text-slate-200 hover:bg-brand-800/60 hover:text-white' }}">
                        <i class="fa-solid fa-boxes-stacked mr-1.5 text-xs text-teal-300"></i> Umum & Keuangan
                    </a>
                </nav>

                <!-- Right: Actions, Year Switcher & User Profile -->
                <div class="flex items-center gap-3">
                    
                    <!-- Year Filter Pill -->
                    <form method="GET" action="{{ url()->current() }}" class="hidden sm:flex items-center">
                        @foreach(request()->except('year', 'page') as $key => $val)
                            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                        @endforeach
                        <div class="relative flex items-center">
                            <i class="fa-regular fa-calendar absolute left-2.5 text-xs text-teal-300 pointer-events-none"></i>
                            <select name="year" onchange="this.form.submit()" 
                                    class="bg-brand-800/90 text-white text-xs font-semibold pl-7 pr-7 py-1.5 rounded-lg border border-white/15 focus:outline-none focus:ring-2 focus:ring-teal-400 cursor-pointer transition">
                                <option value="2026" {{ request('year', 2026) == 2026 ? 'selected' : '' }}>Tahun 2026</option>
                                <option value="2025" {{ request('year') == 2025 ? 'selected' : '' }}>Tahun 2025</option>
                                <option value="2024" {{ request('year') == 2024 ? 'selected' : '' }}>Tahun 2024</option>
                            </select>
                        </div>
                    </form>

                    <!-- Quick Input Workspace Button -->
                    <a href="{{ route('input.index') }}" 
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-teal-500 hover:bg-teal-600 text-white text-xs font-bold shadow-xs hover:shadow transition transform active:scale-95">
                        <i class="fa-solid fa-plus-circle text-xs"></i>
                        <span class="hidden md:inline">Input Data</span>
                    </a>

                    <!-- User Profile Dropdown -->
                    <div class="relative" x-data="{ userMenu: false }" @click.outside="userMenu = false">
                        <button @click="userMenu = !userMenu" type="button" 
                                class="flex items-center gap-2 p-1 pl-2 pr-2.5 rounded-lg bg-brand-800/80 hover:bg-brand-800 border border-white/10 text-white transition focus:outline-none">
                            <div class="h-7 w-7 rounded-full bg-teal-400/20 text-teal-300 border border-teal-400/40 flex items-center justify-center font-bold text-xs uppercase">
                                {{ substr(Auth::user()->name ?? 'Admin', 0, 2) }}
                            </div>
                            <div class="hidden lg:flex flex-col text-left">
                                <span class="text-xs font-semibold leading-tight text-white">{{ Auth::user()->name ?? 'Administrator' }}</span>
                                <span class="text-[10px] text-teal-300 font-medium capitalize">{{ Auth::user()->role ?? 'Super Admin' }}</span>
                            </div>
                            <i class="fa-solid fa-chevron-down text-[9px] text-slate-300"></i>
                        </button>

                        <div x-show="userMenu" 
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             x-cloak
                             class="absolute right-0 mt-2 w-56 rounded-xl bg-white text-slate-800 border border-slate-200 shadow-2xl py-2 z-50">
                            <div class="px-4 py-2 border-b border-slate-100">
                                <p class="text-xs text-slate-500 font-medium">Masuk sebagai</p>
                                <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->email ?? 'admin@bpvpkendari.go.id' }}</p>
                            </div>
                            <a href="{{ route('input.index') }}" class="flex items-center px-4 py-2 text-xs font-medium text-slate-700 hover:bg-slate-50 transition">
                                <i class="fa-solid fa-table-cells mr-2.5 text-slate-400"></i> Pusat Formulir Input
                            </a>
                            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-xs font-medium text-slate-700 hover:bg-slate-50 transition">
                                <i class="fa-solid fa-chart-line mr-2.5 text-slate-400"></i> Analitik & Laporan
                            </a>
                            <div class="border-t border-slate-100 mt-1 pt-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center px-4 py-2 text-xs font-medium text-red-600 hover:bg-red-50 transition">
                                        <i class="fa-solid fa-arrow-right-from-bracket mr-2.5"></i> Keluar (Logout)
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Menu Trigger -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" 
                            class="xl:hidden p-2 rounded-lg bg-brand-800 hover:bg-brand-900 text-white focus:outline-none">
                        <i class="fa-solid" :class="mobileMenuOpen ? 'fa-xmark text-lg' : 'fa-bars text-lg'"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             x-cloak
             class="xl:hidden bg-brand-900 border-t border-brand-800 px-4 pt-3 pb-5 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-brand-800 text-teal-300' : 'text-slate-200 hover:bg-brand-800' }}">
                <i class="fa-solid fa-chart-pie mr-2 text-teal-400"></i> Dashboard
            </a>
            <a href="{{ route('pelatihan.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('pelatihan.index') ? 'bg-brand-800 text-teal-300' : 'text-slate-200 hover:bg-brand-800' }}">
                <i class="fa-solid fa-graduation-cap mr-2 text-teal-400"></i> Pelatihan UPTP (Kelembagaan)
            </a>
            <a href="{{ route('pelatihan.uptd') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('pelatihan.uptd') ? 'bg-brand-800 text-teal-300' : 'text-slate-200 hover:bg-brand-800' }}">
                <i class="fa-solid fa-map-location-dot mr-2 text-amber-400"></i> Pelatihan UPTD Binaan
            </a>
            <a href="{{ route('sertifikasi.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('sertifikasi.*') ? 'bg-brand-800 text-teal-300' : 'text-slate-200 hover:bg-brand-800' }}">
                <i class="fa-solid fa-certificate mr-2 text-amber-300"></i> Sertifikasi LSP
            </a>
            <a href="{{ route('penempatan.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('penempatan.*') ? 'bg-brand-800 text-teal-300' : 'text-slate-200 hover:bg-brand-800' }}">
                <i class="fa-solid fa-briefcase mr-2 text-teal-400"></i> Penempatan Alumni
            </a>
            <a href="{{ route('produktivitas.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('produktivitas.*') ? 'bg-brand-800 text-teal-300' : 'text-slate-200 hover:bg-brand-800' }}">
                <i class="fa-solid fa-arrow-trend-up mr-2 text-teal-400"></i> Produktivitas
            </a>
            <a href="{{ route('umum.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('umum.*') ? 'bg-brand-800 text-teal-300' : 'text-slate-200 hover:bg-brand-800' }}">
                <i class="fa-solid fa-boxes-stacked mr-2 text-teal-400"></i> Umum & Keuangan
            </a>
            <div class="pt-2 border-t border-brand-800">
                <a href="{{ route('input.index') }}" class="block px-3 py-2 rounded-lg text-sm font-bold bg-teal-600 text-white text-center">
                    <i class="fa-solid fa-plus-circle mr-1.5"></i> Formulir Input Data
                </a>
            </div>
        </div>
    </header>

    <!-- ========================================================================= -->
    <!-- MAIN CONTENT CONTAINER -->
    <!-- ========================================================================= -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
        
        <!-- Flash Alert Message -->
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                 class="mb-6 flex items-center justify-between p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 shadow-xs">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button @click="show = false" type="button" class="text-emerald-600 hover:text-emerald-800">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 shadow-xs">
                <div class="flex items-center gap-3 mb-2">
                    <i class="fa-solid fa-circle-exclamation text-rose-500 text-lg"></i>
                    <span class="text-sm font-bold">Mohon periksa kembali input formulir Anda:</span>
                </div>
                <ul class="list-disc list-inside text-xs space-y-1 ml-6 text-rose-700">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- ========================================================================= -->
    <!-- FOOTER -->
    <!-- ========================================================================= -->
    <footer class="bg-white border-t border-slate-200/80 mt-auto py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <div class="flex items-center gap-2">
                <img src="https://bpvpkendari.kemnaker.go.id/storage/upload/setting/11749712002.png" alt="Logo Kemnaker" class="h-5 w-5 object-contain">
                <span>&copy; {{ date('Y') }} <strong>SIMPEL BPVP Kendari</strong> &bull; Balai Pelatihan Vokasi dan Produktivitas Kendari</span>
            </div>
            <div class="flex items-center gap-4 text-slate-400">
                <span>Laravel 11 &bull; Tailwind CSS &bull; Self-Hosted Edition</span>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
