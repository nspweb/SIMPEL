<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramPelatihan;
use App\Models\PelatihanUptd;
use App\Models\Sertifikasi;
use App\Models\Penempatan;
use App\Models\Produktivitas;
use App\Models\TargetRealisasi;
use App\Models\RealisasiAnggaran;
use App\Models\Pengadaan;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', 2026);

        // Stats Pelatihan
        $totalPrograms = ProgramPelatihan::where('tahun', $year)->count();
        $totalPeserta = ProgramPelatihan::where('tahun', $year)->sum('jumlah_peserta');
        $totalLulus = ProgramPelatihan::where('tahun', $year)->sum('lulus');
        $totalLakiLaki = ProgramPelatihan::where('tahun', $year)->sum('laki_laki');
        $totalPerempuan = ProgramPelatihan::where('tahun', $year)->sum('perempuan');

        // Stats Sertifikasi
        $totalSertifikasi = Sertifikasi::where('tahun', $year)->count();
        $totalKompeten = Sertifikasi::where('tahun', $year)->where('hasil_ujk', 'Kompeten')->count();
        $totalCetakSertifikat = Sertifikasi::where('tahun', $year)->where('cetak_sertifikat', 'Sudah')->count();

        // Stats Penempatan
        $totalPenempatanAlumni = Penempatan::where('tahun', $year)->sum('total_penempatan');
        $totalBekerja = Penempatan::where('tahun', $year)->sum('ditempatkan_bekerja');
        $totalWirausaha = Penempatan::where('tahun', $year)->sum('berwirausaha');

        // Stats Produktivitas
        $totalProduktivitas = Produktivitas::where('tahun', $year)->sum('jumlah');
        $totalPerusahaanBinaan = Produktivitas::where('tahun', $year)->count();

        // Stats UPTD
        $totalPesertaUptd = PelatihanUptd::where('tahun', $year)->sum('jumlah_peserta');

        // Target vs Realisasi
        $targets = TargetRealisasi::where('tahun', $year)->get();
        $anggarans = RealisasiAnggaran::where('tahun', $year)->get();
        $totalPagu = $anggarans->sum('pagu_anggaran');
        $totalRealisasiAnggaran = $anggarans->sum('realisasi_anggaran');
        $persenAnggaran = $totalPagu > 0 ? round(($totalRealisasiAnggaran / $totalPagu) * 100, 1) : 0;

        // Recent Activities / Programs
        $recentPrograms = ProgramPelatihan::where('tahun', $year)->latest()->take(5)->get();
        $recentSertifikasi = Sertifikasi::where('tahun', $year)->latest()->take(5)->get();

        return view('pages.dashboard', compact(
            'year',
            'totalPrograms',
            'totalPeserta',
            'totalLulus',
            'totalLakiLaki',
            'totalPerempuan',
            'totalSertifikasi',
            'totalKompeten',
            'totalCetakSertifikat',
            'totalPenempatanAlumni',
            'totalBekerja',
            'totalWirausaha',
            'totalProduktivitas',
            'totalPerusahaanBinaan',
            'totalPesertaUptd',
            'targets',
            'anggarans',
            'totalPagu',
            'totalRealisasiAnggaran',
            'persenAnggaran',
            'recentPrograms',
            'recentSertifikasi'
        ));
    }
}
