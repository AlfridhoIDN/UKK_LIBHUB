@extends('layouts.settings')

@section('contents')
<div class="max-w-7xl mx-auto pt-6 pb-20 px-4">
    {{-- Header --}}
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl md:text-4xl font-black text-emerald-950 tracking-tighter uppercase">Pinjaman Aktif</h1>
            <p class="text-slate-500 font-medium text-sm md:text-base">Daftar buku yang sedang Anda baca saat ini.</p>
        </div>
        
        <div class="bg-emerald-600 px-6 py-3 rounded-2xl shadow-lg shadow-emerald-100 flex items-center gap-3 text-white">
            <i class="fa-solid fa-book-open-reader"></i>
            <span class="font-black text-xs uppercase tracking-widest">{{ $activeLoans->count() }} Buku Aktif</span>
        </div>
    </div>

    @if($activeLoans->isEmpty())
        {{-- State Kosong --}}
        <div class="bg-white rounded-[3rem] border border-dashed border-slate-200 py-24 flex flex-col items-center justify-center text-center">
            <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-300 mb-6">
                <i class="fa-solid fa-mug-hot text-3xl"></i>
            </div>
            <h3 class="text-xl font-black text-emerald-950">Santai Sejenak</h3>
            <p class="text-slate-400 mt-2">Kamu tidak memiliki pinjaman aktif saat ini.</p>
            <a href="/" class="mt-8 px-8 py-4 bg-emerald-600 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-emerald-700 transition shadow-lg">Jelajahi Buku</a>
        </div>
    @else
        {{-- Grid Pinjaman Aktif --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($activeLoans as $loan)
                <div class="group bg-white rounded-[2.5rem] border border-emerald-50 p-6 flex flex-col shadow-sm hover:shadow-xl transition-all duration-500 relative overflow-hidden">
                    {{-- Decorative Background --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50/50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                    
                    <div class="flex gap-5 relative z-10">
                        {{-- Cover Kecil --}}
                        <div class="w-24 h-36 rounded-2xl overflow-hidden shadow-md shrink-0 border-4 border-white">
                            @if($loan->book->cover_image)
                                <img src="{{ asset('storage/' . $loan->book->cover_image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-emerald-50 flex items-center justify-center text-emerald-200">
                                    <i class="fa-solid fa-book"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Info Pinjaman --}}
                        <div class="flex flex-col justify-center">
                            <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest mb-1">Dipinjam</span>
                            <h3 class="font-black text-emerald-950 leading-tight line-clamp-2 mb-2 group-hover:text-emerald-600 transition">
                                {{ $loan->book->judul }}
                            </h3>
                            <div class="flex items-center gap-2 text-slate-400 text-[10px] font-bold uppercase">
                                <i class="fa-solid fa-user-pen"></i>
                                {{ $loan->book->penulis }}
                            </div>
                        </div>
                    </div>

                    {{-- Progress / Status Waktu --}}
                    <div class="mt-8 pt-6 border-t border-slate-50 relative z-10">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex flex-col">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Batas Kembali</span>
                                <span class="text-sm font-black text-rose-500">{{ \Carbon\Carbon::parse($loan->tanggal_pengembalian)->translatedFormat('d M Y') }}</span>
                            </div>
                            
                            {{-- Badge Sisa Hari --}}
                            @php
                                $now = \Carbon\Carbon::now()->startOfDay();
                                $due = \Carbon\Carbon::parse($loan->tanggal_pengembalian)->startOfDay();
                                $remaining = $now->diffInDays($due, false); 
                            @endphp
                            <div class="px-3 py-1.5 {{ $remaining <= 2 ? 'bg-rose-50 text-rose-600' : 'bg-emerald-50 text-emerald-600' }} rounded-xl text-[10px] font-black uppercase tracking-tighter">
                                @if($remaining < 0)
                                    Terlambat {{ abs($remaining) }} Hari
                                @else
                                    Sisa {{ $remaining }} Hari
                                @endif
                            </div>
                        </div>

                        {{-- Progress Bar Simple --}}
                        <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-500 rounded-full transition-all duration-1000" style="width: 70%"></div>
                        </div>
                    </div>

                    {{-- Action Button --}}
                    <div class="mt-6 flex gap-3 relative z-10">
                        <a href="{{ route('landingpage.book', $loan->buku_id) }}" class="flex-1 py-3 bg-slate-900 text-white rounded-xl text-center font-black text-[10px] uppercase tracking-[0.2em] hover:bg-emerald-600 transition active:scale-95">
                            ajukan kembali
                        </a>
                        <button class="w-12 h-12 flex items-center justify-center bg-slate-50 text-slate-400 rounded-xl hover:text-emerald-600 transition">
                            <i class="fa-solid fa-print"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection