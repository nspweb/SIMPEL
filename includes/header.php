<?php
/**
 * SIMPEL BPVP Kendari - Unified Header & Mobile Nav Trigger
 */
?>
<!-- TOPBAR FOR MOBILE VIEW -->
<div class="lg:hidden bg-[#0F172A] border-b border-slate-800 text-white px-4 py-3 flex items-center justify-between sticky top-0 z-30 shadow-md">
    <div class="flex items-center gap-2.5">
        <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-teal-500 to-emerald-400 flex items-center justify-center text-slate-950 font-extrabold text-sm">
            <i class="fa-solid fa-chart-line"></i>
        </div>
        <span class="font-extrabold text-white text-sm font-heading tracking-wide">SIMPEL BPVP</span>
    </div>
    <button type="button" onclick="document.getElementById('simpel-sidebar').classList.remove('-translate-x-full'); document.getElementById('simpel-sidebar-backdrop').classList.remove('hidden')" class="p-2 rounded-lg bg-slate-800 text-slate-200 hover:text-white">
        <i class="fa-solid fa-bars text-sm"></i>
    </button>
</div>

<style>
    @media (min-width: 1024px) {
        body {
            padding-left: 16rem !important;
            box-sizing: border-box !important;
            width: 100% !important;
        }
        main, footer {
            margin-left: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            min-width: 0 !important;
            box-sizing: border-box !important;
        }
    }
    @media print {
        body { padding-left: 0 !important; }
        #simpel-sidebar, #simpel-sidebar-backdrop { display: none !important; }
    }
</style>
