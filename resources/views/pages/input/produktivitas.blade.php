@extends('layouts.app')

@section('title', 'Formulir Input Produktivitas')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- BREADCRUMB -->
    <div class="flex items-center justify-between">
        <a href="{{ route('input.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-teal-600 transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Pusat Input</span>
        </a>
        <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold">
            Peningkatan Produktivitas Tenaga Kerja & UMKM
        </span>
    </div>

    <!-- MAIN FORM CARD -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- HEADER -->
        <div class="p-6 bg-gradient-to-r from-brand-900 to-emerald-900 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-emerald-300 text-lg border border-white/20">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold font-heading">Input Kegiatan Peningkatan Produktivitas</h2>
                    <p class="text-xs text-slate-200">Pendampingan metodologi 5S/Kaizen, Green Productivity, dan audit UMKM binaan</p>
                </div>
            </div>
            <a href="{{ route('produktivitas.index') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white text-xs font-medium border border-white/20 transition">
                <i class="fa-solid fa-table-list"></i>
                <span>Data Produktivitas</span>
            </a>
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('produktivitas.store') }}" class="p-6 sm:p-8 space-y-6">
            @csrf
            <input type="hidden" name="tahun" value="{{ request('year', 2026) }}">

            <div class="space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold flex items-center justify-center">1</span>
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Rincian Kegiatan & Perusahaan Sasaran</h3>
                </div>

                <div class="text-xs">
                    <label class="block font-semibold text-slate-700 mb-1.5">Nama Program / Kegiatan Produktivitas <span class="text-red-500">*</span></label>
                    <input type="text" name="peserta" required placeholder="Contoh: Bimbingan Konsultasi Peningkatan Produktivitas UMKM Olahan Pangan" 
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-slate-50/50">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Nama Perusahaan / Kelompok Usaha <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_perusahaan" required placeholder="Contoh: CV Sumber Rezeki Sultra" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-slate-50/50">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Jumlah Tenaga Kerja Didampingi <span class="text-red-500">*</span></label>
                        <input type="number" name="jumlah" required value="25" min="1" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-slate-50/50 font-bold text-slate-800">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Tanggal Pelaksanaan Kegiatan</label>
                        <input type="date" name="tanggal_kegiatan" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-slate-50/50">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Sektor Industri / Usaha</label>
                        <select name="sektor" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-slate-50/50">
                            <option value="Industri Pengolahan Pangan">Industri Pengolahan Pangan</option>
                            <option value="Kerajinan & Furnitur">Kerajinan & Furnitur</option>
                            <option value="Jasa Perbaikan & Fabrikasi">Jasa Perbaikan & Fabrikasi</option>
                            <option value="Pariwisata & Hospitality">Pariwisata & Hospitality</option>
                            <option value="Perdagangan & Distribusi">Perdagangan & Distribusi</option>
                        </select>
                    </div>
                </div>

                <div class="text-xs">
                    <label class="block font-semibold text-slate-700 mb-1.5">Alamat Lokasi Usaha / Workshop</label>
                    <input type="text" name="alamat_perusahaan" placeholder="Jalan, kelurahan, kecamatan, kab/kota..." 
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-slate-50/50">
                </div>

                <div class="text-xs">
                    <label class="block font-semibold text-slate-700 mb-1.5">Metodologi & Capaian Intervensi</label>
                    <textarea name="keterangan" rows="2" placeholder="Penerapan 5S, pengurangan waste produksi, tata letak layout workshop..." 
                              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-slate-50/50"></textarea>
                </div>
            </div>

            <!-- ACTION BAR -->
            <div class="pt-6 border-t border-slate-200 flex items-center justify-between">
                <button type="reset" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-100 transition">
                    <i class="fa-solid fa-rotate-left mr-1.5"></i> Reset
                </button>
                <div class="flex items-center gap-3">
                    <a href="{{ route('produktivitas.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Simpan Kegiatan Produktivitas</span>
                    </button>
                </div>
            </div>

        </form>

    </div>

</div>
@endsection
