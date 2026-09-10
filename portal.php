<?php
require_once __DIR__ . '/auth/auth_check.php';
requireRoleAccess(['admin', 'pimpinan', 'penyelenggara', 'pemberdayaan', 'lsp', 'produktivitas', 'pengadaan', 'tu', 'keuangan']);
$activePage = 'portal';
?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Utama - SIMPEL BPVP Kendari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="simpel_auth.js"></script>
    <style>
        body, html, button, input, select, textarea, .font-heading { font-family: 'Montserrat', sans-serif; }
        i, [class*="fa-"] { font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands", "FontAwesome" !important; }
    </style>
</head>
<body class="min-h-screen bg-slate-50 flex flex-col">

    <?php include __DIR__ . '/includes/header.php'; ?>
    <?php include __DIR__ . '/includes/sidebar.php'; ?>

    <!-- MAIN WORKSPACE CONTAINER -->
    <main class="flex-1 min-w-0 w-full px-4 sm:px-6 lg:px-8 xl:px-10 py-5 sm:py-6 space-y-6">
        
        <!-- BANNER -->
        <div class="rounded-2xl bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 p-4 sm:p-6 text-white shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <span id="user-role-badge" class="px-2.5 py-0.5 rounded-full text-[10px] font-bold text-white bg-teal-500 uppercase tracking-wider">ROLE</span>
                    <span id="user-dept-name" class="text-xs text-teal-300 font-medium">Seksi Penyelenggara</span>
                </div>
                <h1 class="text-lg sm:text-2xl font-bold font-heading text-white">
                    Selamat Datang, <span id="user-display-name" class="text-teal-300">User</span>
                </h1>
                <p class="text-xs text-slate-300 max-w-xl">
                    Integrasi 9 bidang kerja: proposal pelatihan, peserta BNBA, pengadaan bahan, pencairan SP2D, uji sertifikasi, dan penempatan kerja.
                </p>
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto">
                <a href="dashboard.php" class="flex-1 sm:flex-none justify-center px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white text-xs font-bold transition flex items-center gap-1.5">
                    <i class="fa-solid fa-chart-pie text-teal-300"></i>
                    <span>Dashboard</span>
                </a>
                <a href="input.php" class="flex-1 sm:flex-none justify-center px-4 py-2 rounded-xl bg-teal-500 hover:bg-teal-600 text-white text-xs font-bold transition flex items-center gap-1.5">
                    <i class="fa-solid fa-plus"></i>
                    <span>Form Input</span>
                </a>
            </div>
        </div>

        <!-- WORKFLOW PIPELINE TRACKER -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200 space-y-3 shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold font-heading text-slate-900">Alur Kerja Terpadu Lintas Bidang</span>
                <span class="text-[10px] font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded-full">9 Tahapan Terintegrasi</span>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-2 sm:gap-2.5 text-xs">
                
                <div class="p-3 rounded-xl bg-teal-50 border border-teal-200 flex flex-col justify-between">
                    <div>
                        <span class="w-5 h-5 rounded-full bg-teal-600 text-white font-bold flex items-center justify-center text-[10px] mb-1.5">1</span>
                        <h4 class="font-bold text-teal-950 text-xs">Penyelenggara</h4>
                        <p class="text-[10px] text-teal-700 mt-0.5">Proposal & Kuota</p>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-blue-50 border border-blue-200 flex flex-col justify-between">
                    <div>
                        <span class="w-5 h-5 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center text-[10px] mb-1.5">2</span>
                        <h4 class="font-bold text-blue-950 text-xs">Pemberdayaan</h4>
                        <p class="text-[10px] text-blue-700 mt-0.5">Penjaringan BNBA</p>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 flex flex-col justify-between">
                    <div>
                        <span class="w-5 h-5 rounded-full bg-slate-700 text-white font-bold flex items-center justify-center text-[10px] mb-1.5">3</span>
                        <h4 class="font-bold text-slate-900 text-xs">Jadwal Kelas</h4>
                        <p class="text-[10px] text-slate-600 mt-0.5">Jadwal & Instruktur</p>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-indigo-50 border border-indigo-200 flex flex-col justify-between">
                    <div>
                        <span class="w-5 h-5 rounded-full bg-indigo-600 text-white font-bold flex items-center justify-center text-[10px] mb-1.5">4</span>
                        <h4 class="font-bold text-indigo-950 text-xs">Pengadaan</h4>
                        <p class="text-[10px] text-indigo-700 mt-0.5">Bahan & Seragam</p>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-200 flex flex-col justify-between">
                    <div>
                        <span class="w-5 h-5 rounded-full bg-emerald-600 text-white font-bold flex items-center justify-center text-[10px] mb-1.5">5</span>
                        <h4 class="font-bold text-emerald-950 text-xs">Keuangan</h4>
                        <p class="text-[10px] text-emerald-700 mt-0.5">Uang Saku & SP2D</p>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-amber-50 border border-amber-200 flex flex-col justify-between">
                    <div>
                        <span class="w-5 h-5 rounded-full bg-amber-600 text-white font-bold flex items-center justify-center text-[10px] mb-1.5">6</span>
                        <h4 class="font-bold text-amber-950 text-xs">LSP BNSP</h4>
                        <p class="text-[10px] text-amber-700 mt-0.5">Uji Sertifikasi</p>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-purple-50 border border-purple-200 flex flex-col justify-between col-span-2 sm:col-span-1">
                    <div>
                        <span class="w-5 h-5 rounded-full bg-purple-600 text-white font-bold flex items-center justify-center text-[10px] mb-1.5">7</span>
                        <h4 class="font-bold text-purple-950 text-xs">Penempatan</h4>
                        <p class="text-[10px] text-purple-700 mt-0.5">Kerja & Wirausaha</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- 9 ROLE WORKSPACE ACCESS CARDS -->
        <div class="space-y-3">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 font-heading">Workspace Modul:</span>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2.5 sm:gap-3">

                <!-- 1. Admin -->
                <a href="dashboard.php" class="bg-white rounded-xl p-3.5 sm:p-4 border border-slate-200 hover:border-rose-400 hover:shadow-xs transition flex items-center gap-3.5 group">
                    <div class="w-10 h-10 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center text-lg group-hover:bg-rose-600 group-hover:text-white transition-colors flex-shrink-0">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[10px] font-bold uppercase text-rose-600 block">Admin</span>
                        <h4 class="text-xs font-bold text-slate-900 truncate">Pusat Kendali Admin</h4>
                        <p class="text-[11px] text-slate-400 truncate">Monitoring lintas 8 bidang</p>
                    </div>
                </a>

                <!-- 2. Pimpinan -->
                <a href="dashboard.php" class="bg-white rounded-xl p-3.5 sm:p-4 border border-slate-200 hover:border-purple-400 hover:shadow-xs transition flex items-center gap-3.5 group">
                    <div class="w-10 h-10 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center text-lg group-hover:bg-purple-600 group-hover:text-white transition-colors flex-shrink-0">
                        <i class="fa-solid fa-chart-pie"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[10px] font-bold uppercase text-purple-600 block">Pimpinan</span>
                        <h4 class="text-xs font-bold text-slate-900 truncate">Dashboard Eksekutif</h4>
                        <p class="text-[11px] text-slate-400 truncate">Ringkasan DIPA & pencairan</p>
                    </div>
                </a>

                <!-- 3. Penyelenggara -->
                <a href="pelatihan.php" class="bg-white rounded-xl p-3.5 sm:p-4 border border-slate-200 hover:border-teal-400 hover:shadow-xs transition flex items-center gap-3.5 group">
                    <div class="w-10 h-10 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center text-lg group-hover:bg-teal-600 group-hover:text-white transition-colors flex-shrink-0">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[10px] font-bold uppercase text-teal-600 block">Penyelenggara</span>
                        <h4 class="text-xs font-bold text-slate-900 truncate">Program Pelatihan</h4>
                        <p class="text-[11px] text-slate-400 truncate">TMT, PBK, PBL & jadwal</p>
                    </div>
                </a>

                <!-- 4. Pemberdayaan -->
                <a href="penempatan.php" class="bg-white rounded-xl p-3.5 sm:p-4 border border-slate-200 hover:border-blue-400 hover:shadow-xs transition flex items-center gap-3.5 group">
                    <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-lg group-hover:bg-blue-600 group-hover:text-white transition-colors flex-shrink-0">
                        <i class="fa-solid fa-users-rectangle"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[10px] font-bold uppercase text-blue-600 block">Pemberdayaan</span>
                        <h4 class="text-xs font-bold text-slate-900 truncate">Peserta & Penempatan</h4>
                        <p class="text-[11px] text-slate-400 truncate">BNBA & pelacakan alumni</p>
                    </div>
                </a>

                <!-- 5. LSP -->
                <a href="sertifikasi.php" class="bg-white rounded-xl p-3.5 sm:p-4 border border-slate-200 hover:border-amber-400 hover:shadow-xs transition flex items-center gap-3.5 group">
                    <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-lg group-hover:bg-amber-600 group-hover:text-white transition-colors flex-shrink-0">
                        <i class="fa-solid fa-stamp"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[10px] font-bold uppercase text-amber-600 block">LSP</span>
                        <h4 class="text-xs font-bold text-slate-900 truncate">Sertifikasi BNSP</h4>
                        <p class="text-[11px] text-slate-400 truncate">Skema, asesor, hasil UJK</p>
                    </div>
                </a>

                <!-- 6. Produktivitas -->
                <a href="produktivitas.php" class="bg-white rounded-xl p-3.5 sm:p-4 border border-slate-200 hover:border-emerald-400 hover:shadow-xs transition flex items-center gap-3.5 group">
                    <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg group-hover:bg-emerald-600 group-hover:text-white transition-colors flex-shrink-0">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[10px] font-bold uppercase text-emerald-600 block">Produktivitas</span>
                        <h4 class="text-xs font-bold text-slate-900 truncate">Peningkatan Produktivitas</h4>
                        <p class="text-[11px] text-slate-400 truncate">5S, Kaizen, UMKM binaan</p>
                    </div>
                </a>

                <!-- 7. Pengadaan -->
                <a href="pengadaan.php" class="bg-white rounded-xl p-3.5 sm:p-4 border border-slate-200 hover:border-indigo-400 hover:shadow-xs transition flex items-center gap-3.5 group">
                    <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-lg group-hover:bg-indigo-600 group-hover:text-white transition-colors flex-shrink-0">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[10px] font-bold uppercase text-indigo-600 block">Pengadaan</span>
                        <h4 class="text-xs font-bold text-slate-900 truncate">Pengadaan & Logistik</h4>
                        <p class="text-[11px] text-slate-400 truncate">Bahan praktek, baju & ATK</p>
                    </div>
                </a>

                <!-- 8. Umum / TU -->
                <a href="pelatihan_uptd.php" class="bg-white rounded-xl p-3.5 sm:p-4 border border-slate-200 hover:border-slate-500 hover:shadow-xs transition flex items-center gap-3.5 group">
                    <div class="w-10 h-10 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center text-lg group-hover:bg-slate-800 group-hover:text-white transition-colors flex-shrink-0">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[10px] font-bold uppercase text-slate-600 block">Umum / TU</span>
                        <h4 class="text-xs font-bold text-slate-900 truncate">5 BLK UPTD Binaan</h4>
                        <p class="text-[11px] text-slate-400 truncate">Kolaka, Konsel, Buton, dll</p>
                    </div>
                </a>

                <!-- 9. Keuangan -->
                <a href="keuangan.php" class="bg-white rounded-xl p-3.5 sm:p-4 border border-slate-200 hover:border-emerald-400 hover:shadow-xs transition flex items-center gap-3.5 group">
                    <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg group-hover:bg-emerald-600 group-hover:text-white transition-colors flex-shrink-0">
                        <i class="fa-solid fa-money-check-dollar"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[10px] font-bold uppercase text-emerald-600 block">Keuangan</span>
                        <h4 class="text-xs font-bold text-slate-900 truncate">Keuangan & SP2D</h4>
                        <p class="text-[11px] text-slate-400 truncate">Uang saku, honor, pencairan</p>
                    </div>
                </a>

            </div>
        </div>

    </main>

    <footer class="bg-white border-t border-slate-200 py-4 text-center text-xs text-slate-400">
        &copy; 2026 SIMPEL BPVP Kendari
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const user = SimpelAuth.getCurrentUser();
            document.getElementById('user-display-name').innerText = user.name;
            document.getElementById('user-dept-name').innerText = user.dept || user.roleLabel;
            const badge = document.getElementById('user-role-badge');
            badge.innerText = user.roleLabel || user.role;
            badge.className = `px-2.5 py-0.5 rounded-full text-[10px] font-bold text-white uppercase tracking-wider ${user.badgeColor || 'bg-teal-500'}`;
            // Sidebar rendered server-side by PHP
        });
    </script>
</body>
</html>