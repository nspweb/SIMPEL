@extends('layouts.app')

@section('title', 'Formulir Pengadaan & Keuangan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6" x-data="{ mode: 'pengadaan' }">

    <!-- BREADCRUMB -->
    <div class="flex items-center justify-between">
        <a href="{{ route('input.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-teal-600 transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Pusat Input</span>
        </a>
        <span class="px-3 py-1 rounded-full bg-purple-50 text-purple-700 text-xs font-bold">
            Administrasi Umum & Logistik Keuangan
        </span>
    </div>

    <!-- MODE SWITCHER -->
    <div class="flex p-1.5 bg-slate-200/80 rounded-2xl max-w-md mx-auto">
        <button @click="mode = 'pengadaan'" type="button" 
                class="flex-1 py-2 text-xs font-bold rounded-xl transition flex items-center justify-center gap-2"
                :class="mode === 'pengadaan' ? 'bg-white text-slate-900 shadow-xs' : 'text-slate-600 hover:text-slate-900'">
            <i class="fa-solid fa-boxes-packing text-xs"></i>
            <span>Pengajuan Pengadaan</span>
        </button>
        <button @click="mode = 'pembayaran'" type="button" 
                class="flex-1 py-2 text-xs font-bold rounded-xl transition flex items-center justify-center gap-2"
                :class="mode === 'pembayaran' ? 'bg-white text-slate-900 shadow-xs' : 'text-slate-600 hover:text-slate-900'">
            <i class="fa-solid fa-money-check-dollar text-xs"></i>
            <span>Pencatatan Pembayaran</span>
        </button>
    </div>

    <!-- PENGADAAN FORM CARD -->
    <div x-show="mode === 'pengadaan'" class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="p-6 bg-gradient-to-r from-brand-900 to-purple-900 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-purple-300 text-lg border border-white/20">
                    <i class="fa-solid fa-boxes-packing"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold font-heading">Formulir Pengajuan Pengadaan Bahan/Alat</h2>
                    <p class="text-xs text-slate-200">Logistik praktek, alat peraga workshop, modul pelatihan, dan APD K3</p>
                </div>
            </div>
            <a href="{{ route('umum.index', ['tab' => 'pengadaan']) }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white text-xs font-medium border border-white/20 transition">
                <i class="fa-solid fa-table-list"></i>
                <span>Data Pengadaan</span>
            </a>
        </div>

        <form method="POST" action="{{ route('umum.pengadaan.store') }}" class="p-6 sm:p-8 space-y-6">
            @csrf
            <input type="hidden" name="tahun" value="{{ request('year', 2026) }}">

            <div class="space-y-4 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Program Pelatihan / Batch Terkait <span class="text-red-500">*</span></label>
                    <input type="text" name="program_batch" required placeholder="Contoh: Pengelasan SMAW 3G - Batch 1" 
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-purple-500 focus:outline-none bg-slate-50/50">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Jenis Kategori Logistik <span class="text-red-500">*</span></label>
                        <select name="jenis" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-purple-500 focus:outline-none bg-slate-50/50">
                            <option value="Bahan Pelatihan">Bahan Praktek Pelatihan</option>
                            <option value="Alat / Peraga Praktek">Alat / Peraga Praktek</option>
                            <option value="Modul / ATK">Buku Modul & ATK Peserta</option>
                            <option value="Perlengkapan K3 / APD">Perlengkapan K3 & Seragam</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Nama Alat / Bahan <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_alat_bahan" required placeholder="Contoh: Elektroda LB-52 & Plat Baja Karbon" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-purple-500 focus:outline-none bg-slate-50/50">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Jumlah Kebutuhan</label>
                        <input type="number" name="jumlah" value="16" min="1" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-purple-500 focus:outline-none bg-slate-50/50">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Satuan</label>
                        <input type="text" name="satuan" value="Paket / Set" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-purple-500 focus:outline-none bg-slate-50/50">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Perkiraan Nilai Pengadaan (Rp)</label>
                        <input type="number" name="perkiraan_nilai" value="5000000" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-purple-500 focus:outline-none bg-slate-50/50 font-bold text-purple-700">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Spesifikasi Detail & Merek Standar</label>
                    <textarea name="spesifikasi" rows="2" placeholder="Tulis spesifikasi standar PUIL/SKKNI, merek, ukuran, ketebalan..." 
                              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-purple-500 focus:outline-none bg-slate-50/50"></textarea>
                </div>
            </div>

            <!-- ACTION BAR -->
            <div class="pt-6 border-t border-slate-200 flex items-center justify-between">
                <button type="reset" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-100 transition">
                    <i class="fa-solid fa-rotate-left mr-1.5"></i> Reset
                </button>
                <div class="flex items-center gap-3">
                    <a href="{{ route('umum.index', ['tab' => 'pengadaan']) }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Kirim Pengajuan Pengadaan</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- PEMBAYARAN FORM CARD -->
    <div x-show="mode === 'pembayaran'" class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="p-6 bg-gradient-to-r from-brand-900 to-emerald-900 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-emerald-300 text-lg border border-white/20">
                    <i class="fa-solid fa-money-check-dollar"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold font-heading">Formulir Pencatatan Pembayaran & Honor</h2>
                    <p class="text-xs text-slate-200">Pencairan uang saku peserta, honor instruktur, dan logistik SP2D</p>
                </div>
            </div>
            <a href="{{ route('umum.index', ['tab' => 'pembayaran']) }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white text-xs font-medium border border-white/20 transition">
                <i class="fa-solid fa-table-list"></i>
                <span>Log Pembayaran</span>
            </a>
        </div>

        <form method="POST" action="{{ route('umum.pembayaran.store') }}" class="p-6 sm:p-8 space-y-6">
            @csrf
            <input type="hidden" name="tahun" value="{{ request('year', 2026) }}">

            <div class="space-y-4 text-xs">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Program / Batch Pelatihan <span class="text-red-500">*</span></label>
                        <input type="text" name="program_batch" required placeholder="Contoh: Barista & Tata Hidang Kopi - Batch 1" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-slate-50/50">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Besaran Nilai Pengajuan (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="nilai_pengajuan" required placeholder="Contoh: 19500000" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-slate-50/50 font-bold text-emerald-700">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Peruntukan / Penerima Pembayaran <span class="text-red-500">*</span></label>
                    <input type="text" name="peserta" required placeholder="Contoh: Honorarium Instruktur & Uang Harian Peserta Batch 1" 
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-slate-50/50">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Tanggal Pengajuan</label>
                        <input type="date" name="tanggal_pengajuan" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-slate-50/50">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Tanggal Pencairan / Bayar</label>
                        <input type="date" name="tanggal_bayar" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-slate-50/50">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Status Pembayaran</label>
                        <select name="status_pembayaran" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-slate-50/50">
                            <option value="Menunggu Verifikasi">Menunggu Verifikasi</option>
                            <option value="Disetujui">Disetujui</option>
                            <option value="Dicairkan">Dicairkan (Lunas)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Nomor SP2D / Kuitansi & Keterangan</label>
                    <input type="text" name="catatan" placeholder="Contoh: SP2D No. 0045/BPVP/2026 tanggal 12 Mei 2026" 
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-slate-50/50">
                </div>
            </div>

            <!-- ACTION BAR -->
            <div class="pt-6 border-t border-slate-200 flex items-center justify-between">
                <button type="reset" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-100 transition">
                    <i class="fa-solid fa-rotate-left mr-1.5"></i> Reset
                </button>
                <div class="flex items-center gap-3">
                    <a href="{{ route('umum.index', ['tab' => 'pembayaran']) }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Simpan Data Pembayaran</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
