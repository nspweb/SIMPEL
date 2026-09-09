<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramPelatihan extends Model
{
    use HasFactory;

    protected $table = 'program_pelatihan';

    protected $fillable = [
        'nomor',
        'kejuruan',
        'program_pelatihan',
        'jenis_pelatihan', // PBK Kelembagaan, Non-Institusional, Tailor Made, dll
        'target_peserta',
        'jumlah_peserta',
        'perempuan',
        'laki_laki',
        'tgl_masuk',
        'tgl_mulai',
        'tgl_selesai',
        'bulan_mulai',
        'lulus',
        'tidak_lulus',
        'status_alur', // Draft, Menunggu Verifikasi Peserta, Berjalan, Selesai
        'tahun',
        'keterangan',
        'created_by'
    ];

    protected $casts = [
        'target_peserta' => 'integer',
        'jumlah_peserta' => 'integer',
        'perempuan' => 'integer',
        'laki_laki' => 'integer',
        'lulus' => 'integer',
        'tidak_lulus' => 'integer',
        'tahun' => 'integer',
        'tgl_mulai' => 'date',
        'tgl_selesai' => 'date',
        'tgl_masuk' => 'date',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
