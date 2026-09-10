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
        password: 'password',
        role: 'admin',
        roleLabel: 'Super Admin (Portal)',
        dept: 'Pengelola Sistem Informasi & Integrasi Data',
        badgeColor: 'bg-rose-500',
        homePage: 'dashboard.html',
        permissions: ['*']
    },
    'pimpinan@bpvpkendari.go.id': {
        name: 'Kepala BPVP Kendari',
        email: 'pimpinan@bpvpkendari.go.id',
        password: 'password',
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
        password: 'password',
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
        password: 'password',
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
        password: 'password',
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
        password: 'password',
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
        password: 'password',
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
        password: 'password',
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
        password: 'password',
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

    login(email, password) {
        const allUsers = this.getAllUsers();
        const cleanEmail = (email || '').toLowerCase().trim();
        
        let user = allUsers[cleanEmail];
        if (!user) {
            // Case-insensitive key match
            const matchKey = Object.keys(allUsers).find(k => k.toLowerCase() === cleanEmail);
            if (matchKey) {
                user = allUsers[matchKey];
            }
        }
        
        if (!user) {
            return {
                success: false,
                message: 'Akun dengan email "' + email + '" belum terdaftar. Silakan klik tab "Daftar Akun Baru".'
            };
        }

        // Validate password if provided
        if (password !== undefined && password !== null) {
            const expectedPassword = user.password || 'password';
            if (password !== expectedPassword) {
                return {
                    success: false,
                    message: 'Kata sandi (password) yang Anda masukkan salah. Silakan coba lagi.'
                };
            }
        }

        localStorage.setItem('simpel_user', JSON.stringify(user));
        return {
            success: true,
            user: user,
            ...user
        };
    },

    registerUser({ name, email, password, role }) {
        const registeredUsers = JSON.parse(localStorage.getItem('simpel_registered_users') || '{}');
        
        const roleTemplates = {
            'admin': { roleLabel: 'Super Admin', dept: 'Pengelola Sistem Informasi & Integrasi', badgeColor: 'bg-rose-500', homePage: 'dashboard.html', permissions: ['*'] },
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
        // Enforce role route guarding
        this.enforcePageAccess(activePage);

        const user = this.getCurrentUser();
        const navContainer = document.getElementById('simpel-unified-header');
        if (!navContainer) return;

        // Global Dropdown Toggles for Sidebar
        window.toggleBidangDropdown = function(e) {
            if (e) { e.preventDefault(); e.stopPropagation(); }
            const submenu = document.getElementById('bidang-submenu');
            const chevron = document.getElementById('bidang-chevron');
            if (!submenu) return;
            submenu.classList.toggle('hidden');
            if (chevron) chevron.classList.toggle('rotate-180');
        };

        window.toggleTuDropdown = function(e) {
            if (e) { e.preventDefault(); e.stopPropagation(); }
            const submenu = document.getElementById('tu-submenu');
            const chevron = document.getElementById('tu-chevron');
            if (!submenu) return;
            submenu.classList.toggle('hidden');
            if (chevron) chevron.classList.toggle('rotate-180');
        };

        window.togglePokjaDropdown = function(e) {
            if (e) { e.preventDefault(); e.stopPropagation(); }
            const submenu = document.getElementById('pokja-submenu');
            const chevron = document.getElementById('pokja-chevron');
            if (!submenu) return;
            submenu.classList.toggle('hidden');
            if (chevron) chevron.classList.toggle('rotate-180');
        };

        const bidangPages = ['penempatan', 'pelatihan', 'produktivitas', 'pelatihan_uptd', 'sertifikasi', 'keuangan', 'pengadaan', 'detail_pengadaan', 'input_penyelenggara', 'input_pemberdayaan', 'input_lsp', 'input_produktivitas', 'input_pelatihan_uptd', 'perjalanan_dinas', 'input_perjalanan_dinas'];
        const isBidangActive = bidangPages.includes(activePage);
        const isTuActive = activePage === 'pelatihan_uptd' || activePage === 'input_pelatihan_uptd' || activePage === 'perjalanan_dinas' || activePage === 'input_perjalanan_dinas';
        const isPokjaActive = activePage === 'pengadaan' || activePage === 'detail_pengadaan' || activePage === 'input';

        // Role-Specific & Dynamic Sidebar Navigation
        let menuItemsHtml = '';

        if (user.role === 'pimpinan') {
            menuItemsHtml = `
                <!-- 1. DASHBOARD PIMPINAN -->
                <a href="dashboard.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'dashboard' ? 'bg-gradient-to-r from-indigo-600 to-blue-600 text-white shadow-md shadow-indigo-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'dashboard' ? 'bg-white/20 text-white' : 'bg-indigo-500/15 text-indigo-400 group-hover:bg-indigo-500/30 group-hover:text-indigo-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-chart-pie text-xs"></i>
                    </div>
                    <span>Dashboard Pimpinan</span>
                </a>

                <!-- 2. PERJALANAN DINAS (SPD) PIMPINAN - MANDIRI -->
                <a href="perjalanan_dinas.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'perjalanan_dinas' || activePage === 'input_perjalanan_dinas' ? 'bg-gradient-to-r from-emerald-800 to-teal-900 text-white shadow-md shadow-emerald-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'perjalanan_dinas' || activePage === 'input_perjalanan_dinas' ? 'bg-white/20 text-white' : 'bg-emerald-500/15 text-emerald-400 group-hover:bg-emerald-500/30 group-hover:text-emerald-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-briefcase text-xs"></i>
                    </div>
                    <div class="flex-1 flex items-center justify-between">
                        <span>Perjalanan Dinas (SPD)</span>
                        <span class="px-1.5 py-0.5 rounded-full bg-emerald-500/20 text-[9px] font-extrabold text-emerald-300">Mandiri</span>
                    </div>
                </a>

                <!-- 3. RINCIAN BAHAN -->
                <a href="detail_pengadaan.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'detail_pengadaan' ? 'bg-gradient-to-r from-teal-600 to-emerald-600 text-white shadow-md shadow-teal-500/20' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'detail_pengadaan' ? 'bg-white/20 text-white' : 'bg-teal-500/15 text-teal-400 group-hover:bg-teal-500/30 group-hover:text-teal-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-calculator text-xs"></i>
                    </div>
                    <span>Rincian Bahan Pelatihan</span>
                </a>
            `;
        } else if (user.role === 'pengadaan') {
            menuItemsHtml = `
                <!-- 1. DATA PENGADAAN -->
                <a href="pengadaan.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'pengadaan' ? 'bg-gradient-to-r from-indigo-600 to-blue-600 text-white shadow-md shadow-indigo-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'pengadaan' ? 'bg-white/20 text-white' : 'bg-indigo-500/15 text-indigo-400 group-hover:bg-indigo-500/30 group-hover:text-indigo-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-boxes-packing text-xs"></i>
                    </div>
                    <span>Data Pengadaan Pokja</span>
                </a>

                <!-- 2. REKAP SPK & NOTA PEMESANAN -->
                <a href="input.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'input' ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-blue-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'input' ? 'bg-white/20 text-white' : 'bg-blue-500/15 text-blue-400 group-hover:bg-blue-500/30 group-hover:text-blue-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-file-contract text-xs"></i>
                    </div>
                    <span>Rekap SPK & Nota Pesanan</span>
                </a>

                <!-- 3. RINCIAN BAHAN -->
                <a href="detail_pengadaan.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'detail_pengadaan' ? 'bg-gradient-to-r from-teal-600 to-emerald-600 text-white shadow-md shadow-teal-500/20' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'detail_pengadaan' ? 'bg-white/20 text-white' : 'bg-teal-500/15 text-teal-400 group-hover:bg-teal-500/30 group-hover:text-teal-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-calculator text-xs"></i>
                    </div>
                    <span>Rincian Bahan & Harga</span>
                </a>
            `;
        } else if (user.role === 'penyelenggara') {
            menuItemsHtml = `
                <!-- 1. DATA PELATIHAN -->
                <a href="pelatihan.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'pelatihan' ? 'bg-gradient-to-r from-teal-600 to-emerald-600 text-white shadow-md shadow-teal-500/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'pelatihan' ? 'bg-white/20 text-white' : 'bg-teal-500/15 text-teal-400 group-hover:bg-teal-500/30 group-hover:text-teal-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-graduation-cap text-xs"></i>
                    </div>
                    <span>Data Pelatihan</span>
                </a>

                <!-- 2. INPUT PELATIHAN PER BATCH -->
                <a href="input_penyelenggara.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'input_penyelenggara' ? 'bg-gradient-to-r from-teal-600 to-emerald-600 text-white shadow-md shadow-teal-500/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'input_penyelenggara' ? 'bg-white/20 text-white' : 'bg-teal-500/15 text-teal-400 group-hover:bg-teal-500/30 group-hover:text-teal-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-calendar-plus text-xs"></i>
                    </div>
                    <span>Input Pelatihan (Per Batch)</span>
                </a>
            `;
        } else if (user.role === 'pemberdayaan') {
            menuItemsHtml = `
                <!-- 1. PENEMPATAN ALUMNI -->
                <a href="penempatan.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'penempatan' ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-blue-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'penempatan' ? 'bg-white/20 text-white' : 'bg-blue-500/15 text-blue-400 group-hover:bg-blue-500/30 group-hover:text-blue-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-users text-xs"></i>
                    </div>
                    <span>Penempatan Alumni</span>
                </a>

                <!-- 2. INPUT PESERTA BNBA -->
                <a href="input_pemberdayaan.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'input_pemberdayaan' ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-blue-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'input_pemberdayaan' ? 'bg-white/20 text-white' : 'bg-blue-500/15 text-blue-400 group-hover:bg-blue-500/30 group-hover:text-blue-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-user-plus text-xs"></i>
                    </div>
                    <span>Input Peserta (BNBA)</span>
                </a>
            `;
        } else if (user.role === 'produktivitas') {
            menuItemsHtml = `
                <!-- 1. DATA PENGUKURAN PRODUKTIVITAS -->
                <a href="produktivitas.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'produktivitas' ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-500/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'produktivitas' ? 'bg-white/20 text-white' : 'bg-emerald-500/15 text-emerald-400 group-hover:bg-emerald-500/30 group-hover:text-emerald-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-arrow-trend-up text-xs"></i>
                    </div>
                    <span>Data Produktivitas</span>
                </a>

                <!-- 2. INPUT DATA PRODUKTIVITAS -->
                <a href="input_produktivitas.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'input_produktivitas' ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-500/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'input_produktivitas' ? 'bg-white/20 text-white' : 'bg-emerald-500/15 text-emerald-400 group-hover:bg-emerald-500/30 group-hover:text-emerald-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-chart-line text-xs"></i>
                    </div>
                    <span>Input Produktivitas</span>
                </a>
            `;
        } else if (user.role === 'tu') {
            menuItemsHtml = `
                <!-- 1. DATA PELATIHAN UPTD -->
                <a href="pelatihan_uptd.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'pelatihan_uptd' ? 'bg-gradient-to-r from-amber-600 to-orange-600 text-white shadow-md shadow-amber-500/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'pelatihan_uptd' ? 'bg-white/20 text-white' : 'bg-amber-500/15 text-amber-400 group-hover:bg-amber-500/30 group-hover:text-amber-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-map-location-dot text-xs"></i>
                    </div>
                    <span>Pelatihan UPTD</span>
                </a>

                <!-- 2. PERJALANAN DINAS (SPD) -->
                <a href="perjalanan_dinas.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'perjalanan_dinas' || activePage === 'input_perjalanan_dinas' ? 'bg-gradient-to-r from-emerald-700 to-teal-800 text-white shadow-md shadow-emerald-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'perjalanan_dinas' || activePage === 'input_perjalanan_dinas' ? 'bg-white/20 text-white' : 'bg-emerald-500/15 text-emerald-400 group-hover:bg-emerald-500/30 group-hover:text-emerald-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-briefcase text-xs"></i>
                    </div>
                    <span>Perjalanan Dinas (SPD)</span>
                </a>

                <!-- 3. INPUT PELATIHAN UPTD -->
                <a href="input_pelatihan_uptd.php" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'input_pelatihan_uptd' ? 'bg-gradient-to-r from-amber-600 to-orange-600 text-white shadow-md shadow-amber-500/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'input_pelatihan_uptd' ? 'bg-white/20 text-white' : 'bg-amber-500/15 text-amber-400 group-hover:bg-amber-500/30 group-hover:text-amber-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                    </div>
                    <span>Input Pelatihan UPTD</span>
                </a>
            `;
        } else if (user.role === 'lsp') {
            menuItemsHtml = `
                <!-- 1. DATA SERTIFIKASI LSP -->
                <a href="sertifikasi.html" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'sertifikasi' ? 'bg-gradient-to-r from-orange-600 to-amber-600 text-white shadow-md shadow-orange-500/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'sertifikasi' ? 'bg-white/20 text-white' : 'bg-orange-500/15 text-orange-400 group-hover:bg-orange-500/30 group-hover:text-orange-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-award text-xs"></i>
                    </div>
                    <span>Data Sertifikasi LSP</span>
                </a>

                <!-- 2. INPUT SERTIFIKASI -->
                <a href="input_lsp.html" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'input_lsp' ? 'bg-gradient-to-r from-orange-600 to-amber-600 text-white shadow-md shadow-orange-500/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'input_lsp' ? 'bg-white/20 text-white' : 'bg-orange-500/15 text-orange-400 group-hover:bg-orange-500/30 group-hover:text-orange-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-id-card-clip text-xs"></i>
                    </div>
                    <span>Input Sertifikasi LSP</span>
                </a>
            `;
        } else if (user.role === 'keuangan') {
            menuItemsHtml = `
                <!-- 1. DATA KEUANGAN -->
                <a href="keuangan.html" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'keuangan' ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-500/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'keuangan' ? 'bg-white/20 text-white' : 'bg-emerald-500/15 text-emerald-400 group-hover:bg-emerald-500/30 group-hover:text-emerald-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-wallet text-xs"></i>
                    </div>
                    <span>Data Keuangan</span>
                </a>
            `;
        } else {
            // ADMIN / DEFAULT FULL ACCESS (DROPDOWN BIDANG)
            menuItemsHtml = `
                <!-- 1. DASHBOARD UTAMA -->
                <a href="dashboard.html" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${activePage === 'dashboard' ? 'bg-gradient-to-r from-emerald-700 to-teal-800 text-white shadow-md shadow-emerald-900/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'}">
                    <div class="w-6 h-6 rounded-lg ${activePage === 'dashboard' ? 'bg-white/20 text-white' : 'bg-emerald-500/15 text-emerald-400 group-hover:bg-emerald-500/30 group-hover:text-emerald-300'} flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-chart-pie text-xs"></i>
                    </div>
                    <span>Dashboard Utama</span>
                </a>

                <!-- 2. DROPDOWN MENU BIDANG -->
                <div class="space-y-1">
                    <button type="button" onclick="window.toggleBidangDropdown(event)" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold transition group ${isBidangActive ? 'bg-slate-800/80 text-white' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white'}">
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-lg ${isBidangActive ? 'bg-emerald-500/20 text-emerald-400' : 'bg-slate-800 text-slate-400 group-hover:text-white'} flex items-center justify-center shrink-0 transition">
                                <i class="fa-solid fa-sitemap text-xs"></i>
                            </div>
                            <span>Bidang</span>
                        </div>
                        <i id="bidang-chevron" class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200 ${isBidangActive ? 'rotate-180' : ''}"></i>
                    </button>

                    <div id="bidang-submenu" class="${isBidangActive ? '' : 'hidden'} space-y-1 pl-4 border-l-2 border-slate-800 ml-4 py-1">
                        
                        <!-- 1. Pemberdayaan -->
                        <a href="penempatan.html" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold transition group ${activePage === 'penempatan' || activePage === 'input_pemberdayaan' ? 'bg-blue-600/20 text-blue-400 font-bold border-l-2 border-blue-500 -ml-[16px] pl-[14px]' : 'text-slate-400 hover:text-white hover:bg-slate-800/40'}">
                            <div class="w-5 h-5 rounded-md bg-blue-500/15 text-blue-400 flex items-center justify-center shrink-0 group-hover:bg-blue-500/30 transition">
                                <i class="fa-solid fa-users text-[10px]"></i>
                            </div>
                            <span>Pemberdayaan</span>
                        </a>

                        <!-- 2. Penyelenggara -->
                        <a href="pelatihan.html" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold transition group ${activePage === 'pelatihan' || activePage === 'input_penyelenggara' ? 'bg-teal-600/20 text-teal-400 font-bold border-l-2 border-teal-500 -ml-[16px] pl-[14px]' : 'text-slate-400 hover:text-white hover:bg-slate-800/40'}">
                            <div class="w-5 h-5 rounded-md bg-teal-500/15 text-teal-400 flex items-center justify-center shrink-0 group-hover:bg-teal-500/30 transition">
                                <i class="fa-solid fa-graduation-cap text-[10px]"></i>
                            </div>
                            <span>Penyelenggara</span>
                        </a>

                        <!-- 3. Produktivitas -->
                        <a href="produktivitas.html" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold transition group ${activePage === 'produktivitas' || activePage === 'input_produktivitas' ? 'bg-emerald-600/20 text-emerald-400 font-bold border-l-2 border-emerald-500 -ml-[16px] pl-[14px]' : 'text-slate-400 hover:text-white hover:bg-slate-800/40'}">
                            <div class="w-5 h-5 rounded-md bg-emerald-500/15 text-emerald-400 flex items-center justify-center shrink-0 group-hover:bg-emerald-500/30 transition">
                                <i class="fa-solid fa-arrow-trend-up text-[10px]"></i>
                            </div>
                            <span>Produktivitas</span>
                        </a>

                        <!-- 4. Umum / TU (Di dalam TU ada Pelatihan UPTD) -->
                        <div class="space-y-0.5">
                            <button type="button" onclick="window.toggleTuDropdown(event)" class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-xs font-semibold text-slate-400 hover:text-white hover:bg-slate-800/40 transition group">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-5 h-5 rounded-md bg-amber-500/15 text-amber-400 flex items-center justify-center shrink-0 group-hover:bg-amber-500/30 transition">
                                        <i class="fa-solid fa-landmark text-[10px]"></i>
                                    </div>
                                    <span>Umum / TU</span>
                                </div>
                                <i id="tu-chevron" class="fa-solid fa-chevron-down text-[9px] text-slate-500 transition-transform duration-200 ${isTuActive ? 'rotate-180' : ''}"></i>
                            </button>
                            <div id="tu-submenu" class="${isTuActive ? '' : 'hidden'} space-y-1 pl-3.5 border-l border-slate-700 ml-4 py-0.5">
                                <a href="pelatihan_uptd.php" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-[11px] font-medium transition group ${activePage === 'pelatihan_uptd' || activePage === 'input_pelatihan_uptd' ? 'text-amber-300 font-bold bg-amber-500/20' : 'text-slate-400 hover:text-white'}">
                                    <div class="w-4 h-4 rounded bg-amber-500/20 text-amber-400 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-map-location-dot text-[9px]"></i>
                                    </div>
                                    <span>Pelatihan UPTD</span>
                                </a>
                                <a href="perjalanan_dinas.php" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-[11px] font-medium transition group ${activePage === 'perjalanan_dinas' || activePage === 'input_perjalanan_dinas' ? 'text-emerald-300 font-bold bg-emerald-500/20' : 'text-slate-400 hover:text-white'}">
                                    <div class="w-4 h-4 rounded bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-briefcase text-[9px]"></i>
                                    </div>
                                    <span>Perjalanan Dinas (SPD)</span>
                                </a>
                            </div>
                        </div>

                        <!-- 5. LSP -->
                        <a href="sertifikasi.html" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold transition group ${activePage === 'sertifikasi' || activePage === 'input_lsp' ? 'bg-orange-600/20 text-orange-400 font-bold border-l-2 border-orange-500 -ml-[16px] pl-[14px]' : 'text-slate-400 hover:text-white hover:bg-slate-800/40'}">
                            <div class="w-5 h-5 rounded-md bg-orange-500/15 text-orange-400 flex items-center justify-center shrink-0 group-hover:bg-orange-500/30 transition">
                                <i class="fa-solid fa-award text-[10px]"></i>
                            </div>
                            <span>LSP</span>
                        </a>

                        <!-- 6. Keuangan -->
                        <a href="keuangan.html" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold transition group ${activePage === 'keuangan' ? 'bg-emerald-600/20 text-emerald-400 font-bold border-l-2 border-emerald-500 -ml-[16px] pl-[14px]' : 'text-slate-400 hover:text-white hover:bg-slate-800/40'}">
                            <div class="w-5 h-5 rounded-md bg-emerald-500/15 text-emerald-400 flex items-center justify-center shrink-0 group-hover:bg-emerald-500/30 transition">
                                <i class="fa-solid fa-wallet text-[10px]"></i>
                            </div>
                            <span>Keuangan</span>
                        </a>

                        <!-- 7. Pengadaan / Pokja (Dropdown dengan Rincian Bahan di dalamnya) -->
                        <div class="space-y-0.5">
                            <button type="button" onclick="window.togglePokjaDropdown(event)" class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-xs font-semibold text-slate-400 hover:text-white hover:bg-slate-800/40 transition group">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-5 h-5 rounded-md bg-indigo-500/15 text-indigo-400 flex items-center justify-center shrink-0 group-hover:bg-indigo-500/30 transition">
                                        <i class="fa-solid fa-boxes-packing text-[10px]"></i>
                                    </div>
                                    <span>Pengadaan / Pokja</span>
                                </div>
                                <i id="pokja-chevron" class="fa-solid fa-chevron-down text-[9px] text-slate-500 transition-transform duration-200 ${isPokjaActive ? 'rotate-180' : ''}"></i>
                            </button>
                            <div id="pokja-submenu" class="${isPokjaActive ? '' : 'hidden'} space-y-1 pl-3.5 border-l border-slate-700 ml-4 py-0.5">
                                <a href="pengadaan.html" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-[11px] font-medium transition group ${activePage === 'pengadaan' ? 'text-indigo-300 font-bold bg-indigo-500/20' : 'text-slate-400 hover:text-white'}">
                                    <div class="w-4 h-4 rounded bg-indigo-500/20 text-indigo-400 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-boxes-stacked text-[9px]"></i>
                                    </div>
                                    <span>Data Pengadaan</span>
                                </a>
                                <a href="detail_pengadaan.html" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-[11px] font-medium transition group ${activePage === 'detail_pengadaan' ? 'text-indigo-300 font-bold bg-indigo-500/20' : 'text-slate-400 hover:text-white'}">
                                    <div class="w-4 h-4 rounded bg-indigo-500/20 text-indigo-400 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-calculator text-[9px]"></i>
                                    </div>
                                    <span>Rincian Bahan</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            `;
        }

        const userInitial = (user.name || 'Admin').charAt(0).toUpperCase();

        navContainer.innerHTML = `
        <!-- BACKDROP OVERLAY FOR MOBILE -->
        <div id="simpel-sidebar-backdrop" onclick="document.getElementById('simpel-sidebar').classList.add('-translate-x-full'); this.classList.add('hidden')" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-40 lg:hidden hidden transition-opacity"></div>

        <!-- MODERN SLEEK DARK SIDEBAR (PERSIS SEPERTI GAMBAR CONTOH) -->
        <aside id="simpel-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0F172A] border-r border-slate-800 text-slate-200 flex flex-col justify-between transition-transform duration-300 -translate-x-full lg:translate-x-0 shadow-2xl">
            
            <!-- SIDEBAR HEADER / BRAND LOGO -->
            <div>
                <div class="h-20 flex items-center justify-between px-6 border-b border-slate-800/80">
                    <a href="${user.homePage || 'portal.html'}" class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-teal-500 to-emerald-400 flex items-center justify-center text-slate-950 font-extrabold text-lg shadow-md shadow-teal-500/20">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg font-extrabold font-heading text-white tracking-wider leading-none">
                                SIMPEL
                            </span>
                            <span class="text-[10px] text-teal-400 font-semibold uppercase tracking-widest mt-1">
                                BPVP KENDARI
                            </span>
                        </div>
                    </a>

                    <!-- Mobile Close button -->
                    <button onclick="document.getElementById('simpel-sidebar').classList.add('-translate-x-full'); document.getElementById('simpel-sidebar-backdrop').classList.add('hidden')" class="lg:hidden p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <!-- SIDEBAR NAV ITEMS -->
                <nav class="p-4 space-y-1.5 overflow-y-auto max-h-[calc(100vh-170px)]">
                    ${menuItemsHtml}
                </nav>
            </div>

            <!-- SIDEBAR USER PROFILE FOOTER (SESUAI GAMBAR CONTOH) -->
            <div class="p-4 border-t border-slate-800/80 bg-slate-900/60">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-9 h-9 rounded-xl bg-blue-600 text-white font-extrabold text-sm flex items-center justify-center shrink-0 shadow-md shadow-blue-500/30">
                            ${userInitial}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-bold text-white truncate">${user.name}</p>
                            <span class="text-[9px] font-extrabold text-teal-300 uppercase tracking-wider block truncate">${user.roleLabel || user.role}</span>
                        </div>
                    </div>

                    <!-- Role Switcher Trigger -->
                    <div class="relative group">
                        <button type="button" class="p-2 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800 transition" title="Ganti Role (Demo)">
                            <i class="fa-solid fa-gear text-xs"></i>
                        </button>

                        <div class="absolute bottom-full right-0 mb-2 w-64 rounded-2xl bg-white text-slate-800 border border-slate-200 shadow-2xl p-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 text-xs">
                            <div class="px-3 py-1.5 text-[10px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">Ganti Role Pengguna:</div>
                            <div class="max-h-48 overflow-y-auto space-y-1 p-1">
                                <button onclick="SimpelAuth.switchRole('admin@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between">
                                    <span>1. Admin (Super Access)</span>
                                </button>
                                <button onclick="SimpelAuth.switchRole('pimpinan@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between">
                                    <span>2. Pimpinan (Dashboard)</span>
                                </button>
                                <button onclick="SimpelAuth.switchRole('penyelenggara@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between">
                                    <span>3. Penyelenggara (Pelatihan)</span>
                                </button>
                                <button onclick="SimpelAuth.switchRole('pemberdayaan@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between">
                                    <span>4. Pemberdayaan (Alumni)</span>
                                </button>
                                <button onclick="SimpelAuth.switchRole('lsp@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between">
                                    <span>5. LSP (Sertifikasi)</span>
                                </button>
                                <button onclick="SimpelAuth.switchRole('produktivitas@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between">
                                    <span>6. Produktivitas (UMKM)</span>
                                </button>
                                <button onclick="SimpelAuth.switchRole('pengadaan@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between">
                                    <span>7. Pengadaan / Pokja</span>
                                </button>
                                <button onclick="SimpelAuth.switchRole('umum@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between">
                                    <span>8. Umum / TU (UPTD)</span>
                                </button>
                                <button onclick="SimpelAuth.switchRole('keuangan@bpvpkendari.go.id')" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-100 flex items-center justify-between">
                                    <span>9. Keuangan & SP2D</span>
                                </button>
                            </div>
                            <div class="border-t border-slate-100 pt-1">
                                <button onclick="SimpelAuth.logout()" class="w-full py-1.5 text-center text-rose-600 font-bold hover:bg-rose-50 rounded-lg">
                                    Keluar (Logout)
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </aside>

        <!-- TOP MOBILE APP BAR TOGGLE -->
        <div class="lg:hidden sticky top-0 z-40 bg-[#0F172A] text-white px-4 py-3 flex items-center justify-between border-b border-slate-800 shadow-md">
            <button onclick="document.getElementById('simpel-sidebar').classList.remove('-translate-x-full'); document.getElementById('simpel-sidebar-backdrop').classList.remove('hidden')" class="p-2 rounded-xl bg-slate-800 text-white">
                <i class="fa-solid fa-bars text-sm"></i>
            </button>
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-teal-500 text-slate-950 font-black text-xs flex items-center justify-center">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <span class="font-bold text-sm tracking-wide">SIMPEL</span>
            </div>
            <div class="w-7 h-7 rounded-lg bg-blue-600 text-white font-bold text-xs flex items-center justify-center">
                ${userInitial}
            </div>
        </div>
        `;

        // Universal Responsive Layout Engine: Fixes horizontal overflow across all screen sizes
        if (!document.getElementById('simpel-responsive-layout-style')) {
            const style = document.createElement('style');
            style.id = 'simpel-responsive-layout-style';
            style.textContent = `
                @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap');
                
                html, body, button, input, select, textarea, p, span, h1, h2, h3, h4, h5, h6, a, div, label, table, th, td, .font-heading {
                    font-family: 'Montserrat', sans-serif;
                }

                /* ENFORCE & PROTECT FONT AWESOME ICONS FROM BEING OVERRIDDEN */
                i, [class*="fa-"], .fa, .fas, .far, .fal, .fad, .fab, .fa-solid, .fa-regular, .fa-brands {
                    font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands", "FontAwesome" !important;
                    display: inline-block;
                    font-style: normal;
                    font-variant: normal;
                    text-rendering: auto;
                    line-height: 1;
                    -webkit-font-smoothing: antialiased;
                }
                .fa-regular {
                    font-weight: 400 !important;
                }
                .fa-solid, .fas {
                    font-weight: 900 !important;
                }
                .fa-brands, .fab {
                    font-weight: 400 !important;
                    font-family: "Font Awesome 6 Brands" !important;
                }
                html, body {
                    max-width: 100vw;
                    overflow-x: hidden;
                }
                /* Sleek modern custom scrollbar */
                ::-webkit-scrollbar {
                    width: 6px;
                    height: 6px;
                }
                ::-webkit-scrollbar-track {
                    background: transparent;
                }
                ::-webkit-scrollbar-thumb {
                    background: #cbd5e1;
                    border-radius: 9999px;
                }
                ::-webkit-scrollbar-thumb:hover {
                    background: #94a3b8;
                }
                @media (min-width: 1024px) {
                    body {
                        padding-left: 16rem !important; /* 256px for sidebar */
                        box-sizing: border-box !important;
                        width: 100% !important;
                    }
                    main {
                        margin-left: 0 !important;
                        width: 100% !important;
                        max-width: 100% !important;
                        min-width: 0 !important;
                        box-sizing: border-box !important;
                    }
                    footer {
                        margin-left: 0 !important;
                        width: 100% !important;
                        min-width: 0 !important;
                        box-sizing: border-box !important;
                    }
                }
                @media print {
                    body {
                        padding-left: 0 !important;
                    }
                    #simpel-sidebar, #simpel-unified-header, #simpel-sidebar-backdrop {
                        display: none !important;
                    }
                }
            `;
            document.head.appendChild(style);
        }

        document.body.classList.add('overflow-x-hidden');
        const mainEl = document.querySelector('main');
        if (mainEl) {
            mainEl.classList.remove('lg:ml-64');
            mainEl.classList.add('min-w-0');
        }
        const footerEl = document.querySelector('footer');
        if (footerEl) {
            footerEl.classList.remove('lg:ml-64');
        }
    }
};

window.SimpelAuth = SimpelAuth;
window.SIMPEL_DATA = SIMPEL_DATA;
