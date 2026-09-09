<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Users Table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('penyelenggara'); // admin, penyelenggara, pemberdayaan, lsp, produktivitas, pimpinan
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Program Pelatihan (UPTP / Kelembagaan)
        Schema::create('program_pelatihan', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor')->nullable();
            $table->string('kejuruan');
            $table->string('program_pelatihan');
            $table->string('jenis_pelatihan')->default('PBK Kelembagaan');
            $table->integer('target_peserta')->default(16);
            $table->integer('jumlah_peserta')->default(0);
            $table->integer('perempuan')->default(0);
            $table->integer('laki_laki')->default(0);
            $table->date('tgl_masuk')->nullable();
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->string('bulan_mulai')->nullable();
            $table->integer('lulus')->default(0);
            $table->integer('tidak_lulus')->default(0);
            $table->string('status_alur')->default('Draft'); // Draft, Terverifikasi, Berjalan, Selesai
            $table->integer('tahun')->default(2026);
            $table->text('keterangan')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // 3. Pelatihan UPTD
        Schema::create('pelatihan_uptd', function (Blueprint $table) {
            $table->id();
            $table->string('uptd_name'); // Kolaka, Kolaka Utara, Konawe Selatan, Konawe Utara, Buton
            $table->integer('nomor')->nullable();
            $table->string('kejuruan');
            $table->string('program_pelatihan');
            $table->integer('jumlah_peserta')->default(0);
            $table->integer('perempuan')->default(0);
            $table->integer('laki_laki')->default(0);
            $table->integer('edu_s1_d4')->default(0);
            $table->integer('edu_d3')->default(0);
            $table->integer('edu_sma_smk')->default(0);
            $table->integer('edu_smp')->default(0);
            $table->integer('edu_sd')->default(0);
            $table->integer('disabilitas')->default(0);
            $table->integer('age_17_24')->default(0);
            $table->integer('age_25_28')->default(0);
            $table->integer('age_29_34')->default(0);
            $table->integer('age_35_40')->default(0);
            $table->integer('age_41_dst')->default(0);
            $table->integer('tahun')->default(2026);
            $table->timestamps();
        });

        // 4. Sertifikasi LSP
        Schema::create('sertifikasi', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor')->nullable();
            $table->string('skema');
            $table->string('tuk')->default('TUK Sewaktu BPVP Kendari');
            $table->string('tahap')->nullable();
            $table->date('tanggal_pendaftaran')->nullable();
            $table->string('nama_lengkap');
            $table->string('nomor_ktp')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->default('L');
            $table->text('alamat_rumah')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('kualifikasi_pendidikan')->nullable();
            $table->string('kebangsaan')->default('WNI');
            $table->string('asesor')->nullable();
            $table->string('form_apl_01_02')->default('Lengkap');
            $table->string('hasil_ujk')->default('Kompeten'); // Kompeten, Belum Kompeten, Belum Uji
            $table->string('cetak_sertifikat')->default('Belum'); // Sudah, Belum, Proses
            $table->integer('tahun')->default(2026);
            $table->timestamps();
        });

        // 5. Penempatan & Alumni
        Schema::create('penempatan', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor')->nullable();
            $table->string('kejuruan');
            $table->integer('jumlah_peserta_pelatihan')->default(0);
            $table->integer('total_penempatan')->default(0);
            $table->integer('ditempatkan_bekerja')->default(0);
            $table->integer('tidak_ditempatkan')->default(0);
            $table->integer('berwirausaha')->default(0);
            $table->string('nama_perusahaan')->nullable();
            $table->string('sektor')->nullable();
            $table->integer('jumlah_alumni_ditempatkan')->default(0);
            $table->integer('tahun')->default(2026);
            $table->timestamps();
        });

        // 6. Produktivitas
        Schema::create('produktivitas', function (Blueprint $table) {
            $table->id();
            $table->string('peserta');
            $table->integer('jumlah')->default(0);
            $table->string('nama_perusahaan');
            $table->text('alamat_perusahaan')->nullable();
            $table->date('tanggal_kegiatan')->nullable();
            $table->string('sektor')->nullable();
            $table->integer('tahun')->default(2026);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // 7. Pengadaan (Umum)
        Schema::create('pengadaan', function (Blueprint $table) {
            $table->id();
            $table->string('program_batch');
            $table->string('jenis')->default('Bahan Pelatihan');
            $table->string('nama_alat_bahan');
            $table->integer('jumlah')->default(1);
            $table->string('satuan')->default('Paket');
            $table->decimal('perkiraan_nilai', 15, 2)->default(0);
            $table->text('spesifikasi')->nullable();
            $table->string('status')->default('Diajukan');
            $table->integer('tahun')->default(2026);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // 8. Pembayaran & Keuangan
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('program_batch');
            $table->string('peserta');
            $table->decimal('nilai_pengajuan', 15, 2)->default(0);
            $table->string('status_pembayaran')->default('Menunggu Verifikasi');
            $table->date('tanggal_pengajuan')->nullable();
            $table->date('tanggal_bayar')->nullable();
            $table->text('catatan')->nullable();
            $table->integer('tahun')->default(2026);
            $table->timestamps();
        });

        // 9. Target Realisasi
        Schema::create('target_realisasi', function (Blueprint $table) {
            $table->id();
            $table->string('kategori')->default('jenis_pelatihan');
            $table->string('nama');
            $table->integer('target')->default(0);
            $table->integer('realisasi')->default(0);
            $table->string('satuan')->default('Paket');
            $table->integer('tahun')->default(2026);
            $table->timestamps();
        });

        // 10. Realisasi Anggaran
        Schema::create('realisasi_anggaran', function (Blueprint $table) {
            $table->id();
            $table->string('uraian');
            $table->decimal('pagu_anggaran', 15, 2)->default(0);
            $table->decimal('realisasi_anggaran', 15, 2)->default(0);
            $table->decimal('persentase', 5, 2)->default(0);
            $table->text('keterangan')->nullable();
            $table->integer('tahun')->default(2026);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('realisasi_anggaran');
        Schema::dropIfExists('target_realisasi');
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('pengadaan');
        Schema::dropIfExists('produktivitas');
        Schema::dropIfExists('penempatan');
        Schema::dropIfExists('sertifikasi');
        Schema::dropIfExists('pelatihan_uptd');
        Schema::dropIfExists('program_pelatihan');
        Schema::dropIfExists('users');
    }
};
