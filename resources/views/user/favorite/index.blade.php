@extends('layouts.settings')

@section('contents')
<div class="max-w-7xl mx-auto pt-6 pb-20">
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4 px-2">
        <div>
            <h1 class="text-3xl md:text-4xl font-black text-emerald-950 tracking-tighter uppercase">Koleksi Favorit</h1>
            <p class="text-slate-500 font-medium">Buku-buku yang kamu simpan untuk dibaca nanti.</p>
        </div>
        
        <div class="bg-emerald-50 px-4 py-2 rounded-2xl border border-emerald-100 flex items-center gap-3">
            <i class="fa-solid fa-heart text-emerald-500"></i>
            <span class="font-black text-emerald-900 text-sm">{{ $favorites->count() }} Buku Disimpan</span>
        </div>
    </div>

    @if($favorites->isEmpty())
        <div class="bg-white rounded-[3rem] border border-dashed border-slate-200 py-20 flex flex-col items-center justify-center text-center">
            <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mb-6">
                <i class="fa-solid fa-heart-crack text-4xl"></i>
            </div>
            <h3 class="text-xl font-black text-emerald-950">Belum Ada Favorit</h3>
            <p class="text-slate-400 mt-2 mb-8">Jelajahi perpustakaan dan temukan buku yang kamu sukai.</p>
            <a href="/explore" class="px-8 py-4 bg-emerald-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-emerald-700 transition shadow-xl shadow-emerald-100">
                Cari Buku Sekarang
            </a>
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach($favorites as $book)
                <div class="group bg-white rounded-[2rem] border border-emerald-50 p-3 hover:shadow-2xl hover:shadow-emerald-100 transition-all duration-500">
                    <div class="relative aspect-[3/4.5] rounded-[1.5rem] overflow-hidden mb-4 shadow-sm">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        @else
                            <div class="w-full h-full bg-emerald-50 flex items-center justify-center text-emerald-200">
                                <i class="fa-solid fa-book text-4xl"></i>
                            </div>
                        @endif

                        <form action="#" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            @csrf
                            <button class="w-10 h-10 bg-white/90 backdrop-blur-md text-rose-500 rounded-xl flex items-center justify-center shadow-lg hover:bg-rose-500 hover:text-white transition">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </button>
                        </form>
                    </div>

                    <div class="px-1 pb-2">
                        <p class="text-slate-400 font-black text-[9px] mb-1 uppercase tracking-tight">
                            {{ $book->categories->first()->nama_kategori ?? 'Umum' }}
                        </p>

                        <h3 class="font-black text-emerald-950 leading-tight group-hover:text-emerald-600 transition line-clamp-2 mb-2 h-10">
                            {{ $book->judul }}
                        </h3>

                        <div class="flex items-center justify-between mt-3 pt-3 border-t border-slate-50">
                            <div class="flex items-center gap-1.5">
                                <i class="fa-solid fa-heart text-emerald-500 text-[10px]"></i>
                                <span class="text-emerald-900 font-black text-[11px]">{{ number_format(rand(100, 999)) }}</span>
                            </div>
                            <a href="{{ route('landingpage.book', $book->id) }}" class="text-[10px] font-black text-emerald-600 hover:underline uppercase tracking-tighter">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection