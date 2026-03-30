<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Denda #{{ $invoice->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus_Jakarta_Sans', sans-serif; }
    </style>
</head>
<body class="bg-white p-10 max-w-sm mx-auto border border-slate-100 shadow-lg">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-black uppercase tracking-tighter text-emerald-600">LibHub</h1>
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Official Library Receipt</p>
    </div>

    <div class="border-b-2 border-dashed border-slate-100 pb-4 mb-4 space-y-2">
        <div class="flex justify-between text-[10px]">
            <span class="font-bold text-slate-400 uppercase">No. Invoice</span>
            <span class="font-black text-slate-900">#INV-{{ $invoice->id }}</span>
        </div>
        <div class="flex justify-between text-[10px]">
            <span class="font-bold text-slate-400 uppercase">Tanggal</span>
            <span class="font-black text-slate-900">{{ date('d/m/Y H:i') }}</span>
        </div>
    </div>

    <div class="mb-8">
        <p class="text-[9px] font-black text-emerald-500 uppercase mb-2">Detail Pelanggaran:</p>
        <p class="text-sm font-bold text-slate-700 leading-relaxed">{{ $invoice->deskripsi_pelanggaran }}</p>
    </div>

    <div class="bg-emerald-50 p-4 rounded-2xl mb-8">
        <div class="flex justify-between items-center">
            <span class="text-[10px] font-black text-emerald-600 uppercase">Total Bayar</span>
            <span class="text-xl font-black text-emerald-950">Rp {{ number_format($invoice->total_bayar, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="text-center">
        <p class="text-[10px] font-bold text-slate-400">Terima kasih atas kerja samanya.</p>
        <div class="mt-4 pt-4 border-t border-slate-50 italic text-[9px] text-slate-300">
            Keep reading, keep growing!
        </div>
    </div>
</body>
</html>