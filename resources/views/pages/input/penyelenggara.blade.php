@extends('layouts.app')

@section('title', 'Formulir Penyelenggara Pelatihan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- BREADCRUMB & BACK LINK -->
    <div class="flex items-center justify-between">
        <a href="{{ route('input.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-teal-600 transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Pusat Input</span>
        </a>
        <span class="px-3 py-1 rounded-full bg-teal-50 text-teal-700 text-xs font-bold">
            Tahap 1: Pembukaan Kelas & Program
        </span>
    </div>

    <!-- MAIN FORM CARD -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- FORM HEADER -->
        <div class="p-6 bg-gradient-to-r from-brand-900 to-brand-700 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-teal-300 text-lg border border-white/20">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold font-heading">Formulir Input Penyelenggara</h2>
                    <p class="text-xs text-slate-200">Buat paket program pelatihan kerja baru BPVP Kendari TA {{ request('year', 2026) }}</p>
                </div>
            </div>
            <a href="{{ route('pelatihan.index') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white text-xs font-medium border border-white/20 transition">
                <i class="fa-solid fa-table-list"></i>
                <span>Lihat Data Pelatihan</span>
            </a>
        </div>

        <!-- FORM BODY -->
        <form method="POST" action="{{ route('pelatihan.store') }}" class="p-6 sm:p-8 space-y-6">
            @csrf
            <input type="hidden" name="tahun" value="{{ request('year', 2026) }}">

            <!-- SECTION 1: INFORMASI PROGRAM -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-full bg-teal-100 text-teal-800 text-xs font-bold flex items-center justify-center">1</span>
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Identitas Program & Kejuruan</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Kejuruan Pelatihan <span class="text-red-500">*</span></label>
                        <select name="kejuruan" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:outline-none bg-slate-50/50">
                            <option value="">-- Pilih Kejuruan --</option>
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
                        <label class="block font-semibold text-slate-700 mb-1.5">Jenis Skema Pelatihan <span class="text-red-500">*</span></label>
                        <select name="jenis_pelatihan" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:outline-none bg-slate-50/50">
                            <option value="PBK Kelembagaan">PBK Kelembagaan (Reguler UPTP)</option>
                            <option value="PBK Non-Institusional (MTU)">PBK Non-Institusional (Mobile Training Unit / MTU)</option>
                            <option value="Tailor Made Training">Tailor Made Training (Kerjasama Khusus)</option>
                        </select>
                    </div>
                </div>

                <div class="text-xs">
                    <label class="block font-semibold text-slate-700 mb-1.5">Nama Program Pelatihan & Nomor Batch <span class="text-red-500">*</span></label>
                    <input type="text" name="program_pelatihan" required placeholder="Contoh: Junior Web Developer - Batch 2" 
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:outline-none bg-slate-50/50 text-slate-800">
                </div>
            </div>

            <!-- SECTION 2: JADWAL & KUOTA -->
            <div class="space-y-4 pt-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-full bg-teal-100 text-teal-800 text-xs font-bold flex items-center justify-center">2</span>
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Target Kuota & Jadwal Pelaksanaan</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Target Kuota Peserta</label>
                        <input type="number" name="target_peserta" value="16" min="1" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:outline-none bg-slate-50/50">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Bulan Pelaksanaan</label>
                        <select name="bulan_mulai" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:outline-none bg-slate-50/50">
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Status Alur Awal</label>
                        <select name="status_alur" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:outline-none bg-slate-50/50">
                            <option value="Draft">Draft (Persiapan)</option>
                            <option value="Terverifikasi">Terverifikasi (Siap Mulai)</option>
                            <option value="Berjalan">Sedang Berjalan</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Tanggal Mulai Pelatihan</label>
                        <input type="date" name="tgl_mulai" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:outline-none bg-slate-50/50">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Tanggal Selesai Pelatihan</label>
                        <input type="date" name="tgl_selesai" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:outline-none bg-slate-50/50">
                    </div>
                </div>

                <div class="text-xs">
                    <label class="block font-semibold text-slate-700 mb-1.5">Catatan / Keterangan Khusus</label>
                    <textarea name="keterangan" rows="2" placeholder="Catatan instruktur, tempat workshop, atau standar SKKNI..." 
                              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:outline-none bg-slate-50/50"></textarea>
                </div>
            </div>

            <!-- UNIFIED ACTION BUTTONS (CLEAN & ELEGANT) -->
            <div class="pt-6 border-t border-slate-200 flex items-center justify-between">
                <button type="reset" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-100 transition">
                    <i class="fa-solid fa-rotate-left mr-1.5"></i> Reset Form
                </button>
                <div class="flex items-center gap-3">
                    <a href="{{ route('pelatihan.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Simpan Program Pelatihan</span>
                    </button>
                </div>
            </div>

        </form>

    </div>

    <!-- RECENT PROGRAMS QUICK LIST -->
    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs">
        <h4 class="text-sm font-bold text-slate-800 mb-3 font-heading">10 Program Pelatihan Terakhir Terdaftar</h4>
        <div class="divide-y divide-slate-100 text-xs">
            @forelse($programs as $p)
            <div class="py-2.5 flex items-center justify-between">
                <div>
                    <span class="font-bold text-slate-800">{{ $p->program_pelatihan }}</span>
                    <span class="text-slate-400 ml-2">({{ $p->kejuruan }})</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-[11px] font-semibold text-slate-500">{{ $p->jumlah_peserta }} Peserta</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-teal-50 text-teal-700">{{ $p->status_alur }}</span>
                </div>
            </div>
            @empty
            <p class="py-2 text-slate-400 italic">Belum ada program pelatihan terdaftar.</p>
            @endforelse
        </div>
    </div>

</div>
@endsection
