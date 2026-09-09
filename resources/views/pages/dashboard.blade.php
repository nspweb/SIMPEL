@extends('layouts.app')

@section('title', 'Executive Dashboard')

@section('content')
<div class="space-y-6">

    <!-- TOP HEADER BANNER -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-brand-900 via-brand-700 to-slate-800 p-6 sm:p-8 text-white shadow-xl">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-400/20 text-teal-300 text-xs font-semibold border border-teal-400/30">
                    <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse"></span>
                    <span>Monitoring Real-Time Kinerja Vokasi & Produktivitas</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold font-heading tracking-tight text-white">
                    Dashboard Eksekutif SIMPEL BPVP Kendari {{ $year }}
                </h1>
                <p class="text-xs sm:text-sm text-slate-200 max-w-2xl leading-relaxed">
                    Sistem pemantauan terpadu pelatihan kerja kelembagaan, pembinaan UPTD 5 daerah, sertifikasi kompetensi LSP, penyerapan alumni di industri, serta realisasi anggaran tahun berjalan.
                </p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('input.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-teal-500 hover:bg-teal-600 text-white text-xs sm:text-sm font-bold shadow-lg hover:shadow-teal-500/30 transition transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-plus-circle"></i>
                    <span>Input Data Baru</span>
                </a>
                <a href="{{ route('export.csv', ['module' => 'pelatihan', 'year' => $year]) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs sm:text-sm font-semibold border border-white/20 backdrop-blur-md transition">
                    <i class="fa-solid fa-file-excel text-emerald-400"></i>
                    <span>Unduh Rekap Laporan</span>
                </a>
            </div>
        </div>

        <!-- Decorative background glow -->
        <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-teal-500/20 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <!-- KPI STATS CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <!-- Card 1: Total Pelatihan UPTP -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Pelatihan UPTP</p>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 font-heading mt-1">{{ number_format($totalPeserta) }} <span class="text-xs font-normal text-slate-500">Alumni</span></h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>{{ $totalPrograms }} Paket / Kelas</span>
                <span class="text-emerald-600 font-semibold"><i class="fa-solid fa-check-circle mr-1"></i>{{ $totalLulus }} Lulus</span>
            </div>
        </div>

        <!-- Card 2: Sertifikasi LSP -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Sertifikasi BNSP / LSP</p>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 font-heading mt-1">{{ number_format($totalKompeten) }} <span class="text-xs font-normal text-slate-500">Kompeten</span></h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-certificate"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Total {{ $totalSertifikasi }} Asesi</span>
                <span class="text-teal-600 font-semibold"><i class="fa-solid fa-print mr-1"></i>{{ $totalCetakSertifikat }} Tercetak</span>
            </div>
        </div>

        <!-- Card 3: Penempatan Alumni -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Penyerapan Kerja</p>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 font-heading mt-1">{{ number_format($totalPenempatanAlumni) }} <span class="text-xs font-normal text-slate-500">Terserap</span></h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-briefcase"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>{{ $totalBekerja }} Industri</span>
                <span class="text-amber-600 font-semibold"><i class="fa-solid fa-store mr-1"></i>{{ $totalWirausaha }} Wirausaha</span>
            </div>
        </div>

        <!-- Card 4: Serapan Anggaran -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Realisasi Anggaran</p>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 font-heading mt-1">{{ $persenAnggaran }}%</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-coins"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Rp {{ number_format($totalRealisasiAnggaran / 1000000000, 2, ',', '.') }} Miliar</span>
                <span class="text-purple-600 font-semibold">dari Rp {{ number_format($totalPagu / 1000000000, 2, ',', '.') }} M</span>
            </div>
        </div>

    </div>

    <!-- CHARTS & TARGET REALISASI ROW -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Main Chart: Target vs Realisasi (2 Cols) -->
        <div class="lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-800 font-heading">Capaian Target vs Realisasi Program {{ $year }}</h3>
                    <p class="text-xs text-slate-500">Perbandingan paket dan jumlah peserta pelatihan vokasi BPVP Kendari</p>
                </div>
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-700">Tahun {{ $year }}</span>
            </div>
            <div class="h-72">
                <canvas id="targetRealisasiChart"></canvas>
            </div>
        </div>

        <!-- Donut Chart: Rasio Gender & Komposisi (1 Col) -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
            <div>
                <h3 class="text-base font-bold text-slate-800 font-heading mb-1">Rasio Peserta Pelatihan</h3>
                <p class="text-xs text-slate-500 mb-4">Proporsi peserta laki-laki vs perempuan</p>
                <div class="h-48 relative flex items-center justify-center">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3 mt-4 pt-4 border-t border-slate-100 text-center">
                <div class="p-2.5 rounded-xl bg-blue-50/80 border border-blue-100">
                    <p class="text-[11px] font-bold text-blue-600 uppercase">Laki-Laki</p>
                    <p class="text-lg font-extrabold text-blue-900 mt-0.5">{{ $totalLakiLaki }}</p>
                </div>
                <div class="p-2.5 rounded-xl bg-pink-50/80 border border-pink-100">
                    <p class="text-[11px] font-bold text-pink-600 uppercase">Perempuan</p>
                    <p class="text-lg font-extrabold text-pink-900 mt-0.5">{{ $totalPerempuan }}</p>
                </div>
            </div>
        </div>

    </div>

    <!-- REALISASI ANGGARAN & TARGET TABLE -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Table Target Realisasi -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-800 font-heading">Rincian Sasaran Strategis</h3>
                    <p class="text-xs text-slate-500">Status pencapaian target output operasional</p>
                </div>
                <a href="{{ route('pelatihan.index') }}" class="text-xs text-teal-600 hover:text-teal-700 font-bold">Lihat Semua →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100">
                        <tr>
                            <th class="py-2.5 px-3">Jenis Program / Output</th>
                            <th class="py-2.5 px-3 text-center">Target</th>
                            <th class="py-2.5 px-3 text-center">Realisasi</th>
                            <th class="py-2.5 px-3 text-right">Persentase</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @forelse($targets as $t)
                        @php $persen = $t->target > 0 ? round(($t->realisasi / $t->target) * 100, 1) : 0; @endphp
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-2.5 px-3 font-semibold text-slate-800">{{ $t->nama }}</td>
                            <td class="py-2.5 px-3 text-center">{{ number_format($t->target) }} {{ $t->satuan }}</td>
                            <td class="py-2.5 px-3 text-center font-bold text-teal-700">{{ number_format($t->realisasi) }} {{ $t->satuan }}</td>
                            <td class="py-2.5 px-3 text-right">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold {{ $persen >= 80 ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                    {{ $persen }}%
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-slate-400">Belum ada data target untuk tahun {{ $year }}.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Table Realisasi Anggaran DIPA -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-800 font-heading">Realisasi Anggaran (DIPA)</h3>
                    <p class="text-xs text-slate-500">Penyerapan belanja kegiatan pelatihan & operasional</p>
                </div>
                <a href="{{ route('umum.index') }}" class="text-xs text-teal-600 hover:text-teal-700 font-bold">Kelola Anggaran →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100">
                        <tr>
                            <th class="py-2.5 px-3">Uraian Akun Kegiatan</th>
                            <th class="py-2.5 px-3 text-right">Pagu (Rp)</th>
                            <th class="py-2.5 px-3 text-right">Realisasi (Rp)</th>
                            <th class="py-2.5 px-3 text-right">%</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @forelse($anggarans as $a)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-2.5 px-3 font-semibold text-slate-800 truncate max-w-[200px]" title="{{ $a->uraian }}">{{ $a->uraian }}</td>
                            <td class="py-2.5 px-3 text-right text-slate-500">{{ number_format($a->pagu_anggaran, 0, ',', '.') }}</td>
                            <td class="py-2.5 px-3 text-right font-bold text-purple-700">{{ number_format($a->realisasi_anggaran, 0, ',', '.') }}</td>
                            <td class="py-2.5 px-3 text-right">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-purple-100 text-purple-800">
                                    {{ $a->persentase }}%
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-slate-400">Belum ada data anggaran untuk tahun {{ $year }}.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Target vs Realisasi Bar Chart
    const targetCtx = document.getElementById('targetRealisasiChart').getContext('2d');
    const targetLabels = {!! json_encode($targets->pluck('nama')) !!};
    const targetData = {!! json_encode($targets->pluck('target')) !!};
    const realisasiData = {!! json_encode($targets->pluck('realisasi')) !!};

    new Chart(targetCtx, {
        type: 'bar',
        data: {
            labels: targetLabels.length ? targetLabels : ['PBK Kelembagaan', 'Non-Institusional', 'Tailor Made', 'UPTD Binaan', 'Sertifikasi LSP'],
            datasets: [
                {
                    label: 'Target (Paket/Orang)',
                    data: targetData.length ? targetData : [96, 40, 20, 80, 1500],
                    backgroundColor: '#cbd5e1',
                    borderRadius: 6,
                },
                {
                    label: 'Realisasi',
                    data: realisasiData.length ? realisasiData : [80, 28, 16, 64, 1140],
                    backgroundColor: '#0d9488',
                    borderRadius: 6,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top', labels: { font: { family: 'Inter', size: 11 } } }
            },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
                x: { grid: { display: false } }
            }
        }
    });

    // Gender Donut Chart
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    new Chart(genderCtx, {
        type: 'doughnut',
        data: {
            labels: ['Laki-Laki', 'Perempuan'],
            datasets: [{
                data: [{{ $totalLakiLaki ?: 45 }}, {{ $totalPerempuan ?: 35 }}],
                backgroundColor: ['#3b82f6', '#ec4899'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            cutout: '70%'
        }
    });
});
</script>
@endpush
