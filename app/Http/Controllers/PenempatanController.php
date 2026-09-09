<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penempatan;

class PenempatanController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', 2026);
        $search = $request->input('search');
        $kejuruan = $request->input('kejuruan');

        $query = Penempatan::where('tahun', $year);

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('kejuruan', 'like', "%{$search}%")
                  ->orWhere('nama_perusahaan', 'like', "%{$search}%")
                  ->orWhere('sektor', 'like', "%{$search}%");
            });
        }

        if (!empty($kejuruan)) {
            $query->where('kejuruan', $kejuruan);
        }

        $penempatans = $query->orderBy('nomor', 'asc')->paginate(15)->withQueryString();

        $stats = [
            'total_alumni' => Penempatan::where('tahun', $year)->sum('jumlah_peserta_pelatihan'),
            'total_tersalurkan' => Penempatan::where('tahun', $year)->sum('total_penempatan'),
            'bekerja' => Penempatan::where('tahun', $year)->sum('ditempatkan_bekerja'),
            'wirausaha' => Penempatan::where('tahun', $year)->sum('berwirausaha'),
            'belum_bekerja' => Penempatan::where('tahun', $year)->sum('tidak_ditempatkan'),
        ];

        $tingkatPenyerapan = $stats['total_alumni'] > 0 ? round(($stats['total_tersalurkan'] / $stats['total_alumni']) * 100, 1) : 0;
        $stats['tingkat_penyerapan'] = $tingkatPenyerapan;

        $kejuruanList = Penempatan::where('tahun', $year)->distinct()->pluck('kejuruan');

        return view('pages.penempatan', compact('penempatans', 'stats', 'kejuruanList', 'year', 'search', 'kejuruan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kejuruan' => 'required|string',
            'jumlah_peserta_pelatihan' => 'required|integer',
            'ditempatkan_bekerja' => 'nullable|integer',
            'berwirausaha' => 'nullable|integer',
            'tidak_ditempatkan' => 'nullable|integer',
            'nama_perusahaan' => 'nullable|string',
            'sektor' => 'nullable|string',
            'tahun' => 'nullable|integer',
        ]);

        $validated['tahun'] = $validated['tahun'] ?? 2026;
        $validated['ditempatkan_bekerja'] = $validated['ditempatkan_bekerja'] ?? 0;
        $validated['berwirausaha'] = $validated['berwirausaha'] ?? 0;
        $validated['tidak_ditempatkan'] = $validated['tidak_ditempatkan'] ?? 0;
        $validated['total_penempatan'] = $validated['ditempatkan_bekerja'] + $validated['berwirausaha'];
        $validated['jumlah_alumni_ditempatkan'] = $validated['ditempatkan_bekerja'];

        $maxNomor = Penempatan::where('tahun', $validated['tahun'])->max('nomor') ?? 0;
        $validated['nomor'] = $maxNomor + 1;

        Penempatan::create($validated);

        return redirect()->back()->with('success', 'Data penempatan alumni berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $penempatan = Penempatan::findOrFail($id);
        $validated = $request->validate([
            'kejuruan' => 'required|string',
            'jumlah_peserta_pelatihan' => 'required|integer',
            'ditempatkan_bekerja' => 'nullable|integer',
            'berwirausaha' => 'nullable|integer',
            'tidak_ditempatkan' => 'nullable|integer',
            'nama_perusahaan' => 'nullable|string',
            'sektor' => 'nullable|string',
        ]);

        $validated['ditempatkan_bekerja'] = $validated['ditempatkan_bekerja'] ?? 0;
        $validated['berwirausaha'] = $validated['berwirausaha'] ?? 0;
        $validated['tidak_ditempatkan'] = $validated['tidak_ditempatkan'] ?? 0;
        $validated['total_penempatan'] = $validated['ditempatkan_bekerja'] + $validated['berwirausaha'];
        $validated['jumlah_alumni_ditempatkan'] = $validated['ditempatkan_bekerja'];

        $penempatan->update($validated);
        return redirect()->back()->with('success', 'Data penempatan alumni berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penempatan = Penempatan::findOrFail($id);
        $penempatan->delete();
        return redirect()->back()->with('success', 'Data penempatan berhasil dihapus.');
    }
}
