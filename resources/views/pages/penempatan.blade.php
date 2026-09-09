@extends('layouts.app')

@section('title', 'Data Penempatan Alumni')

@section('content')
<div class="space-y-6" x-data="{ addModal: false }">

    <!-- PAGE HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-teal-600 mb-1">
                <i class="fa-solid fa-briefcase"></i>
                <span>Kemitraan Industri & Hubungan Kerja</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-bold font-heading text-slate-900">Data Penempatan & Pelacakan Alumni {{ $year }}</h1>
            <p class="text-xs text-slate-500 mt-0.5">Tracking penyerapan lulusan pelatihan BPVP Kendari ke dunia usaha, dunia industri (DUDI), dan wirausaha mandiri.</p>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('export.csv', ['module' => 'penempatan', 'year' => $year]) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold border border-slate-200 transition">
                <i class="fa-solid fa-file-excel text-emerald-600"></i>
                <span>Export Excel/CSV</span>
            </a>
            <button @click="addModal = true" type="button" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold shadow-xs hover:shadow transition">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Data Penempatan</span>
            </button>
        </div>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 sm:gap-4">
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Alumni Lulus</p>
            <p class="text-xl font-extrabold text-slate-800 font-heading mt-1">{{ number_format($stats['total_alumni']) }} <span class="text-xs font-normal text-slate-500">Orang</span></p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-600">Total Tersalurkan</p>
            <p class="text-xl font-extrabold text-emerald-700 font-heading mt-1">{{ number_format($stats['total_tersalurkan']) }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-blue-600">Bekerja di Industri</p>
            <p class="text-xl font-extrabold text-blue-700 font-heading mt-1">{{ number_format($stats['bekerja']) }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-amber-500">Wirausaha Mandiri</p>
            <p class="text-xl font-extrabold text-amber-600 font-heading mt-1">{{ number_format($stats['wirausaha']) }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-purple-600">Tingkat Penyerapan</p>
            <p class="text-xl font-extrabold text-purple-700 font-heading mt-1">{{ $stats['tingkat_penyerapan'] }}%</p>
        </div>
    </div>

    <!-- FILTER & SEARCH -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs">
        <form method="GET" action="{{ route('penempatan.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
            <input type="hidden" name="year" value="{{ $year }}">
            
            <div class="sm:col-span-8 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari kejuruan, nama perusahaan mitra, atau sektor industri..." 
                       class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500 bg-slate-50/50">
            </div>

            <div class="sm:col-span-3">
                <select name="kejuruan" onchange="this.form.submit()" 
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500 bg-slate-50/50">
                    <option value="">Semua Kejuruan</option>
                    @foreach($kejuruanList as $k)
                        <option value="{{ $k }}" {{ $kejuruan == $k ? 'selected' : '' }}>{{ $k }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-1 flex items-center">
                <a href="{{ route('penempatan.index', ['year' => $year]) }}" class="w-full py-2 text-center text-xs font-semibold text-slate-600 hover:text-slate-900 bg-slate-100 rounded-xl">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- DATA TABLE -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-200/80">
                    <tr>
                        <th class="py-3.5 px-4 w-12 text-center">No</th>
                        <th class="py-3.5 px-4">Kejuruan Pelatihan</th>
                        <th class="py-3.5 px-3 text-center">Total Alumni</th>
                        <th class="py-3.5 px-3 text-center">Terserap</th>
                        <th class="py-3.5 px-3 text-center">Bekerja</th>
                        <th class="py-3.5 px-3 text-center">Wirausaha</th>
                        <th class="py-3.5 px-4">Perusahaan Mitra & Sektor Penempatan</th>
                        <th class="py-3.5 px-3 text-center">% Serap</th>
                        <th class="py-3.5 px-4 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($penempatans as $p)
                    @php 
                        $rate = $p->jumlah_peserta_pelatihan > 0 ? round(($p->total_penempatan / $p->jumlah_peserta_pelatihan) * 100, 1) : 0; 
                    @endphp
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-3 px-4 text-center font-bold text-slate-400">{{ $p->nomor ?? $loop->iteration }}</td>
                        <td class="py-3 px-4 font-bold text-slate-800 text-sm">{{ $p->kejuruan }}</td>
                        <td class="py-3 px-3 text-center font-extrabold text-slate-700">{{ $p->jumlah_peserta_pelatihan }}</td>
                        <td class="py-3 px-3 text-center font-extrabold text-teal-700 bg-teal-50/60">{{ $p->total_penempatan }}</td>
                        <td class="py-3 px-3 text-center font-bold text-blue-600">{{ $p->ditempatkan_bekerja }}</td>
                        <td class="py-3 px-3 text-center font-bold text-amber-600">{{ $p->berwirausaha }}</td>
                        <td class="py-3 px-4">
                            <p class="font-medium text-slate-800">{{ $p->nama_perusahaan ?? '-' }}</p>
                            <span class="text-[10px] text-slate-400 font-semibold uppercase">{{ $p->sektor ?? 'Multi-Sektor' }}</span>
                        </td>
                        <td class="py-3 px-3 text-center">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold {{ $rate >= 75 ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $rate }}%
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <form method="POST" action="{{ route('penempatan.destroy', $p->id) }}" onsubmit="return confirm('Hapus data penempatan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-slate-100 transition" title="Hapus">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="py-8 text-center text-slate-400">
                            <i class="fa-solid fa-inbox text-3xl text-slate-300 mb-2 block"></i>
                            Belum ada data penempatan alumni yang sesuai kriteria pencarian.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($penempatans->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $penempatans->links() }}
        </div>
        @endif
    </div>

    <!-- MODAL TAMBAH DATA PENEMPATAN -->
    <div x-show="addModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
        <div @click.outside="addModal = false" class="bg-white rounded-2xl max-w-2xl w-full p-6 shadow-2xl border border-slate-100 space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 font-heading">Tambah Data Penempatan Alumni</h3>
                <button @click="addModal = false" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>

            <form method="POST" action="{{ route('penempatan.store') }}" class="space-y-4 text-xs">
                @csrf
                <input type="hidden" name="tahun" value="{{ $year }}">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Kejuruan *</label>
                        <input type="text" name="kejuruan" required placeholder="Contoh: Teknik Otomotif" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Total Peserta Pelatihan *</label>
                        <input type="number" name="jumlah_peserta_pelatihan" required value="16" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Bekerja di Industri</label>
                        <input type="number" name="ditempatkan_bekerja" value="0" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Berwirausaha</label>
                        <input type="number" name="berwirausaha" value="0" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Belum Bekerja</label>
                        <input type="number" name="tidak_ditempatkan" value="0" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Perusahaan Mitra Penerima</label>
                    <input type="text" name="nama_perusahaan" placeholder="Contoh: PT Kalla Toyota Kendari, Claro Hotel" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Sektor Usaha / Industri</label>
                    <input type="text" name="sektor" placeholder="Contoh: Otomotif, Hospitality, Manufaktur" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                </div>

                <div class="flex items-center justify-end gap-2 pt-4 border-t border-slate-100">
                    <button type="button" @click="addModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold shadow-xs">Simpan Data Penempatan</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
