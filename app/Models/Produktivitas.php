<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produktivitas extends Model
{
    use HasFactory;

    protected $table = 'produktivitas';

    protected $fillable = [
        'peserta',
        'jumlah',
        'nama_perusahaan',
        'alamat_perusahaan',
        'tanggal_kegiatan',
        'sektor',
        'tahun',
        'keterangan'
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'tanggal_kegiatan' => 'date',
        'tahun' => 'integer',
    ];
}
