@extends('layouts.admin')

@section('admin-content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
        <p class="text-slate-400 text-xs font-black uppercase tracking-wider">Total Buku</p>
        <h3 class="text-3xl font-black text-slate-800 mt-2">1,284</h3>
        <div class="mt-4 flex items-center gap-2 text-emerald-500 text-xs font-bold">
            <span>↑ 12% dari bulan lalu</span>
        </div>
    </div>
    </div>

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="p-8 border-b border-slate-50 flex justify-between items-center">
        <h3 class="text-xl font-black text-slate-800">Peminjaman Terbaru</h3>
        <button class="text-sm font-black text-emerald-600 hover:text-emerald-700">Lihat Semua</button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 text-[10px] uppercase tracking-[0.2em] font-black text-slate-400">
                <tr>
                    <th class="px-8 py-4">Buku</th>
                    <th class="px-8 py-4">Peminjam</th>
                    <th class="px-8 py-4">Tgl Pinjam</th>
                    <th class="px-8 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-8 py-4 font-bold text-slate-700 text-sm">Filosofi Teras</td>
                    <td class="px-8 py-4 text-sm font-medium">Budi Sudarsono</td>
                    <td class="px-8 py-4 text-sm text-slate-500">05 Feb 2026</td>
                    <td class="px-8 py-4">
                        <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-lg text-[10px] font-black uppercase">Dipinjam</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection