@extends('layouts.admin')

@section('admin-content')
<div class="max-w-7xl mx-auto pt-10 pb-20 px-4">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10 no-print">
        <div>
            <h1 class="text-3xl md:text-4xl font-black text-emerald-950 tracking-tighter uppercase">Riwayat Peminjaman</h1>
            <p class="text-slate-500 font-medium">Manajemen data transaksi dan riwayat peminjaman buku.</p>
        </div>
        
        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="px-6 py-4 bg-white border-2 border-slate-100 text-slate-600 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-100 transition flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-print"></i>
                Cetak Riwayat
            </button>
            
            <a href="#" class="px-6 py-4 bg-emerald-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-emerald-700 transition shadow-xl shadow-emerald-100 flex items-center gap-2">
                <i class="fa-solid fa-file-export"></i>
                Export Excel
            </a>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-emerald-50 shadow-sm overflow-hidden print:border-none print:shadow-none">
        <div class="hidden print:block text-center py-10 border-b-2 border-emerald-950 mb-6">
            <h2 class="text-2xl font-black uppercase">Laporan Riwayat Perpustakaan LibHub</h2>
            <p class="text-sm font-bold">Tanggal Dicetak: {{ date('d F Y') }}</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-emerald-50/50 print:bg-slate-100">
                        <th class="px-6 py-5 text-[10px] font-black text-emerald-800/50 uppercase tracking-widest">Peminjam</th>
                        <th class="px-6 py-5 text-[10px] font-black text-emerald-800/50 uppercase tracking-widest">Buku</th>
                        <th class="px-6 py-5 text-[10px] font-black text-emerald-800/50 uppercase tracking-widest text-center">Pinjam</th>
                        <th class="px-6 py-5 text-[10px] font-black text-emerald-800/50 uppercase tracking-widest text-center">Kembali</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-emerald-50/50">
                    @foreach($allPeminjaman as $item)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-5">
                            <div class="flex flex-col">
                                <span class="font-black text-emerald-950 text-sm">{{ $item->user->name }}</span>
                                <span class="text-[10px] font-medium text-slate-400">{{ $item->user->email }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="font-bold text-slate-700 text-sm">{{ $item->book->judul }}</span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <span class="text-xs font-bold text-slate-500">{{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d/m/y') }}</span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <span class="text-xs font-bold text-slate-500">{{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d/m/y') }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    @media print {
        aside, 
        header, 
        nav, 
        .no-print, 
        button, 
        form, 
        .fixed,
        footer {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }

        body {
            background-color: white !important;
            margin: 0 !important;
            padding: 0 !important;
            -webkit-print-color-adjust: exact; 
        }

        main {
            margin-left: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            position: relative !important;
            display: block !important;
        }

        .max-w-7xl {
            max-width: 100% !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        table {
            width: 100% !important;
            border: 1px solid #e2e8f0 !important;
            border-collapse: collapse !important;
        }
        
        th, td {
            padding: 12px !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }

        .shadow-sm, .shadow-xl {
            shadow: none !important;
            box-shadow: none !important;
        }
    }
</style>
@endsection