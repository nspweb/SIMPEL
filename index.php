<?php
/**
 * SIMPEL BPVP Kendari - Halaman Login Utama
 * Otentikasi Native PHP & MySQL (Tanpa CodeIgniter)
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika pengguna sudah login, langsung alihkan ke halamannya
if (isset($_SESSION['user']['home']) && !empty($_SESSION['user']['home'])) {
    header("Location: " . $_SESSION['user']['home']);
    exit();
}

$error = $_GET['error'] ?? '';
$msg = $_GET['msg'] ?? '';

$errorMessage = '';
if ($error === 'invalid_credentials') {
    $errorMessage = 'Email atau Kata Sandi yang Anda masukkan salah. Silakan coba lagi.';
} elseif ($error === 'empty_fields') {
    $errorMessage = 'Mohon isi Email dan Kata Sandi dengan lengkap.';
} elseif ($error === 'unauthorized') {
    $errorMessage = 'Sesi Anda telah berakhir atau Anda belum login. Silakan masuk terlebih dahulu.';
}

$successMessage = '';
if ($msg === 'logged_out') {
    $successMessage = 'Anda telah berhasil keluar (logout) dari sistem.';
}
?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk ke Akun - SIMPEL BPVP Kendari 2026</title>

    <!-- Tailwind CSS & Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body, html, button, input, select, textarea, .font-heading { font-family: 'Montserrat', sans-serif; }
        i, [class*="fa-"] { font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands", "FontAwesome" !important; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-slate-950 via-[#132c3c] to-[#1e3e54]">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl p-6 sm:p-9 border border-white/20 relative overflow-hidden my-8">
        
        <!-- TOP BRANDING -->
        <div class="text-center space-y-2 mb-6">
            <div class="inline-flex p-3 rounded-2xl bg-teal-50 border border-teal-100 shadow-xs">
                <img src="assets/logo kemnaker.png" 
                     onerror="this.src='https://bpvpkendari.kemnaker.go.id/storage/upload/setting/11749712002.png'" 
                     alt="Logo Kemnaker" 
                     class="h-12 w-12 object-contain">
            </div>
            <div>
                <span class="text-[10px] font-extrabold uppercase tracking-widest text-emerald-800 block">KEMENTERIAN KETENAGAKERJAAN RI</span>
                <h1 class="text-2xl font-extrabold text-slate-900 font-heading">SIMPEL BPVP Kendari</h1>
                <p class="text-xs text-slate-500">Sistem Informasi Pelatihan, Sertifikasi & Pengadaan</p>
            </div>
        </div>

        <!-- ALERTS / NOTIFIKASI -->
        <?php if (!empty($errorMessage)): ?>
            <div class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs flex items-start gap-2.5">
                <i class="fa-solid fa-circle-exclamation text-sm text-rose-600 shrink-0 mt-0.5"></i>
                <div class="font-medium leading-relaxed"><?= htmlspecialchars($errorMessage) ?></div>
            </div>
        <?php endif; ?>

        <?php if (!empty($successMessage)): ?>
            <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-start gap-2.5">
                <i class="fa-solid fa-circle-check text-sm text-emerald-600 shrink-0 mt-0.5"></i>
                <div class="font-medium leading-relaxed"><?= htmlspecialchars($successMessage) ?></div>
            </div>
        <?php endif; ?>

        <!-- LOGIN FORM (REAL AUTHENTICATION) -->
        <form action="auth/login_process.php" method="POST" class="space-y-4 text-xs">
            <div>
                <label for="email" class="block font-bold text-slate-700 mb-1.5">Email Akun Pengguna</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <i class="fa-solid fa-envelope text-xs"></i>
                    </span>
                    <input type="email" id="email" name="email" required placeholder="nama@bpvpkendari.go.id" 
                           class="w-full pl-10 pr-3.5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 focus:outline-none bg-slate-50 text-slate-900 font-medium text-xs transition">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block font-bold text-slate-700">Kata Sandi (Password)</label>
                    <a href="reset_password.php" class="text-[11px] font-semibold text-emerald-800 hover:underline">Lupa Sandi?</a>
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <i class="fa-solid fa-lock text-xs"></i>
                    </span>
                    <input type="password" id="password" name="password" required placeholder="Masukkan kata sandi..." 
                           class="w-full pl-10 pr-10 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 focus:outline-none bg-slate-50 text-slate-900 font-medium text-xs transition">
                    <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600">
                        <i id="password-toggle-icon" class="fa-solid fa-eye text-xs"></i>
                    </button>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" 
                        class="w-full py-3.5 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold shadow-md shadow-emerald-900/20 transition text-xs flex items-center justify-center gap-2">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>Masuk ke Workspace SIMPEL</span>
                </button>
            </div>
        </form>

        <!-- PANDUAN AKUN KEDINASAN RESMI -->
        <div class="mt-6 pt-5 border-t border-slate-100 text-center">
            <details class="text-left text-slate-500 group">
                <summary class="cursor-pointer text-[11px] font-bold text-slate-600 hover:text-slate-900 list-none flex items-center justify-between p-2 rounded-lg hover:bg-slate-50 transition">
                    <span class="flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-info text-emerald-800 text-xs"></i>
                        <span>Informasi Akun Default Bidang BPVP Kendari</span>
                    </span>
                    <i class="fa-solid fa-chevron-down text-[10px] group-open:rotate-180 transition-transform"></i>
                </summary>
                <div class="mt-2 p-3 bg-slate-50 rounded-xl border border-slate-200/80 text-[11px] space-y-1.5 text-slate-600">
                    <p class="font-bold text-slate-800">Password default seluruh akun: <code class="bg-white px-1.5 py-0.5 rounded border border-slate-200 font-mono text-emerald-900">bpvp2026!</code></p>
                    <ul class="space-y-1 text-[10px] text-slate-600 list-disc pl-4 pt-1">
                        <li><strong>Admin:</strong> admin@bpvpkendari.go.id</li>
                        <li><strong>Pimpinan:</strong> pimpinan@bpvpkendari.go.id</li>
                        <li><strong>Pengadaan:</strong> pengadaan@bpvpkendari.go.id</li>
                        <li><strong>Penyelenggara:</strong> penyelenggara@bpvpkendari.go.id</li>
                        <li><strong>Pemberdayaan:</strong> pemberdayaan@bpvpkendari.go.id</li>
                        <li><strong>Produktivitas:</strong> produktivitas@bpvpkendari.go.id</li>
                        <li><strong>Umum / TU:</strong> tu@bpvpkendari.go.id</li>
                        <li><strong>LSP:</strong> lsp@bpvpkendari.go.id</li>
                        <li><strong>Keuangan:</strong> keuangan@bpvpkendari.go.id</li>
                    </ul>
                </div>
            </details>
        </div>

        <div class="mt-6 text-center text-[10px] text-slate-400">
            &copy; 2026 BPVP Kendari &bull; Kementerian Ketenagakerjaan Republik Indonesia
        </div>

    </div>

    <script>
        function togglePasswordVisibility() {
            const pwdInput = document.getElementById('password');
            const toggleIcon = document.getElementById('password-toggle-icon');
            if (pwdInput.type === 'password') {
                pwdInput.type = 'text';
                toggleIcon.className = 'fa-solid fa-eye-slash text-xs';
            } else {
                pwdInput.type = 'password';
                toggleIcon.className = 'fa-solid fa-eye text-xs';
            }
        }
    </script>
</body>
</html>
