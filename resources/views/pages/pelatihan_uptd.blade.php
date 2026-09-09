@extends('layouts.app')

@section('title', 'Data Pelatihan UPTD')

@section('content')
<div class="space-y-6" x-data="{ addModal: false }">

    <!-- PAGE HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-amber-600 mb-1">
                <i class="fa-solid fa-map-location-dot"></i>
                <span>Wilayah Pembinaan Sulawesi Tenggara</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-bold font-heading text-slate-900">Data Pelatihan UPTD BLK Binaan {{ $year }}</h1>
            <p class="text-xs text-slate-500 mt-0.5">Monitoring pelaksanaan pelatihan di 5 BLK UPTD: Kolaka, Kolaka Utara, Konawe Selatan, Konawe Utara, dan Buton.</p>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('export.csv', ['module' => 'uptd', 'year' => $year]) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold border border-slate-200 transition">
                <i class="fa-solid fa-file-excel text-emerald-600"></i>
                <span>Export Excel/CSV</span>
            </a>
            <button @click="addModal = true" type="button" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold shadow-xs hover:shadow transition">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Data UPTD</span>
            </button>
        </div>
    </div>

    <!-- UPTD SELECTOR TABS -->
    <div class="flex items-center gap-2 overflow-x-auto pb-2 border-b border-slate-200">
        <a href="{{ route('pelatihan.uptd', ['tab' => 'All', 'year' => $year]) }}" 
           class="px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition {{ $activeTab === 'All' ? 'bg-brand-800 text-white shadow-xs' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
            Semua UPTD (5 Wilayah)
        </a>
        @foreach($uptdList as $u)
        <a href="{{ route('pelatihan.uptd', ['tab' => $u, 'year' => $year]) }}" 
           class="px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition flex items-center gap-1.5 {{ $activeTab === $u ? 'bg-teal-600 text-white shadow-xs' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
            <i class="fa-solid fa-location-dot text-[10px]"></i>
            <span>BLK {{ $u }}</span>
        </a>
        @endforeach
    </div>

    <!-- DEMOGRAPHY & EDUCATION STATS SUMMARY -->
    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-3">
        <div class="bg-white rounded-xl p-3 border border-slate-200/80 text-center shadow-xs">
            <span class="text-[10px] font-bold uppercase text-slate-400">Total Peserta</span>
            <p class="text-lg font-extrabold text-slate-800 font-heading mt-0.5">{{ $stats['total_peserta'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-3 border border-slate-200/80 text-center shadow-xs">
            <span class="text-[10px] font-bold uppercase text-blue-500">Laki-Laki</span>
            <p class="text-lg font-extrabold text-blue-700 font-heading mt-0.5">{{ $stats['total_laki'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-3 border border-slate-200/80 text-center shadow-xs">
            <span class="text-[10px] font-bold uppercase text-pink-500">Perempuan</span>
            <p class="text-lg font-extrabold text-pink-700 font-heading mt-0.5">{{ $stats['total_perempuan'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-3 border border-slate-200/80 text-center shadow-xs">
            <span class="text-[10px] font-bold uppercase text-teal-600">S1 / D4</span>
            <p class="text-lg font-extrabold text-teal-800 font-heading mt-0.5">{{ $stats['s1_d4'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-3 border border-slate-200/80 text-center shadow-xs">
            <span class="text-[10px] font-bold uppercase text-slate-500">D3</span>
            <p class="text-lg font-extrabold text-slate-700 font-heading mt-0.5">{{ $stats['d3'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-3 border border-slate-200/80 text-center shadow-xs">
            <span class="text-[10px] font-bold uppercase text-amber-600">SMA / SMK</span>
            <p class="text-lg font-extrabold text-amber-700 font-heading mt-0.5">{{ $stats['sma_smk'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-3 border border-slate-200/80 text-center shadow-xs">
            <span class="text-[10px] font-bold uppercase text-slate-500">SMP / SD</span>
            <p class="text-lg font-extrabold text-slate-700 font-heading mt-0.5">{{ $stats['smp'] + $stats['sd'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-3 border border-slate-200/80 text-center shadow-xs">
            <span class="text-[10px] font-bold uppercase text-purple-600">Disabilitas</span>
            <p class="text-lg font-extrabold text-purple-700 font-heading mt-0.5">{{ $stats['disabilitas'] }}</p>
        </div>
    </div>

    <!-- SEARCH & CONTROLS -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs">
        <form method="GET" action="{{ route('pelatihan.uptd') }}" class="flex flex-col sm:flex-row gap-3 items-center justify-between">
            <input type="hidden" name="year" value="{{ $year }}">
            <input type="hidden" name="tab" value="{{ $activeTab }}">
            
            <div class="relative w-full sm:w-80">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari program / kejuruan UPTD..." 
                       class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500 bg-slate-50/50">
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto">
                <button type="submit" class="px-4 py-2 text-xs font-bold text-white bg-slate-800 hover:bg-slate-900 rounded-xl transition">
                    Cari Data
                </button>
                <a href="{{ route('pelatihan.uptd', ['tab' => $activeTab, 'year' => $year]) }}" class="px-3 py-2 text-xs font-semibold text-slate-600 hover:text-slate-900 bg-slate-100 rounded-xl">
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
                        <th class="py-3.5 px-4">UPTD BLK</th>
                        <th class="py-3.5 px-4">Program Pelatihan</th>
                        <th class="py-3.5 px-4">Kejuruan</th>
                        <th class="py-3.5 px-3 text-center">Peserta</th>
                        <th class="py-3.5 px-3 text-center">L / P</th>
                        <th class="py-3.5 px-4 text-center">Pendidikan Dominan</th>
                        <th class="py-3.5 px-4 text-center">Kelompok Usia (17-28 Thn)</th>
                        <th class="py-3.5 px-4 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($uptdData as $d)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-3 px-4 text-center font-bold text-slate-400">{{ $d->nomor ?? $loop->iteration }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-slate-100 text-slate-800 border border-slate-200">
                                BLK {{ $d->uptd_name }}
                            </span>
                        </td>
                        <td class="py-3 px-4 font-bold text-slate-800 text-sm">{{ $d->program_pelatihan }}</td>
                        <td class="py-3 px-4 font-semibold text-slate-600">{{ $d->kejuruan }}</td>
                        <td class="py-3 px-3 text-center font-extrabold text-slate-800 text-sm">{{ $d->jumlah_peserta }}</td>
                        <td class="py-3 px-3 text-center">
                            <span class="text-blue-600 font-bold">{{ $d->laki_laki }}</span> / 
                            <span class="text-pink-600 font-bold">{{ $d->perempuan }}</span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="text-[11px] font-medium text-slate-600">
                                SMA: <strong>{{ $d->edu_sma_smk }}</strong> | S1: <strong>{{ $d->edu_s1_d4 }}</strong> | D3: <strong>{{ $d->edu_d3 }}</strong>
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2 py-0.5 rounded-md bg-teal-50 text-teal-800 font-bold text-[11px]">
                                {{ $d->age_17_24 + $d->age_25_28 }} Peserta Muda
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <form method="POST" action="{{ route('pelatihan.uptd.destroy', $d->id) }}" onsubmit="return confirm('Hapus data pelatihan UPTD ini?')">
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
                            Belum ada data pelatihan untuk UPTD yang dipilih.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($uptdData->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $uptdData->links() }}
        </div>
        @endif
    </div>

    <!-- MODAL TAMBAH DATA UPTD -->
    <div x-show="addModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
        <div @click.outside="addModal = false" class="bg-white rounded-2xl max-w-2xl w-full p-6 shadow-2xl border border-slate-100 space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 font-heading">Tambah Data Pelatihan UPTD</h3>
                <button @click="addModal = false" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>

            <form method="POST" action="{{ route('pelatihan.uptd.store') }}" class="space-y-4 text-xs">
                @csrf
                <input type="hidden" name="tahun" value="{{ $year }}">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">UPTD Binaan *</label>
                        <select name="uptd_name" required class="w-full px-3 py-2 rounded-xl border border-slate-200">
                            <option value="Kolaka">BLK Kolaka</option>
                            <option value="Kolaka Utara">BLK Kolaka Utara</option>
                            <option value="Konawe Selatan">BLK Konawe Selatan</option>
                            <option value="Konawe Utara">BLK Konawe Utara</option>
                            <option value="Buton">BLK Buton</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Kejuruan *</label>
                        <input type="text" name="kejuruan" required placeholder="Contoh: Otomotif" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Program Pelatihan *</label>
                    <input type="text" name="program_pelatihan" required placeholder="Contoh: Servis Sepeda Motor Konvensional" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Jumlah Peserta</label>
                        <input type="number" name="jumlah_peserta" value="16" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Laki-Laki</label>
                        <input type="number" name="laki_laki" value="8" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Perempuan</label>
                        <input type="number" name="perempuan" value="8" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-3">
                    <p class="font-bold text-slate-800 mb-2">Sebaran Tingkat Pendidikan</p>
                    <div class="grid grid-cols-5 gap-2">
                        <div>
                            <label class="block text-[10px] text-slate-500 mb-1">S1/D4</label>
                            <input type="number" name="edu_s1_d4" value="0" class="w-full px-2 py-1.5 rounded-lg border border-slate-200">
                        </div>
                        <div>
                            <label class="block text-[10px] text-slate-500 mb-1">D3</label>
                            <input type="number" name="edu_d3" value="0" class="w-full px-2 py-1.5 rounded-lg border border-slate-200">
                        </div>
                        <div>
                            <label class="block text-[10px] text-slate-500 mb-1">SMA/SMK</label>
                            <input type="number" name="edu_sma_smk" value="16" class="w-full px-2 py-1.5 rounded-lg border border-slate-200">
                        </div>
                        <div>
                            <label class="block text-[10px] text-slate-500 mb-1">SMP</label>
                            <input type="number" name="edu_smp" value="0" class="w-full px-2 py-1.5 rounded-lg border border-slate-200">
                        </div>
                        <div>
                            <label class="block text-[10px] text-slate-500 mb-1">Disabilitas</label>
                            <input type="number" name="disabilitas" value="0" class="w-full px-2 py-1.5 rounded-lg border border-slate-200">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-4 border-t border-slate-100">
                    <button type="button" @click="addModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold shadow-xs">Simpan Data UPTD</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
