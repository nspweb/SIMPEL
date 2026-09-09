@extends('layouts.app')

@section('title', 'Data Sertifikasi LSP')

@section('content')
<div class="space-y-6" x-data="{ addModal: false }">

    <!-- PAGE HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-amber-600 mb-1">
                <i class="fa-solid fa-certificate"></i>
                <span>LSP P1 BPVP Kendari &bull; BNSP</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-bold font-heading text-slate-900">Master Data Sertifikasi & Uji Kompetensi {{ $year }}</h1>
            <p class="text-xs text-slate-500 mt-0.5">Database asesi, skema kompetensi BNSP, tempat uji kompetensi (TUK), asesor penguji, dan status penerbitan blanko sertifikat.</p>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('export.csv', ['module' => 'sertifikasi', 'year' => $year]) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold border border-slate-200 transition">
                <i class="fa-solid fa-file-excel text-emerald-600"></i>
                <span>Export Excel/CSV</span>
            </a>
            <button @click="addModal = true" type="button" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold shadow-xs hover:shadow transition">
                <i class="fa-solid fa-plus"></i>
                <span>Daftar Asesi Baru</span>
            </button>
        </div>
    </div>

    <!-- KPI STATS CARDS -->
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 sm:gap-4">
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Asesi Terdaftar</p>
            <p class="text-xl font-extrabold text-slate-800 font-heading mt-1">{{ $stats['total_asesi'] }} <span class="text-xs font-normal text-slate-500">Orang</span></p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-600">Kompeten (K)</p>
            <p class="text-xl font-extrabold text-emerald-700 font-heading mt-1">{{ $stats['kompeten'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-rose-500">Belum Kompeten (BK)</p>
            <p class="text-xl font-extrabold text-rose-700 font-heading mt-1">{{ $stats['belum_kompeten'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-teal-600">Sertifikat Selesai</p>
            <p class="text-xl font-extrabold text-teal-700 font-heading mt-1">{{ $stats['sertifikat_dicetak'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-xs">
            <p class="text-[11px] font-bold uppercase tracking-wider text-amber-500">Dalam Proses Cetak</p>
            <p class="text-xl font-extrabold text-amber-600 font-heading mt-1">{{ $stats['sertifikat_proses'] }}</p>
        </div>
    </div>

    <!-- FILTER & SEARCH BAR -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs">
        <form method="GET" action="{{ route('sertifikasi.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
            <input type="hidden" name="year" value="{{ $year }}">
            
            <div class="sm:col-span-5 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama asesi, NIK, skema, atau asesor..." 
                       class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500 bg-slate-50/50">
            </div>

            <div class="sm:col-span-3">
                <select name="skema" onchange="this.form.submit()" 
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500 bg-slate-50/50">
                    <option value="">Semua Skema Sertifikasi</option>
                    @foreach($skemaList as $sk)
                        <option value="{{ $sk }}" {{ $skema == $sk ? 'selected' : '' }}>{{ $sk }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-2">
                <select name="hasil_ujk" onchange="this.form.submit()" 
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500 bg-slate-50/50">
                    <option value="">Hasil UJK</option>
                    <option value="Kompeten" {{ $hasil == 'Kompeten' ? 'selected' : '' }}>Kompeten</option>
                    <option value="Belum Kompeten" {{ $hasil == 'Belum Kompeten' ? 'selected' : '' }}>Belum Kompeten</option>
                </select>
            </div>

            <div class="sm:col-span-2">
                <select name="cetak_sertifikat" onchange="this.form.submit()" 
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500 bg-slate-50/50">
                    <option value="">Status Cetak</option>
                    <option value="Sudah" {{ $cetak == 'Sudah' ? 'selected' : '' }}>Sudah Cetak</option>
                    <option value="Proses" {{ $cetak == 'Proses' ? 'selected' : '' }}>Dalam Proses</option>
                    <option value="Belum" {{ $cetak == 'Belum' ? 'selected' : '' }}>Belum</option>
                </select>
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
                        <th class="py-3.5 px-4">Nama Lengkap & NIK</th>
                        <th class="py-3.5 px-4">Skema Sertifikasi</th>
                        <th class="py-3.5 px-4">TUK / Asesor</th>
                        <th class="py-3.5 px-3 text-center">L/P</th>
                        <th class="py-3.5 px-4 text-center">Pendidikan</th>
                        <th class="py-3.5 px-3 text-center">Hasil UJK</th>
                        <th class="py-3.5 px-4 text-center">Cetak Blanko</th>
                        <th class="py-3.5 px-4 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($sertifikasis as $s)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-3 px-4 text-center font-bold text-slate-400">{{ $s->nomor ?? $loop->iteration }}</td>
                        <td class="py-3 px-4">
                            <p class="font-bold text-slate-800 text-sm">{{ $s->nama_lengkap }}</p>
                            <p class="text-[11px] text-slate-400 font-mono tracking-tight">{{ $s->nomor_ktp ?? '-' }}</p>
                        </td>
                        <td class="py-3 px-4 font-semibold text-slate-700">
                            <span class="block text-teal-800 font-bold">{{ $s->skema }}</span>
                            <span class="text-[10px] text-slate-400">{{ $s->tahap ?? 'UJK Reguler' }}</span>
                        </td>
                        <td class="py-3 px-4 text-slate-600">
                            <p class="text-[11px] font-medium">{{ $s->tuk }}</p>
                            <p class="text-[10px] text-slate-400">Asesor: {{ $s->asesor ?? '-' }}</p>
                        </td>
                        <td class="py-3 px-3 text-center">
                            @if($s->jenis_kelamin === 'L')
                                <span class="text-blue-600 font-bold">L</span>
                            @else
                                <span class="text-pink-600 font-bold">P</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center text-slate-600">{{ $s->kualifikasi_pendidikan ?? '-' }}</td>
                        <td class="py-3 px-3 text-center">
                            @if($s->hasil_ujk === 'Kompeten')
                                <span class="px-2.5 py-1 text-[11px] font-extrabold rounded-full bg-emerald-100 text-emerald-800">Kompeten</span>
                            @elseif($s->hasil_ujk === 'Belum Kompeten')
                                <span class="px-2.5 py-1 text-[11px] font-extrabold rounded-full bg-rose-100 text-rose-800">BK</span>
                            @else
                                <span class="px-2.5 py-1 text-[11px] font-semibold rounded-full bg-slate-100 text-slate-600">Belum Uji</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($s->cetak_sertifikat === 'Sudah')
                                <span class="px-2 py-0.5 text-[10px] font-bold rounded-md bg-teal-50 text-teal-700 border border-teal-200">
                                    <i class="fa-solid fa-check mr-1"></i>Tercetak
                                </span>
                            @elseif($s->cetak_sertifikat === 'Proses')
                                <span class="px-2 py-0.5 text-[10px] font-bold rounded-md bg-amber-50 text-amber-700 border border-amber-200">
                                    <i class="fa-solid fa-spinner fa-spin mr-1"></i>Proses
                                </span>
                            @else
                                <span class="text-[11px] text-slate-400">Belum</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            <form method="POST" action="{{ route('sertifikasi.destroy', $s->id) }}" onsubmit="return confirm('Hapus data sertifikasi asesi ini?')">
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
                            Tidak ditemukan data sertifikasi yang sesuai filter.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($sertifikasis->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $sertifikasis->links() }}
        </div>
        @endif
    </div>

    <!-- MODAL PENDAFTARAN ASESI -->
    <div x-show="addModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
        <div @click.outside="addModal = false" class="bg-white rounded-2xl max-w-2xl w-full p-6 shadow-2xl border border-slate-100 space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 font-heading">Daftarkan Asesi Sertifikasi Baru</h3>
                <button @click="addModal = false" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>

            <form method="POST" action="{{ route('sertifikasi.store') }}" class="space-y-4 text-xs">
                @csrf
                <input type="hidden" name="tahun" value="{{ $year }}">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Skema Sertifikasi *</label>
                        <select name="skema" required class="w-full px-3 py-2 rounded-xl border border-slate-200">
                            <option value="">Pilih Skema</option>
                            <option value="Pemrograman Web (Junior Web Developer)">Pemrograman Web (Junior Web Developer)</option>
                            <option value="Pengelasan SMAW 3G">Pengelasan SMAW 3G</option>
                            <option value="Teknisi Servis Sepeda Motor Injeksi">Teknisi Servis Sepeda Motor Injeksi</option>
                            <option value="Barista dan Tata Hidang Kopi">Barista dan Tata Hidang Kopi</option>
                            <option value="Desainer Grafis Muda">Desainer Grafis Muda</option>
                            <option value="Pengoperasian Mesin Bubut">Pengoperasian Mesin Bubut</option>
                            <option value="Pemasangan Instalasi Listrik Bangunan">Pemasangan Instalasi Listrik Bangunan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Tempat Uji Kompetensi (TUK) *</label>
                        <input type="text" name="tuk" required value="TUK Sewaktu BPVP Kendari" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Nama Lengkap Asesi *</label>
                        <input type="text" name="nama_lengkap" required placeholder="Nama lengkap sesuai KTP" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Nomor KTP / NIK *</label>
                        <input type="text" name="nomor_ktp" placeholder="16 digit NIK" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                            <option value="L">Laki-Laki (L)</option>
                            <option value="P">Perempuan (P)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Pendidikan Terakhir</label>
                        <input type="text" name="kualifikasi_pendidikan" placeholder="Contoh: S1 / SMK" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Asesor Penguji</label>
                        <input type="text" name="asesor" placeholder="Nama Asesor & No Reg" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Hasil Uji Kompetensi (UJK) *</label>
                        <select name="hasil_ujk" required class="w-full px-3 py-2 rounded-xl border border-slate-200">
                            <option value="Kompeten">Kompeten (K)</option>
                            <option value="Belum Kompeten">Belum Kompeten (BK)</option>
                            <option value="Belum Uji">Belum Uji</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Status Blanko Sertifikat</label>
                        <select name="cetak_sertifikat" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                            <option value="Sudah">Sudah Dicetak</option>
                            <option value="Proses">Dalam Proses</option>
                            <option value="Belum">Belum</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-4 border-t border-slate-100">
                    <button type="button" @click="addModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold shadow-xs">Daftarkan Asesi</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
