<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramPelatihan;
use App\Models\PelatihanUptd;
use App\Models\Sertifikasi;
use App\Models\Penempatan;
use App\Models\Produktivitas;
use App\Models\Pengadaan;
use App\Models\Pembayaran;
use App\Models\TargetRealisasi;
use App\Models\RealisasiAnggaran;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Program Pelatihan UPTP 2026
        $programs = [
            [
                'nomor' => 1,
                'kejuruan' => 'Teknologi Informasi dan Komunikasi (TIK)',
                'program_pelatihan' => 'Junior Web Developer - Batch 1',
                'jenis_pelatihan' => 'PBK Kelembagaan',
                'target_peserta' => 16,
                'jumlah_peserta' => 16,
                'perempuan' => 7,
                'laki_laki' => 9,
                'tgl_masuk' => '2026-01-15',
                'tgl_mulai' => '2026-02-02',
                'tgl_selesai' => '2026-03-20',
                'bulan_mulai' => 'Februari',
                'lulus' => 16,
                'tidak_lulus' => 0,
                'status_alur' => 'Selesai',
                'tahun' => 2026,
                'keterangan' => 'Pelatihan kompetensi berbasis SKKNI'
            ],
            [
                'nomor' => 2,
                'kejuruan' => 'Teknik Manufaktur dan Rekayasa (Las)',
                'program_pelatihan' => 'Pengelasan SMAW 3G - Batch 1',
                'jenis_pelatihan' => 'PBK Kelembagaan',
                'target_peserta' => 16,
                'jumlah_peserta' => 16,
                'perempuan' => 1,
                'laki_laki' => 15,
                'tgl_masuk' => '2026-01-20',
                'tgl_mulai' => '2026-02-05',
                'tgl_selesai' => '2026-03-28',
                'bulan_mulai' => 'Februari',
                'lulus' => 15,
                'tidak_lulus' => 1,
                'status_alur' => 'Selesai',
                'tahun' => 2026,
                'keterangan' => 'Kualifikasi sertifikasi 3G posisi vertikal'
            ],
            [
                'nomor' => 3,
                'kejuruan' => 'Teknik Otomotif',
                'program_pelatihan' => 'Teknisi Servis Sepeda Motor Injeksi - Batch 1',
                'jenis_pelatihan' => 'PBK Kelembagaan',
                'target_peserta' => 16,
                'jumlah_peserta' => 16,
                'perempuan' => 2,
                'laki_laki' => 14,
                'tgl_masuk' => '2026-02-10',
                'tgl_mulai' => '2026-02-23',
                'tgl_selesai' => '2026-04-10',
                'bulan_mulai' => 'Februari',
                'lulus' => 16,
                'tidak_lulus' => 0,
                'status_alur' => 'Selesai',
                'tahun' => 2026,
                'keterangan' => 'Praktek langsung diagnosa OBD/Scan tools'
            ],
            [
                'nomor' => 4,
                'kejuruan' => 'Teknik Ketenagalistrikan',
                'program_pelatihan' => 'Instalasi Penerangan Bangunan Sederhana - Batch 1',
                'jenis_pelatihan' => 'PBK Kelembagaan',
                'target_peserta' => 16,
                'jumlah_peserta' => 16,
                'perempuan' => 3,
                'laki_laki' => 13,
                'tgl_masuk' => '2026-03-01',
                'tgl_mulai' => '2026-03-16',
                'tgl_selesai' => '2026-05-08',
                'bulan_mulai' => 'Maret',
                'lulus' => 16,
                'tidak_lulus' => 0,
                'status_alur' => 'Selesai',
                'tahun' => 2026,
                'keterangan' => 'Pemasangan instalasi listrik rumah tinggal & standar PUIL'
            ],
            [
                'nomor' => 5,
                'kejuruan' => 'Pariwisata & Perhotelan',
                'program_pelatihan' => 'Barista dan Tata Hidang Kopi - Batch 1',
                'jenis_pelatihan' => 'PBK Kelembagaan',
                'target_peserta' => 16,
                'jumlah_peserta' => 16,
                'perempuan' => 9,
                'laki_laki' => 7,
                'tgl_masuk' => '2026-04-05',
                'tgl_mulai' => '2026-04-20',
                'tgl_selesai' => '2026-05-30',
                'bulan_mulai' => 'April',
                'lulus' => 16,
                'tidak_lulus' => 0,
                'status_alur' => 'Selesai',
                'tahun' => 2026,
                'keterangan' => 'Espresso preparation, latte art, cupping'
            ],
            [
                'nomor' => 6,
                'kejuruan' => 'Garmen Apparel',
                'program_pelatihan' => 'Menjahit Pakaian Pria & Wanita - Batch 1',
                'jenis_pelatihan' => 'PBK Kelembagaan',
                'target_peserta' => 16,
                'jumlah_peserta' => 16,
                'perempuan' => 14,
                'laki_laki' => 2,
                'tgl_masuk' => '2026-05-02',
                'tgl_mulai' => '2026-05-18',
                'tgl_selesai' => '2026-07-04',
                'bulan_mulai' => 'Mei',
                'lulus' => 0,
                'tidak_lulus' => 0,
                'status_alur' => 'Berjalan',
                'tahun' => 2026,
                'keterangan' => 'Pembuatan pola dasar, potong bahan, dan jahit industri'
            ],
            [
                'nomor' => 7,
                'kejuruan' => 'Teknologi Informasi dan Komunikasi (TIK)',
                'program_pelatihan' => 'Desainer Grafis Muda - Batch 2',
                'jenis_pelatihan' => 'PBK Kelembagaan',
                'target_peserta' => 16,
                'jumlah_peserta' => 16,
                'perempuan' => 8,
                'laki_laki' => 8,
                'tgl_masuk' => '2026-06-01',
                'tgl_mulai' => '2026-06-15',
                'tgl_selesai' => '2026-07-31',
                'bulan_mulai' => 'Juni',
                'lulus' => 0,
                'tidak_lulus' => 0,
                'status_alur' => 'Berjalan',
                'tahun' => 2026,
                'keterangan' => 'Photoshop, Illustrator, Layouting media cetak'
            ],
            [
                'nomor' => 8,
                'kejuruan' => 'Bisnis dan Manajemen',
                'program_pelatihan' => 'Pengelolaan Administrasi Perkantoran - Batch 1',
                'jenis_pelatihan' => 'Tailor Made Training',
                'target_peserta' => 16,
                'jumlah_peserta' => 16,
                'perempuan' => 11,
                'laki_laki' => 5,
                'tgl_masuk' => '2026-07-10',
                'tgl_mulai' => '2026-08-01',
                'tgl_selesai' => '2026-09-15',
                'bulan_mulai' => 'Agustus',
                'lulus' => 0,
                'tidak_lulus' => 0,
                'status_alur' => 'Terverifikasi',
                'tahun' => 2026,
                'keterangan' => 'Pengarsipan digital & spreadsheet advance'
            ],
            [
                'nomor' => 9,
                'kejuruan' => 'Teknik Bangunan & Konstruksi',
                'program_pelatihan' => 'Juru Gambar Bangunan CAD - Batch 1',
                'jenis_pelatihan' => 'PBK Kelembagaan',
                'target_peserta' => 16,
                'jumlah_peserta' => 0,
                'perempuan' => 0,
                'laki_laki' => 0,
                'tgl_masuk' => '2026-08-15',
                'tgl_mulai' => '2026-09-01',
                'tgl_selesai' => '2026-10-20',
                'bulan_mulai' => 'September',
                'lulus' => 0,
                'tidak_lulus' => 0,
                'status_alur' => 'Draft',
                'tahun' => 2026,
                'keterangan' => 'AutoCAD 2D & 3D Modeling'
            ],
        ];

        foreach ($programs as $prog) {
            ProgramPelatihan::create($prog);
        }

        // 2. Pelatihan UPTD
        $uptds = [
            ['uptd' => 'Kolaka', 'kejuruan' => 'Otomotif', 'program' => 'Servis Motor Konvensional', 'peserta' => 16, 'p' => 0, 'l' => 16, 's1' => 2, 'd3' => 1, 'sma' => 11, 'smp' => 2, 'sd' => 0, 'dis' => 0, 'u1' => 9, 'u2' => 4, 'u3' => 2, 'u4' => 1, 'u5' => 0],
            ['uptd' => 'Kolaka', 'kejuruan' => 'Garmen Apparel', 'program' => 'Menjahit Busana Wanita', 'peserta' => 16, 'p' => 16, 'l' => 0, 's1' => 3, 'd3' => 2, 'sma' => 9, 'smp' => 2, 'sd' => 0, 'dis' => 0, 'u1' => 7, 'u2' => 5, 'u3' => 3, 'u4' => 1, 'u5' => 0],
            ['uptd' => 'Kolaka Utara', 'kejuruan' => 'Pengolahan Hasil Pertanian', 'program' => 'Pengolahan Kakao & Kopi', 'peserta' => 16, 'p' => 10, 'l' => 6, 's1' => 4, 'd3' => 1, 'sma' => 10, 'smp' => 1, 'sd' => 0, 'dis' => 0, 'u1' => 6, 'u2' => 6, 'u3' => 3, 'u4' => 1, 'u5' => 0],
            ['uptd' => 'Kolaka Utara', 'kejuruan' => 'Las', 'program' => 'Las Plate SMAW 2G', 'peserta' => 16, 'p' => 0, 'l' => 16, 's1' => 1, 'd3' => 2, 'sma' => 12, 'smp' => 1, 'sd' => 0, 'dis' => 0, 'u1' => 10, 'u2' => 4, 'u3' => 2, 'u4' => 0, 'u5' => 0],
            ['uptd' => 'Konawe Selatan', 'kejuruan' => 'Listrik', 'program' => 'Pemasangan Instalasi Listrik Bangunan Sederhana', 'peserta' => 16, 'p' => 1, 'l' => 15, 's1' => 2, 'd3' => 0, 'sma' => 12, 'smp' => 2, 'sd' => 0, 'dis' => 0, 'u1' => 8, 'u2' => 5, 'u3' => 2, 'u4' => 1, 'u5' => 0],
            ['uptd' => 'Konawe Selatan', 'kejuruan' => 'TIK', 'program' => 'Practical Office Advance', 'peserta' => 16, 'p' => 9, 'l' => 7, 's1' => 6, 'd3' => 3, 'sma' => 7, 'smp' => 0, 'sd' => 0, 'dis' => 1, 'u1' => 8, 'u2' => 6, 'u3' => 2, 'u4' => 0, 'u5' => 0],
            ['uptd' => 'Konawe Utara', 'kejuruan' => 'Alat Berat', 'program' => 'Operator Excavator Kelas 1', 'peserta' => 16, 'p' => 0, 'l' => 16, 's1' => 1, 'd3' => 1, 'sma' => 13, 'smp' => 1, 'sd' => 0, 'dis' => 0, 'u1' => 9, 'u2' => 5, 'u3' => 2, 'u4' => 0, 'u5' => 0],
            ['uptd' => 'Buton', 'kejuruan' => 'Pariwisata', 'program' => 'Pemandu Wisata Selam & Homestay', 'peserta' => 16, 'p' => 6, 'l' => 10, 's1' => 4, 'd3' => 2, 'sma' => 10, 'smp' => 0, 'sd' => 0, 'dis' => 0, 'u1' => 10, 'u2' => 4, 'u3' => 2, 'u4' => 0, 'u5' => 0],
        ];

        $noU = 1;
        foreach ($uptds as $u) {
            PelatihanUptd::create([
                'nomor' => $noU++,
                'uptd_name' => $u['uptd'],
                'kejuruan' => $u['kejuruan'],
                'program_pelatihan' => $u['program'],
                'jumlah_peserta' => $u['peserta'],
                'perempuan' => $u['p'],
                'laki_laki' => $u['l'],
                'edu_s1_d4' => $u['s1'],
                'edu_d3' => $u['d3'],
                'edu_sma_smk' => $u['sma'],
                'edu_smp' => $u['smp'],
                'edu_sd' => $u['sd'],
                'disabilitas' => $u['dis'],
                'age_17_24' => $u['u1'],
                'age_25_28' => $u['u2'],
                'age_29_34' => $u['u3'],
                'age_35_40' => $u['u4'],
                'age_41_dst' => $u['u5'],
                'tahun' => 2026
            ]);
        }

        // 3. Sertifikasi LSP
        $sertifikasis = [
            [
                'nomor' => 1,
                'skema' => 'Pemrograman Web (Junior Web Developer)',
                'tuk' => 'TUK Sewaktu Lab Komputer BPVP Kendari',
                'tahap' => 'Tahap 1',
                'tanggal_pendaftaran' => '2026-03-22',
                'nama_lengkap' => 'Ahmad Fauzi Pratama',
                'nomor_ktp' => '7471012204990001',
                'tempat_lahir' => 'Kendari',
                'tanggal_lahir' => '1999-04-22',
                'jenis_kelamin' => 'L',
                'alamat_rumah' => 'Jl. Bunga Melati No. 12, Kendari Barat',
                'nomor_telepon' => '081298765432',
                'email' => 'fauzi.pratama@gmail.com',
                'kualifikasi_pendidikan' => 'S1 Teknik Informatika',
                'kebangsaan' => 'WNI',
                'asesor' => 'Ir. Hendra Saputra, M.Kom (MET.000.001)',
                'form_apl_01_02' => 'Lengkap',
                'hasil_ujk' => 'Kompeten',
                'cetak_sertifikat' => 'Sudah',
                'tahun' => 2026
            ],
            [
                'nomor' => 2,
                'skema' => 'Pemrograman Web (Junior Web Developer)',
                'tuk' => 'TUK Sewaktu Lab Komputer BPVP Kendari',
                'tahap' => 'Tahap 1',
                'tanggal_pendaftaran' => '2026-03-22',
                'nama_lengkap' => 'Siti Nurhaliza',
                'nomor_ktp' => '7471025508010003',
                'tempat_lahir' => 'Unaaha',
                'tanggal_lahir' => '2001-08-15',
                'jenis_kelamin' => 'P',
                'alamat_rumah' => 'Jl. Abunawas No. 45, Mandonga, Kendari',
                'nomor_telepon' => '082199887766',
                'email' => 'siti.nurhaliza21@gmail.com',
                'kualifikasi_pendidikan' => 'D3 Manajemen Informatika',
                'kebangsaan' => 'WNI',
                'asesor' => 'Ir. Hendra Saputra, M.Kom (MET.000.001)',
                'form_apl_01_02' => 'Lengkap',
                'hasil_ujk' => 'Kompeten',
                'cetak_sertifikat' => 'Sudah',
                'tahun' => 2026
            ],
            [
                'nomor' => 3,
                'skema' => 'Pengelasan SMAW 3G',
                'tuk' => 'TUK Workshop Las BPVP Kendari',
                'tahap' => 'Tahap 1',
                'tanggal_pendaftaran' => '2026-03-30',
                'nama_lengkap' => 'Muh. Rizal Anugrah',
                'nomor_ktp' => '7471031102000004',
                'tempat_lahir' => 'Kendari',
                'tanggal_lahir' => '2000-02-11',
                'jenis_kelamin' => 'L',
                'alamat_rumah' => 'Jl. Chairil Anwar No. 88, Puuwatu',
                'nomor_telepon' => '085241001122',
                'email' => 'rizal.welder99@gmail.com',
                'kualifikasi_pendidikan' => 'SMK Teknik Mesin',
                'kebangsaan' => 'WNI',
                'asesor' => 'Bambang Irawan, S.T. (MET.000.014)',
                'form_apl_01_02' => 'Lengkap',
                'hasil_ujk' => 'Kompeten',
                'cetak_sertifikat' => 'Sudah',
                'tahun' => 2026
            ],
            [
                'nomor' => 4,
                'skema' => 'Teknisi Servis Sepeda Motor Injeksi',
                'tuk' => 'TUK Workshop Otomotif BPVP Kendari',
                'tahap' => 'Tahap 2',
                'tanggal_pendaftaran' => '2026-04-15',
                'nama_lengkap' => 'Wahyu Hidayat',
                'nomor_ktp' => '7403011409020002',
                'tempat_lahir' => 'Raha',
                'tanggal_lahir' => '2002-09-14',
                'jenis_kelamin' => 'L',
                'alamat_rumah' => 'Jl. Dr. Sutomo No. 19, Kendari',
                'nomor_telepon' => '082345671199',
                'email' => 'wahyu.hidayat@gmail.com',
                'kualifikasi_pendidikan' => 'SMA IPA',
                'kebangsaan' => 'WNI',
                'asesor' => 'Dedi Supriadi, S.Pd (MET.000.022)',
                'form_apl_01_02' => 'Lengkap',
                'hasil_ujk' => 'Kompeten',
                'cetak_sertifikat' => 'Proses',
                'tahun' => 2026
            ],
            [
                'nomor' => 5,
                'skema' => 'Barista dan Tata Hidang Kopi',
                'tuk' => 'TUK Pariwisata BPVP Kendari',
                'tahap' => 'Tahap 2',
                'tanggal_pendaftaran' => '2026-06-02',
                'nama_lengkap' => 'Dewi Anggraini',
                'nomor_ktp' => '7471016511010005',
                'tempat_lahir' => 'Kendari',
                'tanggal_lahir' => '2001-11-25',
                'jenis_kelamin' => 'P',
                'alamat_rumah' => 'Jl. Sao-sao No. 22, Bungi',
                'nomor_telepon' => '081344556677',
                'email' => 'dewi.barista@gmail.com',
                'kualifikasi_pendidikan' => 'SMK Perhotelan',
                'kebangsaan' => 'WNI',
                'asesor' => 'Ratna Sari, S.Tr.Par (MET.000.035)',
                'form_apl_01_02' => 'Lengkap',
                'hasil_ujk' => 'Kompeten',
                'cetak_sertifikat' => 'Belum',
                'tahun' => 2026
            ]
        ];

        foreach ($sertifikasis as $sert) {
            Sertifikasi::create($sert);
        }

        // 4. Penempatan Alumni
        $penempatans = [
            [
                'nomor' => 1,
                'kejuruan' => 'Teknologi Informasi dan Komunikasi (TIK)',
                'jumlah_peserta_pelatihan' => 32,
                'total_penempatan' => 27,
                'ditempatkan_bekerja' => 19,
                'tidak_ditempatkan' => 5,
                'berwirausaha' => 8,
                'nama_perusahaan' => 'PT Sulawesi Digital Solution, CV Kreatif Media, Bank Mandiri Kendari',
                'sektor' => 'Teknologi & Jasa Keuangan',
                'jumlah_alumni_ditempatkan' => 19,
                'tahun' => 2026
            ],
            [
                'nomor' => 2,
                'kejuruan' => 'Teknik Manufaktur dan Rekayasa (Las)',
                'jumlah_peserta_pelatihan' => 16,
                'total_penempatan' => 15,
                'ditempatkan_bekerja' => 13,
                'tidak_ditempatkan' => 1,
                'berwirausaha' => 2,
                'nama_perusahaan' => 'PT VDNI Morosi, PT OSS, Bengkel Bubut Mandiri',
                'sektor' => 'Pertambangan & Industri Fabrikasi',
                'jumlah_alumni_ditempatkan' => 13,
                'tahun' => 2026
            ],
            [
                'nomor' => 3,
                'kejuruan' => 'Teknik Otomotif',
                'jumlah_peserta_pelatihan' => 16,
                'total_penempatan' => 14,
                'ditempatkan_bekerja' => 9,
                'tidak_ditempatkan' => 2,
                'berwirausaha' => 5,
                'nama_perusahaan' => 'Astra Motor Kendari, PT Kalla Toyota Kendari, Wirausaha Mandiri',
                'sektor' => 'Otomotif & Bengkel Mandiri',
                'jumlah_alumni_ditempatkan' => 9,
                'tahun' => 2026
            ],
            [
                'nomor' => 4,
                'kejuruan' => 'Pariwisata & Perhotelan',
                'jumlah_peserta_pelatihan' => 16,
                'total_penempatan' => 15,
                'ditempatkan_bekerja' => 10,
                'tidak_ditempatkan' => 1,
                'berwirausaha' => 5,
                'nama_perusahaan' => 'Claro Hotel Kendari, Swiss-Belhotel Kendari, Kopikita Coffee',
                'sektor' => 'Hospitality & F&B',
                'jumlah_alumni_ditempatkan' => 10,
                'tahun' => 2026
            ],
        ];

        foreach ($penempatans as $pen) {
            Penempatan::create($pen);
        }

        // 5. Produktivitas
        $produktivitasList = [
            [
                'peserta' => 'Bimbingan Konsultasi Peningkatan Produktivitas UMKM Pangan',
                'jumlah' => 25,
                'nama_perusahaan' => 'CV Sumber Rezeki Sultra (Olahan Mete & Abon Ikan)',
                'alamat_perusahaan' => 'Jl. Brigjen Katamso No. 104, Kendari',
                'tanggal_kegiatan' => '2026-03-10',
                'sektor' => 'Industri Pengolahan Pangan',
                'tahun' => 2026,
                'keterangan' => 'Penerapan Metodologi 5S/5R dan Kaizen di lini produksi'
            ],
            [
                'peserta' => 'Pengukuran Tingkat Produktivitas Industri Kerajinan Rotan',
                'jumlah' => 20,
                'nama_perusahaan' => 'UD Rotan Karya Mandiri',
                'alamat_perusahaan' => 'Jl. Poros Lepo-lepo, Baruga, Kendari',
                'tanggal_kegiatan' => '2026-04-18',
                'sektor' => 'Kerajinan & Furnitur',
                'tahun' => 2026,
                'keterangan' => 'Audit efisiensi pemanfaatan bahan baku dan tata letak workshop'
            ],
            [
                'peserta' => 'Peningkatan Produktivitas Jasa Perbengkelan & Logam',
                'jumlah' => 30,
                'nama_perusahaan' => 'Asosiasi Bengkel Las Mandiri Kendari',
                'alamat_perusahaan' => 'Kawasan Industri Mandonga, Kendari',
                'tanggal_kegiatan' => '2026-05-22',
                'sektor' => 'Jasa Perbaikan & Fabrikasi',
                'tahun' => 2026,
                'keterangan' => 'Pelatihan Green Productivity dan efisiensi energi kelistrikan'
            ]
        ];

        foreach ($produktivitasList as $prod) {
            Produktivitas::create($prod);
        }

        // 6. Pengadaan Barang & Bahan
        $pengadaans = [
            [
                'program_batch' => 'Junior Web Developer - Batch 1',
                'jenis' => 'Bahan Pelatihan',
                'nama_alat_bahan' => 'Flashdisk 32GB High Speed & Buku Modul SKKNI TIK',
                'jumlah' => 16,
                'satuan' => 'Paket',
                'perkiraan_nilai' => 3200000,
                'spesifikasi' => 'USB 3.2 Sandisk Ultra 32GB, Modul full color jilid spiral',
                'status' => 'Selesai',
                'tahun' => 2026
            ],
            [
                'program_batch' => 'Pengelasan SMAW 3G - Batch 1',
                'jenis' => 'Bahan Pelatihan',
                'nama_alat_bahan' => 'Elektroda E7018 & Plat Baja Karbon 10mm',
                'jumlah' => 32,
                'satuan' => 'Kotak / Lembar',
                'perkiraan_nilai' => 14800000,
                'spesifikasi' => 'Elektroda LB-52 Kobe Steel, Plat SS400 tebal 10mm siap potong',
                'status' => 'Selesai',
                'tahun' => 2026
            ],
            [
                'program_batch' => 'Barista dan Tata Hidang Kopi - Batch 1',
                'jenis' => 'Bahan Pelatihan',
                'nama_alat_bahan' => 'Biji Kopi Arabika Toraja & Robusta Sultra Fresh Roast',
                'jumlah' => 25,
                'satuan' => 'Kilogram',
                'perkiraan_nilai' => 4500000,
                'spesifikasi' => 'Medium roast roast date < 14 hari, kemasan valve degassing',
                'status' => 'Selesai',
                'tahun' => 2026
            ],
            [
                'program_batch' => 'Menjahit Pakaian Pria & Wanita - Batch 1',
                'jenis' => 'Bahan Pelatihan',
                'nama_alat_bahan' => 'Kain Katun Toyobo, Benang Jahit Astra, Gunting Tailor',
                'jumlah' => 16,
                'satuan' => 'Set Bahan',
                'perkiraan_nilai' => 8400000,
                'spesifikasi' => 'Katun Toyobo original 48 meter, gunting baja 10 inch',
                'status' => 'Disetujui',
                'tahun' => 2026
            ]
        ];

        foreach ($pengadaans as $peng) {
            Pengadaan::create($peng);
        }

        // 7. Pembayaran / Keuangan
        $pembayarans = [
            [
                'program_batch' => 'Junior Web Developer - Batch 1',
                'peserta' => 'Honorarium Instruktur & Uang Saku Peserta Batch 1',
                'nilai_pengajuan' => 24800000,
                'status_pembayaran' => 'Dicairkan',
                'tanggal_pengajuan' => '2026-03-18',
                'tanggal_bayar' => '2026-03-24',
                'catatan' => 'Transfer via Bank BNI SP2D Nomor 0021/BPVP/2026',
                'tahun' => 2026
            ],
            [
                'program_batch' => 'Pengelasan SMAW 3G - Batch 1',
                'peserta' => 'Uang Saku & Uji Sertifikasi Asesi Las 16 Orang',
                'nilai_pengajuan' => 29600000,
                'status_pembayaran' => 'Dicairkan',
                'tanggal_pengajuan' => '2026-03-25',
                'tanggal_bayar' => '2026-03-31',
                'catatan' => 'Sertifikasi BNSP LSP P1 BPVP Kendari',
                'tahun' => 2026
            ],
            [
                'program_batch' => 'Barista dan Tata Hidang Kopi - Batch 1',
                'peserta' => 'Bahan Praktek & Uang Harian Peserta Pelatihan',
                'nilai_pengajuan' => 19500000,
                'status_pembayaran' => 'Dicairkan',
                'tanggal_pengajuan' => '2026-05-28',
                'tanggal_bayar' => '2026-06-03',
                'catatan' => 'Pencairan operasional termin 2',
                'tahun' => 2026
            ]
        ];

        foreach ($pembayarans as $pem) {
            Pembayaran::create($pem);
        }

        // 8. Target Realisasi 2026
        $targetRealisasiList = [
            ['kategori' => 'jenis_pelatihan', 'nama' => 'PBK Kelembagaan (UPTP)', 'target' => 96, 'realisasi' => 80, 'satuan' => 'Paket', 'tahun' => 2026],
            ['kategori' => 'jenis_pelatihan', 'nama' => 'PBK Non-Institusional (MTU)', 'target' => 40, 'realisasi' => 28, 'satuan' => 'Paket', 'tahun' => 2026],
            ['kategori' => 'jenis_pelatihan', 'nama' => 'Tailor Made Training', 'target' => 20, 'realisasi' => 16, 'satuan' => 'Paket', 'tahun' => 2026],
            ['kategori' => 'jenis_pelatihan', 'nama' => 'Pelatihan UPTD Binaan', 'target' => 80, 'realisasi' => 64, 'satuan' => 'Paket', 'tahun' => 2026],
            ['kategori' => 'jenis_pelatihan', 'nama' => 'Sertifikasi UJK BNSP', 'target' => 1500, 'realisasi' => 1140, 'satuan' => 'Orang', 'tahun' => 2026],
            ['kategori' => 'jenis_pelatihan', 'nama' => 'Peningkatan Produktivitas', 'target' => 300, 'realisasi' => 245, 'satuan' => 'Orang', 'tahun' => 2026],
        ];

        foreach ($targetRealisasiList as $tr) {
            TargetRealisasi::create($tr);
        }

        // 9. Realisasi Anggaran 2026
        $anggaranList = [
            [
                'uraian' => 'Program Pelatihan Kerja dan Sertifikasi Vokasi',
                'pagu_anggaran' => 18500000000,
                'realisasi_anggaran' => 14615000000,
                'persentase' => 79.0,
                'keterangan' => 'Realisasi DIPA BPVP Kendari TA 2026',
                'tahun' => 2026
            ],
            [
                'uraian' => 'Pelaksanaan Sertifikasi Kompetensi Tenaga Kerja',
                'pagu_anggaran' => 3200000000,
                'realisasi_anggaran' => 2528000000,
                'persentase' => 79.0,
                'keterangan' => 'Honor Asesor, Sewa TUK & Logistik Asesmen',
                'tahun' => 2026
            ],
            [
                'uraian' => 'Peningkatan Produktivitas Tenaga Kerja & UMKM',
                'pagu_anggaran' => 1150000000,
                'realisasi_anggaran' => 931500000,
                'persentase' => 81.0,
                'keterangan' => 'Bimbingan Konsultasi & Pengukuran Produktivitas',
                'tahun' => 2026
            ],
            [
                'uraian' => 'Layanan Penempatan dan Hubungan Kelembagaan',
                'pagu_anggaran' => 850000000,
                'realisasi_anggaran' => 697000000,
                'persentase' => 82.0,
                'keterangan' => 'Job Fair, MoU Perusahaan & Tracking Alumni',
                'tahun' => 2026
            ]
        ];

        foreach ($anggaranList as $ang) {
            RealisasiAnggaran::create($ang);
        }
    }
}
