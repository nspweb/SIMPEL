<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produktivitas;

class ProduktivitasController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', 2026);
        $search = $request->input('search');
        $sektor = $request->input('sektor');

        $query = Produktivitas::where('tahun', $year);

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('peserta', 'like', "%{$search}%")
                  ->orWhere('nama_perusahaan', 'like', "%{$search}%")
                  ->orWhere('alamat_perusahaan', 'like', "%{$search}%")
                  ->orWhere('sektor', 'like', "%{$search}%");
            });
        }

        if (!empty($sektor)) {
            $query->where('sektor', $sektor);
        }

        $produktivitasList = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        $stats = [
            'total_kegiatan' => Produktivitas::where('tahun', $year)->count(),
            'total_peserta' => Produktivitas::where('tahun', $year)->sum('jumlah'),
            'total_perusahaan' => Produktivitas::where('tahun', $year)->distinct('nama_perusahaan')->count('nama_perusahaan'),
        ];

        $sektorList = Produktivitas::where('tahun', $year)->distinct()->pluck('sektor');

        return view('pages.produktivitas', compact('produktivitasList', 'stats', 'sektorList', 'year', 'search', 'sektor'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'peserta' => 'required|string',
            'jumlah' => 'required|integer',
            'nama_perusahaan' => 'required|string',
            'alamat_perusahaan' => 'nullable|string',
            'tanggal_kegiatan' => 'nullable|date',
            'sektor' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'tahun' => 'nullable|integer',
        ]);

        $validated['tahun'] = $validated['tahun'] ?? 2026;
        Produktivitas::create($validated);

        return redirect()->back()->with('success', 'Data kegiatan produktivitas berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $item = Produktivitas::findOrFail($id);
        $validated = $request->validate([
            'peserta' => 'required|string',
            'jumlah' => 'required|integer',
            'nama_perusahaan' => 'required|string',
            'alamat_perusahaan' => 'nullable|string',
            'tanggal_kegiatan' => 'nullable|date',
            'sektor' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        $item->update($validated);
        return redirect()->back()->with('success', 'Data produktivitas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = Produktivitas::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('success', 'Data produktivitas berhasil dihapus.');
    }
}
