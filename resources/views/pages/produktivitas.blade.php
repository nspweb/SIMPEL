@extends('layouts.app')

@section('title', 'Data Produktivitas')

@section('content')
<div class="space-y-6" x-data="{ addModal: false }">

    <!-- PAGE HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-teal-600 mb-1">
                <i class="fa-solid fa-arrow-trend-up"></i>
                <span>Peningkatan Produktivitas & Konsultasi UMKM</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-bold font-heading text-slate-900">Data Peningkatan Produktivitas {{ $year }}</h1>
            <p class="text-xs text-slate-500 mt-0.5">Monitoring pelaksanaan bimbingan konsultasi, pengukuran produktivitas, serta pendampingan metodologi 5S/Kaizen pada UMKM dan industri.</p>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('export.csv', ['module' => 'produktivitas', 'year' => $year]) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold border border-slate-200 transition">
                <i class="fa-solid fa-file-excel text-emerald-600"></i>
                <span>Export Excel/CSV</span>
            </a>
            <button @click="addModal = true" type="button" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold shadow-xs hover:shadow transition">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Kegiatan</span>
            </button>
        </div>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl p-5 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Kegiatan</p>
                <p class="text-2xl font-extrabold text-slate-800 font-heading mt-1">{{ $stats['total_kegiatan'] }} <span class="text-xs font-normal text-slate-500">Program</span></p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-chart-simple"></i>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Peserta Didampingi</p>
                <p class="text-2xl font-extrabold text-teal-700 font-heading mt-1">{{ number_format($stats['total_peserta']) }} <span class="text-xs font-normal text-slate-500">Orang</span></p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Perusahaan / UMKM Binaan</p>
                <p class="text-2xl font-extrabold text-amber-600 font-heading mt-1">{{ $stats['total_perusahaan'] }} <span class="text-xs font-normal text-slate-500">Entitas</span></p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-building"></i>
            </div>
        </div>
    </div>

    <!-- FILTER & SEARCH -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs">
        <form method="GET" action="{{ route('produktivitas.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
            <input type="hidden" name="year" value="{{ $year }}">
            
            <div class="sm:col-span-8 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama kegiatan, nama perusahaan, alamat, atau sektor..." 
                       class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500 bg-slate-50/50">
            </div>

            <div class="sm:col-span-3">
                <select name="sektor" onchange="this.form.submit()" 
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500 bg-slate-50/50">
                    <option value="">Semua Sektor Usaha</option>
                    @foreach($sektorList as $s)
                        <option value="{{ $s }}" {{ $sektor == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-1 flex items-center">
                <a href="{{ route('produktivitas.index', ['year' => $year]) }}" class="w-full py-2 text-center text-xs font-semibold text-slate-600 hover:text-slate-900 bg-slate-100 rounded-xl">
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
                        <th class="py-3.5 px-4">Nama Kegiatan & Metode</th>
                        <th class="py-3.5 px-3 text-center">Peserta</th>
                        <th class="py-3.5 px-4">Nama Perusahaan / UMKM</th>
                        <th class="py-3.5 px-4">Alamat Perusahaan</th>
                        <th class="py-3.5 px-4 text-center">Tanggal Pelaksanaan</th>
                        <th class="py-3.5 px-4">Sektor</th>
                        <th class="py-3.5 px-4 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($produktivitasList as $prod)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-3 px-4 text-center font-bold text-slate-400">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4">
                            <p class="font-bold text-slate-800 text-sm">{{ $prod->peserta }}</p>
                            <p class="text-[11px] text-slate-400">{{ $prod->keterangan ?? 'Bimbingan Konsultasi Produktivitas' }}</p>
                        </td>
                        <td class="py-3 px-3 text-center font-extrabold text-teal-700 bg-teal-50/40 text-sm">
                            {{ $prod->jumlah }}
                        </td>
                        <td class="py-3 px-4 font-bold text-slate-800">{{ $prod->nama_perusahaan }}</td>
                        <td class="py-3 px-4 text-slate-500 max-w-xs truncate" title="{{ $prod->alamat_perusahaan }}">{{ $prod->alamat_perusahaan ?? '-' }}</td>
                        <td class="py-3 px-4 text-center text-slate-600 font-medium">
                            {{ $prod->tanggal_kegiatan ? $prod->tanggal_kegiatan->format('d M Y') : '-' }}
                        </td>
                        <td class="py-3 px-4">
                            <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-slate-100 text-slate-700 border border-slate-200">
                                {{ $prod->sektor ?? 'Umum' }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <form method="POST" action="{{ route('produktivitas.destroy', $prod->id) }}" onsubmit="return confirm('Hapus data kegiatan produktivitas ini?')">
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
                        <td colspan="8" class="py-8 text-center text-slate-400">
                            <i class="fa-solid fa-inbox text-3xl text-slate-300 mb-2 block"></i>
                            Belum ada data kegiatan produktivitas yang tercatat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($produktivitasList->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $produktivitasList->links() }}
        </div>
        @endif
    </div>

    <!-- MODAL TAMBAH KEGIATAN PRODUKTIVITAS -->
    <div x-show="addModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
        <div @click.outside="addModal = false" class="bg-white rounded-2xl max-w-2xl w-full p-6 shadow-2xl border border-slate-100 space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 font-heading">Tambah Kegiatan Produktivitas</h3>
                <button @click="addModal = false" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>

            <form method="POST" action="{{ route('produktivitas.store') }}" class="space-y-4 text-xs">
                @csrf
                <input type="hidden" name="tahun" value="{{ $year }}">

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Kegiatan & Sasaran *</label>
                    <input type="text" name="peserta" required placeholder="Contoh: Bimbingan Konsultasi Peningkatan Produktivitas UMKM Olahan Pangan" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Nama Perusahaan / UMKM *</label>
                        <input type="text" name="nama_perusahaan" required placeholder="Contoh: CV Sumber Rezeki Sultra" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Jumlah Peserta Terlibat *</label>
                        <input type="number" name="jumlah" required value="25" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal_kegiatan" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Sektor Usaha</label>
                        <input type="text" name="sektor" placeholder="Contoh: Industri Pengolahan Pangan" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Alamat Perusahaan</label>
                    <input type="text" name="alamat_perusahaan" placeholder="Alamat lengkap lokasi kegiatan..." class="w-full px-3 py-2 rounded-xl border border-slate-200">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Keterangan / Metodologi</label>
                    <input type="text" name="keterangan" placeholder="Contoh: Penerapan 5S/Kaizen dan Green Productivity" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                </div>

                <div class="flex items-center justify-end gap-2 pt-4 border-t border-slate-100">
                    <button type="button" @click="addModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold shadow-xs">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
