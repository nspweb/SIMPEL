<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengadaan;
use App\Models\Pembayaran;

class UmumController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', 2026);
        $tab = $request->input('tab', 'pengadaan');
        $search = $request->input('search');

        // Pengadaan Query
        $pengadaanQuery = Pengadaan::where('tahun', $year);
        if (!empty($search)) {
            $pengadaanQuery->where(function($q) use ($search) {
                $q->where('program_batch', 'like', "%{$search}%")
                  ->orWhere('nama_alat_bahan', 'like', "%{$search}%")
                  ->orWhere('jenis', 'like', "%{$search}%");
            });
        }
        $pengadaans = $pengadaanQuery->orderBy('created_at', 'desc')->paginate(10, ['*'], 'p_page')->withQueryString();

        // Pembayaran Query
        $pembayaranQuery = Pembayaran::where('tahun', $year);
        if (!empty($search)) {
            $pembayaranQuery->where(function($q) use ($search) {
                $q->where('program_batch', 'like', "%{$search}%")
                  ->orWhere('peserta', 'like', "%{$search}%")
                  ->orWhere('catatan', 'like', "%{$search}%");
            });
        }
        $pembayarans = $pembayaranQuery->orderBy('created_at', 'desc')->paginate(10, ['*'], 'b_page')->withQueryString();

        // Stats
        $stats = [
            'total_pengadaan' => Pengadaan::where('tahun', $year)->count(),
            'total_nilai_pengadaan' => Pengadaan::where('tahun', $year)->sum('perkiraan_nilai'),
            'pengadaan_selesai' => Pengadaan::where('tahun', $year)->where('status', 'Selesai')->count(),
            'total_pencairan' => Pembayaran::where('tahun', $year)->where('status_pembayaran', 'Dicairkan')->sum('nilai_pengajuan'),
            'menunggu_bayar' => Pembayaran::where('tahun', $year)->where('status_pembayaran', 'Menunggu Verifikasi')->count(),
        ];

        return view('pages.umum', compact('pengadaans', 'pembayarans', 'stats', 'tab', 'year', 'search'));
    }

    public function storePengadaan(Request $request)
    {
        $validated = $request->validate([
            'program_batch' => 'required|string',
            'jenis' => 'required|string',
            'nama_alat_bahan' => 'required|string',
            'jumlah' => 'required|integer',
            'satuan' => 'required|string',
            'perkiraan_nilai' => 'required|numeric',
            'spesifikasi' => 'nullable|string',
            'status' => 'nullable|string',
            'tahun' => 'nullable|integer',
        ]);

        $validated['tahun'] = $validated['tahun'] ?? 2026;
        $validated['status'] = $validated['status'] ?? 'Diajukan';

        Pengadaan::create($validated);
        return redirect()->route('umum.index', ['tab' => 'pengadaan'])->with('success', 'Pengajuan pengadaan berhasil ditambahkan.');
    }

    public function storePembayaran(Request $request)
    {
        $validated = $request->validate([
            'program_batch' => 'required|string',
            'peserta' => 'required|string',
            'nilai_pengajuan' => 'required|numeric',
            'status_pembayaran' => 'nullable|string',
            'tanggal_pengajuan' => 'nullable|date',
            'tanggal_bayar' => 'nullable|date',
            'catatan' => 'nullable|string',
            'tahun' => 'nullable|integer',
        ]);

        $validated['tahun'] = $validated['tahun'] ?? 2026;
        $validated['status_pembayaran'] = $validated['status_pembayaran'] ?? 'Menunggu Verifikasi';

        Pembayaran::create($validated);
        return redirect()->route('umum.index', ['tab' => 'pembayaran'])->with('success', 'Pencatatan pengajuan pembayaran berhasil ditambahkan.');
    }

    public function destroyPengadaan($id)
    {
        Pengadaan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data pengadaan berhasil dihapus.');
    }

    public function destroyPembayaran($id)
    {
        Pembayaran::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data pembayaran berhasil dihapus.');
    }
}
