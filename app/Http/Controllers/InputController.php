<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramPelatihan;
use App\Models\PelatihanUptd;
use App\Models\Sertifikasi;
use App\Models\Penempatan;
use App\Models\Produktivitas;
use App\Models\Pengadaan;
use App\Models\Pembayaran;

class InputController extends Controller
{
    public function index()
    {
        return view('pages.input.index');
    }

    public function penyelenggara()
    {
        $programs = ProgramPelatihan::where('tahun', 2026)->orderBy('nomor', 'desc')->take(10)->get();
        return view('pages.input.penyelenggara', compact('programs'));
    }

    public function pemberdayaan()
    {
        $programs = ProgramPelatihan::where('tahun', 2026)->orderBy('id', 'desc')->get();
        return view('pages.input.pemberdayaan', compact('programs'));
    }

    public function lsp()
    {
        $recentSertifikasi = Sertifikasi::where('tahun', 2026)->latest()->take(10)->get();
        return view('pages.input.lsp', compact('recentSertifikasi'));
    }

    public function produktivitas()
    {
        $recentProduktivitas = Produktivitas::where('tahun', 2026)->latest()->take(10)->get();
        return view('pages.input.produktivitas', compact('recentProduktivitas'));
    }

    public function umum()
    {
        $recentPengadaan = Pengadaan::where('tahun', 2026)->latest()->take(5)->get();
        $recentPembayaran = Pembayaran::where('tahun', 2026)->latest()->take(5)->get();
        return view('pages.input.umum', compact('recentPengadaan', 'recentPembayaran'));
    }
}
