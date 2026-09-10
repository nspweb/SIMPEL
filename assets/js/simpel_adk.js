/**
 * SIMPEL BPVP Kendari - Sistem Pertukaran Data ADK (Arsip Data Komputer)
 * Modul terpadu untuk:
 * 1. Download Template Excel (.xlsx) dengan kolom resmi & contoh riil BPVP Kendari
 * 2. Import Excel/ADK dengan parsing instan SheetJS & pemetaan ke formulir
 * 3. Export Data tabel/formulir ke file Excel (.xlsx)
 */

const SimpelADK = (function () {
    // Definisi Template Resmi Tiap Modul
    const MODULE_SCHEMAS = {
        penyelenggara: {
            name: "Penyelenggara Pelatihan",
            filename: "Template_ADK_Penyelenggara_Pelatihan.xlsx",
            columns: [
                { key: "kejuruan", label: "Kejuruan", example: "Teknologi Informasi dan Komunikasi (TIK)" },
                { key: "jenis_pelatihan", label: "Jenis Skema Program", example: "PBK Reguler" },
                { key: "program_pelatihan", label: "Nama Program & Batch", example: "Junior Web Developer - Batch 2" },
                { key: "kuota_peserta", label: "Kuota Siswa", example: 16 },
                { key: "jam_pelatihan", label: "Jam Pelatihan (JP)", example: 340 },
                { key: "tanggal_mulai", label: "Tanggal Mulai (YYYY-MM-DD)", example: "2026-04-01" },
                { key: "tanggal_selesai", label: "Tanggal Selesai (YYYY-MM-DD)", example: "2026-05-20" },
                { key: "lokasi", label: "Lokasi Workshop", example: "Workshop Komputer BPVP Kendari" }
            ],
            sampleRows: [
                {
                    "Kejuruan": "Teknologi Informasi dan Komunikasi (TIK)",
                    "Jenis Skema Program": "PBK Reguler",
                    "Nama Program & Batch": "Junior Web Developer - Batch 2",
                    "Kuota Siswa": 16,
                    "Jam Pelatihan (JP)": 340,
                    "Tanggal Mulai (YYYY-MM-DD)": "2026-04-01",
                    "Tanggal Selesai (YYYY-MM-DD)": "2026-05-20",
                    "Lokasi Workshop": "Workshop Komputer BPVP Kendari"
                },
                {
                    "Kejuruan": "Teknik Otomotif",
                    "Jenis Skema Program": "PBK Reguler",
                    "Nama Program & Batch": "Service Sepeda Motor Injeksi - Batch 1",
                    "Kuota Siswa": 16,
                    "Jam Pelatihan (JP)": 280,
                    "Tanggal Mulai (YYYY-MM-DD)": "2026-04-10",
                    "Tanggal Selesai (YYYY-MM-DD)": "2026-05-25",
                    "Lokasi Workshop": "Workshop Otomotif Gedung B"
                }
            ]
        },

        pemberdayaan: {
            name: "Pemberdayaan & Penempatan Alumni",
            filename: "Template_ADK_Pemberdayaan_Peserta.xlsx",
            columns: [
                { key: "program_pelatihan", label: "Program Pelatihan", example: "Junior Web Developer - Batch 1" },
                { key: "pria", label: "Peserta Laki-laki", example: 10 },
                { key: "wanita", label: "Peserta Perempuan", example: 6 },
                { key: "status_penempatan", label: "Status Dominan", example: "Ditempatkan" },
                { key: "nama_perusahaan", label: "Nama Industri / Perusahaan Mitra", example: "PT Sultra Telematika Solusindo" },
                { key: "sektor_usaha", label: "Sektor Usaha", example: "Teknologi Informasi & Jasa" },
                { key: "gaji_rata", label: "Estimasi Range Gaji", example: "UMK (Rp 3.100.000 - Rp 4.500.000)" }
            ],
            sampleRows: [
                {
                    "Program Pelatihan": "Junior Web Developer - Batch 1",
                    "Peserta Laki-laki": 10,
                    "Peserta Perempuan": 6,
                    "Status Dominan": "Ditempatkan",
                    "Nama Industri / Perusahaan Mitra": "PT Sultra Telematika Solusindo",
                    "Sektor Usaha": "Teknologi Informasi & Jasa",
                    "Estimasi Range Gaji": "UMK (Rp 3.100.000 - Rp 4.500.000)"
                },
                {
                    "Program Pelatihan": "Plate Welder SMAW 3G - Batch 1",
                    "Peserta Laki-laki": 16,
                    "Peserta Perempuan": 0,
                    "Status Dominan": "Ditempatkan",
                    "Nama Industri / Perusahaan Mitra": "PT VDNI (Konawe Industrial Estate)",
                    "Sektor Usaha": "Pertambangan & Manufaktur",
                    "Estimasi Range Gaji": "> UMK (Rp 4.500.000 - Rp 6.000.000)"
                }
            ]
        },

        produktivitas: {
            name: "Bimbingan Produktivitas",
            filename: "Template_ADK_Produktivitas.xlsx",
            columns: [
                { key: "nama_program", label: "Nama Program Bimbingan", example: "Bimtek Penerapan 5S / 5R di Industri" },
                { key: "perusahaan", label: "Nama Perusahaan / UMKM Mitra", example: "CV Kendari Cipta Pangan" },
                { key: "sektor", label: "Sektor Usaha", example: "Pengolahan Makanan & Minuman" },
                { key: "jumlah_peserta", label: "Jumlah Peserta / Karyawan", example: 25 },
                { key: "tgl_mulai", label: "Tanggal Mulai", example: "2026-04-15" },
                { key: "tgl_selesai", label: "Tanggal Selesai", example: "2026-04-20" },
                { key: "target_output", label: "Target Peningkatan Produktivitas (%)", example: "15%" }
            ],
            sampleRows: [
                {
                    "Nama Program Bimbingan": "Bimtek Penerapan 5S / 5R di Industri",
                    "Nama Perusahaan / UMKM Mitra": "CV Kendari Cipta Pangan",
                    "Sektor Usaha": "Pengolahan Makanan & Minuman",
                    "Jumlah Peserta / Karyawan": 25,
                    "Tanggal Mulai": "2026-04-15",
                    "Tanggal Selesai": "2026-04-20",
                    "Target Peningkatan Produktivitas (%)": "15%"
                }
            ]
        },

        pelatihan_uptd: {
            name: "Pelatihan UPTD Binaan",
            filename: "Template_ADK_Pelatihan_UPTD.xlsx",
            columns: [
                { key: "nama_uptd", label: "Nama UPTD Balai Binaan", example: "UPTD BLK Kabupaten Konawe" },
                { key: "kejuruan", label: "Kejuruan", example: "Teknik Las Listrik (SMAW)" },
                { key: "paket", label: "Jumlah Paket", example: 2 },
                { key: "kuota_peserta", label: "Target Siswa", example: 32 },
                { key: "tgl_mulai", label: "Tanggal Mulai", example: "2026-05-02" },
                { key: "tgl_selesai", label: "Tanggal Selesai", example: "2026-06-12" },
                { key: "sumber_anggaran", label: "Sumber Anggaran", example: "Dekonsentrasi / DIPA BPVP" }
            ],
            sampleRows: [
                {
                    "Nama UPTD Balai Binaan": "UPTD BLK Kabupaten Konawe",
                    "Kejuruan": "Teknik Las Listrik (SMAW)",
                    "Jumlah Paket": 2,
                    "Target Siswa": 32,
                    "Tanggal Mulai": "2026-05-02",
                    "Tanggal Selesai": "2026-06-12",
                    "Sumber Anggaran": "Dekonsentrasi / DIPA BPVP"
                }
            ]
        },

        lsp: {
            name: "Uji Kompetensi & Asesmen LSP",
            filename: "Template_ADK_Sertifikasi_LSP.xlsx",
            columns: [
                { key: "skema", label: "Skema Sertifikasi BNSP", example: "Junior Web Programmer" },
                { key: "kejuruan", label: "Kejuruan", example: "TIK" },
                { key: "tgl_asesmen", label: "Tanggal Uji Kompetensi", example: "2026-05-22" },
                { key: "nama_asesor", label: "Nama Asesor Kompetensi", example: "Bambang Suhartono, S.Kom, M.T" },
                { key: "peserta_terdaftar", label: "Peserta Terdaftar", example: 16 },
                { key: "rekomendasi_k", label: "Kompeten (K)", example: 15 },
                { key: "rekomendasi_bk", label: "Belum Kompeten (BK)", example: 1 }
            ],
            sampleRows: [
                {
                    "Skema Sertifikasi BNSP": "Junior Web Programmer",
                    "Kejuruan": "TIK",
                    "Tanggal Uji Kompetensi": "2026-05-22",
                    "Nama Asesor Kompetensi": "Bambang Suhartono, S.Kom, M.T",
                    "Peserta Terdaftar": 16,
                    "Kompeten (K)": 15,
                    "Belum Kompeten (BK)": 1
                }
            ]
        },

        pengadaan: {
            name: "Pokja Pengadaan & Kontrak",
            filename: "Template_ADK_Pokja_Pengadaan.xlsx",
            columns: [
                { key: "no_spk", label: "Nomor SPK / Nota", example: "SPK.04/BPVP-KDI/PL.02/IV/2026" },
                { key: "paket_pengadaan", label: "Nama Paket Pengadaan", example: "Pengadaan Bahan Praktek Kejuruan TIK Batch 2" },
                { key: "perusahaan", label: "Penyedia / Rekanan", example: "CV Mega Pratama Jaya" },
                { key: "nilai_kontrak", label: "Nilai Kontrak (Rp)", example: 48500000 },
                { key: "tgl_kontrak", label: "Tanggal SPK", example: "2026-04-05" },
                { key: "waktu_pelaksanaan", label: "Jangka Waktu (Hari)", example: "30 Hari Kalender" }
            ],
            sampleRows: [
                {
                    "Nomor SPK / Nota": "SPK.04/BPVP-KDI/PL.02/IV/2026",
                    "Nama Paket Pengadaan": "Pengadaan Bahan Praktek Kejuruan TIK Batch 2",
                    "Penyedia / Rekanan": "CV Mega Pratama Jaya",
                    "Nilai Kontrak (Rp)": 48500000,
                    "Tanggal SPK": "2026-04-05",
                    "Jangka Waktu (Hari)": "30 Hari Kalender"
                }
            ]
        },

        perjalanan_dinas: {
            name: "Perjalanan Dinas (SPD) Pimpinan & Pegawai",
            filename: "Template_ADK_Perjalanan_Dinas_SPD.xlsx",
            columns: [
                { key: "no_surat_tugas", label: "Nomor Surat Tugas", example: "ST.018/BPVP-KDI/TU/IV/2026" },
                { key: "nama_pejabat", label: "Nama yang Ditugaskan", example: "La Ode Haji Polingai, S.E., M.M." },
                { key: "jabatan", label: "Jabatan", example: "Kepala BPVP Kendari" },
                { key: "maksud_tugas", label: "Maksud Penugasan / Agenda", example: "Rapat Koordinasi Nasional Pelatihan Vokasi & Kemitraan Industri Tahun 2026" },
                { key: "kota_asal", label: "Kota Keberangkatan", example: "Kendari" },
                { key: "kota_tujuan", label: "Kota Tujuan", example: "Jakarta (Kementerian Ketenagakerjaan RI)" },
                { key: "tgl_berangkat", label: "Tanggal Berangkat", example: "2026-04-12" },
                { key: "tgl_kembali", label: "Tanggal Kembali", example: "2026-04-15" },
                { key: "lama_hari", label: "Lama Hari", example: 4 },
                { key: "beban_anggaran", label: "Beban Anggaran", example: "DIPA BPVP Kendari TA 2026" },
                { key: "total_biaya", label: "Estimasi Biaya SPD (Rp)", example: 14850000 },
                { key: "status", label: "Status Perjalanan", example: "Terjadwal" }
            ],
            sampleRows: [
                {
                    "Nomor Surat Tugas": "ST.018/BPVP-KDI/TU/IV/2026",
                    "Nama yang Ditugaskan": "La Ode Haji Polingai, S.E., M.M.",
                    "Jabatan": "Kepala BPVP Kendari",
                    "Maksud Penugasan / Agenda": "Rapat Koordinasi Nasional Pelatihan Vokasi & Kemitraan Industri Tahun 2026",
                    "Kota Keberangkatan": "Kendari",
                    "Kota Tujuan": "Jakarta (Kementerian Ketenagakerjaan RI)",
                    "Tanggal Berangkat": "2026-04-12",
                    "Tanggal Kembali": "2026-04-15",
                    "Lama Hari": 4,
                    "Beban Anggaran": "DIPA BPVP Kendari TA 2026",
                    "Estimasi Biaya SPD (Rp)": 14850000,
                    "Status Perjalanan": "Terjadwal"
                },
                {
                    "Nomor Surat Tugas": "ST.019/BPVP-KDI/TU/IV/2026",
                    "Nama yang Ditugaskan": "Drs. Ahmad Yani, M.Si",
                    "Jabatan": "Subkoordinator Tata Usaha",
                    "Maksud Penugasan / Agenda": "Supervisi dan Koordinasi Program Pelatihan Bersama UPTD BLK Konawe",
                    "Kota Keberangkatan": "Kendari",
                    "Kota Tujuan": "Kabupaten Konawe",
                    "Tanggal Berangkat": "2026-04-20",
                    "Tanggal Kembali": "2026-04-21",
                    "Lama Hari": 2,
                    "Beban Anggaran": "DIPA BPVP Kendari TA 2026",
                    "Estimasi Biaya SPD (Rp)": 2300000,
                    "Status Perjalanan": "Terjadwal"
                }
            ]
        }
    };

    /**
     * Memastikan library SheetJS XLSX sudah termuat, jika belum panggil dinamis
     */
    function ensureXLSX(callback) {
        if (typeof XLSX !== 'undefined') {
            callback();
            return;
        }
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js';
        script.onload = () => callback();
        script.onerror = () => {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Memuat SheetJS',
                    text: 'Koneksi internet diperlukan untuk memuat engine Excel ADK pertama kali.',
                    confirmButtonColor: '#0F172A'
                });
            } else {
                alert('Gagal memuat engine Excel ADK.');
            }
        };
        document.head.appendChild(script);
    }

    /**
     * 1. DOWNLOAD TEMPLATE EXCEL (.xlsx) RESMI
     */
    function downloadCSV(dataList, filename) {
        if (!dataList || !dataList.length) return;
        const headers = Object.keys(dataList[0]);
        let csv = headers.join(';') + '\n';
        dataList.forEach(row => {
            csv += headers.map(h => `"${String(row[h] ?? '').replace(/"/g, '""')}"`).join(';') + '\n';
        });
        const blob = new Blob(["\ufeff" + csv], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = filename;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    /**
     * 1. DOWNLOAD TEMPLATE EXCEL (.xlsx) RESMI
     */
    function downloadTemplate(moduleKey) {
        const schema = MODULE_SCHEMAS[moduleKey];
        if (!schema) {
            console.error("Module ADK schema not found: ", moduleKey);
            return;
        }

        ensureXLSX(() => {
            try {
                if (typeof XLSX !== 'undefined') {
                    const ws = XLSX.utils.json_to_sheet(schema.sampleRows);
                    const colWidths = Object.keys(schema.sampleRows[0]).map(key => ({
                        wch: Math.max(key.length, 20)
                    }));
                    ws['!cols'] = colWidths;

                    const wb = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(wb, ws, "ADK_" + moduleKey.toUpperCase());
                    XLSX.writeFile(wb, schema.filename);
                } else {
                    downloadCSV(schema.sampleRows, schema.filename.replace('.xlsx', '.csv'));
                }

                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Template Berhasil Diunduh!',
                        html: `<p class="text-xs text-slate-600">File <strong>${schema.filename}</strong> siap dibuka di Microsoft Excel. Silakan isi data mengikuti kolom contoh yang telah disediakan.</p>`,
                        confirmButtonColor: '#10B981',
                        confirmButtonText: 'Bagus, Mengerti'
                    });
                }
            } catch (e) {
                downloadCSV(schema.sampleRows, schema.filename.replace('.xlsx', '.csv'));
            }
        });
    }

    /**
     * 2. EXPORT DATA KE EXCEL RESMI
     */
    function exportData(moduleKey, dataList, customFilename) {
        const schema = MODULE_SCHEMAS[moduleKey] || { name: 'Data SIMPEL', filename: `Export_SIMPEL_${Date.now()}.xlsx` };
        
        if (!dataList || dataList.length === 0) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'info',
                    title: 'Belum Ada Data',
                    text: 'Tidak ada baris data untuk diekspor ke Excel.',
                    confirmButtonColor: '#0F172A'
                });
            }
            return;
        }

        const fname = customFilename || `ADK_Export_${moduleKey}_${new Date().toISOString().slice(0, 10)}.xlsx`;

        ensureXLSX(() => {
            try {
                if (typeof XLSX !== 'undefined') {
                    const ws = XLSX.utils.json_to_sheet(dataList);
                    const wb = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(wb, ws, "DATA_ADK");
                    XLSX.writeFile(wb, fname);
                } else {
                    downloadCSV(dataList, fname.replace('.xlsx', '.csv'));
                }

                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Ekspor Berhasil!',
                        text: `Data telah disimpan dalam file ${fname}`,
                        confirmButtonColor: '#10B981'
                    });
                }
            } catch (e) {
                downloadCSV(dataList, fname.replace('.xlsx', '.csv'));
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Ekspor Berhasil (CSV)!',
                        text: `Data telah disimpan dalam file ${fname.replace('.xlsx', '.csv')}`,
                        confirmButtonColor: '#10B981'
                    });
                }
            }
        });
    }

    /**
     * 3. DIALOG IMPORT EXCEL / ADK
     */
    function openImportModal(moduleKey, onDataLoaded) {
        const schema = MODULE_SCHEMAS[moduleKey];
        if (!schema) return;

        const modalId = 'simpel-adk-modal';
        let modalEl = document.getElementById(modalId);
        if (modalEl) modalEl.remove();

        const modalHtml = `
            <div id="${modalId}" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-xs">
                <div class="bg-white rounded-3xl border border-slate-200 shadow-2xl max-w-2xl w-full overflow-hidden animate-in fade-in zoom-in duration-150">
                    
                    <!-- MODAL HEADER -->
                    <div class="px-6 py-5 bg-gradient-to-r from-slate-900 to-emerald-950 text-white flex items-center justify-between border-b border-slate-800">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center font-bold text-lg">
                                <i class="fa-solid fa-file-excel"></i>
                            </div>
                            <div>
                                <h3 class="font-extrabold text-sm sm:text-base font-heading">Import Excel (Sistem ADK)</h3>
                                <p class="text-[11px] text-emerald-300/90 font-medium">Modul: ${schema.name}</p>
                            </div>
                        </div>
                        <button onclick="document.getElementById('${modalId}').remove()" class="w-8 h-8 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 flex items-center justify-center transition">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <!-- MODAL BODY -->
                    <div class="p-6 space-y-4">
                        
                        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200/80 flex items-start gap-3">
                            <i class="fa-solid fa-circle-info text-emerald-700 text-sm mt-0.5"></i>
                            <div class="text-xs text-emerald-900 leading-relaxed">
                                Pastikan file Anda menggunakan format template resmi ADK agar nama kolom cocok dengan sistem.
                                Belum punya templatenya? 
                                <button type="button" onclick="SimpelADK.downloadTemplate('${moduleKey}')" class="font-bold text-emerald-700 underline hover:text-emerald-900 cursor-pointer">
                                    Unduh Template Excel di Sini
                                </button>.
                            </div>
                        </div>

                        <!-- DROPZONE -->
                        <div id="adk-dropzone" 
                             onclick="document.getElementById('adk-file-input').click()"
                             ondragover="event.preventDefault(); this.classList.add('border-emerald-500', 'bg-emerald-50/50')"
                             ondragleave="this.classList.remove('border-emerald-500', 'bg-emerald-50/50')"
                             ondrop="handleDrop(event)"
                             class="border-2 border-dashed border-slate-300 rounded-2xl p-8 text-center cursor-pointer hover:border-emerald-500 hover:bg-emerald-50/30 transition flex flex-col items-center justify-center gap-2">
                            <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-500 flex items-center justify-center text-2xl mb-1 shadow-inner">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-800">Klik untuk pilih file Excel / ADK, atau seret ke sini</span>
                            <span class="text-[10px] text-slate-500">Mendukung format .xlsx, .xls, atau .csv standar</span>
                            <input type="file" id="adk-file-input" accept=".xlsx, .xls, .csv" class="hidden" onchange="handleFileSelect(event)">
                        </div>

                        <!-- PREVIEW CONTAINER -->
                        <div id="adk-preview-area" class="hidden space-y-2">
                            <div class="flex items-center justify-between text-xs font-bold text-slate-700">
                                <span id="adk-preview-count">0 Data Terdeteksi</span>
                                <span class="text-[10px] text-emerald-600 font-semibold"><i class="fa-solid fa-check"></i> Siap Dimuat</span>
                            </div>
                            <div class="max-h-48 overflow-y-auto rounded-xl border border-slate-200 text-[11px]">
                                <table class="w-full text-left border-collapse" id="adk-preview-table">
                                    <!-- Dynamic rows -->
                                </table>
                            </div>
                        </div>

                    </div>

                    <!-- MODAL FOOTER -->
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex items-center justify-end gap-2.5">
                        <button type="button" onclick="document.getElementById('${modalId}').remove()" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-200 transition">
                            Batal
                        </button>
                        <button type="button" id="btn-apply-adk" disabled onclick="applyADKData()" class="px-5 py-2 rounded-xl text-xs font-bold bg-emerald-600 hover:bg-emerald-700 text-white disabled:opacity-50 disabled:cursor-not-allowed transition shadow-xs flex items-center gap-2">
                            <i class="fa-solid fa-file-import"></i>
                            <span>Terapkan Data ke Form</span>
                        </button>
                    </div>

                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalHtml);

        let parsedRowsData = [];

        window.handleDrop = function (e) {
            e.preventDefault();
            const dt = e.dataTransfer;
            if (dt && dt.files && dt.files.length) {
                processFile(dt.files[0]);
            }
        };

        window.handleFileSelect = function (e) {
            if (e.target.files && e.target.files.length) {
                processFile(e.target.files[0]);
            }
        };

        function processFile(file) {
            ensureXLSX(() => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    try {
                        const data = new Uint8Array(e.target.result);
                        const workbook = XLSX.read(data, { type: 'array' });
                        const firstSheetName = workbook.SheetNames[0];
                        const worksheet = workbook.Sheets[firstSheetName];
                        const json = XLSX.utils.sheet_to_json(worksheet);

                        if (!json || json.length === 0) {
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'File Kosong',
                                    text: 'Tidak ada baris data yang ditemukan di sheet pertama.',
                                    confirmButtonColor: '#0F172A'
                                });
                            }
                            return;
                        }

                        parsedRowsData = json;
                        renderPreview(json);
                    } catch (err) {
                        console.error(err);
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Format Tidak Valid',
                                text: 'Gagal membaca file Excel. Pastikan file tidak rusak.',
                                confirmButtonColor: '#0F172A'
                            });
                        }
                    }
                };
                reader.readAsArrayBuffer(file);
            });
        }

        function renderPreview(rows) {
            const previewArea = document.getElementById('adk-preview-area');
            const previewCount = document.getElementById('adk-preview-count');
            const previewTable = document.getElementById('adk-preview-table');
            const applyBtn = document.getElementById('btn-apply-adk');

            previewArea.classList.remove('hidden');
            previewCount.textContent = `${rows.length} Baris Data Ditemukan`;
            applyBtn.removeAttribute('disabled');

            // Render table header & first 5 rows
            const headers = Object.keys(rows[0] || {});
            let theadHtml = `<thead class="bg-slate-100 text-slate-700 font-bold sticky top-0"><tr>`;
            headers.slice(0, 5).forEach(h => theadHtml += `<th class="p-2 border-b border-slate-200">${h}</th>`);
            theadHtml += `</tr></thead>`;

            let tbodyHtml = `<tbody class="divide-y divide-slate-100 bg-white">`;
            rows.slice(0, 5).forEach(r => {
                tbodyHtml += `<tr>`;
                headers.slice(0, 5).forEach(h => {
                    tbodyHtml += `<td class="p-2 truncate max-w-[150px] text-slate-600">${r[h] ?? ''}</td>`;
                });
                tbodyHtml += `</tr>`;
            });
            tbodyHtml += `</tbody>`;

            previewTable.innerHTML = theadHtml + tbodyHtml;
        }

        window.applyADKData = function () {
            if (typeof onDataLoaded === 'function') {
                onDataLoaded(parsedRowsData);
            }
            const el = document.getElementById(modalId);
            if (el) el.remove();
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'success',
                    title: 'Data ADK Berhasil Dimuat!',
                    text: `${parsedRowsData.length} baris data berhasil disinkronkan ke formulir.`,
                    timer: 2200,
                    showConfirmButton: false
                });
            }
        };
    }

    /**
     * Generator data ekspor cerdas berdasarkan modul & dataset SIMPEL
     */
    function getDefaultExportRows(moduleKey) {
        if (typeof window.getModuleExportRows === 'function') {
            const custom = window.getModuleExportRows(moduleKey);
            if (custom && custom.length) return custom;
        }

        const programs = (typeof SIMPEL_DATA !== 'undefined' && SIMPEL_DATA.programs) ? SIMPEL_DATA.programs : [];

        switch (moduleKey) {
            case 'penyelenggara':
                if (programs.length) {
                    return programs.map(p => ({
                        "Kejuruan": p.kejuruan,
                        "Jenis Skema Program": p.jenis,
                        "Nama Program & Batch": `${p.program} - ${p.batch}`,
                        "Kuota Siswa": p.target,
                        "Jam Pelatihan (JP)": 280,
                        "Tanggal Mulai (YYYY-MM-DD)": p.tgl_mulai,
                        "Tanggal Selesai (YYYY-MM-DD)": p.tgl_selesai,
                        "Lokasi Workshop": "Workshop BPVP Kendari"
                    }));
                }
                return MODULE_SCHEMAS.penyelenggara.sampleRows;

            case 'pemberdayaan':
                if (programs.length) {
                    return programs.map(p => ({
                        "Program Pelatihan": `${p.program} - ${p.batch}`,
                        "Peserta Laki-laki": p.laki,
                        "Peserta Perempuan": p.perempuan,
                        "Status Dominan": p.penempatan_bekerja > 0 ? "Ditempatkan" : "Proses",
                        "Nama Industri / Perusahaan Mitra": "PT Sultra Telematika Solusindo",
                        "Sektor Usaha": p.kejuruan,
                        "Estimasi Range Gaji": "UMK (Rp 3.100.000 - Rp 4.500.000)"
                    }));
                }
                return MODULE_SCHEMAS.pemberdayaan.sampleRows;

            case 'produktivitas':
                return MODULE_SCHEMAS.produktivitas.sampleRows;

            case 'pelatihan_uptd':
                return MODULE_SCHEMAS.pelatihan_uptd.sampleRows;

            case 'lsp':
                if (programs.length) {
                    return programs.map(p => ({
                        "Skema Sertifikasi BNSP": p.program,
                        "Kejuruan": p.kejuruan,
                        "Tanggal Uji Kompetensi": p.tgl_selesai,
                        "Nama Asesor Kompetensi": "Asesor Lisensi BNSP BPVP Kendari",
                        "Peserta Terdaftar": p.peserta,
                        "Kompeten (K)": p.lulus,
                        "Belum Kompeten (BK)": p.tidak_lulus
                    }));
                }
                return MODULE_SCHEMAS.lsp.sampleRows;

            case 'pengadaan':
                try {
                    const stored = localStorage.getItem('simpel_spk_data');
                    if (stored) {
                        const parsed = JSON.parse(stored);
                        if (parsed && parsed.length) {
                            return parsed.map(s => ({
                                "Nomor SPK / Nota": s.no_spk,
                                "Nama Paket Pengadaan": s.paket_pengadaan,
                                "Penyedia / Rekanan": s.nama_perusahaan,
                                "Nilai Kontrak (Rp)": s.nilai_kontrak,
                                "Tanggal SPK": s.tgl_spk,
                                "Jangka Waktu (Hari)": s.waktu_pelaksanaan
                            }));
                        }
                    }
                } catch (e) {}
                return MODULE_SCHEMAS.pengadaan.sampleRows;

            case 'perjalanan_dinas':
                return MODULE_SCHEMAS.perjalanan_dinas.sampleRows;

            default:
                return (MODULE_SCHEMAS[moduleKey] && MODULE_SCHEMAS[moduleKey].sampleRows) || [];
        }
    }

    /**
     * Handler pemicu ekspor modul
     */
    function triggerModuleExport(moduleKey) {
        const rows = getDefaultExportRows(moduleKey);
        const schema = MODULE_SCHEMAS[moduleKey] || { name: moduleKey };
        const cleanName = schema.name.replace(/[^a-zA-Z0-9]/g, '_');
        const fname = `Data_SIMPEL_${cleanName}_${new Date().toISOString().slice(0, 10)}.xlsx`;
        exportData(moduleKey, rows, fname);
    }

    // Expose global jika halaman belum mendefinisikannya
    if (typeof window.triggerModuleExport === 'undefined') {
        window.triggerModuleExport = triggerModuleExport;
    }

    /**
     * Komponen Toolbar HTML seragam untuk setiap halaman input:
     * 1. Unduh Template (.xlsx)
     * 2. Import ADK Excel (.xlsx / .csv)
     * 3. Export Data (.xlsx)
     */
    function renderToolbarHTML(moduleKey, customTitle) {
        return `
            <div class="bg-gradient-to-r from-emerald-950 via-[#0a3324] to-slate-950 rounded-2xl p-4 sm:p-5 text-white shadow-md border border-emerald-800/60 flex flex-col lg:flex-row lg:items-center justify-between gap-4 my-4">
                <div class="flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-emerald-300 font-extrabold shrink-0 shadow-inner text-xl">
                        <i class="fa-solid fa-file-excel"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/30 text-emerald-200 text-[10px] font-extrabold uppercase tracking-wider border border-emerald-500/40">Sistem ADK Excel</span>
                            <h3 class="font-extrabold text-xs sm:text-sm text-white">${customTitle || 'Pertukaran Data Excel (ADK)'}</h3>
                        </div>
                        <p class="text-[11px] text-emerald-200/90 mt-0.5">
                            Unduh template resmi, import file spreadsheet otomatis ke formulir, dan ekspor data aktif ke format Microsoft Excel.
                        </p>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-2 shrink-0">
                    <button type="button" onclick="SimpelADK.downloadTemplate('${moduleKey}')" class="px-3.5 py-2 rounded-xl bg-white/15 hover:bg-white/25 text-white font-bold text-xs border border-white/20 transition flex items-center gap-1.5 shadow-xs cursor-pointer" title="Unduh template kolom kosong dengan contoh isian">
                        <i class="fa-solid fa-download text-emerald-300 text-xs"></i>
                        <span>Unduh Template (.xlsx)</span>
                    </button>
                    <button type="button" onclick="triggerModuleImport('${moduleKey}')" class="px-3.5 py-2 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-extrabold text-xs shadow-md shadow-emerald-950/30 transition flex items-center gap-1.5 cursor-pointer" title="Import data dari file Excel / CSV ke formulir ini">
                        <i class="fa-solid fa-file-import text-xs"></i>
                        <span>Import Data ADK</span>
                    </button>
                    <button type="button" onclick="triggerModuleExport('${moduleKey}')" class="px-3.5 py-2 rounded-xl bg-teal-700 hover:bg-teal-600 text-white font-extrabold text-xs border border-teal-500/40 transition flex items-center gap-1.5 shadow-xs cursor-pointer" title="Ekspor rekap data modul ini ke file Excel">
                        <i class="fa-solid fa-file-export text-teal-200 text-xs"></i>
                        <span>Export Data (.xlsx)</span>
                    </button>
                </div>
            </div>
        `;
    }

    return {
        downloadTemplate,
        exportData,
        openImportModal,
        renderToolbarHTML,
        getDefaultExportRows,
        triggerModuleExport,
        schemas: MODULE_SCHEMAS
    };
})();
