@extends('layouts.app')

@section('title', 'Umum & Keuangan')

@section('content')
<div class="space-y-6" x-data="{ addPengadaanModal: false, addPembayaranModal: false }">

    <!-- PAGE HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-teal-600 mb-1">
                <i class="fa-solid fa-boxes-stacked"></i>
                <span>Administrasi Umum & Tata Usaha</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-bold font-heading text-slate-900">Pengadaan Bahan & Pencairan Pembayaran {{ $year }}</h1>
            <p class="text-xs text-slate-500 mt-0.5">Pencatatan pengadaan logistik pelatihan, alat peraga, bahan praktek workshop, serta tracking status pencairan pembayaran operasional.</p>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            @if($tab === 'pengadaan')
            <button @click="addPengadaanModal = true" type="button" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold shadow-xs hover:shadow transition">
                <i class="fa-solid fa-plus"></i>
                <span>Ajukan Pengadaan</span>
            </button>
            @else
            <button @click="addPembayaranModal = true" type="button" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold shadow-xs hover:shadow transition">
                <i class="fa-solid fa-plus"></i>
                <span>Catat Pembayaran</span>
            </button>
            @endif
        </div>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Pengajuan Pengadaan</p>
            <p class="text-xl font-extrabold text-slate-800 font-heading mt-1">{{ $stats['total_pengadaan'] }} <span class="text-xs font-normal text-slate-500">Item</span></p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-blue-600">Estimasi Nilai Pengadaan</p>
            <p class="text-xl font-extrabold text-blue-700 font-heading mt-1">Rp {{ number_format($stats['total_nilai_pengadaan'], 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-600">Total Dicairkan</p>
            <p class="text-xl font-extrabold text-emerald-700 font-heading mt-1">Rp {{ number_format($stats['total_pencairan'], 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-amber-500">Menunggu Verifikasi Bayar</p>
            <p class="text-xl font-extrabold text-amber-600 font-heading mt-1">{{ $stats['menunggu_bayar'] }} <span class="text-xs font-normal text-slate-500">Pengajuan</span></p>
        </div>
    </div>

    <!-- TABS SWITCHER -->
    <div class="flex items-center gap-2 border-b border-slate-200 pb-2">
        <a href="{{ route('umum.index', ['tab' => 'pengadaan', 'year' => $year]) }}" 
           class="px-5 py-2.5 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ $tab === 'pengadaan' ? 'bg-brand-800 text-white shadow-xs' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
            <i class="fa-solid fa-boxes-packing text-xs"></i>
            <span>Daftar Pengadaan Bahan & Alat</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $tab === 'pengadaan' ? 'bg-teal-500 text-white' : 'bg-slate-100 text-slate-700' }}">{{ $stats['total_pengadaan'] }}</span>
        </a>
        <a href="{{ route('umum.index', ['tab' => 'pembayaran', 'year' => $year]) }}" 
           class="px-5 py-2.5 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ $tab === 'pembayaran' ? 'bg-brand-800 text-white shadow-xs' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
            <i class="fa-solid fa-money-check-dollar text-xs"></i>
            <span>Log Pembayaran & Honorarium</span>
        </a>
    </div>

    @if($tab === 'pengadaan')
    <!-- TAB 1: PENGADAAN TABLE -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-200/80">
                    <tr>
                        <th class="py-3.5 px-4 w-12 text-center">No</th>
                        <th class="py-3.5 px-4">Program / Batch Terkait</th>
                        <th class="py-3.5 px-4">Nama Alat / Bahan Praktek</th>
                        <th class="py-3.5 px-4">Jenis</th>
                        <th class="py-3.5 px-3 text-center">Jumlah & Satuan</th>
                        <th class="py-3.5 px-4 text-right">Perkiraan Nilai (Rp)</th>
                        <th class="py-3.5 px-4">Spesifikasi Detail</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pengadaans as $peng)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-3 px-4 text-center font-bold text-slate-400">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4 font-bold text-slate-800">{{ $peng->program_batch }}</td>
                        <td class="py-3 px-4 font-semibold text-slate-700">{{ $peng->nama_alat_bahan }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-0.5 rounded-md text-[10px] font-semibold bg-slate-100 text-slate-700">
                                {{ $peng->jenis }}
                            </span>
                        </td>
                        <td class="py-3 px-3 text-center font-extrabold text-slate-800">{{ $peng->jumlah }} {{ $peng->satuan }}</td>
                        <td class="py-3 px-4 text-right font-bold text-teal-800">Rp {{ number_format($peng->perkiraan_nilai, 0, ',', '.') }}</td>
                        <td class="py-3 px-4 text-slate-500 max-w-xs truncate" title="{{ $peng->spesifikasi }}">{{ $peng->spesifikasi ?? '-' }}</td>
                        <td class="py-3 px-4 text-center">
                            @if($peng->status === 'Selesai')
                                <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800">Selesai</span>
                            @elseif($peng->status === 'Disetujui')
                                <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-blue-100 text-blue-800">Disetujui</span>
                            @else
                                <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-amber-100 text-amber-800">Diajukan</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            <form method="POST" action="{{ route('umum.pengadaan.destroy', $peng->id) }}" onsubmit="return confirm('Hapus data pengadaan ini?')">
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
                            Belum ada data pengadaan barang & bahan tercatat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pengadaans->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $pengadaans->links() }}
        </div>
        @endif
    </div>
    @else
    <!-- TAB 2: PEMBAYARAN TABLE -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-200/80">
                    <tr>
                        <th class="py-3.5 px-4 w-12 text-center">No</th>
                        <th class="py-3.5 px-4">Program / Batch</th>
                        <th class="py-3.5 px-4">Peruntukan / Peserta / Instruktur</th>
                        <th class="py-3.5 px-4 text-right">Nilai Pengajuan (Rp)</th>
                        <th class="py-3.5 px-4 text-center">Tanggal Pengajuan</th>
                        <th class="py-3.5 px-4 text-center">Tanggal Pencairan</th>
                        <th class="py-3.5 px-4">Catatan SP2D</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pembayarans as $pem)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-3 px-4 text-center font-bold text-slate-400">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4 font-bold text-slate-800">{{ $pem->program_batch }}</td>
                        <td class="py-3 px-4 font-semibold text-slate-700">{{ $pem->peserta }}</td>
                        <td class="py-3 px-4 text-right font-extrabold text-emerald-700">Rp {{ number_format($pem->nilai_pengajuan, 0, ',', '.') }}</td>
                        <td class="py-3 px-4 text-center text-slate-500">{{ $pem->tanggal_pengajuan ? $pem->tanggal_pengajuan->format('d M Y') : '-' }}</td>
                        <td class="py-3 px-4 text-center text-slate-600 font-medium">{{ $pem->tanggal_bayar ? $pem->tanggal_bayar->format('d M Y') : '-' }}</td>
                        <td class="py-3 px-4 text-slate-500 max-w-xs truncate" title="{{ $pem->catatan }}">{{ $pem->catatan ?? '-' }}</td>
                        <td class="py-3 px-4 text-center">
                            @if($pem->status_pembayaran === 'Dicairkan')
                                <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800">Dicairkan</span>
                            @elseif($pem->status_pembayaran === 'Disetujui')
                                <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-blue-100 text-blue-800">Disetujui</span>
                            @else
                                <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-amber-100 text-amber-800">Menunggu</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            <form method="POST" action="{{ route('umum.pembayaran.destroy', $pem->id) }}" onsubmit="return confirm('Hapus data pembayaran ini?')">
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
                            Belum ada log pembayaran tercatat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pembayarans->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $pembayarans->links() }}
        </div>
        @endif
    </div>
    @endif

    <!-- MODAL PENGAJUAN PENGADAAN -->
    <div x-show="addPengadaanModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
        <div @click.outside="addPengadaanModal = false" class="bg-white rounded-2xl max-w-2xl w-full p-6 shadow-2xl border border-slate-100 space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 font-heading">Pengajuan Pengadaan Bahan & Alat</h3>
                <button @click="addPengadaanModal = false" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>

            <form method="POST" action="{{ route('umum.pengadaan.store') }}" class="space-y-4 text-xs">
                @csrf
                <input type="hidden" name="tahun" value="{{ $year }}">

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Program / Batch Pelatihan *</label>
                    <input type="text" name="program_batch" required placeholder="Contoh: Junior Web Developer - Batch 1" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Jenis Logistik *</label>
                        <select name="jenis" required class="w-full px-3 py-2 rounded-xl border border-slate-200">
                            <option value="Bahan Pelatihan">Bahan Pelatihan</option>
                            <option value="Alat / Peraga Praktek">Alat / Peraga Praktek</option>
                            <option value="Modul / ATK">Modul / ATK</option>
                            <option value="Perlengkapan K3 / APD">Perlengkapan K3 / APD</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Nama Alat / Bahan *</label>
                        <input type="text" name="nama_alat_bahan" required placeholder="Contoh: Flashdisk Sandisk 32GB" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Jumlah</label>
                        <input type="number" name="jumlah" value="16" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Satuan</label>
                        <input type="text" name="satuan" value="Paket" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Perkiraan Nilai (Rp)</label>
                        <input type="number" name="perkiraan_nilai" value="3200000" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Spesifikasi / Rincian Kebutuhan</label>
                    <textarea name="spesifikasi" rows="2" placeholder="Spesifikasi teknis, merek, atau ukuran..." class="w-full px-3 py-2 rounded-xl border border-slate-200"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-4 border-t border-slate-100">
                    <button type="button" @click="addPengadaanModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold shadow-xs">Ajukan Pengadaan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL PENCATATAN PEMBAYARAN -->
    <div x-show="addPembayaranModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
        <div @click.outside="addPembayaranModal = false" class="bg-white rounded-2xl max-w-2xl w-full p-6 shadow-2xl border border-slate-100 space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 font-heading">Catat Pembayaran & Pencairan Anggaran</h3>
                <button @click="addPembayaranModal = false" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>

            <form method="POST" action="{{ route('umum.pembayaran.store') }}" class="space-y-4 text-xs">
                @csrf
                <input type="hidden" name="tahun" value="{{ $year }}">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Program / Batch *</label>
                        <input type="text" name="program_batch" required placeholder="Contoh: Junior Web Developer - Batch 1" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Nilai Pengajuan (Rp) *</label>
                        <input type="number" name="nilai_pengajuan" required placeholder="Contoh: 24800000" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Peruntukan Pembayaran *</label>
                    <input type="text" name="peserta" required placeholder="Contoh: Honorarium Instruktur & Uang Saku Peserta" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Tanggal Pengajuan</label>
                        <input type="date" name="tanggal_pengajuan" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Status Pembayaran</label>
                        <select name="status_pembayaran" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                            <option value="Menunggu Verifikasi">Menunggu Verifikasi</option>
                            <option value="Disetujui">Disetujui</option>
                            <option value="Dicairkan">Dicairkan (Lunas)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Catatan Dokumen SP2D / Kuitansi</label>
                    <input type="text" name="catatan" placeholder="Nomor kuitansi atau tanggal pencairan bank..." class="w-full px-3 py-2 rounded-xl border border-slate-200">
                </div>

                <div class="flex items-center justify-end gap-2 pt-4 border-t border-slate-100">
                    <button type="button" @click="addPembayaranModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold shadow-xs">Simpan Pembayaran</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
