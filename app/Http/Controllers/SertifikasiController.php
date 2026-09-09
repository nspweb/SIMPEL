<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sertifikasi;

class SertifikasiController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', 2026);
        $search = $request->input('search');
        $skema = $request->input('skema');
        $hasil = $request->input('hasil_ujk');
        $cetak = $request->input('cetak_sertifikat');

        $query = Sertifikasi::where('tahun', $year);

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nomor_ktp', 'like', "%{$search}%")
                  ->orWhere('skema', 'like', "%{$search}%")
                  ->orWhere('tuk', 'like', "%{$search}%")
                  ->orWhere('asesor', 'like', "%{$search}%");
            });
        }

        if (!empty($skema)) {
            $query->where('skema', $skema);
        }

        if (!empty($hasil)) {
            $query->where('hasil_ujk', $hasil);
        }

        if (!empty($cetak)) {
            $query->where('cetak_sertifikat', $cetak);
        }

        $sertifikasis = $query->orderBy('nomor', 'asc')->paginate(15)->withQueryString();

        $stats = [
            'total_asesi' => Sertifikasi::where('tahun', $year)->count(),
            'kompeten' => Sertifikasi::where('tahun', $year)->where('hasil_ujk', 'Kompeten')->count(),
            'belum_kompeten' => Sertifikasi::where('tahun', $year)->where('hasil_ujk', 'Belum Kompeten')->count(),
            'sertifikat_dicetak' => Sertifikasi::where('tahun', $year)->where('cetak_sertifikat', 'Sudah')->count(),
            'sertifikat_proses' => Sertifikasi::where('tahun', $year)->where('cetak_sertifikat', 'Proses')->count(),
        ];

        $skemaList = Sertifikasi::where('tahun', $year)->distinct()->pluck('skema');

        return view('pages.sertifikasi', compact('sertifikasis', 'stats', 'skemaList', 'year', 'search', 'skema', 'hasil', 'cetak'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'skema' => 'required|string',
            'tuk' => 'required|string',
            'tahap' => 'nullable|string',
            'tanggal_pendaftaran' => 'nullable|date',
            'nama_lengkap' => 'required|string|max:255',
            'nomor_ktp' => 'nullable|string|max:20',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_rumah' => 'nullable|string',
            'nomor_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'kualifikasi_pendidikan' => 'nullable|string',
            'kebangsaan' => 'nullable|string',
            'asesor' => 'nullable|string',
            'form_apl_01_02' => 'nullable|string',
            'hasil_ujk' => 'required|string',
            'cetak_sertifikat' => 'nullable|string',
            'tahun' => 'nullable|integer',
        ]);

        $validated['tahun'] = $validated['tahun'] ?? 2026;
        $maxNomor = Sertifikasi::where('tahun', $validated['tahun'])->max('nomor') ?? 0;
        $validated['nomor'] = $maxNomor + 1;

        Sertifikasi::create($validated);

        return redirect()->back()->with('success', 'Data asesi sertifikasi berhasil didaftarkan.');
    }

    public function update(Request $request, $id)
    {
        $sertifikasi = Sertifikasi::findOrFail($id);
        $validated = $request->validate([
            'skema' => 'required|string',
            'tuk' => 'required|string',
            'tahap' => 'nullable|string',
            'tanggal_pendaftaran' => 'nullable|date',
            'nama_lengkap' => 'required|string|max:255',
            'nomor_ktp' => 'nullable|string|max:20',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_rumah' => 'nullable|string',
            'nomor_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'kualifikasi_pendidikan' => 'nullable|string',
            'asesor' => 'nullable|string',
            'form_apl_01_02' => 'nullable|string',
            'hasil_ujk' => 'required|string',
            'cetak_sertifikat' => 'nullable|string',
        ]);

        $sertifikasi->update($validated);
        return redirect()->back()->with('success', 'Data sertifikasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sertifikasi = Sertifikasi::findOrFail($id);
        $sertifikasi->delete();
        return redirect()->back()->with('success', 'Data sertifikasi berhasil dihapus.');
    }
}
