@extends('layouts.app')

@section('title', 'Pusat Formulir Input')

@section('content')
<div class="space-y-6">

    <!-- HEADER BANNER -->
    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-teal-50 text-teal-700 text-xs font-bold mb-2">
                <i class="fa-solid fa-pen-to-square"></i>
                <span>Workspace Input Terpadu</span>
            </div>
            <h1 class="text-2xl font-bold font-heading text-slate-900">Pusat Penginputan & Manajemen Data</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-2xl leading-relaxed">
                Pilih modul kerja di bawah ini untuk mengisi dan memperbarui data operasional BPVP Kendari. Formulir telah diredesain secara terstruktur untuk memudahkan alur kerja Anda.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <span class="px-3 py-1.5 rounded-xl bg-slate-100 text-slate-700 text-xs font-semibold border border-slate-200">
                <i class="fa-regular fa-calendar mr-1.5 text-teal-600"></i> Tahun Aktif: <strong>{{ request('year', 2026) }}</strong>
            </span>
        </div>
    </div>

    <!-- WORKSPACE MODULE CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Card 1: Penyelenggara Pelatihan -->
        <a href="{{ route('input.penyelenggara') }}" class="group bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-teal-500 transition-all duration-200 flex flex-col justify-between">
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl group-hover:bg-teal-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <span class="text-[10px] font-extrabold uppercase px-2.5 py-1 rounded-full bg-teal-50 text-teal-700">Tahap 1</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-teal-700 transition font-heading">Input Penyelenggara</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Pembuatan paket program pelatihan, penetapan kuota peserta, kejuruan, instruktur, dan jadwal pelaksanaan kelas.
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-teal-600">
                <span>Buka Formulir</span>
                <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
            </div>
        </a>

        <!-- Card 2: Pemberdayaan & Peserta (BNBA) -->
        <a href="{{ route('input.pemberdayaan') }}" class="group bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-blue-500 transition-all duration-200 flex flex-col justify-between">
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-users-rectangle"></i>
                    </div>
                    <span class="text-[10px] font-extrabold uppercase px-2.5 py-1 rounded-full bg-blue-50 text-blue-700">Tahap 2</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700 transition font-heading">Input Pemberdayaan & Peserta</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Registrasi peserta latih (By Name By Address / BNBA), verifikasi berkas pendaftaran, dan penetapan status kelulusan.
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-blue-600">
                <span>Buka Formulir</span>
                <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
            </div>
        </a>

        <!-- Card 3: Sertifikasi LSP -->
        <a href="{{ route('input.lsp') }}" class="group bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-amber-500 transition-all duration-200 flex flex-col justify-between">
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl group-hover:bg-amber-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-stamp"></i>
                    </div>
                    <span class="text-[10px] font-extrabold uppercase px-2.5 py-1 rounded-full bg-amber-50 text-amber-700">LSP P1</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-amber-700 transition font-heading">Input Sertifikasi LSP</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Pendaftaran asesi uji kompetensi, penugasan asesor, pencatatan hasil UJK (K/BK), dan status blanko sertifikat BNSP.
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-amber-600">
                <span>Buka Formulir</span>
                <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
            </div>
        </a>

        <!-- Card 4: Produktivitas -->
        <a href="{{ route('input.produktivitas') }}" class="group bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-emerald-500 transition-all duration-200 flex flex-col justify-between">
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                    </div>
                    <span class="text-[10px] font-extrabold uppercase px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700">UMKM</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-emerald-700 transition font-heading">Input Produktivitas</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Pendataan bimbingan konsultasi peningkatan produktivitas, audit 5S/Kaizen, dan pendampingan perusahaan mitra.
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-emerald-600">
                <span>Buka Formulir</span>
                <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
            </div>
        </a>

        <!-- Card 5: Pengadaan & Keuangan -->
        <a href="{{ route('input.umum') }}" class="group bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-purple-500 transition-all duration-200 flex flex-col justify-between">
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl group-hover:bg-purple-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                    <span class="text-[10px] font-extrabold uppercase px-2.5 py-1 rounded-full bg-purple-50 text-purple-700">Umum & Keu</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-purple-700 transition font-heading">Input Pengadaan & Keuangan</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Pengajuan logistik alat/bahan praktek pelatihan dan pencatatan honorarium instruktur / uang saku peserta.
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-purple-600">
                <span>Buka Formulir</span>
                <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
            </div>
        </a>

    </div>

</div>
@endsection
