<?php
require_once __DIR__ . '/auth/auth_check.php';
requireRoleAccess(['admin', 'pimpinan', 'keuangan']);
$activePage = 'keuangan';
?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Keuangan & SP2D - SIMPEL BPVP Kendari</title>
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
                    Dashboard Keuangan & Realisasi DIPA
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 font-medium mt-0.5">
                    Monitoring pencairan SP2D KPPN, serapan pagu anggaran DIPA, uang saku siswa, dan belanja operasional pelatihan TA 2026.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2.5 text-xs">
                <button onclick="openPaymentModal()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold shadow-xs transition">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Catat SP2D Baru</span>
                </button>
                <a href="detail_pengadaan.php" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 font-bold shadow-xs transition">
                    <i class="fa-solid fa-calculator text-teal-600"></i>
                    <span>RAB Rincian Bahan</span>
                </a>
            </div>
        </div>

        <!-- 4 KPI HERO METRIC CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
            
            <!-- CARD 1: REALISASI SP2D (HERO EMERALD ACCENT) -->
            <div class="rounded-3xl p-6 bg-gradient-to-br from-emerald-950 via-emerald-800 to-teal-950 text-white shadow-md flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-emerald-200 tracking-wide uppercase">Realisasi SP2D Cair</span>
                    <span class="w-8 h-8 rounded-full bg-white/15 flex items-center justify-center text-white text-xs">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </span>
                </div>
                <div class="my-4">
                    <span class="text-3xl sm:text-4xl font-black font-heading tracking-tight text-emerald-200">Rp 18,77 M</span>
                </div>
                <div class="flex items-center gap-2 text-[11px] font-semibold text-emerald-100 bg-black/20 px-3 py-1 rounded-xl w-fit">
                    <i class="fa-solid fa-chart-pie text-emerald-300"></i>
                    <span>Serapan Pagu 79,2%</span>
                </div>
            </div>

            <!-- CARD 2: PAGU TOTAL DIPA -->
            <div class="rounded-3xl p-6 bg-white border border-slate-200/90 shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 tracking-wide uppercase">Pagu Total DIPA</span>
                    <span class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-700 text-xs">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </span>
                </div>
                <div class="my-4">
                    <span class="text-3xl sm:text-4xl font-black text-slate-900 font-heading tracking-tight">Rp 23,70 M</span>
                </div>
                <div class="flex items-center gap-2 text-[11px] font-semibold text-blue-700 bg-blue-50 px-3 py-1 rounded-xl w-fit">
                    <i class="fa-solid fa-landmark text-blue-600"></i>
                    <span>DIPA Petikan BPVP Kendari</span>
                </div>
            </div>

            <!-- CARD 3: BERKAS SP2D TERBIT -->
            <div class="rounded-3xl p-6 bg-white border border-slate-200/90 shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 tracking-wide uppercase">Berkas SP2D Terbit</span>
                    <span class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-700 text-xs">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </span>
                </div>
                <div class="my-4">
                    <span class="text-4xl sm:text-5xl font-black text-slate-900 font-heading tracking-tight">15 SP2D</span>
                </div>
                <div class="flex items-center gap-2 text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-xl w-fit">
                    <i class="fa-solid fa-check-double text-emerald-600"></i>
                    <span>Tervalidasi KPPN Kendari</span>
                </div>
            </div>

            <!-- CARD 4: SISA ANGGARAN -->
            <div class="rounded-3xl p-6 bg-white border border-slate-200/90 shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 tracking-wide uppercase">Sisa Anggaran Pagu</span>
                    <span class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-700 text-xs">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </span>
                </div>
                <div class="my-4">
                    <span class="text-3xl sm:text-4xl font-black text-slate-900 font-heading tracking-tight">Rp 4,93 M</span>
                </div>
                <div class="flex items-center gap-2 text-[11px] font-semibold text-purple-700 bg-purple-50 px-3 py-1 rounded-xl w-fit">
                    <i class="fa-solid fa-wallet text-purple-600"></i>
                    <span>Untuk Batch 2 & Batch 3</span>
                </div>
            </div>

        </div>

        <!-- MIDDLE SECTION: BREAKDOWN AKUN BELANJA & STATUS PENCAIRAN -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
            
            <!-- REALISASI PER AKUN BELANJA DIPA -->
            <div class="lg:col-span-7 bg-white rounded-3xl p-6 border border-slate-200/90 shadow-xs space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-black text-slate-900 text-sm sm:text-base tracking-tight font-heading">
                            Realisasi Menurut Akun Belanja Operasional
                        </h3>
                        <p class="text-xs text-slate-400">Komposisi pos anggaran penyelenggaraan pelatihan vokasi</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-xl text-[10px] font-extrabold bg-emerald-50 text-emerald-800">79,2% Rata-rata</span>
                </div>

                <div class="space-y-3 pt-1 text-xs">
                    <div>
                        <div class="flex items-center justify-between mb-1 font-semibold text-slate-700">
                            <span>Akun 521211 - Belanja Bahan Praktek & Wearpack Siswa</span>
                            <span class="font-extrabold text-slate-900">Rp 8,45 M (82%)</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-emerald-600 h-full rounded-full" style="width: 82%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1 font-semibold text-slate-700">
                            <span>Akun 521219 - Belanja Uang Saku Peserta Pelatihan (SBM PMK)</span>
                            <span class="font-extrabold text-slate-900">Rp 4,20 M (80%)</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-teal-600 h-full rounded-full" style="width: 80%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1 font-semibold text-slate-700">
                            <span>Akun 521213 - Honorarium Instruktur & Asesor UJK BNSP</span>
                            <span class="font-extrabold text-slate-900">Rp 3,80 M (76%)</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-blue-600 h-full rounded-full" style="width: 76%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1 font-semibold text-slate-700">
                            <span>Akun 522151 - Belanja Konsumsi Siswa & Operasional Workshop</span>
                            <span class="font-extrabold text-slate-900">Rp 2,32 M (72%)</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-purple-600 h-full rounded-full" style="width: 72%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- STATUS PENGAJUAN TERKINI KPPN -->
            <div class="lg:col-span-5 bg-white rounded-3xl p-6 border border-slate-200/90 shadow-xs space-y-3">
                <div class="flex items-center justify-between pb-1 border-b border-slate-100">
                    <div>
                        <h3 class="font-black text-slate-900 text-sm sm:text-base tracking-tight font-heading">
                            Status SP2D KPPN Kendari
                        </h3>
                        <p class="text-xs text-slate-400">Verifikasi dokumen SPM & penerbitan SP2D</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-xl text-[10px] font-extrabold bg-emerald-50 text-emerald-700">Terkontrol</span>
                </div>

                <div class="divide-y divide-slate-100 text-xs">
                    <div class="py-2.5 flex items-center justify-between">
                        <div>
                            <p class="font-bold text-slate-900">SP2D Telah Terbit & Dicairkan</p>
                            <span class="text-[10px] text-slate-500">Rekening Giro Penampung & Rekening Siswa</span>
                        </div>
                        <span class="font-black text-emerald-700 text-sm">15 Berkas</span>
                    </div>

                    <div class="py-2.5 flex items-center justify-between">
                        <div>
                            <p class="font-bold text-slate-900">SPM Dalam Verifikasi KPPN</p>
                            <span class="text-[10px] text-slate-500">Pengadaan Bahan Batch 2</span>
                        </div>
                        <span class="font-black text-amber-600 text-sm">1 Berkas</span>
                    </div>

                    <div class="py-2.5 flex items-center justify-between">
                        <div>
                            <p class="font-bold text-slate-900">Rekonsiliasi Bank Operasional</p>
                            <span class="text-[10px] text-slate-500">Bank Mandiri / BNI Kas Negara</span>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Sesuai (Match)</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- TABLE SECTION: DETAIL RIWAYAT PENCAIRAN SP2D -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-2 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-black text-slate-900 font-heading">
                        Daftar Realisasi Pembayaran & SP2D Terbit
                    </h3>
                    <p class="text-xs text-slate-500">Pencatatan realisasi dana APBN per program dan peruntukan biaya</p>
                </div>
                <div class="relative max-w-xs w-full">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Cari nomor SP2D / program..." 
                           class="w-full pl-8 pr-3 py-1.5 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                </div>
            </div>

            <div class="w-full overflow-hidden rounded-2xl border border-slate-200/70">
                <table class="w-full text-left text-xs text-slate-700">
                    <thead class="bg-slate-50 text-slate-600 font-bold border-b border-slate-200 uppercase tracking-wider text-[10px]">
                        <tr>
                            <th class="py-3 px-3 text-center w-12">No</th>
                            <th class="py-3 px-4">Program Pelatihan</th>
                            <th class="py-3 px-4">Peruntukan Dana</th>
                            <th class="py-3 px-4 text-right">Nilai Pengajuan</th>
                            <th class="py-3 px-4 text-center">Tgl Pengajuan</th>
                            <th class="py-3 px-4 text-center">Tgl Cair</th>
                            <th class="py-3 px-4">Nomor SP2D</th>
                            <th class="py-3 px-3 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-3 text-center font-bold text-slate-400">1</td>
                            <td class="py-3.5 px-4 font-bold text-slate-900">Junior Web Developer <span class="text-slate-400 font-normal">&bull; Batch 1</span></td>
                            <td class="py-3.5 px-4 text-slate-700 font-medium">Honor Instruktur & Uang Saku Peserta</td>
                            <td class="py-3.5 px-4 text-right font-black text-emerald-800">Rp 24.800.000</td>
                            <td class="py-3.5 px-4 text-center text-slate-500">18 Mar 2026</td>
                            <td class="py-3.5 px-4 text-center text-slate-700 font-bold">24 Mar 2026</td>
                            <td class="py-3.5 px-4 font-mono text-[11px] text-slate-700">0021/BPVP/2026</td>
                            <td class="py-3.5 px-3 text-center"><span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800">Dicairkan</span></td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-3 text-center font-bold text-slate-400">2</td>
                            <td class="py-3.5 px-4 font-bold text-slate-900">Plate Welder SMAW 3G UP <span class="text-slate-400 font-normal">&bull; Batch 1</span></td>
                            <td class="py-3.5 px-4 text-slate-700 font-medium">Uang Saku & Uji Sertifikasi (16 Asesi)</td>
                            <td class="py-3.5 px-4 text-right font-black text-emerald-800">Rp 29.600.000</td>
                            <td class="py-3.5 px-4 text-center text-slate-500">25 Mar 2026</td>
                            <td class="py-3.5 px-4 text-center text-slate-700 font-bold">31 Mar 2026</td>
                            <td class="py-3.5 px-4 font-mono text-[11px] text-slate-700">0035/BPVP/2026</td>
                            <td class="py-3.5 px-3 text-center"><span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800">Dicairkan</span></td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-3 text-center font-bold text-slate-400">3</td>
                            <td class="py-3.5 px-4 font-bold text-slate-900">Barista & Tata Hidang Kopi <span class="text-slate-400 font-normal">&bull; Batch 1</span></td>
                            <td class="py-3.5 px-4 text-slate-700 font-medium">Bahan Praktek Workshop & Uang Harian</td>
                            <td class="py-3.5 px-4 text-right font-black text-emerald-800">Rp 19.500.000</td>
                            <td class="py-3.5 px-4 text-center text-slate-500">28 Mei 2026</td>
                            <td class="py-3.5 px-4 text-center text-slate-700 font-bold">03 Jun 2026</td>
                            <td class="py-3.5 px-4 font-mono text-[11px] text-slate-700">0048/BPVP/2026</td>
                            <td class="py-3.5 px-3 text-center"><span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800">Dicairkan</span></td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-3 text-center font-bold text-slate-400">4</td>
                            <td class="py-3.5 px-4 font-bold text-slate-900">Menjahit Pakaian <span class="text-slate-400 font-normal">&bull; Batch 2</span></td>
                            <td class="py-3.5 px-4 text-slate-700 font-medium">Bahan Praktek Kain Toyobo & Benang</td>
                            <td class="py-3.5 px-4 text-right font-black text-blue-700">Rp 14.200.000</td>
                            <td class="py-3.5 px-4 text-center text-slate-500">10 Jun 2026</td>
                            <td class="py-3.5 px-4 text-center text-slate-400">&ndash;</td>
                            <td class="py-3.5 px-4 font-mono text-[11px] text-slate-400">Menunggu KPPN</td>
                            <td class="py-3.5 px-3 text-center"><span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-blue-100 text-blue-800 animate-pulse">Diproses</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-slate-200 py-5 text-center text-xs text-slate-500 mt-auto">
        &copy; 2026 <strong>Balai Pelatihan Vokasi dan Produktivitas (BPVP) Kendari</strong> &bull; Urusan Keuangan
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Sidebar rendered server-side by PHP
        });

        function openPaymentModal() {
            Swal.fire({
                title: '<span class="text-base font-bold text-slate-800">Catat Pencairan SP2D Baru</span>',
                html: `
                    <div class="text-left space-y-3 text-xs pt-2 text-slate-700">
                        <div>
                            <label class="block font-semibold mb-1">Program / Kejuruan</label>
                            <input id="swal-prog" class="swal2-input !m-0 !w-full !text-xs !py-2 rounded-xl" placeholder="Contoh: Operator Alat Berat - Batch 1">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Akun Peruntukan Dana</label>
                            <select id="swal-jenis" class="swal2-select !m-0 !w-full !text-xs !py-2 rounded-xl">
                                <option value="Uang Saku Peserta">521219 - Uang Saku Peserta (SBM PMK)</option>
                                <option value="Bahan Praktek">521211 - Belanja Bahan Praktek Workshop</option>
                                <option value="Honorarium Instruktur">521213 - Honorarium Instruktur / Asesor</option>
                                <option value="Konsumsi Siswa">522151 - Belanja Konsumsi & Katering</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block font-semibold mb-1">Nominal (Rp)</label>
                                <input id="swal-nominal" type="number" class="swal2-input !m-0 !w-full !text-xs !py-2 rounded-xl" placeholder="24500000">
                            </div>
                            <div>
                                <label class="block font-semibold mb-1">Nomor SP2D</label>
                                <input id="swal-sp2d" class="swal2-input !m-0 !w-full !text-xs !py-2 rounded-xl" placeholder="SP2D-0056/2026">
                            </div>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Simpan Pembayaran',
                confirmButtonColor: '#059669',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-3xl' }
            }).then((res) => {
                if (res.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'SP2D Berhasil Dicatat!',
                        text: 'Pencairan dana telah tercatat dalam sistem pembukuan DIPA.',
                        confirmButtonColor: '#059669'
                    });
                }
            });
        }
    </script>
</body>
</html>
