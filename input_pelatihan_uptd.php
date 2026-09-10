<?php
require_once __DIR__ . '/auth/auth_check.php';
requireRoleAccess(['admin', 'tu']);
$activePage = 'input_pelatihan_uptd';
?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Pelatihan UPTD - SIMPEL BPVP Kendari 2026</title>

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
            <a href="pelatihan_uptd.php" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-amber-600 transition">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Master Data Pelatihan UPTD</span>
            </a>
            <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-800 text-xs font-bold">
                Modul TU & 5 BLK UPTD Binaan
            </span>
        </div>

        <!-- ADK EXCEL TOOLBAR CONTAINER -->
        <div id="adk-toolbar-container"></div>

        <!-- FORM CARD -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
            
            <div class="p-6 bg-gradient-to-r from-slate-900 to-amber-900 text-white flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-amber-300 text-lg border border-white/20">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold font-heading">Formulir Input Data Pelatihan BLK UPTD Binaan</h2>
                        <p class="text-xs text-slate-200">Pencatatan data kejuruan, peserta, gender, tingkat pendidikan, disabilitas, dan kelompok usia</p>
                    </div>
                </div>
                <a href="pelatihan_uptd.php" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white text-xs font-medium border border-white/20 transition">
                    <i class="fa-solid fa-table-list"></i>
                    <span>Lihat Tabel UPTD</span>
                </a>
            </div>

            <form onsubmit="handleSave(event)" class="p-6 sm:p-8 text-xs">
                
                <!-- TAB NAVIGATION BAR -->
                <div class="flex items-center gap-2 border-b border-slate-200 pb-3 mb-6 overflow-x-auto">
                    <button type="button" onclick="switchFormTab(1)" id="tab-btn-1" class="tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-amber-600 text-white shadow-xs transition">
                        <span class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center text-[10px]">1</span>
                        <span>Wilayah & Program</span>
                    </button>
                    <button type="button" onclick="switchFormTab(2)" id="tab-btn-2" class="tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                        <span class="w-5 h-5 rounded-full bg-slate-300 text-slate-700 flex items-center justify-center text-[10px]">2</span>
                        <span>Gender & Disabilitas</span>
                    </button>
                    <button type="button" onclick="switchFormTab(3)" id="tab-btn-3" class="tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                        <span class="w-5 h-5 rounded-full bg-slate-300 text-slate-700 flex items-center justify-center text-[10px]">3</span>
                        <span>Pendidikan</span>
                    </button>
                    <button type="button" onclick="switchFormTab(4)" id="tab-btn-4" class="tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                        <span class="w-5 h-5 rounded-full bg-slate-300 text-slate-700 flex items-center justify-center text-[10px]">4</span>
                        <span>Kelompok Usia</span>
                    </button>
                </div>

                <!-- TAB PANEL 1: LOKASI & PROGRAM -->
                <div id="form-panel-1" class="form-panel space-y-4">
                    <div class="pb-2 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">1. Wilayah UPTD & Program Pelatihan</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Pilih BLK binaan daerah, kejuruan, dan nama paket pelatihan.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Wilayah BLK UPTD Binaan <span class="text-red-500">*</span></label>
                            <select id="uptd_wilayah" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 bg-slate-50/50 font-medium">
                                <option value="Kolaka">BLK Kolaka</option>
                                <option value="Kolaka Utara">BLK Kolaka Utara</option>
                                <option value="Konawe Selatan">BLK Konawe Selatan</option>
                                <option value="Konawe Utara">BLK Konawe Utara</option>
                                <option value="Buton">BLK Buton</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Kejuruan <span class="text-red-500">*</span></label>
                            <select id="kejuruan" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 bg-slate-50/50">
                                <option value="">-- Pilih Kejuruan --</option>
                                <option value="Otomotif">Otomotif</option>
                                <option value="Teknik Las">Teknik Las / Manufaktur</option>
                                <option value="Garmen Apparel">Garmen Apparel / Menjahit</option>
                                <option value="Teknologi Informasi">Teknologi Informasi & Komunikasi (TIK)</option>
                                <option value="Teknik Listrik">Teknik Listrik / Elektronika</option>
                                <option value="Refrigerasi">Teknik Pendingin / AC</option>
                                <option value="Bangunan">Teknik Bangunan / Konstruksi</option>
                                <option value="Pengolahan Hasil Pertanian">Pengolahan Hasil Pertanian (PHP)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Jumlah Peserta Pelatihan <span class="text-red-500">*</span></label>
                            <input type="number" id="jumlah_peserta" required min="1" value="16" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 bg-amber-50/50 font-bold text-slate-900 text-center">
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Nama Program Pelatihan <span class="text-red-500">*</span></label>
                        <input type="text" id="program_pelatihan" required placeholder="Contoh: Servis Sepeda Motor Konvensional / Menjahit Pakaian Wanita" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 bg-slate-50/50">
                    </div>
                </div>

                <!-- TAB PANEL 2: REKAPITULASI GENDER & DISABILITAS -->
                <div id="form-panel-2" class="form-panel space-y-4 hidden">
                    <div class="pb-2 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">2. Rincian Gender & Disabilitas</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Komposisi peserta berdasarkan jenis kelamin dan inklusi disabilitas.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-semibold text-pink-700 mb-1.5">Peserta Perempuan <span class="text-red-500">*</span></label>
                            <input type="number" id="perempuan" required min="0" value="0" oninput="recalcTotals()" class="w-full px-3.5 py-2.5 rounded-xl border border-pink-200 focus:ring-2 focus:ring-pink-500 bg-pink-50/30 font-bold text-center">
                        </div>
                        <div>
                            <label class="block font-semibold text-blue-700 mb-1.5">Peserta Laki-Laki <span class="text-red-500">*</span></label>
                            <input type="number" id="laki_laki" required min="0" value="16" oninput="recalcTotals()" class="w-full px-3.5 py-2.5 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 bg-blue-50/30 font-bold text-center">
                        </div>
                        <div>
                            <label class="block font-semibold text-amber-700 mb-1.5">Peserta Disabilitas</label>
                            <input type="number" id="disabilitas" min="0" value="0" class="w-full px-3.5 py-2.5 rounded-xl border border-amber-200 focus:ring-2 focus:ring-amber-500 bg-amber-50/30 font-bold text-center">
                        </div>
                    </div>
                </div>

                <!-- TAB PANEL 3: TINGKAT PENDIDIKAN -->
                <div id="form-panel-3" class="form-panel space-y-4 hidden">
                    <div class="pb-2 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">3. Tingkat Kualifikasi Pendidikan</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Sebaran latar belakang pendidikan formal peserta binaan.</p>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5 text-center">S1 / D4</label>
                            <input type="number" id="pend_s1" min="0" value="2" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-purple-500 bg-slate-50/50 text-center font-bold">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5 text-center">D3</label>
                            <input type="number" id="pend_d3" min="0" value="1" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-purple-500 bg-slate-50/50 text-center font-bold">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5 text-center">SMA / SMK</label>
                            <input type="number" id="pend_sma" min="0" value="11" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-purple-500 bg-slate-50/50 text-center font-bold">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5 text-center">SMP</label>
                            <input type="number" id="pend_smp" min="0" value="2" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-purple-500 bg-slate-50/50 text-center font-bold">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5 text-center">SD</label>
                            <input type="number" id="pend_sd" min="0" value="0" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-purple-500 bg-slate-50/50 text-center font-bold">
                        </div>
                    </div>
                </div>

                <!-- TAB PANEL 4: KELOMPOK USIA -->
                <div id="form-panel-4" class="form-panel space-y-4 hidden">
                    <div class="pb-2 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">4. Sebaran Kelompok Usia Peserta (Tahun)</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Kelompok demografi usia produktif angkatan kerja.</p>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5 text-center">U 17-24 Thn</label>
                            <input type="number" id="usia_17_24" min="0" value="10" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500 bg-slate-50/50 text-center font-bold">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5 text-center">U 25-28 Thn</label>
                            <input type="number" id="usia_25_28" min="0" value="4" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500 bg-slate-50/50 text-center font-bold">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5 text-center">U 29-34 Thn</label>
                            <input type="number" id="usia_29_34" min="0" value="2" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500 bg-slate-50/50 text-center font-bold">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5 text-center">U 35-40 Thn</label>
                            <input type="number" id="usia_35_40" min="0" value="0" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500 bg-slate-50/50 text-center font-bold">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5 text-center">U 41-dst Thn</label>
                            <input type="number" id="usia_41_dst" min="0" value="0" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500 bg-slate-50/50 text-center font-bold">
                        </div>
                    </div>
                </div>

                <!-- TAB ACTION BAR -->
                <div class="pt-6 mt-6 border-t border-slate-200 flex items-center justify-between">
                    <button type="button" id="prev-tab-btn" onclick="stepFormTab(-1)" class="invisible px-4 py-2.5 rounded-xl font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-100 transition flex items-center gap-1.5">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Sebelumnya</span>
                    </button>
                    
                    <div class="flex items-center gap-3">
                        <a href="pelatihan_uptd.php" class="px-4 py-2.5 rounded-xl font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                            Batal
                        </a>
                        <button type="button" id="next-tab-btn" onclick="stepFormTab(1)" class="px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold transition flex items-center gap-1.5">
                            <span>Selanjutnya</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                        <button type="submit" id="submit-tab-btn" class="hidden inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold shadow-md hover:shadow-lg transition">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Simpan Data Pelatihan UPTD</span>
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-slate-200 py-6 text-center text-xs text-slate-500">
        &copy; 2026 SIMPEL BPVP Kendari &bull; Subbag Tata Usaha & Wilayah Pembinaan Sultra
    </footer>

    <script>
        let currentTab = 1;
        const totalTabs = 4;

        document.addEventListener('DOMContentLoaded', () => {
            // Sidebar rendered server-side by PHP
            switchFormTab(1);
        });

        function switchFormTab(tabIdx) {
            currentTab = tabIdx;
            for (let i = 1; i <= totalTabs; i++) {
                const panel = document.getElementById(`form-panel-${i}`);
                const btn = document.getElementById(`tab-btn-${i}`);
                if (panel) {
                    if (i === tabIdx) {
                        panel.classList.remove('hidden');
                    } else {
                        panel.classList.add('hidden');
                    }
                }
                if (btn) {
                    const badge = btn.querySelector('span:first-child');
                    if (i === tabIdx) {
                        btn.className = 'tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-amber-600 text-white shadow-xs transition';
                        if (badge) badge.className = 'w-5 h-5 rounded-full bg-white/20 flex items-center justify-center text-[10px] text-white';
                    } else {
                        btn.className = 'tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-slate-100 text-slate-600 hover:bg-slate-200 transition';
                        if (badge) badge.className = 'w-5 h-5 rounded-full bg-slate-300 text-slate-700 flex items-center justify-center text-[10px]';
                    }
                }
            }

            const prevBtn = document.getElementById('prev-tab-btn');
            const nextBtn = document.getElementById('next-tab-btn');
            const submitBtn = document.getElementById('submit-tab-btn');

            if (currentTab === 1) {
                if (prevBtn) prevBtn.classList.add('invisible');
            } else {
                if (prevBtn) prevBtn.classList.remove('invisible');
            }

            if (currentTab === totalTabs) {
                if (nextBtn) nextBtn.classList.add('hidden');
                if (submitBtn) submitBtn.classList.remove('hidden');
            } else {
                if (nextBtn) nextBtn.classList.remove('hidden');
                if (submitBtn) submitBtn.classList.add('hidden');
            }
        }

        function stepFormTab(step) {
            const target = currentTab + step;
            if (target >= 1 && target <= totalTabs) {
                switchFormTab(target);
            }
        }

        function recalcTotals() {
            const p = parseInt(document.getElementById('perempuan').value) || 0;
            const l = parseInt(document.getElementById('laki_laki').value) || 0;
            document.getElementById('jumlah_peserta').value = p + l;
        }

        function handleSave(e) {
            e.preventDefault();
            const prog = document.getElementById('program_pelatihan').value;
            const blk = document.getElementById('uptd_wilayah').value;
            Swal.fire({
                icon: 'success',
                title: 'Data Berhasil Disimpan!',
                text: 'Pelatihan ' + prog + ' pada ' + blk + ' telah berhasil ditambahkan.',
                confirmButtonColor: '#d97706'
            }).then(() => {
                window.location.href = 'pelatihan_uptd.php';
            });
        }

        function triggerModuleImport(moduleKey) {
            SimpelADK.openImportModal(moduleKey, (rows) => {
                if (rows && rows.length > 0) {
                    const r = rows[0];
                    if (r["Nama UPTD Balai Binaan"]) document.getElementById('uptd_wilayah').value = r["Nama UPTD Balai Binaan"];
                    if (r["Kejuruan"]) document.getElementById('kejuruan').value = r["Kejuruan"];
                    if (r["Jumlah Paket"]) document.getElementById('jumlah_paket').value = r["Jumlah Paket"];
                    if (r["Target Siswa"]) document.getElementById('jumlah_peserta').value = r["Target Siswa"];
                    if (r["Tanggal Mulai"]) document.getElementById('tanggal_mulai').value = r["Tanggal Mulai"];
                    if (r["Tanggal Selesai"]) document.getElementById('tanggal_selesai').value = r["Tanggal Selesai"];
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('adk-toolbar-container');
            if (container && typeof SimpelADK !== 'undefined') {
                container.innerHTML = SimpelADK.renderToolbarHTML('pelatihan_uptd', 'ADK Pelatihan UPTD: Template, Import & Export Binaan');
            }
        });
    </script>
</body>
</html>
