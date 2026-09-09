<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealisasiAnggaran extends Model
{
    use HasFactory;

    protected $table = 'realisasi_anggaran';

    protected $fillable = [
        'uraian',
        'pagu_anggaran',
        'realisasi_anggaran',
        'persentase',
        'keterangan',
        'tahun'
    ];

    protected $casts = [
        'pagu_anggaran' => 'decimal:2',
        'realisasi_anggaran' => 'decimal:2',
        'persentase' => 'decimal:2',
        'tahun' => 'integer',
    ];
}
