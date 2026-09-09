<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelatihanUptd extends Model
{
    use HasFactory;

    protected $table = 'pelatihan_uptd';

    protected $fillable = [
        'uptd_name', // Kolaka, Kolaka Utara, Konawe Selatan, Konawe Utara, Buton
        'nomor',
        'kejuruan',
        'program_pelatihan',
        'jumlah_peserta',
        'perempuan',
        'laki_laki',
        'edu_s1_d4',
        'edu_d3',
        'edu_sma_smk',
        'edu_smp',
        'edu_sd',
        'disabilitas',
        'age_17_24',
        'age_25_28',
        'age_29_34',
        'age_35_40',
        'age_41_dst',
        'tahun'
    ];

    protected $casts = [
        'jumlah_peserta' => 'integer',
        'perempuan' => 'integer',
        'laki_laki' => 'integer',
        'edu_s1_d4' => 'integer',
        'edu_d3' => 'integer',
        'edu_sma_smk' => 'integer',
        'edu_smp' => 'integer',
        'edu_sd' => 'integer',
        'disabilitas' => 'integer',
        'age_17_24' => 'integer',
        'age_25_28' => 'integer',
        'age_29_34' => 'integer',
        'age_35_40' => 'integer',
        'age_41_dst' => 'integer',
        'tahun' => 'integer',
    ];
}
