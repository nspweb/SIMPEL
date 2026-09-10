<?php
require_once __DIR__ . '/auth/auth_check.php';
requireRoleAccess(['admin', 'pimpinan', 'tu']);
$activePage = 'input_perjalanan_dinas';
?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Perjalanan Dinas (SPD) - SIMPEL BPVP Kendari 2026</title>

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
        
        <!-- BREADCRUMB -->
        <div class="flex items-center justify-between">
            <a href="perjalanan_dinas.php" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-emerald-700 transition">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Rekap Perjalanan Dinas</span>
            </a>
            <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-bold">
                Administrasi Mandiri: Surat Perjalanan Dinas (SPD)
            </span>
        </div>

        <!-- ADK EXCEL TOOLBAR CONTAINER -->
        <div id="adk-toolbar-container">
            <!-- Injected by SimpelADK -->
        </div>

        <!-- FORM CARD -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
            
            <div class="p-6 bg-gradient-to-r from-slate-900 to-[#134e38] text-white flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-emerald-300 text-lg border border-white/20">
                        <i class="fa-solid fa-file-signature"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold font-heading">Formulir Surat Tugas & Perjalanan Dinas</h2>
                        <p class="text-xs text-emerald-200">Penerbitan surat tugas dan SPD Kepala Balai serta staf TA 2026</p>
                    </div>
                </div>
                <a href="perjalanan_dinas.php" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white text-xs font-medium border border-white/20 transition">
                    <i class="fa-solid fa-table-list"></i>
                    <span>Rekap SPD</span>
                </a>
            </div>

            <form onsubmit="handleSaveSpd(event)" class="p-6 sm:p-8 text-xs">
                
                <!-- TAB NAVIGATION BAR -->
                <div class="flex items-center gap-2 border-b border-slate-200 pb-3 mb-6 overflow-x-auto">
                    <button type="button" onclick="switchFormTab(1)" id="tab-btn-1" class="tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-emerald-700 text-white shadow-xs transition">
                        <span class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center text-[10px]">1</span>
                        <span>Dasar Surat Tugas & Pejabat</span>
                    </button>
                    <button type="button" onclick="switchFormTab(2)" id="tab-btn-2" class="tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                        <span class="w-5 h-5 rounded-full bg-slate-300 text-slate-700 flex items-center justify-center text-[10px]">2</span>
                        <span>Maksud & Rute Perjalanan</span>
                    </button>
                    <button type="button" onclick="switchFormTab(3)" id="tab-btn-3" class="tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                        <span class="w-5 h-5 rounded-full bg-slate-300 text-slate-700 flex items-center justify-center text-[10px]">3</span>
                        <span>Anggaran & Biaya SPPD</span>
                    </button>
                </div>

                <!-- TAB PANEL 1: SURAT TUGAS & PEJABAT -->
                <div id="form-panel-1" class="form-panel space-y-4">
                    <div class="pb-2 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">1. Identitas Surat Tugas & Pelaksana</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Pilih pejabat atau staf yang melaksanakan tugas perjalanan dinas.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Nomor Surat Tugas <span class="text-red-500">*</span></label>
                            <input type="text" id="no_surat_tugas" required placeholder="Contoh: ST.020/BPVP-KDI/TU/IV/2026" 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-600 focus:outline-none bg-slate-50/50 font-medium">
                        </div>

                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Tanggal Surat Tugas <span class="text-red-500">*</span></label>
                            <input type="date" id="tgl_st" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-600 focus:outline-none bg-slate-50/50">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Nama Pejabat / Pelaksana Tugas <span class="text-red-500">*</span></label>
                            <select id="nama_pejabat" required onchange="handlePejabatChange(this.value)" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-600 focus:outline-none bg-slate-50/50">
                                <option value="">-- Pilih Pejabat / Pegawai --</option>
                                <option value="La Ode Haji Polingai, S.E., M.M.">La Ode Haji Polingai, S.E., M.M. (Kepala Balai)</option>
                                <option value="Drs. Ahmad Yani, M.Si">Drs. Ahmad Yani, M.Si (Subkoordinator TU)</option>
                                <option value="Ir. Hendra Gunawan, S.T.">Ir. Hendra Gunawan, S.T. (Subkoordinator Pemberdayaan)</option>
                                <option value="Siti Rahmawati, S.Sos">Siti Rahmawati, S.Sos (Bendahara Pengeluaran)</option>
                                <option value="Muhammad Fajar, S.T.">Muhammad Fajar, S.T. (Koordinator Instruktur)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Jabatan & Golongan</label>
                            <input type="text" id="jabatan" placeholder="Jabatan Pejabat / Pegawai" 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-slate-700 font-semibold focus:outline-none" readonly>
                        </div>
                    </div>
                </div>

                <!-- TAB PANEL 2: RUTE & JADWAL -->
                <div id="form-panel-2" class="form-panel space-y-4 hidden">
                    <div class="pb-2 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">2. Maksud & Rute Perjalanan Dinas</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Tentukan agenda perjalanan dinas, kota tujuan, dan rentang waktu pelaksanaan.</p>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Maksud Perjalanan Dinas / Agenda Kegiatan <span class="text-red-500">*</span></label>
                        <textarea id="maksud_tugas" rows="2" required placeholder="Contoh: Rapat Koordinasi Nasional Pelatihan Vokasi & Kemitraan Industri Tahun 2026 bersama Kemnaker RI" 
                                  class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-600 focus:outline-none bg-slate-50/50"></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Kota Asal <span class="text-red-500">*</span></label>
                            <input type="text" id="kota_asal" value="Kendari" required 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-600 focus:outline-none bg-slate-50/50">
                        </div>

                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Kota / Lokasi Tujuan <span class="text-red-500">*</span></label>
                            <input type="text" id="kota_tujuan" required placeholder="Contoh: Jakarta (Gedung Kemnaker RI)" 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-600 focus:outline-none bg-slate-50/50">
                        </div>

                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Kategori Wilayah <span class="text-red-500">*</span></label>
                            <select id="kategori_wilayah" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-600 focus:outline-none bg-slate-50/50">
                                <option value="luar">Luar Daerah (Jakarta / Pusat / Provinsi Lain)</option>
                                <option value="dalam">Dalam Daerah (Kabupaten / Kota se-Sultra)</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Tanggal Berangkat <span class="text-red-500">*</span></label>
                            <input type="date" id="tgl_berangkat" required onchange="calcDuration()" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-600 focus:outline-none bg-slate-50/50">
                        </div>

                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Tanggal Kembali <span class="text-red-500">*</span></label>
                            <input type="date" id="tgl_kembali" required onchange="calcDuration()" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-600 focus:outline-none bg-slate-50/50">
                        </div>

                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Lama Hari</label>
                            <input type="text" id="lama_hari" value="1 Hari" readonly class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-slate-700 font-bold focus:outline-none">
                        </div>
                    </div>
                </div>

                <!-- TAB PANEL 3: PEMBIAYAAN & SPPD -->
                <div id="form-panel-3" class="form-panel space-y-4 hidden">
                    <div class="pb-2 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">3. Pembebanan Anggaran & Rincian SPPD</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Alokasi anggaran DIPA dan rincian estimasi biaya perjalanan dinas.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Mata Anggaran / DIPA <span class="text-red-500">*</span></label>
                            <input type="text" id="beban_anggaran" value="DIPA BPVP Kendari TA 2026" required 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-600 focus:outline-none bg-slate-50/50">
                        </div>

                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Estimasi Total Biaya SPD (Rp) <span class="text-red-500">*</span></label>
                            <input type="number" id="total_biaya" required placeholder="Contoh: 14850000" 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-600 focus:outline-none bg-slate-50/50 font-bold text-emerald-800">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Moda Transportasi</label>
                            <select id="transportasi" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-600 focus:outline-none bg-slate-50/50">
                                <option value="Pesawat Terbang (Garuda/Batik)">Pesawat Terbang (Garuda Indonesia / Batik Air)</option>
                                <option value="Kendaraan Dinas Operasional">Kendaraan Dinas Operasional Balai</option>
                                <option value="Transportasi Darat Umum">Transportasi Darat Umum</option>
                                <option value="Kapal Laut / Feri Cepat">Kapal Laut / Feri Cepat</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Status Disposisi / Perjalanan</label>
                            <select id="status_perjalanan" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-600 focus:outline-none bg-slate-50/50 font-semibold">
                                <option value="Terjadwal">Terjadwal (Surat Tugas Terbit)</option>
                                <option value="Sedang Berjalan">Sedang Berjalan (Berangkat)</option>
                                <option value="Selesai">Selesai (Laporan & SPJ Lengkap)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- FOOTER ACTIONS -->
                <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-between">
                    <button type="button" onclick="window.history.back()" class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 font-semibold transition">
                        Batal
                    </button>
                    <div class="flex items-center gap-3">
                        <button type="button" id="prev-tab-btn" onclick="stepTab(-1)" class="hidden px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold transition">
                            Sebelumnya
                        </button>
                        <button type="button" id="next-tab-btn" onclick="stepTab(1)" class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-900 text-white font-bold transition">
                            Lanjut: Rute & Jadwal
                        </button>
                        <button type="submit" id="submit-btn" class="hidden px-6 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-extrabold shadow-md shadow-emerald-900/20 transition flex items-center gap-2">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <span>Simpan Surat Perjalanan Dinas</span>
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </main>

    <script>
        let currentTab = 1;

        function switchFormTab(tabIdx) {
            currentTab = tabIdx;
            
            // Hide all panels
            document.querySelectorAll('.form-panel').forEach(panel => panel.classList.add('hidden'));
            
            // Show target panel
            const activePanel = document.getElementById(`form-panel-${tabIdx}`);
            if (activePanel) activePanel.classList.remove('hidden');

            // Update Tab Nav Buttons
            document.querySelectorAll('.tab-nav-btn').forEach((btn, idx) => {
                const step = idx + 1;
                if (step === tabIdx) {
                    btn.className = "tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-emerald-700 text-white shadow-xs transition";
                    btn.querySelector('span:first-child').className = "w-5 h-5 rounded-full bg-white/20 flex items-center justify-center text-[10px]";
                } else {
                    btn.className = "tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-slate-100 text-slate-600 hover:bg-slate-200 transition";
                    btn.querySelector('span:first-child').className = "w-5 h-5 rounded-full bg-slate-300 text-slate-700 flex items-center justify-center text-[10px]";
                }
            });

            // Update Bottom Buttons
            const prevBtn = document.getElementById('prev-tab-btn');
            const nextBtn = document.getElementById('next-tab-btn');
            const submitBtn = document.getElementById('submit-btn');

            if (tabIdx === 1) {
                prevBtn.classList.add('hidden');
                nextBtn.classList.remove('hidden');
                nextBtn.textContent = 'Lanjut: Rute & Jadwal';
                submitBtn.classList.add('hidden');
            } else if (tabIdx === 2) {
                prevBtn.classList.remove('hidden');
                nextBtn.classList.remove('hidden');
                nextBtn.textContent = 'Lanjut: Anggaran & SPPD';
                submitBtn.classList.add('hidden');
            } else {
                prevBtn.classList.remove('hidden');
                nextBtn.classList.add('hidden');
                submitBtn.classList.remove('hidden');
            }
        }

        function stepTab(direction) {
            const next = currentTab + direction;
            if (next >= 1 && next <= 3) {
                switchFormTab(next);
            }
        }

        function handlePejabatChange(name) {
            const jabEl = document.getElementById('jabatan');
            if (name.includes('La Ode')) {
                jabEl.value = 'Kepala BPVP Kendari (Pembina Tk. I / IV.b)';
            } else if (name.includes('Ahmad Yani')) {
                jabEl.value = 'Subkoordinator Tata Usaha (Penata Tk. I / III.d)';
            } else if (name.includes('Hendra')) {
                jabEl.value = 'Subkoordinator Pemberdayaan (Penata / III.c)';
            } else if (name.includes('Siti Rahmawati')) {
                jabEl.value = 'Bendahara Pengeluaran Balai (Penata Muda / III.a)';
            } else if (name.includes('Fajar')) {
                jabEl.value = 'Instruktur Ahli Muda (Penata / III.c)';
            } else {
                jabEl.value = '';
            }
        }

        function calcDuration() {
            const b = document.getElementById('tgl_berangkat').value;
            const k = document.getElementById('tgl_kembali').value;
            if (b && k) {
                const dtB = new Date(b);
                const dtK = new Date(k);
                const diffTime = dtK - dtB;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                document.getElementById('lama_hari').value = diffDays > 0 ? `${diffDays} Hari` : '1 Hari';
            }
        }

        function triggerModuleImport(moduleKey) {
            SimpelADK.openImportModal(moduleKey, (rows) => {
                if (rows && rows.length > 0) {
                    const r = rows[0]; // Isi baris pertama ke form
                    if (r["Nomor Surat Tugas"]) document.getElementById('no_surat_tugas').value = r["Nomor Surat Tugas"];
                    if (r["Maksud Penugasan / Agenda"]) document.getElementById('maksud_tugas').value = r["Maksud Penugasan / Agenda"];
                    if (r["Kota Keberangkatan"]) document.getElementById('kota_asal').value = r["Kota Keberangkatan"];
                    if (r["Kota Tujuan"]) document.getElementById('kota_tujuan').value = r["Kota Tujuan"];
                    if (r["Tanggal Berangkat"]) document.getElementById('tgl_berangkat').value = r["Tanggal Berangkat"];
                    if (r["Tanggal Kembali"]) document.getElementById('tgl_kembali').value = r["Tanggal Kembali"];
                    if (r["Beban Anggaran"]) document.getElementById('beban_anggaran').value = r["Beban Anggaran"];
                    if (r["Estimasi Biaya SPD (Rp)"]) document.getElementById('total_biaya').value = r["Estimasi Biaya SPD (Rp)"];
                    
                    const nama = r["Nama yang Ditugaskan"] || '';
                    if (nama.includes('La Ode')) {
                        document.getElementById('nama_pejabat').value = 'La Ode Haji Polingai, S.E., M.M.';
                    } else if (nama.includes('Ahmad Yani')) {
                        document.getElementById('nama_pejabat').value = 'Drs. Ahmad Yani, M.Si';
                    }
                    handlePejabatChange(document.getElementById('nama_pejabat').value);
                    calcDuration();

                    // Simpan seluruh data jika ada lebih dari 1 baris
                    if (rows.length > 1) {
                        const stored = JSON.parse(localStorage.getItem('simpel_spd_data') || '[]');
                        rows.forEach((row, i) => {
                            stored.unshift({
                                id: Date.now() + i,
                                no_st: row["Nomor Surat Tugas"] || `ST.0${25+i}/BPVP-KDI/TU/IV/2026`,
                                tgl_st: new Date().toISOString().slice(0, 10),
                                nama: row["Nama yang Ditugaskan"] || 'Pejabat BPVP Kendari',
                                jabatan: row["Jabatan"] || 'Staf BPVP',
                                is_pimpinan: (row["Nama yang Ditugaskan"] || '').includes('La Ode'),
                                maksud: row["Maksud Penugasan / Agenda"] || 'Penugasan Dinas Luar Kantor',
                                asal: row["Kota Keberangkatan"] || 'Kendari',
                                tujuan: row["Kota Tujuan"] || 'Jakarta',
                                kategori: (row["Kota Tujuan"] || '').toLowerCase().includes('jakarta') ? 'luar' : 'dalam',
                                tgl_berangkat: row["Tanggal Berangkat"] || '12 Apr 2026',
                                tgl_kembali: row["Tanggal Kembali"] || '15 Apr 2026',
                                lama: (row["Lama Hari"] || 3) + ' Hari',
                                anggaran: row["Beban Anggaran"] || 'DIPA BPVP Kendari',
                                biaya: parseFloat(row["Estimasi Biaya SPD (Rp)"] || 5000000),
                                status: row["Status Perjalanan"] || 'Terjadwal'
                            });
                        });
                        localStorage.setItem('simpel_spd_data', JSON.stringify(stored));
                    }
                }
            });
        }

        function handleSaveSpd(e) {
            e.preventDefault();

            const noSt = document.getElementById('no_surat_tugas').value;
            const nama = document.getElementById('nama_pejabat').value;
            const jabatan = document.getElementById('jabatan').value;
            const maksud = document.getElementById('maksud_tugas').value;
            const tujuan = document.getElementById('kota_tujuan').value;
            const asal = document.getElementById('kota_asal').value;
            const tglB = document.getElementById('tgl_berangkat').value;
            const tglK = document.getElementById('tgl_kembali').value;
            const lama = document.getElementById('lama_hari').value;
            const anggaran = document.getElementById('beban_anggaran').value;
            const biaya = parseFloat(document.getElementById('total_biaya').value) || 0;
            const status = document.getElementById('status_perjalanan').value;
            const kategori = document.getElementById('kategori_wilayah').value;

            const newItem = {
                id: Date.now(),
                no_st: noSt,
                tgl_st: document.getElementById('tgl_st').value,
                nama: nama,
                jabatan: jabatan,
                is_pimpinan: nama.includes('La Ode'),
                maksud: maksud,
                asal: asal,
                tujuan: tujuan,
                kategori: kategori,
                tgl_berangkat: tglB,
                tgl_kembali: tglK,
                lama: lama,
                anggaran: anggaran,
                biaya: biaya,
                status: status
            };

            const stored = JSON.parse(localStorage.getItem('simpel_spd_data') || '[]');
            stored.unshift(newItem);
            localStorage.setItem('simpel_spd_data', JSON.stringify(stored));

            Swal.fire({
                icon: 'success',
                title: 'Surat Perjalanan Dinas Berhasil Diterbitkan!',
                text: `Data SPD untuk ${nama} telah tercatat di rekapitulasi umum.`,
                confirmButtonColor: '#134e38',
                confirmButtonText: 'Buka Rekap SPD'
            }).then(() => {
                window.location.href = 'perjalanan_dinas.php';
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Render Toolbar ADK
            const container = document.getElementById('adk-toolbar-container');
            if (container) {
                container.innerHTML = SimpelADK.renderToolbarHTML('perjalanan_dinas', 'ADK Pertukaran Data Surat Perjalanan Dinas (SPD)');
            }

            // Set default date
            const today = new Date().toISOString().slice(0, 10);
            document.getElementById('tgl_st').value = today;
            document.getElementById('tgl_berangkat').value = today;
            document.getElementById('tgl_kembali').value = today;
        });
    </script>
</body>
</html>
