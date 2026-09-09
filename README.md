# SIMPEL BPVP Kendari - Sistem Informasi Pelatihan Vokasi & Produktivitas

Aplikasi Web Terpadu Pelatihan, Sertifikasi, Penempatan, Produktivitas, dan Administrasi BPVP Kendari berbasis **Laravel & Tailwind CSS** untuk Self-Hosting.

---

## 🌟 Fitur Utama

1. **Unified Headbar & Navigation**:
   - Struktur navbar modern dan seragam di semua halaman.
   - Filter tahun anggaran global (2026, 2025, 2024).
   - Menu profil pengguna, quick input workspace, dan mobile responsive drawer.
2. **Dashboard Eksekutif**:
   - Grafik interaktif capaian target vs realisasi (PBK Kelembagaan, MTU, Tailor Made, UPTD, LSP).
   - Rasio peserta laki-laki vs perempuan.
   - Realisasi anggaran DIPA & rincian sasaran strategis.
3. **Data Pages Lengkap**:
   - **Pelatihan UPTP**: Data paket pelatihan, rasio gender, kelulusan, jadwal kelas, filter kejuruan & status.
   - **Pelatihan UPTD**: Multi-tab explorer 5 BLK binaan (Kolaka, Kolaka Utara, Konawe Selatan, Konawe Utara, Buton) dengan sebaran usia & pendidikan.
   - **Sertifikasi LSP**: Master data asesi, skema BNSP, TUK, asesor, hasil UJK (Kompeten/BK), status cetak blanko sertifikat.
   - **Penempatan Alumni**: Pelacakan alumni bekerja, wirausaha mandiri, perusahaan mitra DUDI, dan rasio keterserapan kerja.
   - **Produktivitas**: Bimbingan konsultasi UMKM, metodologi 5S/Kaizen, pendampingan sektor industri.
   - **Umum & Keuangan**: Dual-tab pengadaan logistik/bahan praktek dan log pembayaran SP2D.
4. **Formulir Input Terstruktur (Redesain Total)**:
   - Menghapus tombol-tombol input yang berantakan.
   - Menggunakan layout kartu multi-tahap dengan validasi dan action bar yang bersih (*Simpan, Reset, Kembali*).
5. **Ekspor Data**:
   - Fitur ekspor data langsung ke format Excel/CSV untuk setiap modul.

---

## 🚀 Panduan Menjalankan & Self-Hosting (Laravel)

### Prasyarat:
- PHP 8.1 / 8.2 atau lebih tinggi
- Composer
- Database MySQL atau SQLite

### Langkah Instalasi:

1. **Install Dependencies**:
   ```bash
   composer install
   ```

2. **Konfigurasi Environment**:
   Salin `.env.example` ke `.env`:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Migrasi & Seeding Data Master 2026**:
   ```bash
   php artisan migrate:fresh --seed
   ```

4. **Jalankan Server**:
   ```bash
   php artisan serve
   ```
   Buka browser di: `http://localhost:8000`

### Akun Login Demo:
- **Email**: `admin@bpvpkendari.go.id`
- **Password**: `password`

---

## 📂 Struktur Direktori Laravel

- `app/Models/`: Model Eloquent untuk ProgramPelatihan, PelatihanUptd, Sertifikasi, Penempatan, Produktivitas, Pengadaan, Pembayaran, RealisasiAnggaran.
- `app/Http/Controllers/`: Controller untuk Dashboard, Pelatihan, Sertifikasi, Penempatan, Produktivitas, Umum, Input, Auth, dan Export.
- `database/migrations/`: Skema database lengkap.
- `database/seeders/`: Data master BPVP Kendari 2026.
- `resources/views/layouts/app.blade.php`: Unified layout & header.
- `resources/views/pages/`: Seluruh tampilan data page dan form input.
- `routes/web.php`: Rute web aplikasi.
