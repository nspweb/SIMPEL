@extends('layouts.app')

@section('title', 'Formulir Pemberdayaan & Peserta')

@section('content')
<div class="max-w-4xl mx-auto space-y-6" x-data="{ selectedProgram: '' }">

    <!-- BREADCRUMB -->
    <div class="flex items-center justify-between">
        <a href="{{ route('input.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-teal-600 transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Pusat Input</span>
        </a>
        <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold">
            Tahap 2: Pengisian & Verifikasi Peserta
        </span>
    </div>

    <!-- MAIN CARD -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- HEADER -->
        <div class="p-6 bg-gradient-to-r from-brand-900 to-blue-900 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-blue-300 text-lg border border-white/20">
                    <i class="fa-solid fa-users-rectangle"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold font-heading">Input Pemberdayaan & Peserta (BNBA)</h2>
                    <p class="text-xs text-slate-200">Verifikasi berkas, pembagian kuota laki-laki/perempuan, dan penetapan kelulusan kelas</p>
                </div>
            </div>
            <a href="{{ route('pelatihan.index') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white text-xs font-medium border border-white/20 transition">
                <i class="fa-solid fa-list-check"></i>
                <span>Lihat Status Kelas</span>
            </a>
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('pelatihan.store') }}" class="p-6 sm:p-8 space-y-6">
            @csrf
            <input type="hidden" name="tahun" value="{{ request('year', 2026) }}">

            <!-- SECTION 1: PILIH PROGRAM KELAS -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-full bg-blue-100 text-blue-800 text-xs font-bold flex items-center justify-center">1</span>
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Pilih Paket Program Pelatihan</h3>
                </div>

                <div class="text-xs">
                    <label class="block font-semibold text-slate-700 mb-1.5">Program Pelatihan Target <span class="text-red-500">*</span></label>
                    <select name="program_pelatihan" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-slate-50/50">
                        <option value="">-- Pilih Program yang Membuka Pendaftaran --</option>
                        @foreach($programs as $prog)
                            <option value="{{ $prog->program_pelatihan }}">
                                {{ $prog->program_pelatihan }} ({{ $prog->kejuruan }} - Status: {{ $prog->status_alur }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Kejuruan</label>
                        <input type="text" name="kejuruan" placeholder="Kejuruan otomatis atau isi manual..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Jenis Pelatihan</label>
                        <input type="text" name="jenis_pelatihan" value="PBK Kelembagaan" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50">
                    </div>
                </div>
            </div>

            <!-- SECTION 2: KOMPOSISI PESERTA & KELULUSAN -->
            <div class="space-y-4 pt-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-full bg-blue-100 text-blue-800 text-xs font-bold flex items-center justify-center">2</span>
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Data Peserta & Kelulusan</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Peserta Laki-Laki</label>
                        <input type="number" name="laki_laki" value="8" min="0" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-slate-50/50 font-bold text-blue-700">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Peserta Perempuan</label>
                        <input type="number" name="perempuan" value="8" min="0" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-slate-50/50 font-bold text-pink-700">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Jumlah Lulus</label>
                        <input type="number" name="lulus" value="16" min="0" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-slate-50/50 font-bold text-emerald-700">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Tidak Lulus / DO</label>
                        <input type="number" name="tidak_lulus" value="0" min="0" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-slate-50/50 font-bold text-rose-700">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Update Status Alur</label>
                        <select name="status_alur" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-slate-50/50 font-bold text-slate-800">
                            <option value="Terverifikasi">Terverifikasi (Peserta Lengkap)</option>
                            <option value="Berjalan">Sedang Berjalan</option>
                            <option value="Selesai">Selesai (Sudah Uji Kelulusan)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Tanggal Masuk / Registrasi Ulang</label>
                        <input type="date" name="tgl_masuk" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-slate-50/50">
                    </div>
                </div>
            </div>

            <!-- ACTION BAR -->
            <div class="pt-6 border-t border-slate-200 flex items-center justify-between">
                <button type="reset" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-100 transition">
                    <i class="fa-solid fa-rotate-left mr-1.5"></i> Reset
                </button>
                <div class="flex items-center gap-3">
                    <a href="{{ route('pelatihan.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Simpan Data Pemberdayaan</span>
                    </button>
                </div>
            </div>

        </form>

    </div>

</div>
@endsection
