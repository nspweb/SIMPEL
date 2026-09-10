<?php
require_once __DIR__ . '/auth/auth_check.php';
requireRoleAccess(['admin', 'pimpinan', 'lsp']);
$activePage = 'sertifikasi';
?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Sertifikasi LSP - SIMPEL BPVP Kendari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="simpel_auth.js"></script>
    <style>
        body, html, button, input, select, textarea, .font-heading { font-family: 'Montserrat', sans-serif; }
        i, [class*="fa-"] { font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands", "FontAwesome" !important; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
    </style>
</head>
<body class="min-h-screen bg-slate-50 flex flex-col antialiased">

    <!-- UNIFIED SIDEBAR (SIMPEL AUTH) -->
    <?php include __DIR__ . '/includes/header.php'; ?>
    <?php include __DIR__ . '/includes/sidebar.php'; ?>

    <!-- MAIN WORKSPACE -->
    <main class="flex-1 min-w-0 w-full px-4 sm:px-6 lg:px-8 xl:px-10 py-5 sm:py-6 space-y-6">
        
        <!-- PAGE HEADER & ACTIONS -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight font-heading">
                    Dashboard Sertifikasi & Uji Kompetensi
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 font-medium mt-0.5">
                    Monitoring asesmen UJK, penerbitan sertifikat kompetensi BNSP, verifikasi APL 01 & 02, serta utilisasi TUK TA 2026.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2.5 text-xs">
                <a href="input_lsp.php" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-amber-600 hover:bg-amber-700 text-white font-bold shadow-xs transition">
                    <i class="fa-solid fa-stamp text-xs"></i>
                    <span>Input Sertifikasi (UJK)</span>
                </a>
                <button onclick="downloadReport()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 font-bold shadow-xs transition">
                    <i class="fa-solid fa-file-excel text-emerald-600"></i>
                    <span>Ekspor Hasil Asesi</span>
                </button>
            </div>
        </div>

        <!-- 4 KPI HERO METRIC CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
            
            <!-- CARD 1: TOTAL ASESI (HERO AMBER ACCENT) -->
            <div class="rounded-3xl p-6 bg-gradient-to-br from-amber-900 via-amber-800 to-yellow-900 text-white shadow-md flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-amber-200 tracking-wide uppercase">Total Asesi Terdaftar</span>
                    <span class="w-8 h-8 rounded-full bg-white/15 flex items-center justify-center text-white text-xs">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </span>
                </div>
                <div class="my-4">
                    <span class="text-4xl sm:text-5xl font-black font-heading tracking-tight">1.250</span>
                </div>
                <div class="flex items-center gap-2 text-[11px] font-semibold text-amber-100 bg-black/20 px-3 py-1 rounded-xl w-fit">
                    <i class="fa-solid fa-users text-amber-300"></i>
                    <span>Siswa Balai & Tenaga Kerja Sultra</span>
                </div>
            </div>

            <!-- CARD 2: HASIL KOMPETEN (K) -->
            <div class="rounded-3xl p-6 bg-white border border-slate-200/90 shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 tracking-wide uppercase">Dinyatakan Kompeten (K)</span>
                    <span class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-700 text-xs">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </span>
                </div>
                <div class="my-4">
                    <span class="text-4xl sm:text-5xl font-black text-slate-900 font-heading tracking-tight">1.140</span>
                </div>
                <div class="flex items-center gap-2 text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-xl w-fit">
                    <i class="fa-solid fa-check-double text-emerald-600"></i>
                    <span>Tingkat Kelulusan 91,2%</span>
                </div>
            </div>

            <!-- CARD 3: SERTIFIKAT TERCETAK -->
            <div class="rounded-3xl p-6 bg-white border border-slate-200/90 shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 tracking-wide uppercase">Sertifikat BNSP Terbit</span>
                    <span class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-700 text-xs">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </span>
                </div>
                <div class="my-4">
                    <span class="text-4xl sm:text-5xl font-black text-slate-900 font-heading tracking-tight">980</span>
                </div>
                <div class="flex items-center gap-2 text-[11px] font-semibold text-teal-700 bg-teal-50 px-3 py-1 rounded-xl w-fit">
                    <i class="fa-solid fa-certificate text-teal-600"></i>
                    <span>86,0% Blanko Terdistribusi</span>
                </div>
            </div>

            <!-- CARD 4: SKEMA BNSP AKTIF -->
            <div class="rounded-3xl p-6 bg-white border border-slate-200/90 shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 tracking-wide uppercase">Skema SKKNI Terlisensi</span>
                    <span class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-700 text-xs">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </span>
                </div>
                <div class="my-4">
                    <span class="text-4xl sm:text-5xl font-black text-slate-900 font-heading tracking-tight">12 Skema</span>
                </div>
                <div class="flex items-center gap-2 text-[11px] font-semibold text-blue-700 bg-blue-50 px-3 py-1 rounded-xl w-fit">
                    <i class="fa-solid fa-layer-group text-blue-600"></i>
                    <span>Standar Nasional BNSP</span>
                </div>
            </div>

        </div>

        <!-- MIDDLE SECTION: SEBARAN SKEMA & STATUS TUK -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
            
            <!-- SEBARAN ASESMEN PER SKEMA -->
            <div class="lg:col-span-7 bg-white rounded-3xl p-6 border border-slate-200/90 shadow-xs space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-black text-slate-900 text-sm sm:text-base tracking-tight font-heading">
                            Realisasi Asesi Berdasarkan Skema SKKNI
                        </h3>
                        <p class="text-xs text-slate-400">Jumlah asesi teruji per klaster kompetensi</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-xl text-[10px] font-extrabold bg-amber-50 text-amber-800">1.250 Asesi</span>
                </div>

                <div class="space-y-3 pt-1 text-xs">
                    <div>
                        <div class="flex items-center justify-between mb-1 font-semibold text-slate-700">
                            <span>Junior Web Developer (TIK)</span>
                            <span class="font-extrabold text-slate-900">220 Asesi (95% K)</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-blue-600 h-full rounded-full" style="width: 85%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1 font-semibold text-slate-700">
                            <span>Plate Welder SMAW 3G UP (Las & Fabrikasi)</span>
                            <span class="font-extrabold text-slate-900">210 Asesi (94% K)</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-orange-600 h-full rounded-full" style="width: 80%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1 font-semibold text-slate-700">
                            <span>Teknisi Servis Sepeda Motor Injeksi (Otomotif)</span>
                            <span class="font-extrabold text-slate-900">180 Asesi (90% K)</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-emerald-600 h-full rounded-full" style="width: 70%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1 font-semibold text-slate-700">
                            <span>Barista & Tata Hidang Minuman (Pariwisata)</span>
                            <span class="font-extrabold text-slate-900">160 Asesi (96% K)</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-amber-600 h-full rounded-full" style="width: 65%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1 font-semibold text-slate-700">
                            <span>Operator Alat Berat & Penjahit Garmen</span>
                            <span class="font-extrabold text-slate-900">480 Asesi (88% K)</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-purple-600 h-full rounded-full" style="width: 90%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- STATUS TUK & ASESOR LISENSI -->
            <div class="lg:col-span-5 bg-white rounded-3xl p-6 border border-slate-200/90 shadow-xs space-y-3">
                <div class="flex items-center justify-between pb-1 border-b border-slate-100">
                    <div>
                        <h3 class="font-black text-slate-900 text-sm sm:text-base tracking-tight font-heading">
                            Tempat Uji Kompetensi (TUK)
                        </h3>
                        <p class="text-xs text-slate-400">Verifikasi kelayakan TUK Sewaktu & Mandiri</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-xl text-[10px] font-extrabold bg-emerald-50 text-emerald-700">Tersertifikasi</span>
                </div>

                <div class="divide-y divide-slate-100 text-xs">
                    <div class="py-2.5 flex items-center justify-between">
                        <div>
                            <p class="font-bold text-slate-900">TUK BPVP Kendari (Workshop Utama)</p>
                            <span class="text-[10px] text-slate-500">8 Kejuruan Workshop Terverifikasi</span>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                    </div>

                    <div class="py-2.5 flex items-center justify-between">
                        <div>
                            <p class="font-bold text-slate-900">TUK Hotel Claro Kendari (Pariwisata)</p>
                            <span class="text-[10px] text-slate-500">Skema Barista & Front Office</span>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                    </div>

                    <div class="py-2.5 flex items-center justify-between">
                        <div>
                            <p class="font-bold text-slate-900">TUK Las Industri PT. IMIP</p>
                            <span class="text-[10px] text-slate-500">Skema SMAW 3G & 6G Industri</span>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                    </div>

                    <div class="py-2.5 flex items-center justify-between">
                        <div>
                            <p class="font-bold text-slate-900">Asesor Kompetensi Berlisensi</p>
                            <span class="text-[10px] text-slate-500">24 Asesor Teknis Tersertifikasi BNSP</span>
                        </div>
                        <span class="font-black text-amber-700 text-sm">24 Asesor</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- TABLE SECTION: DAFTAR ASESI & HASIL UJK -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-2 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-black text-slate-900 font-heading">
                        Daftar Asesi, Hasil UJK & Penerbitan Sertifikat BNSP
                    </h3>
                    <p class="text-xs text-slate-500">Hasil uji kompetensi perorangan yang telah melalui verifikasi berkas APL 01 & 02</p>
                </div>
                <div class="relative max-w-xs w-full">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Cari nama asesi / NIK..." 
                           class="w-full pl-8 pr-3 py-1.5 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:outline-none focus:ring-1 focus:ring-amber-500">
                </div>
            </div>

            <div class="w-full overflow-hidden rounded-2xl border border-slate-200/70">
                <table class="w-full text-left text-xs text-slate-700">
                    <thead class="bg-slate-50 text-slate-600 font-bold border-b border-slate-200 uppercase tracking-wider text-[10px]">
                        <tr>
                            <th class="py-3 px-3 text-center w-12">No</th>
                            <th class="py-3 px-4">Nama Lengkap Asesi</th>
                            <th class="py-3 px-4">Skema Kompetensi</th>
                            <th class="py-3 px-4">TUK Pelaksana</th>
                            <th class="py-3 px-4 text-center">Tanggal UJK</th>
                            <th class="py-3 px-4">Asesor Penguji</th>
                            <th class="py-3 px-3 text-center">APL 01 / 02</th>
                            <th class="py-3 px-3 text-center">Hasil Asesmen</th>
                            <th class="py-3 px-3 text-center">Status Blanko</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-3 text-center font-bold text-slate-400">1</td>
                            <td class="py-3.5 px-4 font-bold text-slate-900">Ahmad Rizky Pratama</td>
                            <td class="py-3.5 px-4 text-slate-700">Junior Web Developer</td>
                            <td class="py-3.5 px-4 text-slate-600">TUK BPVP Kendari</td>
                            <td class="py-3.5 px-4 text-center text-slate-500">20 Maret 2026</td>
                            <td class="py-3.5 px-4 text-slate-700">Ir. Budi Santoso, M.T.</td>
                            <td class="py-3.5 px-3 text-center"><span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700">Lengkap</span></td>
                            <td class="py-3.5 px-3 text-center"><span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800">Kompeten (K)</span></td>
                            <td class="py-3.5 px-3 text-center"><span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-teal-100 text-teal-800">Tercetak</span></td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-3 text-center font-bold text-slate-400">2</td>
                            <td class="py-3.5 px-4 font-bold text-slate-900">Muhammad Fajrin</td>
                            <td class="py-3.5 px-4 text-slate-700">Plate Welder SMAW 3G UP</td>
                            <td class="py-3.5 px-4 text-slate-600">TUK Las BPVP</td>
                            <td class="py-3.5 px-4 text-center text-slate-500">28 Maret 2026</td>
                            <td class="py-3.5 px-4 text-slate-700">Drs. Hendra Wijaya</td>
                            <td class="py-3.5 px-3 text-center"><span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700">Lengkap</span></td>
                            <td class="py-3.5 px-3 text-center"><span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800">Kompeten (K)</span></td>
                            <td class="py-3.5 px-3 text-center"><span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-teal-100 text-teal-800">Tercetak</span></td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-3 text-center font-bold text-slate-400">3</td>
                            <td class="py-3.5 px-4 font-bold text-slate-900">Nur Aini Saleh</td>
                            <td class="py-3.5 px-4 text-slate-700">Barista Coffee</td>
                            <td class="py-3.5 px-4 text-slate-600">TUK Hotel Claro</td>
                            <td class="py-3.5 px-4 text-center text-slate-500">30 Mei 2026</td>
                            <td class="py-3.5 px-4 text-slate-700">Sri Wahyuni, S.Par.</td>
                            <td class="py-3.5 px-3 text-center"><span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-50 text-amber-700">Verifikasi</span></td>
                            <td class="py-3.5 px-3 text-center"><span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800">Kompeten (K)</span></td>
                            <td class="py-3.5 px-3 text-center"><span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-amber-100 text-amber-800">Proses Cetak</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-slate-200 py-5 text-center text-xs text-slate-500 mt-auto">
        &copy; 2026 <strong>Balai Pelatihan Vokasi dan Produktivitas (BPVP) Kendari</strong> &bull; Lembaga Sertifikasi Profesi (LSP)
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Sidebar rendered server-side by PHP
        });

        function downloadReport() {
            Swal.fire({
                icon: 'success',
                title: 'Unduh Hasil UJK',
                text: 'Data asesi dan status sertifikat BNSP sedang diekspor ke Excel.',
                confirmButtonColor: '#d97706'
            });
        }
    </script>
</body>
</html>