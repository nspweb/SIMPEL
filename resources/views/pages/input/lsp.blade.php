@extends('layouts.app')

@section('title', 'Formulir Sertifikasi LSP')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- BREADCRUMB -->
    <div class="flex items-center justify-between">
        <a href="{{ route('input.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-teal-600 transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Pusat Input</span>
        </a>
        <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-bold">
            Modul LSP P1: Asesmen Kompetensi BNSP
        </span>
    </div>

    <!-- MAIN FORM CARD -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- HEADER -->
        <div class="p-6 bg-gradient-to-r from-brand-900 via-brand-800 to-amber-900 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-amber-300 text-lg border border-white/20">
                    <i class="fa-solid fa-stamp"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold font-heading">Pendaftaran & Hasil Uji Sertifikasi (LSP)</h2>
                    <p class="text-xs text-slate-200">Registrasi asesi, penugasan asesor kompetensi, dan pelaporan hasil UJK</p>
                </div>
            </div>
            <a href="{{ route('sertifikasi.index') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white text-xs font-medium border border-white/20 transition">
                <i class="fa-solid fa-table-list"></i>
                <span>Data Sertifikasi</span>
            </a>
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('sertifikasi.store') }}" class="p-6 sm:p-8 space-y-6">
            @csrf
            <input type="hidden" name="tahun" value="{{ request('year', 2026) }}">

            <!-- SECTION 1: SKEMA & TUK -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-full bg-amber-100 text-amber-800 text-xs font-bold flex items-center justify-center">1</span>
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Skema & Tempat Uji Kompetensi (TUK)</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Skema Sertifikasi BNSP <span class="text-red-500">*</span></label>
                        <select name="skema" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-slate-50/50">
                            <option value="">-- Pilih Skema Sertifikasi --</option>
                            <option value="Pemrograman Web (Junior Web Developer)">Pemrograman Web (Junior Web Developer)</option>
                            <option value="Pengelasan SMAW 3G">Pengelasan SMAW 3G</option>
                            <option value="Teknisi Servis Sepeda Motor Injeksi">Teknisi Servis Sepeda Motor Injeksi</option>
                            <option value="Barista dan Tata Hidang Kopi">Barista dan Tata Hidang Kopi</option>
                            <option value="Desainer Grafis Muda">Desainer Grafis Muda</option>
                            <option value="Pemasangan Instalasi Listrik Bangunan">Pemasangan Instalasi Listrik Bangunan</option>
                            <option value="Operator Pengoperasian Mesin Bubut">Operator Pengoperasian Mesin Bubut</option>
                            <option value="Menjahit Pakaian Sesuai Style">Menjahit Pakaian Sesuai Style</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Tempat Uji Kompetensi (TUK) <span class="text-red-500">*</span></label>
                        <input type="text" name="tuk" required value="TUK Sewaktu BPVP Kendari" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-slate-50/50">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Asesor Penguji (Nama & No. Registrasi MET)</label>
                        <input type="text" name="asesor" placeholder="Contoh: Ir. Hendra Saputra, M.Kom (MET.000.001)" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-slate-50/50">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Tahap Pelaksanaan</label>
                        <input type="text" name="tahap" value="Tahap 1" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-slate-50/50">
                    </div>
                </div>
            </div>

            <!-- SECTION 2: BIODATA ASESI -->
            <div class="space-y-4 pt-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-full bg-amber-100 text-amber-800 text-xs font-bold flex items-center justify-center">2</span>
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Biodata Lengkap Asesi</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Nama Lengkap Sesuai KTP <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" required placeholder="Nama lengkap tanpa gelar atau dengan gelar" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-slate-50/50">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Nomor KTP / NIK (16 Digit)</label>
                        <input type="text" name="nomor_ktp" maxlength="20" placeholder="7471xxxxxxxxxxxx" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-slate-50/50 font-mono">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-slate-50/50">
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Pendidikan Terakhir</label>
                        <input type="text" name="kualifikasi_pendidikan" placeholder="Contoh: S1 / D3 / SMK" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-slate-50/50">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Nomor Telepon / WhatsApp</label>
                        <input type="text" name="nomor_telepon" placeholder="08xxxxxxxxxx" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-slate-50/50">
                    </div>
                </div>

                <div class="text-xs">
                    <label class="block font-semibold text-slate-700 mb-1.5">Alamat Lengkap Asesi</label>
                    <input type="text" name="alamat_rumah" placeholder="Jalan, kelurahan, kecamatan, kota/kabupaten..." 
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-slate-50/50">
                </div>
            </div>

            <!-- SECTION 3: HASIL UJK & SERTIFIKAT -->
            <div class="space-y-4 pt-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-full bg-amber-100 text-amber-800 text-xs font-bold flex items-center justify-center">3</span>
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Rekomendasi Asesmen & Pencetakan Blanko</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Hasil UJK Asesor <span class="text-red-500">*</span></label>
                        <select name="hasil_ujk" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-slate-50/50 font-bold text-slate-800">
                            <option value="Kompeten">Kompeten (K)</option>
                            <option value="Belum Kompeten">Belum Kompeten (BK)</option>
                            <option value="Belum Uji">Belum Uji (Terdaftar)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Kelengkapan APL 01 & 02</label>
                        <select name="form_apl_01_02" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-slate-50/50">
                            <option value="Lengkap">Lengkap (Terverifikasi)</option>
                            <option value="Belum">Belum Lengkap</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Status Cetak Blanko Sertifikat</label>
                        <select name="cetak_sertifikat" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-slate-50/50">
                            <option value="Sudah">Sudah Dicetak</option>
                            <option value="Proses">Dalam Proses</option>
                            <option value="Belum">Belum Dicetak</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- ACTION BAR -->
            <div class="pt-6 border-t border-slate-200 flex items-center justify-between">
                <button type="reset" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-100 transition">
                    <i class="fa-solid fa-rotate-left mr-1.5"></i> Reset
                </button>
                <div class="flex items-center gap-3">
                    <a href="{{ route('sertifikasi.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Daftarkan & Simpan Asesi</span>
                    </button>
                </div>
            </div>

        </form>

    </div>

</div>
@endsection
