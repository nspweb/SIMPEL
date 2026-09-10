/**
 * SIMPEL BPVP Kendari - Core Role, Navigation & Inter-Department Workflow Engine
 * 9 Roles:
 * 1. Admin (Super Admin & Flow Orchestrator across 8 roles)
 * 2. Pimpinan (Executive Dashboard per Batch, detail logistik/baju/uang saku, status bayar keuangan, realisasi DIPA, charts)
 * 3. Penyelenggara (Proposal Program: TMT, PBK Reguler, PBL, handover ke Pemberdayaan, jadwal kelas)
 * 4. Pemberdayaan (Data Peserta BNBA: umur, gender, pendidikan, lalu data Penempatan alumni bekerja/wirausaha)
 * 5. LSP (Lembaga Sertifikasi Profesi BPVP Kendari / BNSP: skema, asesi, TUK, asesor, UJK, cetak sertifikat)
 * 6. Produktivitas (Bimbingan & Konsultasi Produktivitas Industri / UMKM)
 * 7. Pengadaan / Pokja (Logistik bahan, baju pelatihan, modul, APD per program TMT/PBK/PBL)
 * 8. Umum / TU (Koordinasi Pelatihan UPTD 5 BLK Binaan & Administrasi Balai)
 * 9. Keuangan (Pembayaran uang saku, honor instruktur, bahan, SP2D, verifikasi bayar per program)
 */

const SIMPEL_USERS = {
    'admin@bpvpkendari.go.id': {
        name: 'Administrator SIMPEL',
        email: 'admin@bpvpkendari.go.id',
        role: 'admin',
        roleLabel: 'Super Admin (Portal)',
        dept: 'Pengelola Sistem Informasi & Integrasi Data',
        badgeColor: 'bg-rose-500',
        homePage: 'portal.html',
        permissions: ['*']
    },
    'pimpinan@bpvpkendari.go.id': {
        name: 'Kepala BPVP Kendari',
        email: 'pimpinan@bpvpkendari.go.id',
        role: 'pimpinan',
        roleLabel: 'Pimpinan Balai',
        dept: 'Pimpinan & Pengambil Kebijakan',
        badgeColor: 'bg-purple-600',
        homePage: 'dashboard.html',
        permissions: ['dashboard', 'detail_pengadaan']
    },
    'penyelenggara@bpvpkendari.go.id': {
        name: 'Seksi Penyelenggara Pelatihan',
        email: 'penyelenggara@bpvpkendari.go.id',
        role: 'penyelenggara',
        roleLabel: 'Penyelenggara Pelatihan',
        dept: 'Seksi Penyelenggaraan Pelatihan Vokasi (UPTP)',
        badgeColor: 'bg-teal-600',
        homePage: 'pelatihan.html',
        permissions: ['pelatihan', 'input_penyelenggara', 'input']
    },
    'pemberdayaan@bpvpkendari.go.id': {
        name: 'Seksi Pemberdayaan & Peserta',
        email: 'pemberdayaan@bpvpkendari.go.id',
        role: 'pemberdayaan',
        roleLabel: 'Pemberdayaan Peserta',
        dept: 'Seksi Pemberdayaan & Kerjasama Alumni (UPTP)',
        badgeColor: 'bg-blue-600',
        homePage: 'penempatan.html',
        permissions: ['penempatan', 'input_pemberdayaan', 'input']
    },
    'lsp@bpvpkendari.go.id': {
        name: 'LSP BPVP Kendari',
        email: 'lsp@bpvpkendari.go.id',
        role: 'lsp',
        roleLabel: 'LSP BPVP Kendari',
        dept: 'Lembaga Sertifikasi Profesi (BNSP)',
        badgeColor: 'bg-amber-500',
        homePage: 'sertifikasi.html',
        permissions: ['sertifikasi', 'input_lsp', 'input']
    },
    'produktivitas@bpvpkendari.go.id': {
        name: 'Instruktur & Konsultan Produktivitas',
        email: 'produktivitas@bpvpkendari.go.id',
        role: 'produktivitas',
        roleLabel: 'Produktivitas Industri',
        dept: 'Seksi Peningkatan Produktivitas',
        badgeColor: 'bg-emerald-600',
        homePage: 'produktivitas.html',
        permissions: ['produktivitas', 'input_produktivitas', 'input']
    },
    'pengadaan@bpvpkendari.go.id': {
        name: 'Pokja / Pengadaan Barang & Jasa',
        email: 'pengadaan@bpvpkendari.go.id',
        role: 'pengadaan',
        roleLabel: 'Pengadaan / Pokja',
        dept: 'Pokja Pengadaan Bahan & Alat Pelatihan',
        badgeColor: 'bg-indigo-600',
        homePage: 'pengadaan.html',
        permissions: ['pengadaan', 'detail_pengadaan', 'input_umum', 'input']
    },
    'umum@bpvpkendari.go.id': {
        name: 'Subbag Umum & Tata Usaha',
        email: 'umum@bpvpkendari.go.id',
        role: 'umum',
        roleLabel: 'Umum & TU (UPTD)',
        dept: 'Subbag Tata Usaha & UPTD Binaan',
        badgeColor: 'bg-slate-700',
        homePage: 'pelatihan_uptd.html',
        permissions: ['pelatihan_uptd', 'input_pelatihan_uptd', 'input']
    },
    'keuangan@bpvpkendari.go.id': {
        name: 'Verifikator & Bendahara Keuangan',
        email: 'keuangan@bpvpkendari.go.id',
        role: 'keuangan',
        roleLabel: 'Keuangan & SP2D',
        dept: 'Urusan Keuangan & Perbendaharaan',
        badgeColor: 'bg-emerald-700',
        homePage: 'keuangan.html',
        permissions: ['keuangan', 'input_umum', 'input']
    }
};

// Global Master Workflow Dataset (End-to-End Inter-Department Flow)
const SIMPEL_DATA = {
    programs: [
        {
            id: 1,
            batch: 'Batch 1',
            kejuruan: 'Teknologi Informasi dan Komunikasi (TIK)',
            program: 'Junior Web Developer',
            jenis: 'PBK Reguler',
            target: 16,
            peserta: 16,
            laki: 9,
            perempuan: 7,
            tgl_masuk: '2026-01-15',
            tgl_mulai: '2026-02-02',
            tgl_selesai: '2026-03-20',
            lulus: 16,
            tidak_lulus: 0,
            tahap_flow: 'Selesai & Terserap',
            status_proposal: 'Disetujui',
            status_peserta: 'Lengkap (BNBA Terverifikasi)',
            pengadaan_baju: 'Sudah Diterima (Seragam Praktek & Kaos)',
            pengadaan_modul: 'Lengkap (Buku Ajar & Modul SKKNI)',
            pengadaan_bahan: 'Siap (Flashdisk 64GB, Server Lab, LAN Cable)',
            pengadaan_uang_saku: 'Tersedia Sesuai SBM',
            status_keuangan: 'Lunas Dicairkan (SP2D Terbit)',
            nilai_keuangan: 24500000,
            sp2d_no: 'SP2D-0042/BPVP/2026',
            tgl_bayar: '2026-03-25',
            hasil_ujk: '16 Kompeten',
            status_sertifikat: 'Tercetak 100%',
            penempatan_bekerja: 12,
            penempatan_wirausaha: 3
        },
        {
            id: 2,
            batch: 'Batch 1',
            kejuruan: 'Teknik Manufaktur dan Rekayasa (Las)',
            program: 'Plate Welder SMAW 3G UP',
            jenis: 'PBK Reguler',
            target: 16,
            peserta: 16,
            laki: 16,
            perempuan: 0,
            tgl_masuk: '2026-01-20',
            tgl_mulai: '2026-02-05',
            tgl_selesai: '2026-03-28',
            lulus: 15,
            tidak_lulus: 1,
            tahap_flow: 'Selesai & Terserap',
            status_proposal: 'Disetujui',
            status_peserta: 'Lengkap (BNBA Terverifikasi)',
            pengadaan_baju: 'Sudah Diterima (Wearpack Las & Apron Kulit)',
            pengadaan_modul: 'Lengkap (SOP Las SMAW & K3 Fabrikasi)',
            pengadaan_bahan: 'Siap (Elektroda E7018, Plat Baja 10mm, Gas Argon)',
            pengadaan_uang_saku: 'Tersedia Sesuai SBM',
            status_keuangan: 'Lunas Dicairkan (SP2D Terbit)',
            nilai_keuangan: 38200000,
            sp2d_no: 'SP2D-0045/BPVP/2026',
            tgl_bayar: '2026-04-02',
            hasil_ujk: '15 Kompeten, 1 BK',
            status_sertifikat: 'Tercetak 100%',
            penempatan_bekerja: 14,
            penempatan_wirausaha: 1
        },
        {
            id: 3,
            batch: 'Batch 1',
            kejuruan: 'Teknik Otomotif',
            program: 'Teknisi Servis Sepeda Motor Injeksi',
            jenis: 'PBK Reguler',
            target: 16,
            peserta: 16,
            laki: 15,
            perempuan: 1,
            tgl_masuk: '2026-02-01',
            tgl_mulai: '2026-02-15',
            tgl_selesai: '2026-04-10',
            lulus: 16,
            tidak_lulus: 0,
            tahap_flow: 'Selesai & Terserap',
            status_proposal: 'Disetujui',
            status_peserta: 'Lengkap (BNBA Terverifikasi)',
            pengadaan_baju: 'Sudah Diterima (Wearpack Bengkel Otomotif)',
            pengadaan_modul: 'Lengkap (SOP Scanner Injeksi & Wiring)',
            pengadaan_bahan: 'Siap (Oli Mesin, Spark Plug, Carb Cleaner, Kampas Rem)',
            pengadaan_uang_saku: 'Tersedia Sesuai SBM',
            status_keuangan: 'Lunas Dicairkan (SP2D Terbit)',
            nilai_keuangan: 29800000,
            sp2d_no: 'SP2D-0048/BPVP/2026',
            tgl_bayar: '2026-04-18',
            hasil_ujk: '16 Kompeten',
            status_sertifikat: 'Tercetak 100%',
            penempatan_bekerja: 9,
            penempatan_wirausaha: 5
        },
        {
            id: 4,
            batch: 'Batch 1',
            kejuruan: 'Pariwisata & Perhotelan',
            program: 'Barista dan Tata Hidang Kopi',
            jenis: 'PBK Reguler',
            target: 16,
            peserta: 16,
            laki: 7,
            perempuan: 9,
            tgl_masuk: '2026-04-05',
            tgl_mulai: '2026-04-20',
            tgl_selesai: '2026-05-30',
            lulus: 16,
            tidak_lulus: 0,
            tahap_flow: 'Selesai & Asesmen LSP',
            status_proposal: 'Disetujui',
            status_peserta: 'Lengkap (BNBA Terverifikasi)',
            pengadaan_baju: 'Sudah Diterima (Apron Barista & Kemeja Hitam)',
            pengadaan_modul: 'Lengkap (Buku Resep & Brewing Guide)',
            pengadaan_bahan: 'Siap (Biji Kopi Arabika & Robusta 25kg, Fresh Milk)',
            pengadaan_uang_saku: 'Tersedia Sesuai SBM',
            status_keuangan: 'Lunas Dicairkan (SP2D Terbit)',
            nilai_keuangan: 19500000,
            sp2d_no: 'SP2D-0056/BPVP/2026',
            tgl_bayar: '2026-06-03',
            hasil_ujk: '16 Kompeten',
            status_sertifikat: 'Proses Blanko',
            penempatan_bekerja: 10,
            penempatan_wirausaha: 5
        },
        {
            id: 5,
            batch: 'Batch 2',
            kejuruan: 'Garmen Apparel',
            program: 'Menjahit Pakaian Pria & Wanita',
            jenis: 'PBK Reguler',
            target: 16,
            peserta: 16,
            laki: 2,
            perempuan: 14,
            tgl_masuk: '2026-05-02',
            tgl_mulai: '2026-05-18',
            tgl_selesai: '2026-07-04',
            lulus: 0,
            tidak_lulus: 0,
            tahap_flow: 'Sedang Berjalan (Praktek Kelas)',
            status_proposal: 'Disetujui',
            status_peserta: 'Lengkap (16 Siswa Aktif)',
            pengadaan_baju: 'Sudah Diterima (Baju Praktek Menjahit)',
            pengadaan_modul: 'Lengkap (Buku Pola & Grading)',
            pengadaan_bahan: 'Siap (Kain Toyobo, Benang Astra, Gunting)',
            pengadaan_uang_saku: 'Termin 1 Dicairkan',
            status_keuangan: 'Sebagian Dicairkan (Termin 1)',
            nilai_keuangan: 14200000,
            sp2d_no: 'SP2D-0062/BPVP/2026',
            tgl_bayar: '2026-05-25',
            hasil_ujk: 'Belum UJK',
            status_sertifikat: 'Menunggu Kelulusan',
            penempatan_bekerja: 0,
            penempatan_wirausaha: 0
        },
        {
            id: 6,
            batch: 'Batch 2',
            kejuruan: 'Teknologi Informasi dan Komunikasi (TIK)',
            program: 'Desainer Grafis Muda',
            jenis: 'PBK Reguler',
            target: 16,
            peserta: 16,
            laki: 8,
            perempuan: 8,
            tgl_masuk: '2026-06-01',
            tgl_mulai: '2026-06-15',
            tgl_selesai: '2026-07-31',
            lulus: 0,
            tidak_lulus: 0,
            tahap_flow: 'Sedang Berjalan (Praktek Kelas)',
            status_proposal: 'Disetujui',
            status_peserta: 'Lengkap (16 Siswa Aktif)',
            pengadaan_baju: 'Sudah Diterima (Kaos Polo Komputer)',
            pengadaan_modul: 'Lengkap (Modul Photoshop & Illustrator)',
            pengadaan_bahan: 'Siap (Drawing Pad & Kertas Glossy)',
            pengadaan_uang_saku: 'Termin 1 Dicairkan',
            status_keuangan: 'Sebagian Dicairkan (Termin 1)',
            nilai_keuangan: 12500000,
            sp2d_no: 'SP2D-0070/BPVP/2026',
            tgl_bayar: '2026-06-20',
            hasil_ujk: 'Belum UJK',
            status_sertifikat: 'Menunggu Kelulusan',
            penempatan_bekerja: 0,
            penempatan_wirausaha: 0
        },
        {
            id: 7,
            batch: 'Batch 2',
            kejuruan: 'Bisnis dan Manajemen',
            program: 'Pengelolaan Administrasi Perkantoran',
            jenis: 'TMT (Tailor Made Training)',
            target: 16,
            peserta: 16,
            laki: 5,
            perempuan: 11,
            tgl_masuk: '2026-07-10',
            tgl_mulai: '2026-08-01',
            tgl_selesai: '2026-09-15',
            lulus: 0,
            tidak_lulus: 0,
            tahap_flow: 'Persiapan Pengadaan & Logistik',
            status_proposal: 'Disetujui Kerjasama',
            status_peserta: 'Lengkap (Penjaringan Mitra Selesai)',
            pengadaan_baju: 'Dalam Proses Pengadaan Pokja',
            pengadaan_modul: 'Sedang Dicetak',
            pengadaan_bahan: 'Pengajuan Masuk Pokja',
            pengadaan_uang_saku: 'Menunggu Verifikasi Keuangan',
            status_keuangan: 'Menunggu Verifikasi SP2D',
            nilai_keuangan: 18000000,
            sp2d_no: 'Dalam Antrian',
            tgl_bayar: '-',
            hasil_ujk: 'Belum UJK',
            status_sertifikat: 'Belum',
            penempatan_bekerja: 0,
            penempatan_wirausaha: 0
        },
        {
            id: 8,
            batch: 'Batch 3',
            kejuruan: 'Teknik Bangunan & Konstruksi',
            program: 'Juru Gambar Bangunan CAD',
            jenis: 'PBL (Pelatihan Berbasis Luar / Proyek)',
            target: 16,
            peserta: 0,
            laki: 0,
            perempuan: 0,
            tgl_masuk: '2026-08-15',
            tgl_mulai: '2026-09-01',
            tgl_selesai: '2026-10-20',
            lulus: 0,
            tidak_lulus: 0,
            tahap_flow: 'Penjaringan Peserta di Pemberdayaan',
            status_proposal: 'Proposal Diajukan Penyelenggara',
            status_peserta: 'Dalam Proses Rekrutmen Siswa',
            pengadaan_baju: 'Draft Rencana Kebutuhan',
            pengadaan_modul: 'Draft Modul AutoCAD',
            pengadaan_bahan: 'Draft Pengadaan',
            pengadaan_uang_saku: 'Rencana Anggaran',
            status_keuangan: 'Belum Diajukan',
            nilai_keuangan: 21000000,
            sp2d_no: '-',
            tgl_bayar: '-',
            hasil_ujk: 'Belum UJK',
            status_sertifikat: 'Belum',
            penempatan_bekerja: 0,
            penempatan_wirausaha: 0
        }
    ],

    // Master Detailed Procurement Catalog per Program & Item (with itemized pricing & schedule)
    procurements: [
        // === BATCH 1 (Pelaksanaan Pelatihan Vokasi Nasional Batch 1) ===
        // 1. Merias Wajah 1
        {
            id: 201,
            batch: 'Batch 1',
            program: 'Merias Wajah 1',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Selasa, 28 April 2026',
            kejuruan: 'Tata Kecantikan',
            item_name: 'Makeup Kit Profesional & Beauty Palette Case',
            spesifikasi: 'Set Foundation, Eyeshadow, Blush, Brush Set 24pcs',
            qty: 16,
            satuan: 'Set',
            harga_satuan: 450000,
            total_harga: 7200000,
            rekanan: 'CV. Sultra Beauty Cosmetics',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Bahan Praktek'
        },
        {
            id: 202,
            batch: 'Batch 1',
            program: 'Merias Wajah 1',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Selasa, 28 April 2026',
            kejuruan: 'Tata Kecantikan',
            item_name: 'Baju Seragam Praktek Kecantikan & Celemek Salon',
            spesifikasi: 'Bahan Drill Halus Bordir Logo Kemnaker',
            qty: 16,
            satuan: 'Stel',
            harga_satuan: 165000,
            total_harga: 2640000,
            rekanan: 'CV. Sultra Konveksi Prima',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Pakaian & Seragam'
        },
        {
            id: 203,
            batch: 'Batch 1',
            program: 'Merias Wajah 1',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Selasa, 28 April 2026',
            kejuruan: 'Tata Kecantikan',
            item_name: 'Uang Saku Siswa PBK Reguler (24 Hari)',
            spesifikasi: 'SBM PMK Standar Rp 30.000 / hari x 24 hari kerja',
            qty: 16,
            satuan: 'Paket (24 Hari)',
            harga_satuan: 720000,
            total_harga: 11520000,
            rekanan: 'Bendahara Pengeluaran BPVP Kendari',
            status_pokja: 'Tersedia & Terbayar',
            kategori: 'Uang Saku Siswa'
        },

        // 2. Merias Wajah 2
        {
            id: 204,
            batch: 'Batch 1',
            program: 'Merias Wajah 2',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Selasa, 28 April 2026',
            kejuruan: 'Tata Kecantikan',
            item_name: 'Makeup Kit Profesional & Beauty Palette Case',
            spesifikasi: 'Set Foundation, Eyeshadow, Blush, Brush Set 24pcs',
            qty: 16,
            satuan: 'Set',
            harga_satuan: 450000,
            total_harga: 7200000,
            rekanan: 'CV. Sultra Beauty Cosmetics',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Bahan Praktek'
        },
        {
            id: 205,
            batch: 'Batch 1',
            program: 'Merias Wajah 2',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Selasa, 28 April 2026',
            kejuruan: 'Tata Kecantikan',
            item_name: 'Baju Seragam Praktek Kecantikan & Celemek Salon',
            spesifikasi: 'Bahan Drill Halus Bordir Logo Kemnaker',
            qty: 16,
            satuan: 'Stel',
            harga_satuan: 165000,
            total_harga: 2640000,
            rekanan: 'CV. Sultra Konveksi Prima',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Pakaian & Seragam'
        },
        {
            id: 206,
            batch: 'Batch 1',
            program: 'Merias Wajah 2',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Selasa, 28 April 2026',
            kejuruan: 'Tata Kecantikan',
            item_name: 'Uang Saku Siswa PBK Reguler (24 Hari)',
            spesifikasi: 'SBM PMK Standar Rp 30.000 / hari x 24 hari kerja',
            qty: 16,
            satuan: 'Paket (24 Hari)',
            harga_satuan: 720000,
            total_harga: 11520000,
            rekanan: 'Bendahara Pengeluaran BPVP Kendari',
            status_pokja: 'Tersedia & Terbayar',
            kategori: 'Uang Saku Siswa'
        },

        // 3. Perakitan Komponen Fabrikasi
        {
            id: 207,
            batch: 'Batch 1',
            program: 'Perakitan Komponen Fabrikasi',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Selasa, 05 Mei 2026',
            kejuruan: 'Manufaktur & Las',
            item_name: 'Wearpack Fabrikasi Heavy Duty & Safety Helmet',
            spesifikasi: 'Kain Drill Standar K3 Industri + Kacamata Gerinda',
            qty: 16,
            satuan: 'Stel',
            harga_satuan: 285000,
            total_harga: 4560000,
            rekanan: 'CV. Safety Mandiri Jaya',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Pakaian & Seragam'
        },
        {
            id: 208,
            batch: 'Batch 1',
            program: 'Perakitan Komponen Fabrikasi',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Selasa, 05 Mei 2026',
            kejuruan: 'Manufaktur & Las',
            item_name: 'Plat Baja Karbon, Profil Siku & Baut Mur Fabrikasi',
            spesifikasi: 'Plat SS400 tebal 6mm & Besi Siku 40x40x4mm',
            qty: 1,
            satuan: 'Paket Workshop',
            harga_satuan: 8400000,
            total_harga: 8400000,
            rekanan: 'PT. Teknik Logam Sultra',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Bahan Praktek'
        },
        {
            id: 209,
            batch: 'Batch 1',
            program: 'Perakitan Komponen Fabrikasi',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Selasa, 05 Mei 2026',
            kejuruan: 'Manufaktur & Las',
            item_name: 'Uang Saku Siswa PBK Reguler (29 Hari)',
            spesifikasi: 'SBM PMK Standar Rp 30.000 / hari x 29 hari kerja',
            qty: 16,
            satuan: 'Paket (29 Hari)',
            harga_satuan: 870000,
            total_harga: 13920000,
            rekanan: 'Bendahara Pengeluaran BPVP Kendari',
            status_pokja: 'Tersedia & Terbayar',
            kategori: 'Uang Saku Siswa'
        },

        // 4. Digital Office Administration Berbasis Google Workspace
        {
            id: 210,
            batch: 'Batch 1',
            program: 'Digital Office Administration Berbasis Google Workspace',
            jenis_pelatihan: 'PBL',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Selasa, 12 Mei 2026',
            kejuruan: 'Bisnis & Manajemen',
            item_name: 'Akun Lisensi Google Workspace Enterprise & Modul Cloud Office',
            spesifikasi: 'Lisensi Google Workspace 3 Bulan + Modul Cetak Hardcover',
            qty: 16,
            satuan: 'Paket',
            harga_satuan: 380000,
            total_harga: 6080000,
            rekanan: 'PT. Kendari Cloud Solution',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Modul / ATK'
        },
        {
            id: 211,
            batch: 'Batch 1',
            program: 'Digital Office Administration Berbasis Google Workspace',
            jenis_pelatihan: 'PBL',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Selasa, 12 Mei 2026',
            kejuruan: 'Bisnis & Manajemen',
            item_name: 'Baju Seragam Praktek Kemeja Eksekutif & Rompi',
            spesifikasi: 'Bahan Drill Oxford Logo Kemnaker',
            qty: 16,
            satuan: 'Stel',
            harga_satuan: 175000,
            total_harga: 2800000,
            rekanan: 'CV. Sultra Konveksi Prima',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Pakaian & Seragam'
        },
        {
            id: 212,
            batch: 'Batch 1',
            program: 'Digital Office Administration Berbasis Google Workspace',
            jenis_pelatihan: 'PBL',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Selasa, 12 Mei 2026',
            kejuruan: 'Bisnis & Manajemen',
            item_name: 'Uang Saku Siswa PBL (34 Hari)',
            spesifikasi: 'SBM PMK Standar Rp 30.000 / hari x 34 hari kerja',
            qty: 16,
            satuan: 'Paket (34 Hari)',
            harga_satuan: 1020000,
            total_harga: 16320000,
            rekanan: 'Bendahara Pengeluaran BPVP Kendari',
            status_pokja: 'Tersedia & Terbayar',
            kategori: 'Uang Saku Siswa'
        },

        // 5. Computer Operator Assistant 1
        {
            id: 213,
            batch: 'Batch 1',
            program: 'Computer Operator Assistant 1',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Rabu, 20 Mei 2026',
            kejuruan: 'TIK',
            item_name: 'Flashdisk Sandisk 64GB USB 3.0 & Mouse Ergonomis',
            spesifikasi: 'USB 3.0 64GB Original + Silent Click Optical Mouse',
            qty: 16,
            satuan: 'Set',
            harga_satuan: 145000,
            total_harga: 2320000,
            rekanan: 'PT. Kendari Multimedia Komputer',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Bahan Praktek'
        },
        {
            id: 214,
            batch: 'Batch 1',
            program: 'Computer Operator Assistant 1',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Rabu, 20 Mei 2026',
            kejuruan: 'TIK',
            item_name: 'Baju Seragam Praktek TIK & Kaos Polo Peserta',
            spesifikasi: 'Bahan Cotton Combed 24s Bordir Logo Kemnaker',
            qty: 16,
            satuan: 'Stel',
            harga_satuan: 175000,
            total_harga: 2800000,
            rekanan: 'CV. Sultra Konveksi Prima',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Pakaian & Seragam'
        },
        {
            id: 215,
            batch: 'Batch 1',
            program: 'Computer Operator Assistant 1',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Rabu, 20 Mei 2026',
            kejuruan: 'TIK',
            item_name: 'Uang Saku Siswa PBK Reguler (40 Hari)',
            spesifikasi: 'SBM PMK Standar Rp 30.000 / hari x 40 hari kerja',
            qty: 16,
            satuan: 'Paket (40 Hari)',
            harga_satuan: 1200000,
            total_harga: 19200000,
            rekanan: 'Bendahara Pengeluaran BPVP Kendari',
            status_pokja: 'Tersedia & Terbayar',
            kategori: 'Uang Saku Siswa'
        },

        // 6. Computer Operator Assistant 2
        {
            id: 216,
            batch: 'Batch 1',
            program: 'Computer Operator Assistant 2',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Rabu, 20 Mei 2026',
            kejuruan: 'TIK',
            item_name: 'Flashdisk Sandisk 64GB USB 3.0 & Mouse Ergonomis',
            spesifikasi: 'USB 3.0 64GB Original + Silent Click Optical Mouse',
            qty: 16,
            satuan: 'Set',
            harga_satuan: 145000,
            total_harga: 2320000,
            rekanan: 'PT. Kendari Multimedia Komputer',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Bahan Praktek'
        },
        {
            id: 217,
            batch: 'Batch 1',
            program: 'Computer Operator Assistant 2',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Rabu, 20 Mei 2026',
            kejuruan: 'TIK',
            item_name: 'Baju Seragam Praktek TIK & Kaos Polo Peserta',
            spesifikasi: 'Bahan Cotton Combed 24s Bordir Logo Kemnaker',
            qty: 16,
            satuan: 'Stel',
            harga_satuan: 175000,
            total_harga: 2800000,
            rekanan: 'CV. Sultra Konveksi Prima',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Pakaian & Seragam'
        },
        {
            id: 218,
            batch: 'Batch 1',
            program: 'Computer Operator Assistant 2',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Rabu, 20 Mei 2026',
            kejuruan: 'TIK',
            item_name: 'Uang Saku Siswa PBK Reguler (40 Hari)',
            spesifikasi: 'SBM PMK Standar Rp 30.000 / hari x 40 hari kerja',
            qty: 16,
            satuan: 'Paket (40 Hari)',
            harga_satuan: 1200000,
            total_harga: 19200000,
            rekanan: 'Bendahara Pengeluaran BPVP Kendari',
            status_pokja: 'Tersedia & Terbayar',
            kategori: 'Uang Saku Siswa'
        },

        // 7. Computer Operator Assistant 3
        {
            id: 219,
            batch: 'Batch 1',
            program: 'Computer Operator Assistant 3',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Rabu, 20 Mei 2026',
            kejuruan: 'TIK',
            item_name: 'Flashdisk Sandisk 64GB USB 3.0 & Mouse Ergonomis',
            spesifikasi: 'USB 3.0 64GB Original + Silent Click Optical Mouse',
            qty: 16,
            satuan: 'Set',
            harga_satuan: 145000,
            total_harga: 2320000,
            rekanan: 'PT. Kendari Multimedia Komputer',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Bahan Praktek'
        },
        {
            id: 220,
            batch: 'Batch 1',
            program: 'Computer Operator Assistant 3',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Rabu, 20 Mei 2026',
            kejuruan: 'TIK',
            item_name: 'Baju Seragam Praktek TIK & Kaos Polo Peserta',
            spesifikasi: 'Bahan Cotton Combed 24s Bordir Logo Kemnaker',
            qty: 16,
            satuan: 'Stel',
            harga_satuan: 175000,
            total_harga: 2800000,
            rekanan: 'CV. Sultra Konveksi Prima',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Pakaian & Seragam'
        },
        {
            id: 221,
            batch: 'Batch 1',
            program: 'Computer Operator Assistant 3',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Rabu, 20 Mei 2026',
            kejuruan: 'TIK',
            item_name: 'Uang Saku Siswa PBK Reguler (40 Hari)',
            spesifikasi: 'SBM PMK Standar Rp 30.000 / hari x 40 hari kerja',
            qty: 16,
            satuan: 'Paket (40 Hari)',
            harga_satuan: 1200000,
            total_harga: 19200000,
            rekanan: 'Bendahara Pengeluaran BPVP Kendari',
            status_pokja: 'Tersedia & Terbayar',
            kategori: 'Uang Saku Siswa'
        },

        // 8. Operator Track Excavator
        {
            id: 222,
            batch: 'Batch 1',
            program: 'Operator Track Excavator',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Senin, 25 Mei 2026',
            kejuruan: 'Alat Berat',
            item_name: 'Wearpack Heavy Machinery, Safety Helmet K3 & Boots Baja',
            spesifikasi: 'Standard Pertambangan/Konstruksi ANSI Z89.1 & ISO 20345',
            qty: 16,
            satuan: 'Paket Lengkap',
            harga_satuan: 480000,
            total_harga: 7680000,
            rekanan: 'CV. Safety Mandiri Jaya',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Pakaian & Seragam'
        },
        {
            id: 223,
            batch: 'Batch 1',
            program: 'Operator Track Excavator',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Senin, 25 Mei 2026',
            kejuruan: 'Alat Berat',
            item_name: 'Bahan Bakar Solar Industri Dexlite & Pelumas Hidrolik 68',
            spesifikasi: 'BBM Operasional Lapangan 500 Liter + Oli Hidrolik Drum 200L',
            qty: 1,
            satuan: 'Paket Operasional',
            harga_satuan: 11500000,
            total_harga: 11500000,
            rekanan: 'PT. Pertamina Patra Niaga Kendari',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Bahan Praktek'
        },
        {
            id: 224,
            batch: 'Batch 1',
            program: 'Operator Track Excavator',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Rabu, 01 April 2026',
            tgl_selesai: 'Senin, 25 Mei 2026',
            kejuruan: 'Alat Berat',
            item_name: 'Uang Saku Siswa PBK Reguler (44 Hari)',
            spesifikasi: 'SBM PMK Standar Rp 30.000 / hari x 44 hari kerja',
            qty: 16,
            satuan: 'Paket (44 Hari)',
            harga_satuan: 1320000,
            total_harga: 21120000,
            rekanan: 'Bendahara Pengeluaran BPVP Kendari',
            status_pokja: 'Tersedia & Terbayar',
            kategori: 'Uang Saku Siswa'
        },

        // === BATCH 2 ===
        {
            id: 225,
            batch: 'Batch 2',
            program: 'Menjahit Pakaian Pria & Wanita',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Senin, 01 Juni 2026',
            tgl_selesai: 'Rabu, 15 Juli 2026',
            kejuruan: 'Garmen',
            item_name: 'Kain Katun Toyobo Premium & Kain Drill',
            spesifikasi: 'Lebar 1.5 meter, Berbagai Warna Standar Busana',
            qty: 120,
            satuan: 'Meter',
            harga_satuan: 45000,
            total_harga: 5400000,
            rekanan: 'Toko Tekstil Mode Sultra',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Bahan Praktek'
        },
        {
            id: 226,
            batch: 'Batch 2',
            program: 'Desainer Grafis Muda',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Senin, 01 Juni 2026',
            tgl_selesai: 'Jumat, 10 Juli 2026',
            kejuruan: 'TIK',
            item_name: 'Drawing Tablet Stylus Pen Huion H640P',
            spesifikasi: '8192 Pressure Levels Battery-Free Stylus',
            qty: 16,
            satuan: 'Unit',
            harga_satuan: 450000,
            total_harga: 7200000,
            rekanan: 'PT. Kendari Multimedia Komputer',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Alat / Bahan Praktek'
        },
        {
            id: 227,
            batch: 'Batch 2',
            program: 'Pengelolaan Administrasi Perkantoran',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Senin, 01 Juni 2026',
            tgl_selesai: 'Minggu, 05 Juli 2026',
            kejuruan: 'Bisnis',
            item_name: 'Kertas HVS A4 80gr, Ordner Bantex & Alat Tulis Kantor',
            spesifikasi: 'Box isi 5 Rim Kertas PaperOne + 16 Ordner F4',
            qty: 16,
            satuan: 'Paket Siswa',
            harga_satuan: 225000,
            total_harga: 3600000,
            rekanan: 'Toko Buku & ATK Kendari Baru',
            status_pokja: 'Sedang Proses Pengadaan',
            kategori: 'Modul / ATK'
        },
        {
            id: 228,
            batch: 'Batch 2',
            program: 'Barista dan Tata Hidang Kopi',
            jenis_pelatihan: 'PBK Reguler',
            tgl_mulai: 'Senin, 01 Juni 2026',
            tgl_selesai: 'Minggu, 28 Juni 2026',
            kejuruan: 'Pariwisata',
            item_name: 'Biji Kopi Specialty Single Origin Toraja & Mandheling',
            spesifikasi: 'Roast Profile Medium, Kemasan Valve 1kg',
            qty: 25,
            satuan: 'Kg',
            harga_satuan: 160000,
            total_harga: 4000000,
            rekanan: 'CV. Nusantara Coffee Roastery',
            status_pokja: 'Lengkap Diterima',
            kategori: 'Bahan Praktek'
        }
    ],
};

const SimpelAuth = {
    getAllUsers() {
        let users = { ...SIMPEL_USERS };
        try {
            const registered = localStorage.getItem('simpel_registered_users');
            if (registered) {
                const parsed = JSON.parse(registered);
                Object.assign(users, parsed);
            }
        } catch (e) {}
        return users;
    },

    getCurrentUser() {
        try {
            const raw = localStorage.getItem('simpel_user');
            if (raw) return JSON.parse(raw);
        } catch (e) {}
        return SIMPEL_USERS['admin@bpvpkendari.go.id'];
    },

    login(email) {
        const allUsers = this.getAllUsers();
        let user = allUsers[email];
        
        if (!user) {
            // Default user fallback if typed manually
            user = {
                name: email.split('@')[0],
                email: email,
                role: 'admin',
                roleLabel: 'Admin',
                dept: 'BPVP Kendari',
                badgeColor: 'bg-rose-500',
                homePage: 'portal.html',
                permissions: ['*']
            };
        }
        localStorage.setItem('simpel_user', JSON.stringify(user));
        return user;
    },

    registerUser({ name, email, password, role }) {
        const registeredUsers = JSON.parse(localStorage.getItem('simpel_registered_users') || '{}');
        
        const roleTemplates = {
            'admin': { roleLabel: 'Super Admin', dept: 'Pengelola Sistem Informasi & Integrasi', badgeColor: 'bg-rose-500', homePage: 'portal.html', permissions: ['*'] },
            'pimpinan': { roleLabel: 'Pimpinan Balai', dept: 'Pimpinan & Pengambil Kebijakan', badgeColor: 'bg-purple-600', homePage: 'dashboard.html', permissions: ['dashboard', 'detail_pengadaan'] },
            'penyelenggara': { roleLabel: 'Penyelenggara Pelatihan', dept: 'Seksi Penyelenggaraan Pelatihan Vokasi (UPTP)', badgeColor: 'bg-teal-600', homePage: 'pelatihan.html', permissions: ['pelatihan', 'input_penyelenggara', 'input'] },
            'pemberdayaan': { roleLabel: 'Pemberdayaan Peserta', dept: 'Seksi Pemberdayaan & Kerjasama Alumni (UPTP)', badgeColor: 'bg-blue-600', homePage: 'penempatan.html', permissions: ['penempatan', 'input_pemberdayaan', 'input'] },
            'lsp': { roleLabel: 'LSP BPVP Kendari', dept: 'Lembaga Sertifikasi Profesi (BNSP)', badgeColor: 'bg-amber-500', homePage: 'sertifikasi.html', permissions: ['sertifikasi', 'input_lsp', 'input'] },
            'produktivitas': { roleLabel: 'Produktivitas Industri', dept: 'Seksi Peningkatan Produktivitas', badgeColor: 'bg-emerald-600', homePage: 'produktivitas.html', permissions: ['produktivitas', 'input_produktivitas', 'input'] },
            'pengadaan': { roleLabel: 'Pengadaan / Pokja', dept: 'Pokja Pengadaan Bahan & Alat Pelatihan', badgeColor: 'bg-indigo-600', homePage: 'pengadaan.html', permissions: ['pengadaan', 'detail_pengadaan', 'input_umum', 'input'] },
            'umum': { roleLabel: 'Umum & TU (UPTD)', dept: 'Subbag Tata Usaha & UPTD Binaan', badgeColor: 'bg-slate-700', homePage: 'pelatihan_uptd.html', permissions: ['pelatihan_uptd', 'input_pelatihan_uptd', 'input'] },
            'keuangan': { roleLabel: 'Keuangan & SP2D', dept: 'Urusan Keuangan & Perbendaharaan', badgeColor: 'bg-emerald-700', homePage: 'keuangan.html', permissions: ['keuangan', 'input_umum', 'input'] }
        };

        const template = roleTemplates[role] || roleTemplates['penyelenggara'];

        const newUser = {
            name,
            email,
            password,
            role,
            roleLabel: template.roleLabel,
            dept: template.dept,
            badgeColor: template.badgeColor,
            homePage: template.homePage,
            permissions: template.permissions
        };

        registeredUsers[email] = newUser;
        localStorage.setItem('simpel_registered_users', JSON.stringify(registeredUsers));
        return newUser;
    },

    logout() {
        localStorage.removeItem('simpel_user');
        window.location.href = 'index.html';
    },

    switchRole(email) {
        this.login(email);
        const user = this.getCurrentUser();
        window.location.href = user.homePage || 'portal.html';
    },

    hasPermission(permission) {
        const user = this.getCurrentUser();
        if (!user || user.role === 'admin') return true;
        return user.permissions && (user.permissions.includes('*') || user.permissions.includes(permission));
    },

    /**
     * Strict Route Guard Enforcement:
     * If user role tries to access an unauthorized page, alert & redirect them to their home page.
     */
    enforcePageAccess(pageKey) {
        const user = this.getCurrentUser();
        if (!user) {
            window.location.href = 'index.html';
            return false;
        }

        // Admin has full access to everything
        if (user.role === 'admin') return true;

        const isAllowed = user.permissions && (user.permissions.includes('*') || user.permissions.includes(pageKey));
        
        if (!isAllowed) {
            setTimeout(() => {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Akses Ditolak!',
                        html: `Akun Anda memiliki wewenang sebagai <b>${user.roleLabel}</b>.<br><span class="text-xs text-slate-500">Anda hanya dapat mengakses modul pada bidang wewenang Anda.</span>`,
                        confirmButtonText: 'Buka Modul Saya',
                        confirmButtonColor: '#0f766e',
                        allowOutsideClick: false
                    }).then(() => {
                        window.location.href = user.homePage || 'dashboard.html';
                    });
                } else {
                    alert('Akses Terbatas: Anda dialihkan ke halaman bidang Anda.');
                    window.location.href = user.homePage || 'dashboard.html';
                }
            }, 100);
            return false;
        }
        return true;
    },

    renderNavbar(activePage) {
        // Enforce role route guarding on navbar render
        this.enforcePageAccess(activePage);

        const user = this.getCurrentUser();
        const navContainer = document.getElementById('simpel-unified-header');
        if (!navContainer) return;

        // Generate Role-Specific Navigation Links (STRICT ISOLATION: No access/links to other roles' pages)
        let roleNavHtml = '';

        if (user.role === 'admin') {
            // Admin has Super Access to all modules and Portal
            roleNavHtml = `
                <a href="portal.html" class="px-3.5 py-2 rounded-xl transition ${activePage === 'portal' ? 'bg-[#0E202C] text-rose-300 font-bold ring-1 ring-white/10' : 'text-slate-200 hover:bg-[#0E202C]/60 hover:text-white'}">
                    <i class="fa-solid fa-network-wired mr-1.5 text-rose-400"></i>
                    <span>Portal Admin</span>
                </a>
                <a href="dashboard.html" class="px-3.5 py-2 rounded-xl transition ${activePage === 'dashboard' ? 'bg-[#0E202C] text-teal-300 font-bold ring-1 ring-white/10' : 'text-slate-200 hover:bg-[#0E202C]/60 hover:text-white'}">
                    <i class="fa-solid fa-chart-pie mr-1.5 text-teal-400"></i>
                    <span>Dashboard Pimpinan</span>
                </a>
                <div class="relative group">
                    <button type="button" class="flex items-center gap-1.5 px-3.5 py-2 rounded-xl transition ${['pelatihan', 'penempatan', 'produktivitas', 'umum', 'pelatihan_uptd', 'sertifikasi', 'keuangan', 'pengadaan', 'detail_pengadaan'].includes(activePage) ? 'bg-[#0E202C] text-teal-300 font-bold ring-1 ring-white/10' : 'text-slate-200 hover:bg-[#0E202C]/60 hover:text-white'}">
                        <i class="fa-solid fa-layer-group text-teal-400"></i>
                        <span>Semua Bidang</span>
                        <i class="fa-solid fa-chevron-down text-[9px] ml-0.5 text-slate-400 group-hover:rotate-180 transition-transform"></i>
                    </button>
                    <div class="absolute left-0 top-full mt-1.5 w-80 rounded-2xl bg-white text-slate-800 border border-slate-200 shadow-2xl p-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                        <div class="px-3 py-1.5 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 border-b border-slate-100 mb-1 flex items-center justify-between">
                            <span>Modul Bidang Kerja</span>
                            <span class="text-[9px] text-teal-600 bg-teal-50 px-1.5 py-0.5 rounded font-bold">Admin Super Access</span>
                        </div>
                        <div class="space-y-1 text-xs">
                            <a href="penempatan.html" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 transition ${activePage === 'penempatan' ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-700'}">
                                <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold"><i class="fa-solid fa-users"></i></div>
                                <div class="flex-1"><p class="font-bold leading-tight">Pemberdayaan</p><p class="text-[10px] text-slate-400">Peserta UPTP & Penempatan Alumni</p></div>
                            </a>
                            <a href="pelatihan.html" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 transition ${activePage === 'pelatihan' ? 'bg-teal-50 text-teal-700 font-bold' : 'text-slate-700'}">
                                <div class="w-7 h-7 rounded-lg bg-teal-100 text-teal-700 flex items-center justify-center text-xs font-bold"><i class="fa-solid fa-graduation-cap"></i></div>
                                <div class="flex-1"><p class="font-bold leading-tight">Penyelenggara</p><p class="text-[10px] text-slate-400">Program PBK, TMT, PBL</p></div>
                            </a>
                            <a href="produktivitas.html" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 transition ${activePage === 'produktivitas' ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-700'}">
                                <div class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-bold"><i class="fa-solid fa-arrow-trend-up"></i></div>
                                <div class="flex-1"><p class="font-bold leading-tight">Produktivitas</p><p class="text-[10px] text-slate-400">Bimbingan UMKM & Green Job</p></div>
                            </a>
                            <a href="pelatihan_uptd.html" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 transition ${activePage === 'pelatihan_uptd' ? 'bg-amber-50 text-amber-800 font-bold' : 'text-slate-700'}">
                                <div class="w-7 h-7 rounded-lg bg-amber-100 text-amber-800 flex items-center justify-center text-xs font-bold"><i class="fa-solid fa-map-location-dot"></i></div>
                                <div class="flex-1"><p class="font-bold leading-tight">Pelatihan UPTD</p><p class="text-[10px] text-slate-400">Tata Usaha & 5 BLK Binaan Sultra</p></div>
                            </a>
                            <a href="sertifikasi.html" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 transition ${activePage === 'sertifikasi' ? 'bg-amber-50 text-amber-800 font-bold' : 'text-slate-700'}">
                                <div class="w-7 h-7 rounded-lg bg-amber-100 text-amber-800 flex items-center justify-center text-xs font-bold"><i class="fa-solid fa-certificate"></i></div>
                                <div class="flex-1"><p class="font-bold leading-tight">LSP BPVP Kendari</p><p class="text-[10px] text-slate-400">Sertifikasi Kompetensi BNSP</p></div>
                            </a>
                            <a href="keuangan.html" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 transition ${activePage === 'keuangan' ? 'bg-emerald-50 text-emerald-800 font-bold' : 'text-slate-700'}">
                                <div class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs font-bold"><i class="fa-solid fa-money-check-dollar"></i></div>
                                <div class="flex-1"><p class="font-bold leading-tight">Keuangan</p><p class="text-[10px] text-slate-400">SP2D & Realisasi Anggaran</p></div>
                            </a>
                            <a href="pengadaan.html" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 transition ${['pengadaan', 'detail_pengadaan'].includes(activePage) ? 'bg-indigo-50 text-indigo-800 font-bold' : 'text-slate-700'}">
                                <div class="w-7 h-7 rounded-lg bg-indigo-100 text-indigo-800 flex items-center justify-center text-xs font-bold"><i class="fa-solid fa-boxes-stacked"></i></div>
                                <div class="flex-1"><p class="font-bold leading-tight">Pengadaan / Pokja</p><p class="text-[10px] text-slate-400">Logistik & Rincian Harga Bahan</p></div>
                            </a>
                        </div>
                    </div>
                </div>
            `;
        } else if (user.role === 'pimpinan') {
            roleNavHtml = `
                <a href="dashboard.html" class="px-3.5 py-2 rounded-xl transition ${activePage === 'dashboard' ? 'bg-[#0E202C] text-teal-300 font-bold ring-1 ring-white/10' : 'text-slate-200 hover:bg-[#0E202C]/60 hover:text-white'}">
                    <i class="fa-solid fa-chart-pie mr-1.5 text-teal-400"></i>
                    <span>Dashboard Pimpinan</span>
                </a>
                <a href="detail_pengadaan.html" class="px-3.5 py-2 rounded-xl transition ${activePage === 'detail_pengadaan' ? 'bg-[#0E202C] text-indigo-300 font-bold ring-1 ring-white/10' : 'text-slate-200 hover:bg-[#0E202C]/60 hover:text-white'}">
                    <i class="fa-solid fa-calculator mr-1.5 text-indigo-400"></i>
                    <span>Detail Pengadaan Bahan & Harga</span>
                </a>
            `;
        } else if (user.role === 'penyelenggara') {
            roleNavHtml = `
                <a href="pelatihan.html" class="px-3.5 py-2 rounded-xl transition ${['pelatihan', 'input_penyelenggara'].includes(activePage) ? 'bg-[#0E202C] text-teal-300 font-bold ring-1 ring-white/10' : 'text-slate-200 hover:bg-[#0E202C]/60 hover:text-white'}">
                    <i class="fa-solid fa-graduation-cap mr-1.5 text-teal-400"></i>
                    <span>Penyelenggara (Program Pelatihan)</span>
                </a>
            `;
        } else if (user.role === 'pemberdayaan') {
            roleNavHtml = `
                <a href="penempatan.html" class="px-3.5 py-2 rounded-xl transition ${['penempatan', 'input_pemberdayaan'].includes(activePage) ? 'bg-[#0E202C] text-blue-300 font-bold ring-1 ring-white/10' : 'text-slate-200 hover:bg-[#0E202C]/60 hover:text-white'}">
                    <i class="fa-solid fa-users mr-1.5 text-blue-400"></i>
                    <span>Pemberdayaan & Penempatan Peserta</span>
                </a>
            `;
        } else if (user.role === 'lsp') {
            roleNavHtml = `
                <a href="sertifikasi.html" class="px-3.5 py-2 rounded-xl transition ${['sertifikasi', 'input_lsp'].includes(activePage) ? 'bg-[#0E202C] text-amber-300 font-bold ring-1 ring-white/10' : 'text-slate-200 hover:bg-[#0E202C]/60 hover:text-white'}">
                    <i class="fa-solid fa-certificate mr-1.5 text-amber-400"></i>
                    <span>LSP BPVP Kendari</span>
                </a>
            `;
        } else if (user.role === 'produktivitas') {
            roleNavHtml = `
                <a href="produktivitas.html" class="px-3.5 py-2 rounded-xl transition ${['produktivitas', 'input_produktivitas'].includes(activePage) ? 'bg-[#0E202C] text-emerald-300 font-bold ring-1 ring-white/10' : 'text-slate-200 hover:bg-[#0E202C]/60 hover:text-white'}">
                    <i class="fa-solid fa-arrow-trend-up mr-1.5 text-emerald-400"></i>
                    <span>Produktivitas Industri</span>
                </a>
            `;
        } else if (user.role === 'pengadaan') {
            roleNavHtml = `
                <a href="pengadaan.html" class="px-3.5 py-2 rounded-xl transition ${activePage === 'pengadaan' ? 'bg-[#0E202C] text-indigo-300 font-bold ring-1 ring-white/10' : 'text-slate-200 hover:bg-[#0E202C]/60 hover:text-white'}">
                    <i class="fa-solid fa-boxes-stacked mr-1.5 text-indigo-400"></i>
                    <span>Pengadaan / Pokja</span>
                </a>
                <a href="detail_pengadaan.html" class="px-3.5 py-2 rounded-xl transition ${activePage === 'detail_pengadaan' ? 'bg-[#0E202C] text-indigo-300 font-bold ring-1 ring-white/10' : 'text-slate-200 hover:bg-[#0E202C]/60 hover:text-white'}">
                    <i class="fa-solid fa-calculator mr-1.5 text-indigo-400"></i>
                    <span>Detail Bahan & Harga</span>
                </a>
            `;
        } else if (user.role === 'umum') {
            roleNavHtml = `
                <a href="pelatihan_uptd.html" class="px-3.5 py-2 rounded-xl transition ${['pelatihan_uptd', 'input_pelatihan_uptd'].includes(activePage) ? 'bg-[#0E202C] text-amber-300 font-bold ring-1 ring-white/10' : 'text-slate-200 hover:bg-[#0E202C]/60 hover:text-white'}">
                    <i class="fa-solid fa-map-location-dot mr-1.5 text-amber-400"></i>
                    <span>Data Pelatihan 5 BLK UPTD</span>
                </a>
            `;
        } else if (user.role === 'keuangan') {
            roleNavHtml = `
                <a href="keuangan.html" class="px-3.5 py-2 rounded-xl transition ${activePage === 'keuangan' ? 'bg-[#0E202C] text-emerald-300 font-bold ring-1 ring-white/10' : 'text-slate-200 hover:bg-[#0E202C]/60 hover:text-white'}">
                    <i class="fa-solid fa-money-check-dollar mr-1.5 text-emerald-400"></i>
                    <span>Keuangan & SP2D</span>
                </a>
            `;
        }

        navContainer.innerHTML = `
        <!-- TOP LOGO & APP BAR (STRICT ROLE ISOLATION, NO INPUT DATA BUTTON, CLEAN SIMPEL LOGO ONLY) -->
        <header class="bg-[#1A3344] text-white sticky top-0 z-50 border-b border-slate-700/80 shadow-md">
            <div class="w-full px-4 sm:px-6 lg:px-10">
                <div class="flex items-center justify-between h-16">
                    
                    <!-- LEFT: CLEAN LOGO & SIMPEL ONLY -->
                    <div class="flex items-center space-x-3">
                        <a href="${user.homePage || 'portal.html'}" class="flex items-center gap-3 group">
                            <img src="assets/logo kemnaker.png" 
                                 onerror="this.src='https://bpvpkendari.kemnaker.go.id/storage/upload/setting/11749712002.png'" 
                                 alt="Logo Kemnaker" 
                                 class="h-9 w-9 object-contain rounded-xl p-1 bg-white ring-2 ring-white/20 shadow-xs transition-transform group-hover:scale-105">
                            <div class="flex flex-col">
                                <span class="text-lg sm:text-xl font-extrabold tracking-tight text-white font-heading leading-tight">
                                    SIMPEL
                                </span>
                            </div>
                        </a>
                    </div>

                    <!-- CENTER: STRICT ROLE-SPECIFIC NAVIGATION -->
                    <nav class="hidden md:flex items-center space-x-2 text-xs font-semibold">
                        ${roleNavHtml}
                    </nav>

                    <!-- RIGHT CONTROLS: ROLE PROFILE SWITCHER ONLY (NO INPUT DATA BUTTON) -->
                    <div class="flex items-center gap-3">
                        
                        <!-- Active Role Indicator & Switcher Modal Trigger -->
                        <div class="relative group">
                            <button type="button" class="flex items-center gap-2.5 p-1.5 pl-2.5 pr-3 rounded-xl bg-[#0E202C] hover:bg-slate-800 border border-white/15 text-white text-xs transition">
                                <div class="h-7 w-7 rounded-lg ${user.badgeColor || 'bg-teal-500'} text-white flex items-center justify-center font-bold text-[11px] uppercase shadow-xs">
                                    ${user.role.substring(0, 2).toUpperCase()}
                                </div>
                                <div class="hidden md:flex flex-col text-left">
                                    <span class="font-bold leading-tight text-white truncate max-w-[130px]">${user.name}</span>
                                    <span class="text-[10px] text-teal-300 font-semibold uppercase tracking-wider">${user.roleLabel || user.role}</span>
                                </div>
                                <i class="fa-solid fa-chevron-down text-[9px] text-slate-400"></i>
                            </button>

                            <!-- Role Switcher Dropdown (Allows Quick Role Swapping for 9 Roles Demo) -->
                            <div class="absolute right-0 top-full mt-2 w-72 rounded-2xl bg-white text-slate-800 border border-slate-200 shadow-2xl p-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                                <div class="p-3 border-b border-slate-100 bg-slate-50 rounded-xl mb-2">
                                    <p class="text-[10px] text-slate-400 font-extrabold uppercase tracking-wider">Role Aktif Saat Ini:</p>
                                    <p class="text-xs font-bold text-slate-900 mt-0.5">${user.name}</p>
                                    <span class="inline-block mt-1 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold text-white ${user.badgeColor || 'bg-teal-500'}">
                                        ${user.roleLabel || user.role}
                                    </span>
                                </div>

                                <div class="px-2 py-1 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Ganti Role Pengguna (Demo):</div>
                                <div class="max-h-56 overflow-y-auto space-y-1 pr-1 text-xs">
                                    <button onclick="SimpelAuth.switchRole('admin@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between ${user.role === 'admin' ? 'bg-teal-50 font-bold text-teal-800' : ''}">
                                        <span>1. Admin (Super Access)</span>
                                    </button>
                                    <button onclick="SimpelAuth.switchRole('pimpinan@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between ${user.role === 'pimpinan' ? 'bg-teal-50 font-bold text-teal-800' : ''}">
                                        <span>2. Pimpinan (Dashboard)</span>
                                    </button>
                                    <button onclick="SimpelAuth.switchRole('penyelenggara@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between ${user.role === 'penyelenggara' ? 'bg-teal-50 font-bold text-teal-800' : ''}">
                                        <span>3. Penyelenggara (Proposal)</span>
                                    </button>
                                    <button onclick="SimpelAuth.switchRole('pemberdayaan@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between ${user.role === 'pemberdayaan' ? 'bg-teal-50 font-bold text-teal-800' : ''}">
                                        <span>4. Pemberdayaan (Peserta)</span>
                                    </button>
                                    <button onclick="SimpelAuth.switchRole('lsp@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between ${user.role === 'lsp' ? 'bg-teal-50 font-bold text-teal-800' : ''}">
                                        <span>5. LSP (Sertifikasi BNSP)</span>
                                    </button>
                                    <button onclick="SimpelAuth.switchRole('produktivitas@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between ${user.role === 'produktivitas' ? 'bg-teal-50 font-bold text-teal-800' : ''}">
                                        <span>6. Produktivitas (UMKM)</span>
                                    </button>
                                    <button onclick="SimpelAuth.switchRole('pengadaan@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between ${user.role === 'pengadaan' ? 'bg-teal-50 font-bold text-teal-800' : ''}">
                                        <span>7. Pengadaan / Pokja</span>
                                    </button>
                                    <button onclick="SimpelAuth.switchRole('umum@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between ${user.role === 'umum' ? 'bg-teal-50 font-bold text-teal-800' : ''}">
                                        <span>8. Umum / TU (UPTD)</span>
                                    </button>
                                    <button onclick="SimpelAuth.switchRole('keuangan@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between ${user.role === 'keuangan' ? 'bg-teal-50 font-bold text-teal-800' : ''}">
                                        <span>9. Keuangan (Bayar/SP2D)</span>
                                    </button>
                                </div>

                                <div class="border-t border-slate-100 mt-2 pt-2">
                                    <button onclick="SimpelAuth.logout()" type="button" class="w-full flex items-center justify-center gap-2 py-2 text-xs font-bold text-rose-600 hover:bg-rose-50 rounded-xl transition">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                        <span>Keluar (Logout)</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Menu Button -->
                        <button onclick="document.getElementById('mobile-nav-panel').classList.toggle('hidden')" type="button" class="md:hidden p-2 rounded-xl bg-[#0E202C] text-white">
                            <i class="fa-solid fa-bars text-sm"></i>
                        </button>

                    </div>

                </div>
            </div>

            <!-- Mobile Navigation Panel (Role-Specific) -->
            <div id="mobile-nav-panel" class="hidden md:hidden bg-[#0E202C] border-t border-slate-700/80 px-4 pt-3 pb-5 space-y-1 text-xs">
                ${roleNavHtml}
                <button onclick="SimpelAuth.logout()" class="w-full text-left px-3 py-2 text-rose-400 font-bold border-t border-slate-800 mt-2">Keluar (Logout)</button>
            </div>
        </header>
        `;
    }
};

window.SimpelAuth = SimpelAuth;
window.SIMPEL_DATA = SIMPEL_DATA;
