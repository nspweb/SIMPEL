<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramPelatihan;

class PelatihanController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', 2026);
        $search = $request->input('search');
        $kejuruan = $request->input('kejuruan');
        $status = $request->input('status');

        $query = ProgramPelatihan::where('tahun', $year);

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('program_pelatihan', 'like', "%{$search}%")
                  ->orWhere('kejuruan', 'like', "%{$search}%")
                  ->orWhere('jenis_pelatihan', 'like', "%{$search}%");
            });
        }

        if (!empty($kejuruan)) {
            $query->where('kejuruan', $kejuruan);
        }

        if (!empty($status)) {
            $query->where('status_alur', $status);
        }

        $programs = $query->orderBy('nomor', 'asc')->paginate(15)->withQueryString();

        // Summary Stats
        $stats = [
            'total_paket' => ProgramPelatihan::where('tahun', $year)->count(),
            'total_peserta' => ProgramPelatihan::where('tahun', $year)->sum('jumlah_peserta'),
            'total_laki' => ProgramPelatihan::where('tahun', $year)->sum('laki_laki'),
            'total_perempuan' => ProgramPelatihan::where('tahun', $year)->sum('perempuan'),
            'total_lulus' => ProgramPelatihan::where('tahun', $year)->sum('lulus'),
            'selesai' => ProgramPelatihan::where('tahun', $year)->where('status_alur', 'Selesai')->count(),
            'berjalan' => ProgramPelatihan::where('tahun', $year)->where('status_alur', 'Berjalan')->count(),
            'draft' => ProgramPelatihan::where('tahun', $year)->where('status_alur', 'Draft')->count(),
        ];

        $kejuruanList = ProgramPelatihan::where('tahun', $year)->distinct()->pluck('kejuruan');

        return view('pages.pelatihan', compact('programs', 'stats', 'kejuruanList', 'year', 'search', 'kejuruan', 'status'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kejuruan' => 'required|string|max:255',
            'program_pelatihan' => 'required|string|max:255',
            'jenis_pelatihan' => 'required|string',
            'target_peserta' => 'nullable|integer',
            'jumlah_peserta' => 'nullable|integer',
            'laki_laki' => 'nullable|integer',
            'perempuan' => 'nullable|integer',
            'tgl_masuk' => 'nullable|date',
            'tgl_mulai' => 'nullable|date',
            'tgl_selesai' => 'nullable|date',
            'bulan_mulai' => 'nullable|string',
            'lulus' => 'nullable|integer',
            'tidak_lulus' => 'nullable|integer',
            'status_alur' => 'nullable|string',
            'tahun' => 'nullable|integer',
            'keterangan' => 'nullable|string'
        ]);

        $validated['tahun'] = $validated['tahun'] ?? 2026;
        $validated['target_peserta'] = $validated['target_peserta'] ?? 16;
        $validated['laki_laki'] = $validated['laki_laki'] ?? 0;
        $validated['perempuan'] = $validated['perempuan'] ?? 0;
        $validated['jumlah_peserta'] = $validated['jumlah_peserta'] ?? ($validated['laki_laki'] + $validated['perempuan']);
        $validated['status_alur'] = $validated['status_alur'] ?? 'Draft';

        $maxNomor = ProgramPelatihan::where('tahun', $validated['tahun'])->max('nomor') ?? 0;
        $validated['nomor'] = $maxNomor + 1;

        ProgramPelatihan::create($validated);

        return redirect()->back()->with('success', 'Program pelatihan berhasil ditambahkan ke sistem.');
    }

    public function update(Request $request, $id)
    {
        $program = ProgramPelatihan::findOrFail($id);

        $validated = $request->validate([
            'kejuruan' => 'required|string|max:255',
            'program_pelatihan' => 'required|string|max:255',
            'jenis_pelatihan' => 'required|string',
            'target_peserta' => 'nullable|integer',
            'jumlah_peserta' => 'nullable|integer',
            'laki_laki' => 'nullable|integer',
            'perempuan' => 'nullable|integer',
            'tgl_masuk' => 'nullable|date',
            'tgl_mulai' => 'nullable|date',
            'tgl_selesai' => 'nullable|date',
            'bulan_mulai' => 'nullable|string',
            'lulus' => 'nullable|integer',
            'tidak_lulus' => 'nullable|integer',
            'status_alur' => 'nullable|string',
            'keterangan' => 'nullable|string'
        ]);

        $validated['laki_laki'] = $validated['laki_laki'] ?? 0;
        $validated['perempuan'] = $validated['perempuan'] ?? 0;
        $validated['jumlah_peserta'] = $validated['jumlah_peserta'] ?? ($validated['laki_laki'] + $validated['perempuan']);

        $program->update($validated);

        return redirect()->back()->with('success', 'Data program pelatihan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $program = ProgramPelatihan::findOrFail($id);
        $program->delete();

        return redirect()->back()->with('success', 'Program pelatihan berhasil dihapus.');
    }
}
