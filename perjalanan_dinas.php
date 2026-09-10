<?php
require_once __DIR__ . '/auth/auth_check.php';
requireRoleAccess(['admin', 'pimpinan', 'tu']);
$activePage = 'perjalanan_dinas';
?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrasi Perjalanan Dinas (SPD) - SIMPEL BPVP Kendari 2026</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <script src="assets/js/simpel_adk.js"></script>
    <script src="simpel_auth.js"></script>

    <style>
        body, html, button, input, select, textarea, .font-heading { font-family: 'Montserrat', sans-serif; }
        i, [class*="fa-"] { font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands", "FontAwesome" !important; }
    </style>
</head>
<body class="min-h-screen bg-slate-50 flex flex-col">

    <!-- UNIFIED HEADER -->
    <?php include __DIR__ . '/includes/header.php'; ?>
    <?php include __DIR__ . '/includes/sidebar.php'; ?>

    <!-- MAIN WORKSPACE -->
    <main class="flex-1 min-w-0 w-full px-4 sm:px-6 lg:px-8 xl:px-10 py-6 space-y-6">
        
        <!-- BREADCRUMB & HEADER TITLE -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-1">
                    <span>Administrasi Umum & TU</span>
                    <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
                    <span class="text-emerald-700 font-bold">Perjalanan Dinas (SPD)</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight font-heading">
                    Administrasi & Surat Perjalanan Dinas (SPD)
                </h1>
                <p class="text-xs text-slate-500 mt-0.5">
                    Monitoring penugasan luar kantor Kepala Balai, pejabat struktural, dan staf BPVP Kendari TA 2026.
                </p>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex flex-wrap items-center gap-2.5">
                <button onclick="exportSpdExcel()" class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:text-emerald-700 text-xs font-bold transition shadow-xs">
                    <i class="fa-solid fa-file-excel text-emerald-600"></i>
                    <span>Export Rekap Excel</span>
                </button>
                <a href="input_perjalanan_dinas.php" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-extrabold transition shadow-md shadow-emerald-900/20">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Surat Tugas / SPD</span>
                </a>
            </div>
        </div>

        <!-- STATS CARDS (DONEZO EXECUTIVE STYLE) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <!-- CARD 1: TOTAL SPD (EMERALD PRIMARY) -->
            <div class="bg-[#134e38] rounded-2xl p-5 text-white shadow-md relative overflow-hidden flex flex-col justify-between">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium text-emerald-200 uppercase tracking-wider">Total Penugasan</span>
                    <div class="w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center text-emerald-300">
                        <i class="fa-solid fa-briefcase text-sm"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="text-3xl font-extrabold tracking-tight font-heading" id="stat-total-spd">28</div>
                    <div class="text-[11px] text-emerald-200/90 mt-1 flex items-center gap-1.5">
                        <span class="inline-block w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span>Surat Tugas Diterbitkan 2026</span>
                    </div>
                </div>
            </div>

            <!-- CARD 2: LUAR DAERAH (JAKARTA / KEMNAKER) -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Luar Daerah / Jakarta</span>
                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                        <i class="fa-solid fa-plane-departure text-sm"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="text-3xl font-extrabold text-slate-900 tracking-tight font-heading" id="stat-luar-daerah">12</div>
                    <div class="text-[11px] text-blue-600 font-medium mt-1">
                        Agenda Rakor Pusat & MoU Kementerian
                    </div>
                </div>
            </div>

            <!-- CARD 3: DALAM DAERAH (SULTRA) -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Dalam Daerah (Sultra)</span>
                    <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                        <i class="fa-solid fa-car text-sm"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="text-3xl font-extrabold text-slate-900 tracking-tight font-heading" id="stat-dalam-daerah">16</div>
                    <div class="text-[11px] text-amber-600 font-medium mt-1">
                        Supervisi UPTD & Kunjungan Industri
                    </div>
                </div>
            </div>

            <!-- CARD 4: REALISASI ANGGARAN SPD -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Realisasi Anggaran SPD</span>
                    <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center">
                        <i class="fa-solid fa-money-bill-wave text-sm"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="text-2xl font-extrabold text-slate-900 tracking-tight font-heading" id="stat-biaya-spd">Rp 184,5 Jt</div>
                    <div class="text-[11px] text-teal-700 font-medium mt-1">
                        Beban DIPA BPVP Kendari TA 2026
                    </div>
                </div>
            </div>

        </div>

        <!-- AGENDA PIMPINAN BANNER (EXECUTIVE HIGHLIGHT) -->
        <div class="bg-gradient-to-r from-slate-900 via-[#1e3a2f] to-[#134e38] rounded-2xl p-5 text-white shadow-md border border-emerald-800/40 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-start sm:items-center gap-3.5">
                <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-emerald-300 font-extrabold text-xl shrink-0 shadow-inner">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-0.5 rounded-full bg-emerald-500/30 text-emerald-200 text-[10px] font-bold uppercase tracking-wider">Agenda Pimpinan</span>
                        <h3 class="font-extrabold text-sm sm:text-base text-white">Perjalanan Dinas Kepala BPVP Kendari Mendatang</h3>
                    </div>
                    <p class="text-xs text-emerald-200/90 mt-1 max-w-2xl">
                        <strong>Rakor Nasional Penyelenggaraan Pelatihan Vokasi 2026</strong> &bull; Jakarta (Gedung Kemnaker RI) &bull; 12 – 15 April 2026 (4 Hari)
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <span class="px-3 py-1.5 rounded-xl bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-xs font-bold flex items-center gap-1.5">
                    <i class="fa-solid fa-clock"></i>
                    <span>Status: Terjadwal (ST Resmi)</span>
                </span>
                <a href="input_perjalanan_dinas.php" class="px-3.5 py-2 rounded-xl bg-white text-slate-900 font-extrabold text-xs hover:bg-slate-100 transition shadow-xs">
                    Input SPD Baru
                </a>
            </div>
        </div>

        <!-- TABLE SECTION -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
            
            <!-- TABLE TOOLBAR -->
            <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-base font-bold">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <div>
                        <h2 class="text-sm sm:text-base font-bold text-slate-900 tracking-tight">
                            Rekapitulasi Surat Tugas & Perjalanan Dinas (SPD)
                        </h2>
                        <p class="text-[11px] text-slate-500">Daftar lengkap surat tugas perjalanan dinas tahun anggaran 2026</p>
                    </div>
                </div>

                <!-- FILTER CONTROLS -->
                <div class="flex flex-wrap items-center gap-2.5 text-xs">
                    
                    <!-- Search Input -->
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" id="search-spd" oninput="renderTable()" placeholder="Cari nama, agenda, tujuan..." 
                               class="pl-8 pr-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-1 focus:ring-emerald-600 text-xs w-44 sm:w-56 bg-slate-50/50">
                    </div>

                    <!-- Filter Kategori Lokasi -->
                    <select id="filter-kategori" onchange="renderTable()" class="px-3 py-2 rounded-xl border border-slate-200 font-semibold text-slate-700 focus:outline-none focus:ring-1 focus:ring-emerald-600 bg-slate-50/50 cursor-pointer">
                        <option value="all">Semua Lokasi</option>
                        <option value="luar">Luar Daerah (Jakarta/Pusat)</option>
                        <option value="dalam">Dalam Daerah (Sultra)</option>
                    </select>

                    <!-- Filter Status -->
                    <select id="filter-status" onchange="renderTable()" class="px-3 py-2 rounded-xl border border-slate-200 font-semibold text-slate-700 focus:outline-none focus:ring-1 focus:ring-emerald-600 bg-slate-50/50 cursor-pointer">
                        <option value="all">Semua Status</option>
                        <option value="Terjadwal">Terjadwal</option>
                        <option value="Sedang Berjalan">Sedang Berjalan</option>
                        <option value="Selesai">Selesai (SPJ Lengkap)</option>
                    </select>

                </div>

            </div>

            <!-- TABLE CONTAINER (ZERO HORIZONTAL SCROLL) -->
            <div class="w-full">
                <table class="w-full text-left text-xs border-collapse">
                    <thead class="bg-slate-50/80 text-slate-700 font-bold border-b border-slate-200">
                        <tr>
                            <th class="py-3.5 px-4">No. Surat Tugas & Tgl</th>
                            <th class="py-3.5 px-4">Pejabat / Pelaksana</th>
                            <th class="py-3.5 px-4">Maksud Penugasan</th>
                            <th class="py-3.5 px-4">Tujuan & Jadwal</th>
                            <th class="py-3.5 px-4">Estimasi Biaya</th>
                            <th class="py-3.5 px-4 text-center">Status</th>
                            <th class="py-3.5 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="spd-table-body" class="divide-y divide-slate-100">
                        <!-- Rendered by JS -->
                    </tbody>
                </table>
            </div>

            <!-- TABLE FOOTER -->
            <div class="p-4 bg-slate-50/60 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs text-slate-500">
                <div id="table-info">Menampilkan 0 data perjalanan dinas</div>
                <div class="flex items-center gap-1.5 text-[11px]">
                    <i class="fa-solid fa-shield-halved text-emerald-600"></i>
                    <span>Data terverifikasi Bagian Umum / TU BPVP Kendari</span>
                </div>
            </div>

        </div>

    </main>

    <script>
        // DATA SPD DEFAULT
        const DEFAULT_SPD_DATA = [
            {
                id: 1,
                no_st: "ST.018/BPVP-KDI/TU/IV/2026",
                tgl_st: "2026-04-08",
                nama: "La Ode Haji Polingai, S.E., M.M.",
                jabatan: "Kepala BPVP Kendari",
                is_pimpinan: true,
                maksud: "Rapat Koordinasi Nasional Pelatihan Vokasi & Kemitraan Industri Tahun 2026",
                asal: "Kendari",
                tujuan: "Jakarta (Gedung Kemnaker RI)",
                kategori: "luar",
                tgl_berangkat: "12 Apr 2026",
                tgl_kembali: "15 Apr 2026",
                lama: "4 Hari",
                anggaran: "DIPA BPVP Kendari",
                biaya: 14850000,
                status: "Terjadwal"
            },
            {
                id: 2,
                no_st: "ST.019/BPVP-KDI/TU/IV/2026",
                tgl_st: "2026-04-10",
                nama: "Drs. Ahmad Yani, M.Si",
                jabatan: "Subkoordinator Tata Usaha",
                is_pimpinan: false,
                maksud: "Supervisi Fasilitas & Sinkronisasi Kurikulum Bersama UPTD BLK Konawe",
                asal: "Kendari",
                tujuan: "Kabupaten Konawe",
                kategori: "dalam",
                tgl_berangkat: "20 Apr 2026",
                tgl_kembali: "21 Apr 2026",
                lama: "2 Hari",
                anggaran: "DIPA BPVP Kendari",
                biaya: 2300000,
                status: "Terjadwal"
            },
            {
                id: 3,
                no_st: "ST.014/BPVP-KDI/TU/III/2026",
                tgl_st: "2026-03-22",
                nama: "La Ode Haji Polingai, S.E., M.M.",
                jabatan: "Kepala BPVP Kendari",
                is_pimpinan: true,
                maksud: "Penandatanganan Nota Kesepahaman (MoU) Kemitraan Magang Siswa dengan PT VDNI",
                asal: "Kendari",
                tujuan: "Kawasan Industri Morosi (Konawe)",
                kategori: "dalam",
                tgl_berangkat: "25 Mar 2026",
                tgl_kembali: "26 Mar 2026",
                lama: "2 Hari",
                anggaran: "DIPA BPVP Kendari",
                biaya: 3200000,
                status: "Selesai"
            },
            {
                id: 4,
                no_st: "ST.012/BPVP-KDI/TU/III/2026",
                tgl_st: "2026-03-10",
                nama: "Ir. Hendra Gunawan, S.T.",
                jabatan: "Koordinator Pemberdayaan",
                is_pimpinan: false,
                maksud: "Konsolidasi Verifikasi Data Lulusan Pelatihan dengan Dinas Tenaga Kerja Kabupaten Kolaka",
                asal: "Kendari",
                tujuan: "Kabupaten Kolaka",
                kategori: "dalam",
                tgl_berangkat: "15 Mar 2026",
                tgl_kembali: "17 Mar 2026",
                lama: "3 Hari",
                anggaran: "DIPA BPVP Kendari",
                biaya: 3800000,
                status: "Selesai"
            },
            {
                id: 5,
                no_st: "ST.009/BPVP-KDI/TU/II/2026",
                tgl_st: "2026-02-18",
                nama: "La Ode Haji Polingai, S.E., M.M.",
                jabatan: "Kepala BPVP Kendari",
                is_pimpinan: true,
                maksud: "Konsultasi Alokasi Anggaran Tambahan Pelatihan Berbasis Proyek (PBL) di Ditjen Binalavotas",
                asal: "Kendari",
                tujuan: "Jakarta",
                kategori: "luar",
                tgl_berangkat: "22 Feb 2026",
                tgl_kembali: "25 Feb 2026",
                lama: "4 Hari",
                anggaran: "DIPA BPVP Kendari",
                biaya: 15200000,
                status: "Selesai"
            }
        ];

        // LOAD FROM LOCAL STORAGE OR INITIALIZE
        function getSpdData() {
            const stored = localStorage.getItem('simpel_spd_data');
            if (stored) {
                try { return JSON.parse(stored); } catch(e) {}
            }
            localStorage.setItem('simpel_spd_data', JSON.stringify(DEFAULT_SPD_DATA));
            return DEFAULT_SPD_DATA;
        }

        function formatRupiah(num) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(num);
        }

        function renderTable() {
            const data = getSpdData();
            const search = (document.getElementById('search-spd')?.value || '').toLowerCase();
            const kategori = document.getElementById('filter-kategori')?.value || 'all';
            const status = document.getElementById('filter-status')?.value || 'all';

            const filtered = data.filter(item => {
                const matchSearch = item.nama.toLowerCase().includes(search) || 
                                    item.maksud.toLowerCase().includes(search) || 
                                    item.tujuan.toLowerCase().includes(search) ||
                                    item.no_st.toLowerCase().includes(search);
                const matchKategori = kategori === 'all' || item.kategori === kategori;
                const matchStatus = status === 'all' || item.status === status;
                return matchSearch && matchKategori && matchStatus;
            });

            const tbody = document.getElementById('spd-table-body');
            if (!tbody) return;

            if (filtered.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="p-8 text-center text-slate-400">
                            <i class="fa-solid fa-inbox text-3xl mb-2 text-slate-300"></i>
                            <p class="font-semibold text-xs">Tidak ada data perjalanan dinas yang cocok dengan filter.</p>
                        </td>
                    </tr>
                `;
                document.getElementById('table-info').textContent = "Menampilkan 0 data perjalanan dinas";
                return;
            }

            let html = '';
            filtered.forEach(item => {
                let statusBadge = '';
                if (item.status === 'Terjadwal') {
                    statusBadge = `<span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">Terjadwal</span>`;
                } else if (item.status === 'Sedang Berjalan') {
                    statusBadge = `<span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">Sedang Berjalan</span>`;
                } else {
                    statusBadge = `<span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Selesai (SPJ)</span>`;
                }

                const avatarBg = item.is_pimpinan ? 'bg-emerald-700 text-white font-extrabold' : 'bg-slate-200 text-slate-700 font-bold';

                html += `
                    <tr class="hover:bg-slate-50/70 transition">
                        <td class="py-3 px-4">
                            <div class="font-bold text-slate-900">${item.no_st}</div>
                            <div class="text-[11px] text-slate-500 mt-0.5"><i class="fa-solid fa-calendar-days text-[10px] text-slate-400 mr-1"></i>${item.tgl_st}</div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg ${avatarBg} flex items-center justify-center text-xs shrink-0">
                                    ${item.nama.charAt(0)}
                                </div>
                                <div class="min-w-0">
                                    <div class="font-bold text-slate-900 truncate">${item.nama}</div>
                                    <div class="text-[10px] ${item.is_pimpinan ? 'text-emerald-700 font-extrabold' : 'text-slate-500'}">${item.jabatan}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 max-w-xs">
                            <p class="text-slate-800 font-medium leading-snug break-words">${item.maksud}</p>
                        </td>
                        <td class="py-3 px-4">
                            <div class="font-semibold text-slate-800 flex items-center gap-1.5">
                                <i class="fa-solid fa-location-dot text-[11px] ${item.kategori === 'luar' ? 'text-blue-600' : 'text-amber-600'}"></i>
                                <span>${item.tujuan}</span>
                            </div>
                            <div class="text-[11px] text-slate-500 mt-0.5">
                                ${item.tgl_berangkat} – ${item.tgl_kembali} (${item.lama})
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="font-bold text-slate-900">${formatRupiah(item.biaya)}</div>
                            <div class="text-[10px] text-slate-500">${item.anggaran}</div>
                        </td>
                        <td class="py-3 px-4 text-center">
                            ${statusBadge}
                        </td>
                        <td class="py-3 px-4 text-center">
                            <button onclick="viewDetailSpd(${item.id})" class="p-1.5 rounded-lg text-slate-400 hover:text-emerald-700 hover:bg-emerald-50 transition" title="Lihat Detail SPD">
                                <i class="fa-solid fa-eye text-xs"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });

            tbody.innerHTML = html;
            document.getElementById('table-info').textContent = `Menampilkan ${filtered.length} dari ${data.length} data perjalanan dinas`;
        }

        function viewDetailSpd(id) {
            const data = getSpdData();
            const item = data.find(x => x.id === id);
            if (!item) return;

            Swal.fire({
                title: `<span class="text-base font-bold font-heading">Detail Surat Perjalanan Dinas</span>`,
                html: `
                    <div class="text-left text-xs space-y-2.5 p-2 text-slate-700">
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                            <div class="font-bold text-slate-900">${item.no_st}</div>
                            <div class="text-[11px] text-slate-500">Tanggal: ${item.tgl_st}</div>
                        </div>
                        <div><strong class="text-slate-900">Pelaksana:</strong> ${item.nama} (${item.jabatan})</div>
                        <div><strong class="text-slate-900">Maksud:</strong> ${item.maksud}</div>
                        <div><strong class="text-slate-900">Rute:</strong> ${item.asal} &rarr; ${item.tujuan}</div>
                        <div><strong class="text-slate-900">Jadwal:</strong> ${item.tgl_berangkat} s/d ${item.tgl_kembali} (${item.lama})</div>
                        <div><strong class="text-slate-900">Beban Anggaran:</strong> ${item.anggaran}</div>
                        <div><strong class="text-slate-900">Estimasi Biaya:</strong> ${formatRupiah(item.biaya)}</div>
                        <div><strong class="text-slate-900">Status:</strong> ${item.status}</div>
                    </div>
                `,
                confirmButtonColor: '#134e38',
                confirmButtonText: 'Tutup'
            });
        }

        function exportSpdExcel() {
            const data = getSpdData();
            const exportRows = data.map(x => ({
                "Nomor Surat Tugas": x.no_st,
                "Tanggal Surat Tugas": x.tgl_st,
                "Nama Pejabat / Pegawai": x.nama,
                "Jabatan": x.jabatan,
                "Maksud Penugasan": x.maksud,
                "Kota Keberangkatan": x.asal,
                "Kota Tujuan": x.tujuan,
                "Tanggal Berangkat": x.tgl_berangkat,
                "Tanggal Kembali": x.tgl_kembali,
                "Lama Hari": x.lama,
                "Beban Anggaran": x.anggaran,
                "Estimasi Biaya (Rp)": x.biaya,
                "Status": x.status
            }));

            SimpelADK.exportData('perjalanan_dinas', exportRows, `Rekap_Perjalanan_Dinas_BPVP_Kendari_${new Date().toISOString().slice(0,10)}.xlsx`);
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderTable();
        });
    </script>
</body>
</html>
