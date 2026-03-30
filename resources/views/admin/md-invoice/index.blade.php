@extends('layouts.admin')

@section('admin-content')
<div class="max-w-7xl mx-auto pt-10 pb-20 px-4">
    
    {{-- Header & Global Actions --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10 no-print">
        <div>
            <h1 class="text-3xl md:text-4xl font-black text-emerald-950 tracking-tighter uppercase">Sistem Denda & Invoice</h1>
            <p class="text-slate-500 font-medium text-sm md:text-base">Kelola tagihan keterlambatan dan denda kerusakan buku.</p>
        </div>
        
        <div class="flex flex-wrap items-center gap-3">
            {{-- Button Tambah Invoice --}}
            <button onclick="openModal()" class="px-6 py-4 bg-emerald-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-emerald-700 transition shadow-xl shadow-emerald-100 flex items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                Buat Invoice
            </button>

            {{-- Button Print Laporan --}}
            <button onclick="window.print()" class="px-6 py-4 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-emerald-600 transition shadow-xl shadow-slate-200 flex items-center gap-2">
                <i class="fa-solid fa-print"></i>
                Cetak Laporan
            </button>
        </div>
    </div>

    {{-- Main Table Section --}}
    <div class="bg-white rounded-[2.5rem] border border-emerald-50 shadow-sm overflow-hidden print:border-none print:shadow-none">
        {{-- Kop Laporan (Hanya muncul saat Print Laporan Keseluruhan) --}}
        <div class="hidden print:block text-center py-10 border-b-4 border-double border-emerald-950 mb-8">
            <h2 class="text-3xl font-black uppercase tracking-tighter">Laporan Rekapitulasi Denda LibHub</h2>
            <p class="text-slate-500 font-bold mt-1">Periode: {{ date('F Y') }}</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-emerald-50/50">
                        <th class="px-6 py-5 text-[10px] font-black text-emerald-800/50 uppercase tracking-[0.2em]">No. Invoice</th>
                        <th class="px-6 py-5 text-[10px] font-black text-emerald-800/50 uppercase tracking-[0.2em]">Member</th>
                        <th class="px-6 py-5 text-[10px] font-black text-emerald-800/50 uppercase tracking-[0.2em]">Deskripsi Pelanggaran</th>
                        <th class="px-6 py-5 text-[10px] font-black text-emerald-800/50 uppercase tracking-[0.2em]">Total Bayar</th>
                        <th class="px-6 py-5 text-[10px] font-black text-emerald-800/50 uppercase tracking-[0.2em] text-center no-print">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-emerald-50/50">
                    {{-- @foreach($invoices as $invoice) --}}
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-5">
                            {{-- {{ $invoice->id }}{{ date('Ymd') }} --}}
                            <span class="font-black text-emerald-600 text-sm">#INV-12-11-23-28</span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex flex-col">
                                {{-- {{ $invoice->user->name }} --}}
                                <span class="font-bold text-emerald-950 text-sm">yoga</span>
                                {{-- {{ $invoice->user->email }} --}}
                                <span class="text-[10px] font-medium text-slate-400 uppercase">yoga#gmail.com</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            {{-- {{ $invoice->deskripsi_pelanggaran }} --}}
                            <p class="text-slate-600 text-sm font-medium line-clamp-1">ini desxk</p>
                        </td>
                        <td class="px-6 py-5">
                            {{-- {{ number_format($invoice->total_bayar, 0, ',', '.') }} --}}
                            <span class="font-black text-emerald-950 text-sm">Rp 12000</span>
                        </td>
                        <td class="px-6 py-5 text-center no-print">
                            {{-- Button Cetak Struk Satuan --}}
                            {{-- {{ $invoice->id }} --}}
                            <button onclick="printInvoice('')" class="w-10 h-10 bg-slate-50 text-slate-400 rounded-xl hover:bg-emerald-50 hover:text-emerald-600 transition">
                                <i class="fa-solid fa-receipt"></i>
                            </button>
                        </td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Script & Style Khusus --}}
<style>
    @media print {
        .no-print { display: none !important; }
        body { background: white !important; }
        .lg\:ml-72, .lg\:ml-20 { margin-left: 0 !important; }
        table { width: 100% !important; border: 1px solid #e2e8f0; }
        th, td { border-bottom: 1px solid #e2e8f0; }
    }
</style>

<script>
    function printInvoice(id) {
        // Logika sederhana: Buka halaman struk khusus di tab baru lalu print
        const printUrl = `/admin/denda/print/${id}`;
        const printWindow = window.open(printUrl, '_blank');
        printWindow.onload = function() {
            printWindow.print();
        };
    }
</script>
@endsection