<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelatihanUptd;

class PelatihanUptdController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', 2026);
        $activeTab = $request->input('tab', 'Kolaka');
        $search = $request->input('search');

        $query = PelatihanUptd::where('tahun', $year);

        if (!empty($activeTab) && $activeTab !== 'All') {
            $query->where('uptd_name', $activeTab);
        }

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('program_pelatihan', 'like', "%{$search}%")
                  ->orWhere('kejuruan', 'like', "%{$search}%")
                  ->orWhere('uptd_name', 'like', "%{$search}%");
            });
        }

        $uptdData = $query->orderBy('nomor', 'asc')->paginate(15)->withQueryString();

        // Stats Aggregations for Active UPTD / All
        $statQuery = PelatihanUptd::where('tahun', $year);
        if (!empty($activeTab) && $activeTab !== 'All') {
            $statQuery->where('uptd_name', $activeTab);
        }

        $stats = [
            'total_paket' => (clone $statQuery)->count(),
            'total_peserta' => (clone $statQuery)->sum('jumlah_peserta'),
            'total_laki' => (clone $statQuery)->sum('laki_laki'),
            'total_perempuan' => (clone $statQuery)->sum('perempuan'),
            's1_d4' => (clone $statQuery)->sum('edu_s1_d4'),
            'd3' => (clone $statQuery)->sum('edu_d3'),
            'sma_smk' => (clone $statQuery)->sum('edu_sma_smk'),
            'smp' => (clone $statQuery)->sum('edu_smp'),
            'sd' => (clone $statQuery)->sum('edu_sd'),
            'disabilitas' => (clone $statQuery)->sum('disabilitas'),
            'age_17_24' => (clone $statQuery)->sum('age_17_24'),
            'age_25_28' => (clone $statQuery)->sum('age_25_28'),
            'age_29_34' => (clone $statQuery)->sum('age_29_34'),
            'age_35_40' => (clone $statQuery)->sum('age_35_40'),
            'age_41_dst' => (clone $statQuery)->sum('age_41_dst'),
        ];

        $uptdList = ['Kolaka', 'Kolaka Utara', 'Konawe Selatan', 'Konawe Utara', 'Buton'];

        return view('pages.pelatihan_uptd', compact('uptdData', 'stats', 'uptdList', 'activeTab', 'year', 'search'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'uptd_name' => 'required|string',
            'kejuruan' => 'required|string',
            'program_pelatihan' => 'required|string',
            'jumlah_peserta' => 'nullable|integer',
            'laki_laki' => 'nullable|integer',
            'perempuan' => 'nullable|integer',
            'edu_s1_d4' => 'nullable|integer',
            'edu_d3' => 'nullable|integer',
            'edu_sma_smk' => 'nullable|integer',
            'edu_smp' => 'nullable|integer',
            'edu_sd' => 'nullable|integer',
            'disabilitas' => 'nullable|integer',
            'age_17_24' => 'nullable|integer',
            'age_25_28' => 'nullable|integer',
            'age_29_34' => 'nullable|integer',
            'age_35_40' => 'nullable|integer',
            'age_41_dst' => 'nullable|integer',
            'tahun' => 'nullable|integer',
        ]);

        $validated['tahun'] = $validated['tahun'] ?? 2026;
        $maxNomor = PelatihanUptd::where('uptd_name', $validated['uptd_name'])->where('tahun', $validated['tahun'])->max('nomor') ?? 0;
        $validated['nomor'] = $maxNomor + 1;

        PelatihanUptd::create($validated);

        return redirect()->back()->with('success', 'Data Pelatihan UPTD berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $record = PelatihanUptd::findOrFail($id);
        $validated = $request->validate([
            'uptd_name' => 'required|string',
            'kejuruan' => 'required|string',
            'program_pelatihan' => 'required|string',
            'jumlah_peserta' => 'nullable|integer',
            'laki_laki' => 'nullable|integer',
            'perempuan' => 'nullable|integer',
            'edu_s1_d4' => 'nullable|integer',
            'edu_d3' => 'nullable|integer',
            'edu_sma_smk' => 'nullable|integer',
            'edu_smp' => 'nullable|integer',
            'edu_sd' => 'nullable|integer',
            'disabilitas' => 'nullable|integer',
            'age_17_24' => 'nullable|integer',
            'age_25_28' => 'nullable|integer',
            'age_29_34' => 'nullable|integer',
            'age_35_40' => 'nullable|integer',
            'age_41_dst' => 'nullable|integer',
        ]);

        $record->update($validated);
        return redirect()->back()->with('success', 'Data Pelatihan UPTD berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $record = PelatihanUptd::findOrFail($id);
        $record->delete();
        return redirect()->back()->with('success', 'Data Pelatihan UPTD berhasil dihapus.');
    }
}
