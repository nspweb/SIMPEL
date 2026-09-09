<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    use HasFactory;

    protected $table = 'pengadaan';

    protected $fillable = [
        'program_batch',
        'jenis', // Alat / Bahan / Jasa / Konsumsi
        'nama_alat_bahan',
        'jumlah',
        'satuan',
        'perkiraan_nilai',
        'spesifikasi',
        'status', // Diajukan, Disetujui, Dalam Pengadaan, Selesai, Ditolak
        'tahun',
        'created_by'
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'perkiraan_nilai' => 'decimal:2',
        'tahun' => 'integer',
    ];
}
