-- ==========================================================
-- SISTEM INFORMASI MANAJEMEN PELATIHAN (SIMPEL) BPVP KENDARI
-- BASIS DATA: MySQL
-- TAHUN ANGGARAN: 2026
-- ==========================================================

CREATE DATABASE IF NOT EXISTS `simpel_bpvp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `simpel_bpvp`;

-- ----------------------------------------------------------
-- 1. TABEL PENGGUNA (USERS & OTENTIKASI)
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(50) NOT NULL,
  `role_label` VARCHAR(100) NOT NULL,
  `nip` VARCHAR(50) DEFAULT NULL,
  `phone` VARCHAR(30) DEFAULT NULL,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Pre-seeded data untuk 9 Peran Resmi BPVP Kendari
-- Password default seluruh akun di bawah adalah: bpvp2026!
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `role_label`, `nip`, `phone`) VALUES
(1, 'Administrator SIMPEL', 'admin@bpvpkendari.go.id', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'admin', 'Super Administrator BPVP', '198501152010121001', '081245678901'),
(2, 'Kepala BPVP Kendari', 'pimpinan@bpvpkendari.go.id', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'pimpinan', 'Kepala Balai (Pimpinan)', '197603122002121002', '081140001234'),
(3, 'Koordinator Penyelenggara', 'penyelenggara@bpvpkendari.go.id', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'penyelenggara', 'Bidang Penyelenggara Pelatihan', '198207192008041003', '081355443322'),
(4, 'Koordinator Pemberdayaan', 'pemberdayaan@bpvpkendari.go.id', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'pemberdayaan', 'Bidang Pemberdayaan & Penempatan', '198705232012122004', '085299887766'),
(5, 'Ketua LSP BPVP Kendari', 'lsp@bpvpkendari.go.id', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'lsp', 'LSP P-2 BPVP Kendari', '198009142006041005', '082199001122'),
(6, 'Instruktur Produktivitas', 'produktivitas@bpvpkendari.go.id', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'produktivitas', 'Bidang Peningkatan Produktivitas', '198904102014021006', '081242334455'),
(7, 'Pokja Pengadaan Barang & Jasa', 'pengadaan@bpvpkendari.go.id', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'pengadaan', 'Pokja Pengadaan Bahan & Logistik', '198411082009031007', '085341223344'),
(8, 'Subbag Umum & Tata Usaha', 'tu@bpvpkendari.go.id', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'tu', 'Bagian Umum / TU & UPTD', '198106202007011008', '081140556677'),
(9, 'Bendahara Pengeluaran', 'keuangan@bpvpkendari.go.id', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'keuangan', 'Bidang Keuangan & SP2D', '198602182010122009', '082345678910');

-- ----------------------------------------------------------
-- 2. TABEL PENGADAAN & RINCIAN BAHAN PELATIHAN
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `procurements`;
CREATE TABLE `procurements` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `program` VARCHAR(150) NOT NULL,
  `batch` VARCHAR(50) NOT NULL,
  `kejuruan` VARCHAR(100) NOT NULL,
  `jenis_pelatihan` VARCHAR(50) DEFAULT 'PBK Reguler',
  `tgl_mulai` DATE DEFAULT NULL,
  `tgl_selesai` DATE DEFAULT NULL,
  `item_name` VARCHAR(200) NOT NULL,
  `kategori` VARCHAR(100) NOT NULL,
  `spesifikasi` TEXT,
  `qty` INT NOT NULL DEFAULT 1,
  `satuan` VARCHAR(50) NOT NULL,
  `harga_satuan` DECIMAL(15,2) NOT NULL DEFAULT 0.00,
  `total_harga` DECIMAL(15,2) NOT NULL DEFAULT 0.00,
  `rekanan` VARCHAR(150) DEFAULT NULL,
  `status_pokja` VARCHAR(50) DEFAULT 'Lengkap (BAST)',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `procurements` (`program`, `batch`, `kejuruan`, `jenis_pelatihan`, `item_name`, `kategori`, `spesifikasi`, `qty`, `satuan`, `harga_satuan`, `total_harga`, `rekanan`, `status_pokja`) VALUES
('Junior Web Developer', 'Batch 1', 'TIK', 'PBK Reguler', 'Baju Seragam Praktek TIK & Kaos Polo', 'Pakaian & Seragam', 'Cotton Combed 24s Bordir Logo Kemnaker & BPVP', 16, 'Stel', 175000.00, 2800000.00, 'CV Mega Konveksi Kendari', 'Lengkap (BAST)'),
('Junior Web Developer', 'Batch 1', 'TIK', 'PBK Reguler', 'Flashdisk SanDisk Ultra 64GB', 'Bahan Praktek', 'USB 3.0 Original Garansi Resmi 5 Tahun', 16, 'Unit', 95000.00, 1520000.00, 'Toko Anoa Komputer Kendari', 'Lengkap (BAST)'),
('Junior Web Developer', 'Batch 1', 'TIK', 'PBK Reguler', 'Modul Cetak SKKNI Junior Web Developer', 'Modul / ATK', 'Full Color 180 Halaman HVS 80gr Jilid Spiral', 16, 'Buku', 85000.00, 1360000.00, 'Percetakan Sultra Grafika', 'Lengkap (BAST)'),
('Junior Web Developer', 'Batch 1', 'TIK', 'PBK Reguler', 'Uang Saku Peserta Pelatihan', 'Uang Saku Siswa', 'Standar Biaya Masukan PMK (Rp 30.000/hari x 28 hari)', 16, 'Paket', 840000.00, 13440000.00, 'Penyaluran Bank BNI Kas BPVP', 'Lengkap (BAST)'),
('Pengelasan SMAW 3G', 'Batch 1', 'Teknik Las', 'PBK Reguler', 'Wearpack Katun Anti Percikan Api & Apron Kulit', 'Pakaian & Seragam', 'Bahan Drill Tebal Dilengkapi Apron Kulit Asli', 16, 'Stel', 250000.00, 4000000.00, 'CV Citra Usaha Kendari', 'Lengkap (BAST)'),
('Pengelasan SMAW 3G', 'Batch 1', 'Teknik Las', 'PBK Reguler', 'Elektroda E7018 & Plat Baja 10mm', 'Bahan Praktek', 'Kobe Steel LB-52 3.2mm & Plat Baja SS400', 32, 'Kotak', 462500.00, 14800000.00, 'PT Logam Mulia Sulawesi', 'Lengkap (BAST)'),
('Pengelasan SMAW 3G', 'Batch 1', 'Teknik Las', 'PBK Reguler', 'Sepatu Safety Boots K3 Siswa', 'Alat / Bahan Praktek', 'Ujung Besi Baja Toe Cap Standar SNI', 16, 'Pasang', 225000.00, 3600000.00, 'Toko Safety Mandiri', 'Lengkap (BAST)'),
('Barista & Pengolahan Kopi', 'Batch 1', 'Pariwisata', 'PBL', 'Biji Kopi Arabika Toraja & Robusta Kolaka', 'Bahan Praktek', 'Fresh Roast Medium to Dark Kemasan One-Way Valve', 25, 'Kg', 180000.00, 4500000.00, 'CV Kopi Sultra Berkah', 'Lengkap (BAST)'),
('Desainer Grafis Muda', 'Batch 2', 'TIK & Seni', 'PBK Reguler', 'Drawing Pen Tablet & Kertas Glossy A3', 'Alat / Bahan Praktek', 'Drawing Pad Stylus Pen 8192 Pressure Levels', 16, 'Set', 600000.00, 9600000.00, 'CV Digital Kreatif Nusantara', 'Dalam Pengiriman (PO)'),
('Teknik Otomotif Kendaraan Ringan', 'Batch 2', 'Otomotif', 'PBK Reguler', 'Oli Mesin SAE 10W-40 & Kampas Rem Genuine', 'Bahan Praktek', 'Synthetic Lubricant 4L & Brake Shoe Set', 20, 'Galon', 410000.00, 8200000.00, 'PT Sultra Motor Perkasa', 'Verifikasi Dokumen');

-- ----------------------------------------------------------
-- 3. TABEL SURAT PERINTAH KERJA (SPK) & NOTA PESANAN
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `orders_spk`;
CREATE TABLE `orders_spk` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `no_spk` VARCHAR(100) NOT NULL,
  `tgl_spk` DATE NOT NULL,
  `paket_pekerjaan` VARCHAR(200) NOT NULL,
  `nama_rekanan` VARCHAR(150) NOT NULL,
  `npwp_rekanan` VARCHAR(50) DEFAULT NULL,
  `nilai_kontrak` DECIMAL(15,2) NOT NULL DEFAULT 0.00,
  `jangka_waktu` VARCHAR(50) DEFAULT '30 Hari Kalender',
  `status` ENUM('Draft', 'Ditandatangani', 'Selesai BAST', 'Terbayar SP2D') DEFAULT 'Ditandatangani',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `orders_spk` (`no_spk`, `tgl_spk`, `paket_pekerjaan`, `nama_rekanan`, `npwp_rekanan`, `nilai_kontrak`, `status`) VALUES
('SPK.01/BPVP-KDI/PL/2026', '2026-02-10', 'Pengadaan Seragam & Wearpack Pelatihan Siswa Batch 1', 'CV Mega Konveksi Kendari', '01.234.567.8-811.000', 14500000.00, 'Selesai BAST'),
('SPK.02/BPVP-KDI/PL/2026', '2026-02-15', 'Pengadaan Bahan Praktek Elektroda & Plat Baja Workshop Las', 'PT Logam Mulia Sulawesi', '02.456.789.0-811.000', 18400000.00, 'Selesai BAST'),
('SPK.03/BPVP-KDI/PL/2026', '2026-03-01', 'Pengadaan Bahan Praktek & Biji Kopi Workshop Barista', 'CV Kopi Sultra Berkah', '03.789.012.3-811.000', 4500000.00, 'Terbayar SP2D'),
('SPK.04/BPVP-KDI/PL/2026', '2026-03-10', 'Pengadaan Modul Cetak Kurikulum Vokasi 8 Kejuruan', 'Percetakan Sultra Grafika', '04.890.123.4-811.000', 11200000.00, 'Ditandatangani');

-- ----------------------------------------------------------
-- 4. TABEL PERJALANAN DINAS & SURAT PERJALANAN DINAS (SPD)
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `travel_orders`;
CREATE TABLE `travel_orders` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `no_st` VARCHAR(100) NOT NULL,
  `tgl_st` DATE NOT NULL,
  `nama_pejabat` VARCHAR(150) NOT NULL,
  `jabatan` VARCHAR(100) NOT NULL,
  `is_pimpinan` TINYINT(1) DEFAULT 0,
  `maksud_tugas` TEXT NOT NULL,
  `kota_asal` VARCHAR(100) DEFAULT 'Kendari',
  `kota_tujuan` VARCHAR(150) NOT NULL,
  `kategori_wilayah` ENUM('luar', 'dalam') DEFAULT 'luar',
  `tgl_berangkat` DATE NOT NULL,
  `tgl_kembali` DATE NOT NULL,
  `lama_hari` VARCHAR(50) DEFAULT '1 Hari',
  `beban_anggaran` VARCHAR(150) DEFAULT 'DIPA BPVP Kendari TA 2026',
  `total_biaya` DECIMAL(15,2) DEFAULT 0.00,
  `status` ENUM('Terjadwal', 'Sedang Berjalan', 'Selesai') DEFAULT 'Terjadwal',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `travel_orders` (`no_st`, `tgl_st`, `nama_pejabat`, `jabatan`, `is_pimpinan`, `maksud_tugas`, `kota_asal`, `kota_tujuan`, `kategori_wilayah`, `tgl_berangkat`, `tgl_kembali`, `lama_hari`, `beban_anggaran`, `total_biaya`, `status`) VALUES
('ST.018/BPVP-KDI/TU/IV/2026', '2026-04-08', 'La Ode Haji Polingai, S.E., M.M.', 'Kepala BPVP Kendari', 1, 'Rapat Koordinasi Nasional Pelatihan Vokasi & Kemitraan Industri Tahun 2026', 'Kendari', 'Jakarta (Kemnaker RI)', 'luar', '2026-04-12', '2026-04-15', '4 Hari', 'DIPA BPVP Kendari', 14850000.00, 'Terjadwal'),
('ST.019/BPVP-KDI/TU/IV/2026', '2026-04-10', 'Drs. Ahmad Yani, M.Si', 'Subkoordinator Tata Usaha', 0, 'Supervisi Fasilitas & Sinkronisasi Kurikulum Bersama UPTD BLK Konawe', 'Kendari', 'Kabupaten Konawe', 'dalam', '2026-04-20', '2026-04-21', '2 Hari', 'DIPA BPVP Kendari', 2300000.00, 'Terjadwal'),
('ST.014/BPVP-KDI/TU/III/2026', '2026-03-22', 'La Ode Haji Polingai, S.E., M.M.', 'Kepala BPVP Kendari', 1, 'Penandatanganan Nota Kesepahaman (MoU) Kemitraan Magang Siswa dengan PT VDNI', 'Kendari', 'Kawasan Industri Morosi (Konawe)', 'dalam', '2026-03-25', '2026-03-26', '2 Hari', 'DIPA BPVP Kendari', 3200000.00, 'Selesai');

