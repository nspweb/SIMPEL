<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Masuk - SIMPEL BPVP Kendari</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-heading { font-family: 'Space Grotesk', sans-serif; }
    </style>
</head>
<body class="h-full flex items-center justify-center p-4 bg-gradient-to-br from-slate-900 via-[#1e384b] to-[#2C4C63]">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl p-8 sm:p-10 border border-white/20 relative overflow-hidden">
        
        <!-- TOP BRANDING -->
        <div class="text-center space-y-3 mb-8">
            <div class="inline-flex p-3 rounded-2xl bg-teal-50 border border-teal-100 shadow-xs mb-1">
                <img src="https://bpvpkendari.kemnaker.go.id/storage/upload/setting/11749712002.png" 
                     alt="Logo Kemnaker" 
                     class="h-12 w-12 object-contain">
            </div>
            <div>
                <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-600 block">KEMENTERIAN KETENAGAKERJAAN RI</span>
                <h1 class="text-2xl font-extrabold text-slate-900 font-heading">SIMPEL BPVP Kendari</h1>
                <p class="text-xs text-slate-500 mt-1">Sistem Informasi Pelatihan, Sertifikasi & Penempatan</p>
            </div>
        </div>

        @if($errors->any())
            <div class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
                <p class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-circle-exclamation"></i> Gagal masuk:</p>
                <p class="mt-0.5">{{ $errors->first() }}</p>
            </div>
        @endif

        @if(session('success'))
            <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs">
                <p class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-circle-check"></i> Berhasil:</p>
                <p class="mt-0.5">{{ session('success') }}</p>
            </div>
        @endif

        <!-- LOGIN FORM -->
        <form method="POST" action="{{ route('login.post') }}" class="space-y-4 text-xs">
            @csrf

            <div>
                <label class="block font-bold text-slate-700 mb-1.5">Alamat Email</label>
                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="email" name="email" value="{{ old('email', 'admin@bpvpkendari.go.id') }}" required placeholder="email@bpvpkendari.go.id" 
                           class="w-full pl-10 pr-3.5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:outline-none bg-slate-50/50 text-slate-800 font-medium">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1.5">Kata Sandi (Password)</label>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="password" id="blade-password" name="password" value="password" required placeholder="••••••••" 
                           class="w-full pl-10 pr-11 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:outline-none bg-slate-50/50 text-slate-800">
                    <button type="button" onclick="toggleBladePassword()" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none">
                        <i id="blade-eye-icon" class="fa-solid fa-eye text-sm"></i>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded text-teal-600 focus:ring-teal-500">
                    <span class="text-slate-600">Ingat Saya</span>
                </label>
                <span class="text-slate-400 text-[11px]">Tahun Anggaran 2026</span>
            </div>

            <button type="submit" class="w-full py-3 px-4 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold shadow-lg hover:shadow-teal-600/30 transition transform hover:-translate-y-0.5 text-sm flex items-center justify-center gap-2">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                <span>Masuk ke Sistem</span>
            </button>
        </form>

        <div class="mt-6 pt-5 border-t border-slate-100 text-center">
            <p class="text-[11px] text-slate-400">
                Default Akun Demo: <code class="text-teal-700 font-mono">admin@bpvpkendari.go.id</code> / <code class="text-teal-700 font-mono">password</code>
            </p>
        </div>

    </div>

    <script>
        function toggleBladePassword() {
            const input = document.getElementById('blade-password');
            const icon = document.getElementById('blade-eye-icon');
            if (!input || !icon) return;
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
