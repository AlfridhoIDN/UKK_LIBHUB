@extends('layouts.settings')

@section('contents')
<div class="max-w-7xl mx-auto pt-6 pb-20 px-2">
    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-black text-emerald-950 tracking-tighter uppercase">Riwayat Peminjaman</h1>
        <p class="text-slate-500 font-medium">Daftar buku yang telah selesai Anda baca dan dikembalikan.</p>
    </div>

    @if($history->isEmpty())
        <div class="bg-white rounded-[3rem] border border-dashed border-slate-200 py-20 flex flex-col items-center justify-center text-center">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-6">
                <i class="fa-solid fa-clock-rotate-left text-3xl"></i>
            </div>
            <h3 class="text-lg font-black text-emerald-950">Belum Ada Riwayat</h3>
            <p class="text-slate-400 mt-2">Selesaikan peminjaman buku Anda untuk melihat riwayat di sini.</p>
        </div>
    @else
        <div class="bg-white rounded-[2.5rem] border border-emerald-50 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-emerald-50/50">
                            <th class="px-6 py-5 text-[10px] font-black text-emerald-800/50 uppercase tracking-[0.2em]">Info Buku</th>
                            <th class="px-6 py-5 text-[10px] font-black text-emerald-800/50 uppercase tracking-[0.2em] hidden md:table-cell">Tgl Pinjam</th>
                            <th class="px-6 py-5 text-[10px] font-black text-emerald-800/50 uppercase tracking-[0.2em]">Tgl Kembali</th>
                            <th class="px-6 py-5 text-[10px] font-black text-emerald-800/50 uppercase tracking-[0.2em] text-center">Status</th>
                            <th class="px-6 py-5 text-[10px] font-black text-emerald-800/50 uppercase tracking-[0.2em]"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-emerald-50/50">
                        @foreach($history as $item)
                        <tr class="group hover:bg-emerald-50/20 transition">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-16 rounded-lg bg-slate-100 overflow-hidden shadow-sm shrink-0">
                                        @if($item->book->cover_image)
                                            <img src="{{ asset('storage/' . $item->book->cover_image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                <i class="fa-solid fa-book text-xs"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-black text-emerald-950 leading-tight line-clamp-1 group-hover:text-emerald-600 transition">{{ $item->book->judul }}</h4>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase mt-1">{{ $item->book->penulis }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 hidden md:table-cell">
                                <span class="text-sm font-bold text-slate-600">{{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d M Y') }}</span>
                            </td>
                            <td class="px-6 py-5">
                                <span class="text-sm font-bold text-slate-600">{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[9px] font-black uppercase tracking-widest">
                                    <i class="fa-solid fa-circle-check text-[10px]"></i>
                                    Selesai
                                </span>
                            </td>
                            <td class="px-6 py-5 text-right">
                                <a href="{{ route('landingpage.book', $item->buku_id) }}" class="text-[10px] font-black text-emerald-600 hover:text-emerald-800 uppercase tracking-widest">
                                    Pinjam Lagi
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection