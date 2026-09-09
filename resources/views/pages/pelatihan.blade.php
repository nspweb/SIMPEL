@extends('layouts.app')

@section('title', 'Data Pelatihan UPTP')

@section('content')
<div class="space-y-6" x-data="{ addModal: false, editModal: false, selectedItem: {} }">

    <!-- PAGE HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-teal-600 mb-1">
                <i class="fa-solid fa-building-columns"></i>
                <span>Kelembagaan BPVP Kendari</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-bold font-heading text-slate-900">Data Program Pelatihan UPTP {{ $year }}</h1>
            <p class="text-xs text-slate-500 mt-0.5">Master data penyelenggaraan paket pelatihan, jadwal kelas, progres peserta, dan rasio kelulusan.</p>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('export.csv', ['module' => 'pelatihan', 'year' => $year]) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold border border-slate-200 transition">
                <i class="fa-solid fa-file-excel text-emerald-600"></i>
                <span>Export Excel/CSV</span>
            </a>
            <button @click="addModal = true" type="button" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold shadow-xs hover:shadow transition">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Program</span>
            </button>
        </div>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Program</p>
            <p class="text-xl font-extrabold text-slate-800 font-heading mt-1">{{ $stats['total_paket'] }} <span class="text-xs font-normal text-slate-500">Paket</span></p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Peserta</p>
            <p class="text-xl font-extrabold text-blue-600 font-heading mt-1">{{ number_format($stats['total_peserta']) }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Laki-Laki</p>
            <p class="text-xl font-extrabold text-slate-700 font-heading mt-1">{{ number_format($stats['total_laki']) }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Perempuan</p>
            <p class="text-xl font-extrabold text-pink-600 font-heading mt-1">{{ number_format($stats['total_perempuan']) }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Lulus</p>
            <p class="text-xl font-extrabold text-emerald-600 font-heading mt-1">{{ number_format($stats['total_lulus']) }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Sedang Berjalan</p>
            <p class="text-xl font-extrabold text-amber-600 font-heading mt-1">{{ $stats['berjalan'] }} <span class="text-xs font-normal text-slate-500">Kelas</span></p>
        </div>
    </div>

    <!-- FILTER & SEARCH BAR -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs">
        <form method="GET" action="{{ route('pelatihan.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
            <input type="hidden" name="year" value="{{ $year }}">
            
            <div class="sm:col-span-5 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama program pelatihan / kejuruan..." 
                       class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500 bg-slate-50/50">
            </div>

            <div class="sm:col-span-4">
                <select name="kejuruan" onchange="this.form.submit()" 
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500 bg-slate-50/50">
                    <option value="">Semua Kejuruan</option>
                    @foreach($kejuruanList as $k)
                        <option value="{{ $k }}" {{ $kejuruan == $k ? 'selected' : '' }}>{{ $k }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-2">
                <select name="status" onchange="this.form.submit()" 
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500 bg-slate-50/50">
                    <option value="">Semua Status</option>
                    <option value="Draft" {{ $status == 'Draft' ? 'selected' : '' }}>Draft</option>
                    <option value="Terverifikasi" {{ $status == 'Terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                    <option value="Berjalan" {{ $status == 'Berjalan' ? 'selected' : '' }}>Berjalan</option>
                    <option value="Selesai" {{ $status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="sm:col-span-1 flex items-center">
                <a href="{{ route('pelatihan.index', ['year' => $year]) }}" class="w-full py-2 text-center text-xs font-semibold text-slate-600 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 rounded-xl transition">
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
                        <th class="py-3.5 px-4">Program Pelatihan</th>
                        <th class="py-3.5 px-4">Kejuruan / Jenis</th>
                        <th class="py-3.5 px-3 text-center">Peserta</th>
                        <th class="py-3.5 px-3 text-center">L / P</th>
                        <th class="py-3.5 px-4 text-center">Jadwal Kelas</th>
                        <th class="py-3.5 px-3 text-center">Kelulusan</th>
                        <th class="py-3.5 px-4 text-center">Status Alur</th>
                        <th class="py-3.5 px-4 text-center w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($programs as $p)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-3 px-4 text-center font-bold text-slate-400">{{ $p->nomor ?? $loop->iteration }}</td>
                        <td class="py-3 px-4">
                            <p class="font-bold text-slate-800 text-sm">{{ $p->program_pelatihan }}</p>
                            <p class="text-[11px] text-slate-400">{{ $p->keterangan ?? 'Pelatihan Berbasis Kompetensi' }}</p>
                        </td>
                        <td class="py-3 px-4">
                            <span class="font-semibold text-slate-700 block">{{ $p->kejuruan }}</span>
                            <span class="text-[10px] text-teal-700 bg-teal-50 px-2 py-0.5 rounded-md font-medium">{{ $p->jenis_pelatihan }}</span>
                        </td>
                        <td class="py-3 px-3 text-center font-extrabold text-slate-800">
                            {{ $p->jumlah_peserta }} <span class="text-[10px] text-slate-400 font-normal">/ {{ $p->target_peserta }}</span>
                        </td>
                        <td class="py-3 px-3 text-center">
                            <span class="text-blue-600 font-bold">{{ $p->laki_laki }}</span> / 
                            <span class="text-pink-600 font-bold">{{ $p->perempuan }}</span>
                        </td>
                        <td class="py-3 px-4 text-center text-[11px] text-slate-500">
                            @if($p->tgl_mulai && $p->tgl_selesai)
                                {{ $p->tgl_mulai->format('d M') }} - {{ $p->tgl_selesai->format('d M Y') }}
                            @else
                                <span class="text-slate-400 italic">Jadwal belum ditentukan</span>
                            @endif
                        </td>
                        <td class="py-3 px-3 text-center">
                            @if($p->status_alur === 'Selesai')
                                <span class="font-bold text-emerald-600">{{ $p->lulus }} Lulus</span>
                                @if($p->tidak_lulus > 0)
                                    <span class="text-[10px] text-rose-500 block">({{ $p->tidak_lulus }} tidak lulus)</span>
                                @endif
                            @else
                                <span class="text-[11px] text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($p->status_alur === 'Selesai')
                                <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-emerald-100 text-emerald-800">Selesai</span>
                            @elseif($p->status_alur === 'Berjalan')
                                <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-blue-100 text-blue-800 animate-pulse">Berjalan</span>
                            @elseif($p->status_alur === 'Terverifikasi')
                                <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-purple-100 text-purple-800">Terverifikasi</span>
                            @else
                                <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-slate-100 text-slate-700">Draft</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <button @click="selectedItem = {{ json_encode($p) }}; editModal = true" type="button" 
                                        class="p-1.5 rounded-lg text-slate-400 hover:text-teal-600 hover:bg-slate-100 transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </button>
                                <form method="POST" action="{{ route('pelatihan.destroy', $p->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data program ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-slate-100 transition" title="Hapus">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="py-8 text-center text-slate-400">
                            <i class="fa-solid fa-inbox text-3xl text-slate-300 mb-2 block"></i>
                            Tidak ada data program pelatihan yang cocok dengan kriteria pencarian.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($programs->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $programs->links() }}
        </div>
        @endif
    </div>

    <!-- MODAL TAMBAH PROGRAM -->
    <div x-show="addModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
        <div @click.outside="addModal = false" class="bg-white rounded-2xl max-w-2xl w-full p-6 shadow-2xl border border-slate-100 space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 font-heading">Tambah Program Pelatihan UPTP</h3>
                <button @click="addModal = false" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>

            <form method="POST" action="{{ route('pelatihan.store') }}" class="space-y-4 text-xs">
                @csrf
                <input type="hidden" name="tahun" value="{{ $year }}">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Kejuruan *</label>
                        <select name="kejuruan" required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500">
                            <option value="">Pilih Kejuruan</option>
                            <option value="Teknologi Informasi dan Komunikasi (TIK)">Teknologi Informasi dan Komunikasi (TIK)</option>
                            <option value="Teknik Manufaktur dan Rekayasa (Las)">Teknik Manufaktur dan Rekayasa (Las)</option>
                            <option value="Teknik Otomotif">Teknik Otomotif</option>
                            <option value="Teknik Ketenagalistrikan">Teknik Ketenagalistrikan</option>
                            <option value="Pariwisata & Perhotelan">Pariwisata & Perhotelan</option>
                            <option value="Garmen Apparel">Garmen Apparel</option>
                            <option value="Bisnis dan Manajemen">Bisnis dan Manajemen</option>
                            <option value="Teknik Bangunan & Konstruksi">Teknik Bangunan & Konstruksi</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Jenis Pelatihan *</label>
                        <select name="jenis_pelatihan" required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500">
                            <option value="PBK Kelembagaan">PBK Kelembagaan</option>
                            <option value="PBK Non-Institusional (MTU)">PBK Non-Institusional (MTU)</option>
                            <option value="Tailor Made Training">Tailor Made Training</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Program & Batch *</label>
                    <input type="text" name="program_pelatihan" required placeholder="Contoh: Junior Web Developer - Batch 2" 
                           class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500">
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Target Peserta</label>
                        <input type="number" name="target_peserta" value="16" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Peserta Laki-laki</label>
                        <input type="number" name="laki_laki" value="0" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Peserta Perempuan</label>
                        <input type="number" name="perempuan" value="0" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Tanggal Mulai</label>
                        <input type="date" name="tgl_mulai" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Tanggal Selesai</label>
                        <input type="date" name="tgl_selesai" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Status Alur</label>
                        <select name="status_alur" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                            <option value="Draft">Draft</option>
                            <option value="Terverifikasi">Terverifikasi</option>
                            <option value="Berjalan">Berjalan</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Keterangan Tambahan</label>
                        <input type="text" name="keterangan" placeholder="Keterangan alur..." class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-4 border-t border-slate-100">
                    <button type="button" @click="addModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold shadow-xs">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT PROGRAM -->
    <div x-show="editModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
        <div @click.outside="editModal = false" class="bg-white rounded-2xl max-w-2xl w-full p-6 shadow-2xl border border-slate-100 space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 font-heading">Edit Program Pelatihan</h3>
                <button @click="editModal = false" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>

            <form :action="'/pelatihan/' + selectedItem.id" method="POST" class="space-y-4 text-xs">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Kejuruan *</label>
                        <input type="text" name="kejuruan" :value="selectedItem.kejuruan" required class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Jenis Pelatihan *</label>
                        <input type="text" name="jenis_pelatihan" :value="selectedItem.jenis_pelatihan" required class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Program Pelatihan *</label>
                    <input type="text" name="program_pelatihan" :value="selectedItem.program_pelatihan" required class="w-full px-3 py-2 rounded-xl border border-slate-200">
                </div>

                <div class="grid grid-cols-4 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Target</label>
                        <input type="number" name="target_peserta" :value="selectedItem.target_peserta" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Laki-Laki</label>
                        <input type="number" name="laki_laki" :value="selectedItem.laki_laki" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Perempuan</label>
                        <input type="number" name="perempuan" :value="selectedItem.perempuan" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Lulus</label>
                        <input type="number" name="lulus" :value="selectedItem.lulus" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Status Alur</label>
                        <select name="status_alur" :value="selectedItem.status_alur" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                            <option value="Draft">Draft</option>
                            <option value="Terverifikasi">Terverifikasi</option>
                            <option value="Berjalan">Berjalan</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Keterangan</label>
                        <input type="text" name="keterangan" :value="selectedItem.keterangan" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-4 border-t border-slate-100">
                    <button type="button" @click="editModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold shadow-xs">Perbarui Data</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
