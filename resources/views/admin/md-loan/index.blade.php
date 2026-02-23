@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Manajemen Peminjaman</h1>
            <p class="text-sm text-slate-500 font-medium">Kelola alur sirkulasi buku perpustakaan.</p>
        </div>
    </div>

    <div class="flex items-center gap-2 bg-slate-100/50 p-1.5 rounded-[2rem] w-fit border border-slate-100">
        <a href="{{ route('loan.index', ['status' => 'pending']) }}" 
           class="px-8 py-3 rounded-[1.8rem] text-xs font-black uppercase tracking-widest transition-all {{ $status == 'pending' ? 'bg-white text-emerald-600 shadow-sm border border-slate-100' : 'text-slate-400 hover:text-slate-600' }}">
            Request
        </a>
        <a href="{{ route('loan.index', ['status' => 'accepted']) }}" 
           class="px-8 py-3 rounded-[1.8rem] text-xs font-black uppercase tracking-widest transition-all {{ $status == 'accepted' ? 'bg-white text-emerald-600 shadow-sm border border-slate-100' : 'text-slate-400 hover:text-slate-600' }}">
            Dipinjam
        </a>
        <a href="{{ route('loan.index', ['status' => 'rejected']) }}" 
           class="px-8 py-3 rounded-[1.8rem] text-xs font-black uppercase tracking-widest transition-all {{ $status == 'rejected' ? 'bg-white text-emerald-600 shadow-sm border border-slate-100' : 'text-slate-400 hover:text-slate-600' }}">
            Ditolak
        </a>
    </div>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50 text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">
                    <tr>
                        <th class="px-6 py-4 w-16 text-center">No</th>
                        <th class="px-6 py-4">Buku & Peminjam</th>
                        <th class="px-6 py-4">Periode</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($loans as $loan)
                    <tr class="hover:bg-slate-50/50 transition group">
                        <td class="px-6 py-5 text-center font-bold text-slate-400 text-sm">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <a href="#" class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-400 hover:text-emerald-500 hover:border-emerald-200 transition">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </a>
                                <div>
                                    <h3 class="font-black text-slate-800 text-sm leading-tight line-clamp-1">{{ $loan->book->judul }}</h3>
                                    <p class="text-[11px] font-bold text-emerald-500 mt-0.5">@ {{ $loan->user->username }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-black text-slate-300 uppercase leading-none mb-1">Estimasi Pengembalian</span>
                                <span class="text-xs font-bold text-slate-600 italic">
                                    {{ \Carbon\Carbon::parse($loan->tanggal_peminjaman)->format('d M') }} - {{ \Carbon\Carbon::parse($loan->tanggal_pengembalian)->format('d M Y') }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex justify-center gap-2">
                                @if($status == 'pending')
                                    <form action="#" method="POST">
                                        @csrf
                                        <button class="px-5 py-2.5 bg-emerald-500 text-white text-[10px] font-black rounded-xl hover:bg-emerald-600 transition shadow-sm uppercase tracking-widest">Accept</button>
                                    </form>
                                    <form action="#" method="POST">
                                        @csrf
                                        <button class="px-5 py-2.5 bg-white border border-rose-100 text-rose-500 text-[10px] font-black rounded-xl hover:bg-rose-50 transition shadow-sm uppercase tracking-widest">Reject</button>
                                    </form>
                                @elseif($status == 'accepted')
                                    <span class="px-6 py-2 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-xl uppercase tracking-widest flex items-center gap-2">
                                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                                        Aktif Meminjam
                                    </span>
                                @else
                                    <span class="px-6 py-2 bg-slate-50 text-slate-400 text-[10px] font-black rounded-xl uppercase tracking-widest">
                                        No Action Needed
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-4 border border-slate-100">
                                    <i class="fa-solid fa-inbox text-slate-200 text-2xl"></i>
                                </div>
                                <p class="text-xs font-black text-slate-300 uppercase tracking-[0.2em]">Tidak ada data {{ $status }}</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection