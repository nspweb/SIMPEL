<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetRealisasi extends Model
{
    use HasFactory;

    protected $table = 'target_realisasi';

    protected $fillable = [
        'kategori', // jenis_pelatihan, kejuruan, uptd
        'nama',
        'target',
        'realisasi',
        'satuan', // Paket, Orang, Kegiatan, dll
        'tahun'
    ];

    protected $casts = [
        'target' => 'integer',
        'realisasi' => 'integer',
        'tahun' => 'integer',
    ];
}
