@extends('layouts.app')

@section('contents')
<div class="fixed top-6 left-1/2 -translate-x-1/2 z-[100] w-[92%] md:w-auto min-w-[350px]">
    @if (session('error'))
        <div id="alert-error" class="flex items-start p-4 mb-4 text-rose-800 rounded-[2rem] bg-white/80 backdrop-blur-xl border border-rose-100 shadow-[0_20px_50px_rgba(225,_29,_72,_0.15)] animate-in fade-in slide-in-from-top-4 duration-500">
            <div class="flex-shrink-0 w-12 h-12 bg-rose-50 text-rose-500 rounded-[1.2rem] flex items-center justify-center mr-4 shadow-inner">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div class="flex-1 pt-1">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-rose-400 leading-none mb-1 text-left">Pemberitahuan</p>
                <div class="text-sm font-bold leading-tight text-slate-800 text-left">{{ session('error') }}</div>
            </div>
            <button type="button" onclick="closeAlert('alert-error')" class="ml-4 mt-1 text-slate-300 hover:text-rose-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    @endif
</div>
    <header class="pt-32 pb-16 md:pt-48 md:pb-32 px-4 relative overflow-hidden bg-gradient-to-b from-white to-[#f8faf9]">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-5xl md:text-8xl font-black text-[#0f766e] leading-[1.1] tracking-tighter">
                Baca Buku <br><span class="text-emerald-500 italic">Tanpa Batas.</span>
            </h1>
            <p class="mt-8 text-lg md:text-xl text-emerald-800/70 max-w-2xl mx-auto font-medium leading-relaxed">
                Temukan dunia baru lewat ribuan literasi digital. <br class="hidden md:block"> Gabung bersama LIBHUB hari ini.
            </p>
            <div class="mt-12 flex flex-col sm:flex-row justify-center gap-5">
                <button class="bg-[#0f766e] text-white px-12 py-5 rounded-[2rem] font-black text-xl hover:shadow-2xl hover:shadow-emerald-300 transition-all transform hover:-translate-y-1">Mulai Membaca</button>
                <button class="bg-white text-emerald-900 border-2 border-emerald-100 px-12 py-5 rounded-[2rem] font-black text-xl hover:bg-emerald-50 transition">Koleksi Buku</button>
            </div>
        </div>
    </header>

    <section class="max-w-7xl mx-auto px-4 py-20">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-12">
            <div>
                <span class="text-emerald-500 font-black uppercase tracking-[0.2em] text-xs">Trending Minggu Ini</span>
                <h2 class="text-4xl font-black text-emerald-950 mt-2">Buku Populer</h2>
            </div>
            <a href="/explore" class="px-6 py-3 bg-white border-2 border-emerald-50 rounded-2xl font-black text-emerald-700 hover:border-emerald-200 transition group flex items-center gap-2">
                Lihat Semua <span class="group-hover:translate-x-1 transition-transform">→</span>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
            @forelse ($books as $book)
                
                <div class="group">
                    <a href="{{ route('landingpage.book', $book->id) }}">
                    <div class="relative aspect-[3/4.5] bg-emerald-100 rounded-[2.5rem] overflow-hidden mb-5 shadow-sm group-hover:shadow-2xl group-hover:shadow-emerald-200 transition-all duration-500">
                        <div class="absolute top-5 left-5">
                            @forelse($book->categories as $category)
                                <span class="px-4 py-2 bg-emerald-500/90 backdrop-blur-md text-white text-[10px] font-black rounded-xl uppercase tracking-widest shadow-lg">
                                    {{ $category->nama_kategori}}
                                </span>
                            @empty
                                <span class="text-slate-400">Tidak ada kategori</span>
                            @endforelse
                        </div>
                        
                        <button class="absolute top-5 right-5 z-20 p-3 bg-white/90 backdrop-blur-md rounded-2xl text-emerald-300 hover:text-red-500 transition-all transform translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 shadow-xl">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path></svg>
                        </button>

                        @if($book->cover_image)
                        <img src="{{ asset('storage/' .$book->cover_image) }}" class="w-full h-full object-cover" alt="Cover">
                        @else
                            <div class="w-full h-full bg-slate-200 flex flex-col items-center justify-center text-slate-400">
                                <i class="fa-solid fa-book text-6xl mb-4"></i>
                                <span class="text-[10px] font-black uppercase tracking-widest">No Cover Available</span>
                            </div>
                        @endif
                        <div class="absolute inset-x-0 bottom-0 p-5 translate-y-full group-hover:translate-y-0 transition-transform duration-500 bg-gradient-to-t from-emerald-950/80 to-transparent">
                            <button class="w-full bg-white text-emerald-900 py-3 rounded-2xl font-black text-sm shadow-xl active:scale-95 transition">PINJAM BUKU</button>
                        </div>
                    </div>
                    
                    <div class="px-2 py-3">
                        {{-- 1. Kategori (Posisi Atas, Abu-abu/Muted) --}}
                        <p class="text-slate-400 font-bold text-xs mb-1 uppercase tracking-tight">
                            @forelse($book->categories as $category)
                                {{ $category->nama_kategori }}{{ !$loop->last ? ', ' : '' }}
                            @empty
                                Umum
                            @endforelse
                        </p>

                        {{-- 2. Judul (Tebal, Emerald Dark) --}}
                        <h3 class="font-black text-lg text-emerald-950 leading-tight group-hover:text-emerald-600 transition line-clamp-1">
                            {{ $book->judul }}
                        </h3>

                        {{-- 3. Jumlah Favorite (Ikon Hati Emerald) --}}
                        <div class="flex items-center gap-1.5 mt-2">
                            <i class="fa-solid fa-heart text-emerald-500 text-sm"></i>
                            <span class="text-emerald-600 font-black text-sm tracking-tighter">
                                {{-- Simulasi angka favorite, bisa diganti dengan count data asli --}}
                                {{ number_format($book->favorites_count ?? rand(100, 999), 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </a>
                </div>
            @empty
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-[2rem] flex items-center justify-center mb-4 text-slate-200">
                        <i class="fa-solid fa-book-open text-3xl"></i>
                    </div>
                    <p class="text-xs font-black text-slate-300 uppercase tracking-[0.2em]">Koleksi buku masih kosong</p>
                </div>
            @endforelse
        </div>
    </section>

    <script>
    function closeAlert(id) {
        const alert = document.getElementById(id);
        if (alert) {
            alert.style.transform = "translateY(-20px) translateX(-50%)"; 
            alert.style.opacity = "0";
            alert.style.transition = "all 0.6s cubic-bezier(0.4, 0, 0.2, 1)";
            setTimeout(() => alert.remove(), 600);
        }
    }

    setTimeout(() => {
        closeAlert('alert-error');
    }, 6000);
</script>
@endsection