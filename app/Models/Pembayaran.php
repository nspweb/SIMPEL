<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'program_batch',
        'peserta',
        'nilai_pengajuan',
        'status_pembayaran', // Menunggu Verifikasi, Disetujui, Dicairkan, Ditolak
        'tanggal_pengajuan',
        'tanggal_bayar',
        'catatan',
        'tahun'
    ];

    protected $casts = [
        'nilai_pengajuan' => 'decimal:2',
        'tanggal_pengajuan' => 'date',
        'tanggal_bayar' => 'date',
        'tahun' => 'integer',
    ];
}
