<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikasi extends Model
{
    use HasFactory;

    protected $table = 'sertifikasi';

    protected $fillable = [
        'nomor',
        'skema',
        'tuk',
        'tahap',
        'tanggal_pendaftaran',
        'nama_lengkap',
        'nomor_ktp',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat_rumah',
        'nomor_telepon',
        'email',
        'kualifikasi_pendidikan',
        'kebangsaan',
        'asesor',
        'form_apl_01_02', // Lengkap / Belum
        'hasil_ujk', // Kompeten (K) / Belum Kompeten (BK) / Belum Uji
        'cetak_sertifikat', // Sudah / Belum / Proses
        'tahun'
    ];

    protected $casts = [
        'tanggal_pendaftaran' => 'date',
        'tanggal_lahir' => 'date',
        'tahun' => 'integer',
    ];
}
