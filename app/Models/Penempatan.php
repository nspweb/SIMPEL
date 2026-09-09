<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penempatan extends Model
{
    use HasFactory;

    protected $table = 'penempatan';

    protected $fillable = [
        'nomor',
        'kejuruan',
        'jumlah_peserta_pelatihan',
        'total_penempatan',
        'ditempatkan_bekerja',
        'tidak_ditempatkan',
        'berwirausaha',
        'nama_perusahaan',
        'sektor', // Manufaktur, Otomotif, IT, Konstruksi, Jasa, Perikanan, Pariwisata, dll
        'jumlah_alumni_ditempatkan',
        'tahun'
    ];

    protected $casts = [
        'jumlah_peserta_pelatihan' => 'integer',
        'total_penempatan' => 'integer',
        'ditempatkan_bekerja' => 'integer',
        'tidak_ditempatkan' => 'integer',
        'berwirausaha' => 'integer',
        'jumlah_alumni_ditempatkan' => 'integer',
        'tahun' => 'integer',
    ];
}
