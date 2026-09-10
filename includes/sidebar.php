<?php
/**
 * SIMPEL BPVP Kendari - Server-Side Role-Based Sidebar
 * Menampilkan menu navigasi sesuai hak akses dan wewenang masing-masing role
 */

if (!isset($currentUser)) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $currentUser = $_SESSION['user'] ?? [
        'name' => 'Administrator',
        'role' => 'admin',
        'role_label' => 'Super Administrator',
        'home' => 'dashboard.php'
    ];
}

$userRole = $currentUser['role'] ?? 'admin';
$userName = $currentUser['name'] ?? 'Petugas';
$userRoleLabel = $currentUser['role_label'] ?? strtoupper($userRole);
$userInitial = strtoupper(substr($userName, 0, 1));
$active = $activePage ?? '';

// Role-specific badge styling
$roleThemes = [
    'admin' => [
        'badge' => 'text-rose-400 bg-rose-500/10 border border-rose-500/30',
        'avatar' => 'bg-gradient-to-tr from-rose-600 to-red-500 shadow-rose-500/30',
        'active_bg' => 'bg-gradient-to-r from-rose-700 to-red-800 text-white shadow-md shadow-rose-900/30',
        'active_icon' => 'bg-white/20 text-white',
        'active_sub' => 'bg-rose-600/20 text-rose-400 font-bold border-l-2 border-rose-500 -ml-[16px] pl-[14px]'
    ],
    'pimpinan' => [
        'badge' => 'text-purple-400 bg-purple-500/10 border border-purple-500/30',
        'avatar' => 'bg-gradient-to-tr from-purple-600 to-indigo-500 shadow-purple-500/30',
        'active_bg' => 'bg-gradient-to-r from-purple-700 to-indigo-800 text-white shadow-md shadow-purple-900/30',
        'active_icon' => 'bg-white/20 text-white',
        'active_sub' => 'bg-purple-600/20 text-purple-400 font-bold border-l-2 border-purple-500 -ml-[16px] pl-[14px]'
    ],
    'pemberdayaan' => [
        'badge' => 'text-blue-400 bg-blue-500/10 border border-blue-500/30',
        'avatar' => 'bg-gradient-to-tr from-blue-600 to-cyan-500 shadow-blue-500/30',
        'active_bg' => 'bg-gradient-to-r from-blue-700 to-indigo-800 text-white shadow-md shadow-blue-900/30',
        'active_icon' => 'bg-white/20 text-white',
        'active_sub' => 'bg-blue-600/20 text-blue-400 font-bold border-l-2 border-blue-500 -ml-[16px] pl-[14px]'
    ],
    'penyelenggara' => [
        'badge' => 'text-teal-400 bg-teal-500/10 border border-teal-500/30',
        'avatar' => 'bg-gradient-to-tr from-teal-600 to-emerald-500 shadow-teal-500/30',
        'active_bg' => 'bg-gradient-to-r from-teal-700 to-emerald-800 text-white shadow-md shadow-teal-900/30',
        'active_icon' => 'bg-white/20 text-white',
        'active_sub' => 'bg-teal-600/20 text-teal-400 font-bold border-l-2 border-teal-500 -ml-[16px] pl-[14px]'
    ],
    'produktivitas' => [
        'badge' => 'text-emerald-400 bg-emerald-500/10 border border-emerald-500/30',
        'avatar' => 'bg-gradient-to-tr from-emerald-600 to-teal-500 shadow-emerald-500/30',
        'active_bg' => 'bg-gradient-to-r from-emerald-700 to-teal-800 text-white shadow-md shadow-emerald-900/30',
        'active_icon' => 'bg-white/20 text-white',
        'active_sub' => 'bg-emerald-600/20 text-emerald-400 font-bold border-l-2 border-emerald-500 -ml-[16px] pl-[14px]'
    ],
    'tu' => [
        'badge' => 'text-amber-400 bg-amber-500/10 border border-amber-500/30',
        'avatar' => 'bg-gradient-to-tr from-amber-600 to-orange-500 shadow-amber-500/30',
        'active_bg' => 'bg-gradient-to-r from-amber-700 to-orange-800 text-white shadow-md shadow-amber-900/30',
        'active_icon' => 'bg-white/20 text-white',
        'active_sub' => 'bg-amber-600/20 text-amber-400 font-bold border-l-2 border-amber-500 -ml-[16px] pl-[14px]'
    ],
    'lsp' => [
        'badge' => 'text-orange-400 bg-orange-500/10 border border-orange-500/30',
        'avatar' => 'bg-gradient-to-tr from-orange-600 to-amber-500 shadow-orange-500/30',
        'active_bg' => 'bg-gradient-to-r from-orange-700 to-amber-800 text-white shadow-md shadow-orange-900/30',
        'active_icon' => 'bg-white/20 text-white',
        'active_sub' => 'bg-orange-600/20 text-orange-400 font-bold border-l-2 border-orange-500 -ml-[16px] pl-[14px]'
    ],
    'keuangan' => [
        'badge' => 'text-emerald-400 bg-emerald-500/10 border border-emerald-500/30',
        'avatar' => 'bg-gradient-to-tr from-emerald-600 to-teal-500 shadow-emerald-500/30',
        'active_bg' => 'bg-gradient-to-r from-emerald-700 to-teal-800 text-white shadow-md shadow-emerald-900/30',
        'active_icon' => 'bg-white/20 text-white',
        'active_sub' => 'bg-emerald-600/20 text-emerald-400 font-bold border-l-2 border-emerald-500 -ml-[16px] pl-[14px]'
    ],
    'pengadaan' => [
        'badge' => 'text-indigo-400 bg-indigo-500/10 border border-indigo-500/30',
        'avatar' => 'bg-gradient-to-tr from-indigo-600 to-blue-500 shadow-indigo-500/30',
        'active_bg' => 'bg-gradient-to-r from-indigo-700 to-blue-800 text-white shadow-md shadow-indigo-900/30',
        'active_icon' => 'bg-white/20 text-white',
        'active_sub' => 'bg-indigo-600/20 text-indigo-400 font-bold border-l-2 border-indigo-500 -ml-[16px] pl-[14px]'
    ]
];

$theme = $roleThemes[$userRole] ?? $roleThemes['admin'];

// Helper variables for admin/pimpinan dropdowns
$isTuActive = in_array($active, ['pelatihan_uptd', 'input_pelatihan_uptd', 'perjalanan_dinas', 'input_perjalanan_dinas']);
$isPokjaActive = in_array($active, ['pengadaan', 'detail_pengadaan', 'input']);
$isBidangActive = in_array($active, [
    'penempatan', 'pelatihan', 'produktivitas', 'pelatihan_uptd', 'sertifikasi', 
    'keuangan', 'pengadaan', 'detail_pengadaan', 'input_penyelenggara', 
    'input_pemberdayaan', 'input_lsp', 'input_produktivitas', 'input_pelatihan_uptd',
    'perjalanan_dinas', 'input_perjalanan_dinas', 'input'
]);
?>

<!-- BACKDROP OVERLAY FOR MOBILE -->
<div id="simpel-sidebar-backdrop" onclick="document.getElementById('simpel-sidebar').classList.add('-translate-x-full'); this.classList.add('hidden')" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-40 lg:hidden hidden transition-opacity"></div>

<!-- MODERN SLEEK DARK SIDEBAR -->
<aside id="simpel-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0F172A] border-r border-slate-800 text-slate-200 flex flex-col justify-between transition-transform duration-300 -translate-x-full lg:translate-x-0 shadow-2xl">
    
    <!-- BRAND LOGO & HEADER -->
    <div>
        <div class="h-20 flex items-center justify-between px-6 border-b border-slate-800/80">
            <a href="<?= htmlspecialchars($currentUser['home'] ?? 'dashboard.php') ?>" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-teal-500 to-emerald-400 flex items-center justify-center text-slate-950 font-extrabold text-lg shadow-md shadow-teal-500/20">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-lg font-extrabold font-heading text-white tracking-wider leading-none">
                        SIMPEL
                    </span>
                    <span class="text-[10px] text-teal-400 font-semibold uppercase tracking-widest mt-1">
                        BPVP KENDARI
                    </span>
                </div>
            </a>

            <!-- Mobile Close button -->
            <button type="button" onclick="document.getElementById('simpel-sidebar').classList.add('-translate-x-full'); document.getElementById('simpel-sidebar-backdrop').classList.add('hidden')" class="lg:hidden p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>

        <!-- SIDEBAR NAV ITEMS (ROLE-SPECIFIC) -->
        <nav class="p-4 space-y-1.5 overflow-y-auto max-h-[calc(100vh-170px)]">

            <!-- 1. DASHBOARD UTAMA (ACCESSIBLE TO ALL) -->
            <a href="dashboard.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'dashboard' ? 'bg-gradient-to-r from-emerald-700 to-teal-800 text-white shadow-md shadow-emerald-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                <div class="w-6 h-6 rounded-lg <?= $active === 'dashboard' ? 'bg-white/20 text-white' : 'bg-emerald-500/15 text-emerald-400 group-hover:bg-emerald-500/30 group-hover:text-emerald-300' ?> flex items-center justify-center shrink-0 transition">
                    <i class="fa-solid fa-chart-pie text-xs"></i>
                </div>
                <span><?= $userRole === 'pimpinan' ? 'Dashboard Eksekutif' : 'Dashboard Utama' ?></span>
            </a>

            <!-- ======================================================== -->
            <!-- A. SUPER ADMINISTRATOR (FULL ACCESS KE SELURUH BIDANG) -->
            <!-- ======================================================== -->
            <?php if ($userRole === 'admin'): ?>
                
                <!-- Perjalanan Dinas (SPD) Mandiri -->
                <a href="perjalanan_dinas.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= in_array($active, ['perjalanan_dinas', 'input_perjalanan_dinas']) ? 'bg-gradient-to-r from-emerald-800 to-teal-900 text-white shadow-md shadow-emerald-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= in_array($active, ['perjalanan_dinas', 'input_perjalanan_dinas']) ? 'bg-white/20 text-white' : 'bg-emerald-500/15 text-emerald-400 group-hover:bg-emerald-500/30 group-hover:text-emerald-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-briefcase text-xs"></i>
                    </div>
                    <div class="flex-1 flex items-center justify-between">
                        <span>Perjalanan Dinas (SPD)</span>
                        <span class="px-1.5 py-0.5 rounded-full bg-emerald-500/20 text-[9px] font-extrabold text-emerald-300">Mandiri</span>
                    </div>
                </a>

                <!-- SECTION LABEL -->
                <div class="pt-3 pb-1 px-2">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-slate-500 font-heading">Kontrol Seluruh Bidang</span>
                </div>

                <!-- Dropdown Menu Bidang -->
                <div class="space-y-1">
                    <button type="button" onclick="toggleBidangDropdown()" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $isBidangActive ? 'bg-slate-800/80 text-white' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' ?>">
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-lg <?= $isBidangActive ? 'bg-emerald-500/20 text-emerald-400' : 'bg-slate-800 text-slate-400 group-hover:text-white' ?> flex items-center justify-center shrink-0 transition">
                                <i class="fa-solid fa-sitemap text-xs"></i>
                            </div>
                            <span>Semua Bidang (8)</span>
                        </div>
                        <i id="bidang-chevron" class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200 <?= $isBidangActive ? 'rotate-180' : '' ?>"></i>
                    </button>

                    <div id="bidang-submenu" class="<?= $isBidangActive ? '' : 'hidden' ?> space-y-1 pl-4 border-l-2 border-slate-800 ml-4 py-1">
                        
                        <!-- 1. Pemberdayaan -->
                        <a href="penempatan.php" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold transition group <?= in_array($active, ['penempatan', 'input_pemberdayaan']) ? 'bg-blue-600/20 text-blue-400 font-bold border-l-2 border-blue-500 -ml-[16px] pl-[14px]' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' ?>">
                            <div class="w-5 h-5 rounded-md bg-blue-500/15 text-blue-400 flex items-center justify-center shrink-0 group-hover:bg-blue-500/30 transition">
                                <i class="fa-solid fa-users text-[10px]"></i>
                            </div>
                            <span>Pemberdayaan</span>
                        </a>

                        <!-- 2. Penyelenggara -->
                        <a href="pelatihan.php" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold transition group <?= in_array($active, ['pelatihan', 'input_penyelenggara']) ? 'bg-teal-600/20 text-teal-400 font-bold border-l-2 border-teal-500 -ml-[16px] pl-[14px]' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' ?>">
                            <div class="w-5 h-5 rounded-md bg-teal-500/15 text-teal-400 flex items-center justify-center shrink-0 group-hover:bg-teal-500/30 transition">
                                <i class="fa-solid fa-graduation-cap text-[10px]"></i>
                            </div>
                            <span>Penyelenggara</span>
                        </a>

                        <!-- 3. Produktivitas -->
                        <a href="produktivitas.php" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold transition group <?= in_array($active, ['produktivitas', 'input_produktivitas']) ? 'bg-emerald-600/20 text-emerald-400 font-bold border-l-2 border-emerald-500 -ml-[16px] pl-[14px]' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' ?>">
                            <div class="w-5 h-5 rounded-md bg-emerald-500/15 text-emerald-400 flex items-center justify-center shrink-0 group-hover:bg-emerald-500/30 transition">
                                <i class="fa-solid fa-arrow-trend-up text-[10px]"></i>
                            </div>
                            <span>Produktivitas</span>
                        </a>

                        <!-- 4. Umum / TU -->
                        <div class="space-y-0.5">
                            <button type="button" onclick="toggleTuDropdown()" class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-xs font-semibold text-slate-400 hover:text-white hover:bg-slate-800/40 transition group">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-5 h-5 rounded-md bg-amber-500/15 text-amber-400 flex items-center justify-center shrink-0 group-hover:bg-amber-500/30 transition">
                                        <i class="fa-solid fa-landmark text-[10px]"></i>
                                    </div>
                                    <span>Umum / TU</span>
                                </div>
                                <i id="tu-chevron" class="fa-solid fa-chevron-down text-[9px] text-slate-500 transition-transform duration-200 <?= $isTuActive ? 'rotate-180' : '' ?>"></i>
                            </button>
                            <div id="tu-submenu" class="<?= $isTuActive ? '' : 'hidden' ?> space-y-1 pl-3.5 border-l border-slate-700 ml-4 py-0.5">
                                <a href="pelatihan_uptd.php" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-[11px] font-medium transition group <?= in_array($active, ['pelatihan_uptd', 'input_pelatihan_uptd']) ? 'text-amber-300 font-bold bg-amber-500/20' : 'text-slate-400 hover:text-white' ?>">
                                    <div class="w-4 h-4 rounded bg-amber-500/20 text-amber-400 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-map-location-dot text-[9px]"></i>
                                    </div>
                                    <span>Pelatihan UPTD</span>
                                </a>
                                <a href="perjalanan_dinas.php" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-[11px] font-medium transition group <?= in_array($active, ['perjalanan_dinas', 'input_perjalanan_dinas']) ? 'text-emerald-300 font-bold bg-emerald-500/20' : 'text-slate-400 hover:text-white' ?>">
                                    <div class="w-4 h-4 rounded bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-briefcase text-[9px]"></i>
                                    </div>
                                    <span>Perjalanan Dinas (SPD)</span>
                                </a>
                            </div>
                        </div>

                        <!-- 5. LSP -->
                        <a href="sertifikasi.php" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold transition group <?= in_array($active, ['sertifikasi', 'input_lsp']) ? 'bg-orange-600/20 text-orange-400 font-bold border-l-2 border-orange-500 -ml-[16px] pl-[14px]' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' ?>">
                            <div class="w-5 h-5 rounded-md bg-orange-500/15 text-orange-400 flex items-center justify-center shrink-0 group-hover:bg-orange-500/30 transition">
                                <i class="fa-solid fa-award text-[10px]"></i>
                            </div>
                            <span>LSP</span>
                        </a>

                        <!-- 6. Keuangan -->
                        <a href="keuangan.php" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold transition group <?= $active === 'keuangan' ? 'bg-emerald-600/20 text-emerald-400 font-bold border-l-2 border-emerald-500 -ml-[16px] pl-[14px]' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' ?>">
                            <div class="w-5 h-5 rounded-md bg-emerald-500/15 text-emerald-400 flex items-center justify-center shrink-0 group-hover:bg-emerald-500/30 transition">
                                <i class="fa-solid fa-wallet text-[10px]"></i>
                            </div>
                            <span>Keuangan</span>
                        </a>

                        <!-- 7. Pengadaan / Pokja -->
                        <div class="space-y-0.5">
                            <button type="button" onclick="togglePokjaDropdown()" class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-xs font-semibold text-slate-400 hover:text-white hover:bg-slate-800/40 transition group">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-5 h-5 rounded-md bg-indigo-500/15 text-indigo-400 flex items-center justify-center shrink-0 group-hover:bg-indigo-500/30 transition">
                                        <i class="fa-solid fa-boxes-packing text-[10px]"></i>
                                    </div>
                                    <span>Pengadaan / Pokja</span>
                                </div>
                                <i id="pokja-chevron" class="fa-solid fa-chevron-down text-[9px] text-slate-500 transition-transform duration-200 <?= $isPokjaActive ? 'rotate-180' : '' ?>"></i>
                            </button>
                            <div id="pokja-submenu" class="<?= $isPokjaActive ? '' : 'hidden' ?> space-y-1 pl-3.5 border-l border-slate-700 ml-4 py-0.5">
                                <a href="pengadaan.php" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-[11px] font-medium transition group <?= $active === 'pengadaan' ? 'text-indigo-300 font-bold bg-indigo-500/20' : 'text-slate-400 hover:text-white' ?>">
                                    <div class="w-4 h-4 rounded bg-indigo-500/20 text-indigo-400 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-boxes-stacked text-[9px]"></i>
                                    </div>
                                    <span>Data Pengadaan</span>
                                </a>
                                <a href="detail_pengadaan.php" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-[11px] font-medium transition group <?= $active === 'detail_pengadaan' ? 'text-indigo-300 font-bold bg-indigo-500/20' : 'text-slate-400 hover:text-white' ?>">
                                    <div class="w-4 h-4 rounded bg-indigo-500/20 text-indigo-400 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-calculator text-[9px]"></i>
                                    </div>
                                    <span>Rincian Bahan</span>
                                </a>
                                <a href="input.php" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-[11px] font-medium transition group <?= $active === 'input' ? 'text-indigo-300 font-bold bg-indigo-500/20' : 'text-slate-400 hover:text-white' ?>">
                                    <div class="w-4 h-4 rounded bg-indigo-500/20 text-indigo-400 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-file-contract text-[9px]"></i>
                                    </div>
                                    <span>Rekap SPK & Pesanan</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            <!-- ======================================================== -->
            <!-- B. PIMPINAN (KEPALA BALAI - MONITORING EKSEKUTIF) -->
            <!-- ======================================================== -->
            <?php elseif ($userRole === 'pimpinan'): ?>

                <!-- Perjalanan Dinas (SPD) Mandiri Pimpinan -->
                <a href="perjalanan_dinas.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= in_array($active, ['perjalanan_dinas', 'input_perjalanan_dinas']) ? 'bg-gradient-to-r from-purple-800 to-indigo-900 text-white shadow-md shadow-purple-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= in_array($active, ['perjalanan_dinas', 'input_perjalanan_dinas']) ? 'bg-white/20 text-white' : 'bg-purple-500/15 text-purple-400 group-hover:bg-purple-500/30 group-hover:text-purple-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-briefcase text-xs"></i>
                    </div>
                    <div class="flex-1 flex items-center justify-between">
                        <span>Perjalanan Dinas (SPD)</span>
                        <span class="px-1.5 py-0.5 rounded-full bg-purple-500/20 text-[9px] font-extrabold text-purple-300">Mandiri</span>
                    </div>
                </a>

                <!-- Rincian Bahan Pelatihan -->
                <a href="detail_pengadaan.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'detail_pengadaan' ? 'bg-gradient-to-r from-indigo-700 to-purple-800 text-white shadow-md shadow-indigo-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= $active === 'detail_pengadaan' ? 'bg-white/20 text-white' : 'bg-indigo-500/15 text-indigo-400 group-hover:bg-indigo-500/30 group-hover:text-indigo-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-calculator text-xs"></i>
                    </div>
                    <span>Rincian Bahan Pelatihan</span>
                </a>

                <!-- SECTION LABEL -->
                <div class="pt-3 pb-1 px-2">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-purple-400/80 font-heading">Monitoring Bidang</span>
                </div>

                <!-- Dropdown Monitoring Semua Bidang -->
                <div class="space-y-1">
                    <button type="button" onclick="toggleBidangDropdown()" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $isBidangActive ? 'bg-slate-800/80 text-white' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' ?>">
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-lg <?= $isBidangActive ? 'bg-purple-500/20 text-purple-400' : 'bg-slate-800 text-slate-400 group-hover:text-white' ?> flex items-center justify-center shrink-0 transition">
                                <i class="fa-solid fa-eye text-xs"></i>
                            </div>
                            <span>Laporan Bidang</span>
                        </div>
                        <i id="bidang-chevron" class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200 <?= $isBidangActive ? 'rotate-180' : '' ?>"></i>
                    </button>

                    <div id="bidang-submenu" class="<?= $isBidangActive ? '' : 'hidden' ?> space-y-1 pl-4 border-l-2 border-slate-800 ml-4 py-1">
                        <a href="penempatan.php" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold transition group <?= $active === 'penempatan' ? 'bg-blue-600/20 text-blue-400 font-bold border-l-2 border-blue-500 -ml-[16px] pl-[14px]' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' ?>">
                            <div class="w-5 h-5 rounded-md bg-blue-500/15 text-blue-400 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-users text-[10px]"></i>
                            </div>
                            <span>Pemberdayaan</span>
                        </a>
                        <a href="pelatihan.php" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold transition group <?= $active === 'pelatihan' ? 'bg-teal-600/20 text-teal-400 font-bold border-l-2 border-teal-500 -ml-[16px] pl-[14px]' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' ?>">
                            <div class="w-5 h-5 rounded-md bg-teal-500/15 text-teal-400 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-graduation-cap text-[10px]"></i>
                            </div>
                            <span>Penyelenggara</span>
                        </a>
                        <a href="produktivitas.php" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold transition group <?= $active === 'produktivitas' ? 'bg-emerald-600/20 text-emerald-400 font-bold border-l-2 border-emerald-500 -ml-[16px] pl-[14px]' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' ?>">
                            <div class="w-5 h-5 rounded-md bg-emerald-500/15 text-emerald-400 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-arrow-trend-up text-[10px]"></i>
                            </div>
                            <span>Produktivitas</span>
                        </a>
                        <a href="pelatihan_uptd.php" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold transition group <?= $active === 'pelatihan_uptd' ? 'bg-amber-600/20 text-amber-400 font-bold border-l-2 border-amber-500 -ml-[16px] pl-[14px]' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' ?>">
                            <div class="w-5 h-5 rounded-md bg-amber-500/15 text-amber-400 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-map-location-dot text-[10px]"></i>
                            </div>
                            <span>Pelatihan UPTD</span>
                        </a>
                        <a href="sertifikasi.php" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold transition group <?= $active === 'sertifikasi' ? 'bg-orange-600/20 text-orange-400 font-bold border-l-2 border-orange-500 -ml-[16px] pl-[14px]' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' ?>">
                            <div class="w-5 h-5 rounded-md bg-orange-500/15 text-orange-400 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-award text-[10px]"></i>
                            </div>
                            <span>LSP</span>
                        </a>
                        <a href="keuangan.php" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold transition group <?= $active === 'keuangan' ? 'bg-emerald-600/20 text-emerald-400 font-bold border-l-2 border-emerald-500 -ml-[16px] pl-[14px]' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' ?>">
                            <div class="w-5 h-5 rounded-md bg-emerald-500/15 text-emerald-400 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-wallet text-[10px]"></i>
                            </div>
                            <span>Keuangan</span>
                        </a>
                        <a href="pengadaan.php" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold transition group <?= $active === 'pengadaan' ? 'bg-indigo-600/20 text-indigo-400 font-bold border-l-2 border-indigo-500 -ml-[16px] pl-[14px]' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' ?>">
                            <div class="w-5 h-5 rounded-md bg-indigo-500/15 text-indigo-400 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-boxes-packing text-[10px]"></i>
                            </div>
                            <span>Pengadaan</span>
                        </a>
                    </div>
                </div>

            <!-- ======================================================== -->
            <!-- C. BIDANG PEMBERDAYAAN & PENEMPATAN -->
            <!-- ======================================================== -->
            <?php elseif ($userRole === 'pemberdayaan'): ?>

                <!-- SECTION LABEL -->
                <div class="pt-3 pb-1 px-2">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-blue-400 font-heading">Menu Pemberdayaan</span>
                </div>

                <!-- 1. Data Penempatan Alumni -->
                <a href="penempatan.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'penempatan' ? 'bg-gradient-to-r from-blue-700 to-indigo-800 text-white shadow-md shadow-blue-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= $active === 'penempatan' ? 'bg-white/20 text-white' : 'bg-blue-500/15 text-blue-400 group-hover:bg-blue-500/30 group-hover:text-blue-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-users text-xs"></i>
                    </div>
                    <span>Data Penempatan Alumni</span>
                </a>

                <!-- 2. Input Peserta BNBA -->
                <a href="input_pemberdayaan.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'input_pemberdayaan' ? 'bg-gradient-to-r from-blue-700 to-indigo-800 text-white shadow-md shadow-blue-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= $active === 'input_pemberdayaan' ? 'bg-white/20 text-white' : 'bg-blue-500/15 text-blue-400 group-hover:bg-blue-500/30 group-hover:text-blue-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-user-plus text-xs"></i>
                    </div>
                    <div class="flex-1 flex items-center justify-between">
                        <span>Input Peserta (BNBA)</span>
                        <span class="px-1.5 py-0.5 rounded-md bg-blue-500/20 text-[9px] font-extrabold text-blue-300">Form</span>
                    </div>
                </a>

            <!-- ======================================================== -->
            <!-- D. BIDANG PENYELENGGARA PELATIHAN -->
            <!-- ======================================================== -->
            <?php elseif ($userRole === 'penyelenggara'): ?>

                <!-- SECTION LABEL -->
                <div class="pt-3 pb-1 px-2">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-400 font-heading">Menu Penyelenggara</span>
                </div>

                <!-- 1. Data Pelatihan -->
                <a href="pelatihan.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'pelatihan' ? 'bg-gradient-to-r from-teal-700 to-emerald-800 text-white shadow-md shadow-teal-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= $active === 'pelatihan' ? 'bg-white/20 text-white' : 'bg-teal-500/15 text-teal-400 group-hover:bg-teal-500/30 group-hover:text-teal-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-graduation-cap text-xs"></i>
                    </div>
                    <span>Data Pelatihan</span>
                </a>

                <!-- 2. Input Pelatihan Per Batch -->
                <a href="input_penyelenggara.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'input_penyelenggara' ? 'bg-gradient-to-r from-teal-700 to-emerald-800 text-white shadow-md shadow-teal-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= $active === 'input_penyelenggara' ? 'bg-white/20 text-white' : 'bg-teal-500/15 text-teal-400 group-hover:bg-teal-500/30 group-hover:text-teal-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-calendar-plus text-xs"></i>
                    </div>
                    <div class="flex-1 flex items-center justify-between">
                        <span>Input Pelatihan (Batch)</span>
                        <span class="px-1.5 py-0.5 rounded-md bg-teal-500/20 text-[9px] font-extrabold text-teal-300">Form</span>
                    </div>
                </a>

            <!-- ======================================================== -->
            <!-- E. BIDANG PENINGKATAN PRODUKTIVITAS -->
            <!-- ======================================================== -->
            <?php elseif ($userRole === 'produktivitas'): ?>

                <!-- SECTION LABEL -->
                <div class="pt-3 pb-1 px-2">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-emerald-400 font-heading">Menu Produktivitas</span>
                </div>

                <!-- 1. Data Produktivitas -->
                <a href="produktivitas.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'produktivitas' ? 'bg-gradient-to-r from-emerald-700 to-teal-800 text-white shadow-md shadow-emerald-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= $active === 'produktivitas' ? 'bg-white/20 text-white' : 'bg-emerald-500/15 text-emerald-400 group-hover:bg-emerald-500/30 group-hover:text-emerald-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-arrow-trend-up text-xs"></i>
                    </div>
                    <span>Data Produktivitas</span>
                </a>

                <!-- 2. Input Produktivitas -->
                <a href="input_produktivitas.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'input_produktivitas' ? 'bg-gradient-to-r from-emerald-700 to-teal-800 text-white shadow-md shadow-emerald-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= $active === 'input_produktivitas' ? 'bg-white/20 text-white' : 'bg-emerald-500/15 text-emerald-400 group-hover:bg-emerald-500/30 group-hover:text-emerald-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-chart-line text-xs"></i>
                    </div>
                    <div class="flex-1 flex items-center justify-between">
                        <span>Input Produktivitas</span>
                        <span class="px-1.5 py-0.5 rounded-md bg-emerald-500/20 text-[9px] font-extrabold text-emerald-300">Form</span>
                    </div>
                </a>

            <!-- ======================================================== -->
            <!-- F. BAGIAN UMUM / TATA USAHA & UPTD -->
            <!-- ======================================================== -->
            <?php elseif ($userRole === 'tu'): ?>

                <!-- SECTION LABEL -->
                <div class="pt-3 pb-1 px-2">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-amber-400 font-heading">Menu Umum & TU</span>
                </div>

                <!-- 1. Pelatihan UPTD -->
                <a href="pelatihan_uptd.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'pelatihan_uptd' ? 'bg-gradient-to-r from-amber-700 to-orange-800 text-white shadow-md shadow-amber-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= $active === 'pelatihan_uptd' ? 'bg-white/20 text-white' : 'bg-amber-500/15 text-amber-400 group-hover:bg-amber-500/30 group-hover:text-amber-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-map-location-dot text-xs"></i>
                    </div>
                    <span>Pelatihan UPTD Binaan</span>
                </a>

                <!-- 2. Input Pelatihan UPTD -->
                <a href="input_pelatihan_uptd.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'input_pelatihan_uptd' ? 'bg-gradient-to-r from-amber-700 to-orange-800 text-white shadow-md shadow-amber-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= $active === 'input_pelatihan_uptd' ? 'bg-white/20 text-white' : 'bg-amber-500/15 text-amber-400 group-hover:bg-amber-500/30 group-hover:text-amber-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                    </div>
                    <div class="flex-1 flex items-center justify-between">
                        <span>Input Pelatihan UPTD</span>
                        <span class="px-1.5 py-0.5 rounded-md bg-amber-500/20 text-[9px] font-extrabold text-amber-300">Form</span>
                    </div>
                </a>

                <!-- 3. Perjalanan Dinas (SPD) -->
                <a href="perjalanan_dinas.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'perjalanan_dinas' ? 'bg-gradient-to-r from-emerald-700 to-teal-800 text-white shadow-md shadow-emerald-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= $active === 'perjalanan_dinas' ? 'bg-white/20 text-white' : 'bg-emerald-500/15 text-emerald-400 group-hover:bg-emerald-500/30 group-hover:text-emerald-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-briefcase text-xs"></i>
                    </div>
                    <span>Perjalanan Dinas (SPD)</span>
                </a>

                <!-- 4. Input Perjalanan Dinas -->
                <a href="input_perjalanan_dinas.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'input_perjalanan_dinas' ? 'bg-gradient-to-r from-emerald-700 to-teal-800 text-white shadow-md shadow-emerald-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= $active === 'input_perjalanan_dinas' ? 'bg-white/20 text-white' : 'bg-emerald-500/15 text-emerald-400 group-hover:bg-emerald-500/30 group-hover:text-emerald-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-file-circle-plus text-xs"></i>
                    </div>
                    <div class="flex-1 flex items-center justify-between">
                        <span>Input SPD Mandiri</span>
                        <span class="px-1.5 py-0.5 rounded-md bg-emerald-500/20 text-[9px] font-extrabold text-emerald-300">Form</span>
                    </div>
                </a>

            <!-- ======================================================== -->
            <!-- G. LSP P-2 BPVP KENDARI -->
            <!-- ======================================================== -->
            <?php elseif ($userRole === 'lsp'): ?>

                <!-- SECTION LABEL -->
                <div class="pt-3 pb-1 px-2">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-orange-400 font-heading">Menu LSP P-2</span>
                </div>

                <!-- 1. Data Sertifikasi LSP -->
                <a href="sertifikasi.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'sertifikasi' ? 'bg-gradient-to-r from-orange-700 to-amber-800 text-white shadow-md shadow-orange-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= $active === 'sertifikasi' ? 'bg-white/20 text-white' : 'bg-orange-500/15 text-orange-400 group-hover:bg-orange-500/30 group-hover:text-orange-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-award text-xs"></i>
                    </div>
                    <span>Data Sertifikasi LSP</span>
                </a>

                <!-- 2. Input Sertifikasi LSP -->
                <a href="input_lsp.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'input_lsp' ? 'bg-gradient-to-r from-orange-700 to-amber-800 text-white shadow-md shadow-orange-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= $active === 'input_lsp' ? 'bg-white/20 text-white' : 'bg-orange-500/15 text-orange-400 group-hover:bg-orange-500/30 group-hover:text-orange-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-id-card-clip text-xs"></i>
                    </div>
                    <div class="flex-1 flex items-center justify-between">
                        <span>Input Sertifikasi Peserta</span>
                        <span class="px-1.5 py-0.5 rounded-md bg-orange-500/20 text-[9px] font-extrabold text-orange-300">Form</span>
                    </div>
                </a>

            <!-- ======================================================== -->
            <!-- H. BIDANG KEUANGAN & SP2D -->
            <!-- ======================================================== -->
            <?php elseif ($userRole === 'keuangan'): ?>

                <!-- SECTION LABEL -->
                <div class="pt-3 pb-1 px-2">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-emerald-400 font-heading">Menu Keuangan</span>
                </div>

                <!-- 1. Data Keuangan & SP2D -->
                <a href="keuangan.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'keuangan' ? 'bg-gradient-to-r from-emerald-700 to-teal-800 text-white shadow-md shadow-emerald-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= $active === 'keuangan' ? 'bg-white/20 text-white' : 'bg-emerald-500/15 text-emerald-400 group-hover:bg-emerald-500/30 group-hover:text-emerald-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-wallet text-xs"></i>
                    </div>
                    <span>Data Keuangan & SP2D</span>
                </a>

            <!-- ======================================================== -->
            <!-- I. POKJA PENGADAAN BAHAN & LOGISTIK -->
            <!-- ======================================================== -->
            <?php elseif ($userRole === 'pengadaan'): ?>

                <!-- SECTION LABEL -->
                <div class="pt-3 pb-1 px-2">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-indigo-400 font-heading">Menu Pokja Pengadaan</span>
                </div>

                <!-- 1. Data Pengadaan Pokja -->
                <a href="pengadaan.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'pengadaan' ? 'bg-gradient-to-r from-indigo-700 to-blue-800 text-white shadow-md shadow-indigo-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= $active === 'pengadaan' ? 'bg-white/20 text-white' : 'bg-indigo-500/15 text-indigo-400 group-hover:bg-indigo-500/30 group-hover:text-indigo-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-boxes-packing text-xs"></i>
                    </div>
                    <span>Data Pengadaan Pokja</span>
                </a>

                <!-- 2. Rincian Bahan & Harga -->
                <a href="detail_pengadaan.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'detail_pengadaan' ? 'bg-gradient-to-r from-indigo-700 to-blue-800 text-white shadow-md shadow-indigo-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= $active === 'detail_pengadaan' ? 'bg-white/20 text-white' : 'bg-indigo-500/15 text-indigo-400 group-hover:bg-indigo-500/30 group-hover:text-indigo-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-calculator text-xs"></i>
                    </div>
                    <span>Rincian Bahan & Harga</span>
                </a>

                <!-- 3. Rekap SPK & Nota Pemesanan -->
                <a href="input.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group <?= $active === 'input' ? 'bg-gradient-to-r from-indigo-700 to-blue-800 text-white shadow-md shadow-indigo-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                    <div class="w-6 h-6 rounded-lg <?= $active === 'input' ? 'bg-white/20 text-white' : 'bg-indigo-500/15 text-indigo-400 group-hover:bg-indigo-500/30 group-hover:text-indigo-300' ?> flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-file-contract text-xs"></i>
                    </div>
                    <div class="flex-1 flex items-center justify-between">
                        <span>Rekap SPK & Pesanan</span>
                        <span class="px-1.5 py-0.5 rounded-md bg-indigo-500/20 text-[9px] font-extrabold text-indigo-300">Form</span>
                    </div>
                </a>

            <?php endif; ?>

        </nav>
    </div>

    <!-- SIDEBAR USER PROFILE FOOTER -->
    <div class="p-4 border-t border-slate-800/80 bg-slate-900/80">
        <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-9 h-9 rounded-xl <?= htmlspecialchars($theme['avatar']) ?> text-white font-extrabold text-sm flex items-center justify-center shrink-0 shadow-md">
                    <?= htmlspecialchars($userInitial) ?>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-bold text-white truncate"><?= htmlspecialchars($userName) ?></p>
                    <span class="text-[9px] font-extrabold px-1.5 py-0.5 rounded-md <?= htmlspecialchars($theme['badge']) ?> uppercase tracking-wider block truncate mt-0.5">
                        <?= htmlspecialchars($userRoleLabel) ?>
                    </span>
                </div>
            </div>

            <!-- Logout Link -->
            <a href="auth/logout.php" class="p-2 rounded-xl text-slate-400 hover:text-rose-400 hover:bg-slate-800 transition" title="Keluar / Logout">
                <i class="fa-solid fa-right-from-bracket text-xs"></i>
            </a>
        </div>
    </div>

</aside>

<script>
    function toggleBidangDropdown() {
        const submenu = document.getElementById('bidang-submenu');
        const chevron = document.getElementById('bidang-chevron');
        if (submenu) submenu.classList.toggle('hidden');
        if (chevron) chevron.classList.toggle('rotate-180');
    }
    function toggleTuDropdown() {
        const submenu = document.getElementById('tu-submenu');
        const chevron = document.getElementById('tu-chevron');
        if (submenu) submenu.classList.toggle('hidden');
        if (chevron) chevron.classList.toggle('rotate-180');
    }
    function togglePokjaDropdown() {
        const submenu = document.getElementById('pokja-submenu');
        const chevron = document.getElementById('pokja-chevron');
        if (submenu) submenu.classList.toggle('hidden');
        if (chevron) chevron.classList.toggle('rotate-180');
    }

    // Auto notify if redirected with forbidden error
    <?php if (isset($_GET['error']) && $_GET['error'] === 'forbidden'): ?>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'warning',
                title: 'Akses Dibatasi',
                text: 'Halaman yang Anda tuju khusus untuk wewenang bidang lain. Anda dialihkan ke area kerja yang sesuai dengan akun Anda.',
                confirmButtonColor: '#0d9488',
                confirmButtonText: 'Saya Mengerti'
            });
        }
    });
    <?php endif; ?>
</script>
