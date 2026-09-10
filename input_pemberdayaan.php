<?php
require_once __DIR__ . '/auth/auth_check.php';
requireRoleAccess(['admin', 'pemberdayaan']);
$activePage = 'input_pemberdayaan';
?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Pemberdayaan & Penempatan - SIMPEL BPVP Kendari 2026</title>

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
            <a href="penempatan.php" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-blue-600 transition">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Data Penempatan</span>
            </a>
            <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold">
                Modul Pemberdayaan: Peserta (BNBA) & Penempatan Alumni
            </span>
        </div>

        <!-- ADK EXCEL TOOLBAR CONTAINER -->
        <div id="adk-toolbar-container"></div>

        <!-- FORM CARD -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
            
            <div class="p-6 bg-gradient-to-r from-slate-900 to-blue-900 text-white flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-blue-300 text-lg border border-white/20">
                        <i class="fa-solid fa-users-rectangle"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold font-heading">Formulir Peserta & Penempatan Alumni</h2>
                        <p class="text-xs text-slate-200">Input data lanjutan program pelatihan dari Penyelenggara & penempatan kerja lulusan</p>
                    </div>
                </div>
                <a href="penempatan.php" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white text-xs font-medium border border-white/20 transition">
                    <i class="fa-solid fa-table-list"></i>
                    <span>Tabel Penempatan</span>
                </a>
            </div>

            <form onsubmit="handleSave(event)" class="p-6 sm:p-8 text-xs">
                
                <!-- TAB NAVIGATION BAR -->
                <div class="flex items-center gap-2 border-b border-slate-200 pb-3 mb-6 overflow-x-auto">
                    <button type="button" onclick="switchFormTab(1)" id="tab-btn-1" class="tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-blue-600 text-white shadow-xs transition">
                        <span class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center text-[10px]">1</span>
                        <span>Program Usulan</span>
                    </button>
                    <button type="button" onclick="switchFormTab(2)" id="tab-btn-2" class="tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                        <span class="w-5 h-5 rounded-full bg-slate-300 text-slate-700 flex items-center justify-center text-[10px]">2</span>
                        <span>Gender Peserta</span>
                    </button>
                    <button type="button" onclick="switchFormTab(3)" id="tab-btn-3" class="tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                        <span class="w-5 h-5 rounded-full bg-slate-300 text-slate-700 flex items-center justify-center text-[10px]">3</span>
                        <span>Penempatan Alumni</span>
                    </button>
                </div>

                <!-- TAB PANEL 1: DATA PROGRAM PELATIHAN -->
                <div id="form-panel-1" class="form-panel space-y-4">
                    <div class="pb-2 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">1. Data Program Pelatihan (Lanjutan dari Penyelenggara)</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Pilih program pelatihan dari Seksi Penyelenggaraan untuk mengisi data penempatan.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Pilih Program Usulan Penyelenggara <span class="text-red-500">*</span></label>
                            <select id="program_pelatihan" required onchange="handleProgramChange(this.value)" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-slate-50/50">
                                <option value="">-- Pilih Program Pelatihan --</option>
                                <option value="Junior Web Developer|Teknologi Informasi dan Komunikasi (TIK)|PBK Reguler|16">Junior Web Developer (TIK - PBK Reguler Batch 1)</option>
                                <option value="Pengelasan SMAW 3G|Teknik Manufaktur dan Rekayasa (Las)|PBK Reguler|16">Pengelasan SMAW 3G (Las - PBK Reguler Batch 1)</option>
                                <option value="Teknisi Servis Sepeda Motor|Teknik Otomotif|Tailor Made Training (TMT)|16">Teknisi Servis Sepeda Motor (Otomotif - TMT Batch 1)</option>
                                <option value="Barista dan Tata Hidang Kopi|Pariwisata & Perhotelan|PBK Reguler|16">Barista dan Tata Hidang Kopi (Pariwisata - PBK Reguler Batch 1)</option>
                                <option value="Menjahit Pakaian Pria & Wanita|Garmen Apparel|Pelatihan Berbasis Luar (PBL)|16">Menjahit Pakaian Pria & Wanita (Garmen - PBL Batch 1)</option>
                                <option value="Desainer Grafis Muda|Teknologi Informasi dan Komunikasi (TIK)|PBK Reguler|16">Desainer Grafis Muda (TIK - PBK Reguler Batch 2)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Kejuruan Pelatihan</label>
                            <input type="text" id="kejuruan" readonly placeholder="Otomatis terisi dari penyelenggara" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-100 font-semibold text-slate-700">
                        </div>
                    </div>
                </div>

                <!-- TAB PANEL 2: DATA PESERTA PELATIHAN (JENIS KELAMIN) -->
                <div id="form-panel-2" class="form-panel space-y-4 hidden">
                    <div class="pb-2 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">2. Data Peserta Pelatihan (Jenis Kelamin)</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Input jumlah total peserta dan distribusi peserta laki-laki serta perempuan.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Jumlah Peserta Pelatihan <span class="text-red-500">*</span></label>
                            <input type="number" id="jumlah_peserta" required min="1" value="16" oninput="calculatePlacement()" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 bg-slate-50 font-extrabold text-slate-900 text-sm">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Laki-Laki <span class="text-red-500">*</span></label>
                            <input type="number" id="laki_laki" required min="0" value="9" oninput="validateGenderTotal()" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 bg-blue-50/50 font-bold text-blue-700">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Perempuan <span class="text-red-500">*</span></label>
                            <input type="number" id="perempuan" required min="0" value="7" oninput="validateGenderTotal()" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 bg-pink-50/50 font-bold text-pink-700">
                        </div>
                    </div>
                </div>

                <!-- TAB PANEL 3: DATA PENEMPATAN ALUMNI -->
                <div id="form-panel-3" class="form-panel space-y-4 hidden">
                    <div class="pb-2 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">3. Data Penempatan Alumni Pelatihan</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Rincian alumni yang bekerja, berwirausaha, dan sebaran wilayah penempatan.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 bg-blue-50/50 p-4 rounded-2xl border border-blue-100">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Ditempatkan / Bekerja</label>
                            <input type="number" id="ditempatkan" min="0" value="10" oninput="calculatePlacement()" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 bg-white font-bold text-blue-700">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Berwirausaha</label>
                            <input type="number" id="berwirausaha" min="0" value="4" oninput="calculatePlacement()" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 bg-white font-bold text-amber-700">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Tidak Ditempatkan</label>
                            <input type="number" id="tidak_ditempatkan" min="0" value="2" readonly class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-100 font-bold text-rose-600">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Total Penempatan (Bekerja + Berwirausaha)</label>
                            <input type="number" id="total_penempatan" readonly value="14" class="w-full px-3.5 py-2.5 rounded-xl border border-emerald-200 bg-emerald-50/60 font-extrabold text-emerald-800 text-sm">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Persentase Penempatan (%)</label>
                            <input type="text" id="persentase_penempatan" readonly value="87.5%" class="w-full px-3.5 py-2.5 rounded-xl border border-emerald-200 bg-emerald-50/60 font-extrabold text-emerald-800 text-sm">
                        </div>
                    </div>

                    <!-- LOKASI PENEMPATAN -->
                    <div class="space-y-3 pt-2">
                        <label class="block font-bold text-slate-800 uppercase tracking-wider text-[11px]">Distribusi Wilayah Penempatan:</label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block font-semibold text-slate-700 mb-1.5">Penempatan Dalam Kota Kendari</label>
                                <input type="number" id="penempatan_dalam_kota" min="0" value="10" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 bg-slate-50">
                            </div>
                            <div>
                                <label class="block font-semibold text-slate-700 mb-1.5">Luar Kota Kendari / Sultra</label>
                                <input type="number" id="penempatan_luar_kota_sultra" min="0" value="3" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 bg-slate-50">
                            </div>
                            <div>
                                <label class="block font-semibold text-slate-700 mb-1.5">Luar Sulawesi Tenggara</label>
                                <input type="number" id="penempatan_luar_sultra" min="0" value="1" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 bg-slate-50">
                            </div>
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
                        <a href="penempatan.php" class="px-4 py-2.5 rounded-xl font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                            Batal
                        </a>
                        <button type="button" id="next-tab-btn" onclick="stepFormTab(1)" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold transition flex items-center gap-1.5">
                            <span>Selanjutnya</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                        <button type="submit" id="submit-tab-btn" class="hidden inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold shadow-md hover:shadow-lg transition">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Simpan Data Pemberdayaan</span>
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-slate-200 py-6 text-center text-xs text-slate-500">
        &copy; 2026 SIMPEL BPVP Kendari &bull; Seksi Pemberdayaan & Kerjasama Alumni
    </footer>

    <script>
        let currentTab = 1;
        const totalTabs = 3;

        document.addEventListener('DOMContentLoaded', () => {
            // Sidebar rendered server-side by PHP
            calculatePlacement();
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
                        btn.className = 'tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-blue-600 text-white shadow-xs transition';
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

        function handleProgramChange(val) {
            if (!val) {
                document.getElementById('kejuruan').value = '';
                return;
            }
            const parts = val.split('|');
            document.getElementById('kejuruan').value = parts[1] || '';
            if (parts[3]) {
                document.getElementById('jumlah_peserta').value = parts[3];
                calculatePlacement();
            }
        }

        function validateGenderTotal() {
            const l = parseInt(document.getElementById('laki_laki').value) || 0;
            const p = parseInt(document.getElementById('perempuan').value) || 0;
            document.getElementById('jumlah_peserta').value = l + p;
            calculatePlacement();
        }

        function calculatePlacement() {
            const totalPeserta = parseInt(document.getElementById('jumlah_peserta').value) || 0;
            const bekerja = parseInt(document.getElementById('ditempatkan').value) || 0;
            const wirausaha = parseInt(document.getElementById('berwirausaha').value) || 0;
            
            const totalPenempatan = bekerja + wirausaha;
            document.getElementById('total_penempatan').value = totalPenempatan;

            const tidakDitempatkan = Math.max(0, totalPeserta - totalPenempatan);
            document.getElementById('tidak_ditempatkan').value = tidakDitempatkan;

            const persen = totalPeserta > 0 ? ((totalPenempatan / totalPeserta) * 100).toFixed(1) + '%' : '0.0%';
            document.getElementById('persentase_penempatan').value = persen;
        }

        function handleSave(e) {
            e.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Data Pemberdayaan Disimpan!',
                text: 'Data peserta dan penempatan alumni telah berhasil dicatat ke sistem.',
                confirmButtonColor: '#2563eb'
            }).then(() => {
                window.location.href = 'penempatan.php';
            });
        }

        function triggerModuleImport(moduleKey) {
            SimpelADK.openImportModal(moduleKey, (rows) => {
                if (rows && rows.length > 0) {
                    const r = rows[0];
                    if (r["Peserta Laki-laki"] !== undefined) document.getElementById('laki_laki').value = r["Peserta Laki-laki"];
                    if (r["Peserta Perempuan"] !== undefined) document.getElementById('perempuan').value = r["Peserta Perempuan"];
                    if (r["Nama Industri / Perusahaan Mitra"]) document.getElementById('nama_perusahaan').value = r["Nama Industri / Perusahaan Mitra"];
                    if (r["Sektor Usaha"]) document.getElementById('sektor_industri').value = r["Sektor Usaha"];
                    validateGenderTotal();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('adk-toolbar-container');
            if (container && typeof SimpelADK !== 'undefined') {
                container.innerHTML = SimpelADK.renderToolbarHTML('pemberdayaan', 'ADK Pemberdayaan: Template, Import & Export Peserta/Penempatan');
            }
        });
    </script>
</body>
</html>
