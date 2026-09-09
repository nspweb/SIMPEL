<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\ProgramPelatihan;
use App\Models\PelatihanUptd;
use App\Models\Sertifikasi;
use App\Models\Penempatan;
use App\Models\Produktivitas;
use App\Models\Pengadaan;

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'service' => 'SIMPEL BPVP Kendari API',
        'timestamp' => now()->toIso8601String()
    ]);
});

Route::get('/pelatihan', function (Request $request) {
    $year = $request->input('year', 2026);
    return response()->json(ProgramPelatihan::where('tahun', $year)->get());
});

Route::get('/sertifikasi', function (Request $request) {
    $year = $request->input('year', 2026);
    return response()->json(Sertifikasi::where('tahun', $year)->get());
});

Route::get('/penempatan', function (Request $request) {
    $year = $request->input('year', 2026);
    return response()->json(Penempatan::where('tahun', $year)->get());
});

Route::get('/produktivitas', function (Request $request) {
    $year = $request->input('year', 2026);
    return response()->json(Produktivitas::where('tahun', $year)->get());
});

Route::get('/uptd', function (Request $request) {
    $year = $request->input('year', 2026);
    return response()->json(PelatihanUptd::where('tahun', $year)->get());
});
