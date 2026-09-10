<?php
require_once __DIR__ . '/auth/auth_check.php';
requireRoleAccess(['admin', 'lsp']);
$activePage = 'input_lsp';
?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Pendaftaran & Hasil UJK LSP - SIMPEL BPVP Kendari 2026</title>

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
            <a href="sertifikasi.php" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-amber-600 transition">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Master Data LSP</span>
            </a>
            <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-bold">
                Modul LSP BPVP Kendari &bull; Registrasi Asesi & UJK
            </span>
        </div>

        <!-- ADK EXCEL TOOLBAR CONTAINER -->
        <div id="adk-toolbar-container"></div>

        <!-- FORM CARD -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
            
            <div class="p-6 bg-gradient-to-r from-slate-900 to-amber-900 text-white flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-amber-300 text-lg border border-white/20">
                        <i class="fa-solid fa-stamp"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold font-heading">Formulir Pendaftaran Asesi & Uji Kompetensi</h2>
                        <p class="text-xs text-slate-200">Lengkapi data asesi sesuai form standar BNSP LSP BPVP Kendari</p>
                    </div>
                </div>
                <a href="sertifikasi.php" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white text-xs font-medium border border-white/20 transition">
                    <i class="fa-solid fa-table-list"></i>
                    <span>Lihat Data Asesi</span>
                </a>
            </div>

            <form onsubmit="handleSave(event)" class="p-6 sm:p-8 text-xs">
                
                <!-- TAB NAVIGATION BAR -->
                <div class="flex items-center gap-2 border-b border-slate-200 pb-3 mb-6 overflow-x-auto">
                    <button type="button" onclick="switchFormTab(1)" id="tab-btn-1" class="tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-amber-600 text-white shadow-xs transition">
                        <span class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center text-[10px]">1</span>
                        <span>Skema & TUK</span>
                    </button>
                    <button type="button" onclick="switchFormTab(2)" id="tab-btn-2" class="tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                        <span class="w-5 h-5 rounded-full bg-slate-300 text-slate-700 flex items-center justify-center text-[10px]">2</span>
                        <span>Biodata Asesi</span>
                    </button>
                    <button type="button" onclick="switchFormTab(3)" id="tab-btn-3" class="tab-nav-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                        <span class="w-5 h-5 rounded-full bg-slate-300 text-slate-700 flex items-center justify-center text-[10px]">3</span>
                        <span>Verifikasi & UJK</span>
                    </button>
                </div>

                <!-- TAB PANEL 1: DATA SKEMA & PELAKSANAAN -->
                <div id="form-panel-1" class="form-panel space-y-4">
                    <div class="pb-2 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">1. Informasi Skema, TUK & Asesor</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Pilih skema sertifikasi BNSP, tempat uji kompetensi, dan asesor.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Skema Sertifikasi <span class="text-red-500">*</span></label>
                            <select id="skema" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-slate-50/50">
                                <option value="">-- Pilih Skema Sertifikasi --</option>
                                <option value="Junior Web Developer">Junior Web Developer</option>
                                <option value="Pengelasan SMAW 3G">Pengelasan SMAW 3G</option>
                                <option value="Teknisi Servis Sepeda Motor Injeksi">Teknisi Servis Sepeda Motor Injeksi</option>
                                <option value="Barista dan Tata Hidang Kopi">Barista dan Tata Hidang Kopi</option>
                                <option value="Desainer Grafis Muda">Desainer Grafis Muda</option>
                                <option value="Teknisi Refrigerasi Domestik">Teknisi Refrigerasi Domestik</option>
                                <option value="Commercial Cookery / Pengolahan Makanan">Commercial Cookery / Pengolahan Makanan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Tempat Uji Kompetensi (TUK) <span class="text-red-500">*</span></label>
                            <input type="text" id="tuk" required placeholder="Contoh: TUK Komputer BPVP Kendari" value="TUK BPVP Kendari" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 bg-slate-50/50">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Tahap UJK <span class="text-red-500">*</span></label>
                            <input type="text" id="tahap" required value="Tahap 1" placeholder="Tahap 1 / Tahap 2" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 bg-slate-50/50">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Tanggal Pendaftaran <span class="text-red-500">*</span></label>
                            <input type="date" id="tanggal_pendaftaran" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 bg-slate-50/50">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Nama Asesor Penguji</label>
                            <input type="text" id="asesor" placeholder="Contoh: Ir. Hendra Saputra, M.Kom" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 bg-slate-50/50">
                        </div>
                    </div>
                </div>

                <!-- TAB PANEL 2: BIODATA LENGKAP ASESI -->
                <div id="form-panel-2" class="form-panel space-y-4 hidden">
                    <div class="pb-2 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">2. Biodata Lengkap Asesi</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Identitas calon asesi peserta uji kompetensi keahlian.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Nama Lengkap Asesi <span class="text-red-500">*</span></label>
                            <input type="text" id="nama_lengkap" required placeholder="Nama lengkap sesuai KTP" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 bg-slate-50/50">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Nomor KTP (16 Digit) <span class="text-red-500">*</span></label>
                            <input type="text" id="nomor_ktp" required placeholder="7471xxxxxxxxxxxx" maxlength="16" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 bg-slate-50/50 font-mono">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" placeholder="Kota / Kabupaten Lahir" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Jenis Kelamin</label>
                            <select id="jenis_kelamin" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Alamat Rumah Lengkap</label>
                        <textarea id="alamat_rumah" rows="2" placeholder="Jl. ..., Kelurahan ..., Kecamatan ..., Kota / Kab ..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:ring-2 focus:ring-amber-500"></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Nomor Telepon / WA</label>
                            <input type="tel" id="nomor_telepon" placeholder="08xxxxxxxxxx" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 font-mono">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                            <input type="email" id="alamat_email" placeholder="nama@email.com" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Kualifikasi Pendidikan</label>
                            <select id="kualifikasi_pendidikan" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50">
                                <option value="SMA / SMK">SMA / SMK</option>
                                <option value="D3">D3</option>
                                <option value="S1/D4">S1 / D4</option>
                                <option value="SMP">SMP</option>
                                <option value="SD">SD</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Kebangsaan</label>
                            <input type="text" id="kebangsaan" value="WNI" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50">
                        </div>
                    </div>
                </div>

                <!-- TAB PANEL 3: HASIL ASESMEN & VERIFIKASI -->
                <div id="form-panel-3" class="form-panel space-y-4 hidden">
                    <div class="pb-2 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">3. Verifikasi Dokumen & Hasil UJK</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Status kelengkapan form APL dan rekomendasi kompetensi asesi.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Form APL 01 & 02</label>
                            <select id="form_apl" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 font-medium">
                                <option value="Lengkap">Lengkap & Terverifikasi</option>
                                <option value="Belum Lengkap">Belum Lengkap</option>
                                <option value="Menunggu Verifikasi">Menunggu Verifikasi</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Hasil UJK Asesor <span class="text-red-500">*</span></label>
                            <select id="hasil_ujk" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 bg-slate-50/50 font-bold text-emerald-800">
                                <option value="Kompeten">Kompeten (K)</option>
                                <option value="Belum Kompeten">Belum Kompeten (BK)</option>
                                <option value="Belum Uji">Belum Uji</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Cetak Sertifikat</label>
                            <select id="cetak_sertifikat" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 font-medium">
                                <option value="Sudah Dicetak">Sudah Dicetak</option>
                                <option value="Proses">Dalam Proses</option>
                                <option value="Belum">Belum Dicetak</option>
                            </select>
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
                        <a href="sertifikasi.php" class="px-4 py-2.5 rounded-xl font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                            Batal
                        </a>
                        <button type="button" id="next-tab-btn" onclick="stepFormTab(1)" class="px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold transition flex items-center gap-1.5">
                            <span>Selanjutnya</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                        <button type="submit" id="submit-tab-btn" class="hidden inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold shadow-md hover:shadow-lg transition">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Simpan Data Asesi & UJK</span>
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-slate-200 py-6 text-center text-xs text-slate-500">
        &copy; 2026 SIMPEL BPVP Kendari &bull; LSP BPVP Kendari
    </footer>

    <script>
        let currentTab = 1;
        const totalTabs = 3;

        document.addEventListener('DOMContentLoaded', () => {
            // Sidebar rendered server-side by PHP
            document.getElementById('tanggal_pendaftaran').value = new Date().toISOString().split('T')[0];
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

        function handleSave(e) {
            e.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Data Asesi Berhasil Disimpan!',
                text: 'Asesi ' + document.getElementById('nama_lengkap').value + ' telah terdaftar di LSP BPVP Kendari.',
                confirmButtonColor: '#d97706'
            }).then(() => {
                window.location.href = 'sertifikasi.php';
            });
        }

        function triggerModuleImport(moduleKey) {
            SimpelADK.openImportModal(moduleKey, (rows) => {
                if (rows && rows.length > 0) {
                    const r = rows[0];
                    if (r["Nama Asesor Kompetensi"]) document.getElementById('asesor_penugasan').value = r["Nama Asesor Kompetensi"];
                    if (r["Tanggal Uji Kompetensi"]) document.getElementById('jadwal_asesmen').value = r["Tanggal Uji Kompetensi"];
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('adk-toolbar-container');
            if (container && typeof SimpelADK !== 'undefined') {
                container.innerHTML = SimpelADK.renderToolbarHTML('lsp', 'ADK LSP: Template, Import & Export Sertifikasi / Asesi');
            }
        });
    </script>
</body>
</html>
