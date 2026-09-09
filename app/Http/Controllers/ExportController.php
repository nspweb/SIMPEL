<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramPelatihan;
use App\Models\PelatihanUptd;
use App\Models\Sertifikasi;
use App\Models\Penempatan;
use App\Models\Produktivitas;
use App\Models\Pengadaan;

class ExportController extends Controller
{
    public function exportCsv(Request $request, $module)
    {
        $year = $request->input('year', 2026);
        $filename = "SIMPEL_BPVP_Kendari_{$module}_{$year}_" . date('Ymd_His') . ".csv";

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function() use ($module, $year) {
            $handle = fopen('php://output', 'w');
            // Add BOM for Excel UTF-8 compatibility
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            switch ($module) {
                case 'pelatihan':
                    fputcsv($handle, ['NO', 'KEJURUAN', 'PROGRAM PELATIHAN', 'JENIS PELATIHAN', 'TARGET PESERTA', 'JUMLAH PESERTA', 'LAKI-LAKI', 'PEREMPUAN', 'TGL MULAI', 'TGL SELESAI', 'LULUS', 'STATUS ALUR', 'TAHUN']);
                    $data = ProgramPelatihan::where('tahun', $year)->get();
                    foreach ($data as $d) {
                        fputcsv($handle, [
                            $d->nomor, $d->kejuruan, $d->program_pelatihan, $d->jenis_pelatihan,
                            $d->target_peserta, $d->jumlah_peserta, $d->laki_laki, $d->perempuan,
                            $d->tgl_mulai ? $d->tgl_mulai->format('Y-m-d') : '',
                            $d->tgl_selesai ? $d->tgl_selesai->format('Y-m-d') : '',
                            $d->lulus, $d->status_alur, $d->tahun
                        ]);
                    }
                    break;

                case 'sertifikasi':
                    fputcsv($handle, ['NO', 'SKEMA', 'TUK', 'NAMA LENGKAP', 'NIK / KTP', 'JENIS KELAMIN', 'PENDIDIKAN', 'ASESOR', 'HASIL UJK', 'CETAK SERTIFIKAT', 'TAHUN']);
                    $data = Sertifikasi::where('tahun', $year)->get();
                    foreach ($data as $d) {
                        fputcsv($handle, [
                            $d->nomor, $d->skema, $d->tuk, $d->nama_lengkap, "'".$d->nomor_ktp,
                            $d->jenis_kelamin, $d->kualifikasi_pendidikan, $d->asesor,
                            $d->hasil_ujk, $d->cetak_sertifikat, $d->tahun
                        ]);
                    }
                    break;

                case 'penempatan':
                    fputcsv($handle, ['NO', 'KEJURUAN', 'TOTAL PESERTA', 'TOTAL PENEMPATAN', 'BEKERJA', 'WIRAUSAHA', 'BELUM DITEMPATKAN', 'PERUSAHAAN MITRA', 'SEKTOR', 'TAHUN']);
                    $data = Penempatan::where('tahun', $year)->get();
                    foreach ($data as $d) {
                        fputcsv($handle, [
                            $d->nomor, $d->kejuruan, $d->jumlah_peserta_pelatihan, $d->total_penempatan,
                            $d->ditempatkan_bekerja, $d->berwirausaha, $d->tidak_ditempatkan,
                            $d->nama_perusahaan, $d->sektor, $d->tahun
                        ]);
                    }
                    break;

                case 'produktivitas':
                    fputcsv($handle, ['NAMA KEGIATAN / PESERTA', 'JUMLAH PESERTA', 'NAMA PERUSAHAAN', 'ALAMAT', 'TANGGAL KEGIATAN', 'SEKTOR', 'TAHUN']);
                    $data = Produktivitas::where('tahun', $year)->get();
                    foreach ($data as $d) {
                        fputcsv($handle, [
                            $d->peserta, $d->jumlah, $d->nama_perusahaan, $d->alamat_perusahaan,
                            $d->tanggal_kegiatan ? $d->tanggal_kegiatan->format('Y-m-d') : '',
                            $d->sektor, $d->tahun
                        ]);
                    }
                    break;

                case 'uptd':
                    fputcsv($handle, ['UPTD', 'KEJURUAN', 'PROGRAM PELATIHAN', 'JUMLAH PESERTA', 'LAKI-LAKI', 'PEREMPUAN', 'S1/D4', 'D3', 'SMA/SMK', 'SMP', 'SD', 'DISABILITAS', 'TAHUN']);
                    $data = PelatihanUptd::where('tahun', $year)->get();
                    foreach ($data as $d) {
                        fputcsv($handle, [
                            $d->uptd_name, $d->kejuruan, $d->program_pelatihan, $d->jumlah_peserta,
                            $d->laki_laki, $d->perempuan, $d->edu_s1_d4, $d->edu_d3, $d->edu_sma_smk,
                            $d->edu_smp, $d->edu_sd, $d->disabilitas, $d->tahun
                        ]);
                    }
                    break;

                default:
                    fputcsv($handle, ['Data tidak ditemukan']);
                    break;
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
