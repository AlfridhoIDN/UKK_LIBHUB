@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6 max-w-6xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('book.index') }}" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-emerald-600 hover:border-emerald-100 transition shadow-sm">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h1 class="text-2xl font-black text-slate-800 tracking-tight">Detail Koleksi</h1>
                <p class="text-sm text-slate-500 font-medium">Informasi lengkap literasi digital.</p>
            </div>
        </div>
        
        <div class="flex items-center gap-2">
            <a href="{{ route('book.edit', $book->id) }}" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold text-xs transition shadow-lg shadow-blue-200 uppercase tracking-widest">
                <i class="fa-solid fa-pen-to-square"></i>
                Edit Buku
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white p-4 rounded-[3rem] border border-slate-100 shadow-sm relative overflow-hidden">
                <div class="aspect-[3/4.5] rounded-[2.5rem] overflow-hidden shadow-2xl relative group">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-full object-cover" alt="Cover">
                    @else
                        <div class="w-full h-full bg-slate-50 flex flex-col items-center justify-center text-slate-200">
                            <i class="fa-solid fa-book text-6xl mb-4"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest">No Cover Available</span>
                        </div>
                    @endif
                    
                    <div class="absolute top-6 left-6">
                        @forelse($book->categories as $category)
                            <span class="px-4 py-2 bg-emerald-500/90 backdrop-blur-md text-white text-[10px] font-black rounded-xl uppercase tracking-widest shadow-lg">
                                {{ $category->nama_kategori}}
                            </span>
                        @empty
                            <span class="text-slate-400">Tidak ada kategori</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="bg-emerald-50/50 border border-emerald-100 p-6 rounded-[2rem] flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-emerald-600/60 uppercase tracking-widest mb-1">Status Buku</p>
                    <p class="text-sm font-black text-emerald-900 uppercase tracking-tight">Tersedia untuk Dipinjam</p>
                </div>
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-emerald-500 shadow-sm">
                    <i class="fa-solid fa-check-double"></i>
                </div>
            </div>
        </div>

        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white p-8 md:p-12 rounded-[3rem] border border-slate-100 shadow-sm relative overflow-hidden h-full">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-slate-50 rounded-full blur-3xl"></div>

                <div class="relative space-y-10">
                    <div>
                        <span class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.3em] block mb-2">Informasi Utama</span>
                        <h2 class="text-4xl md:text-5xl font-black text-slate-800 leading-[1.1] tracking-tighter mb-4">{{ $book->judul }}</h2>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                                <i class="fa-solid fa-user text-sm"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Penulis</p>
                                <p class="text-lg font-bold text-slate-700 leading-none">{{ $book->penulis }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="h-px bg-slate-50 w-full"></div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-building-columns text-lg"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Penerbit</p>
                                <p class="text-base font-bold text-slate-800">{{ $book->penerbit }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-calendar-check text-lg"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Tahun Terbit</p>
                                <p class="text-base font-bold text-slate-800">{{ $book->tahun_terbit }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-tags text-lg"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Kategori</p>
                                @forelse($book->categories as $category)
                                <p class="text-base font-bold text-slate-800">{{ $category->nama_kategori}}</p>
                                @empty
                                <p class="text-base font-bold text-slate-800">Tidak ada Kategori</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-hashtag text-lg"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">ID Koleksi</p>
                                <p class="text-base font-bold text-slate-800">#LIB-{{ str_pad($book->id, 5, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.3em]">Sinopsis & Deskripsi</span>
                            <div class="h-[1px] flex-1 bg-slate-100"></div>
                        </div>
                        <div class="bg-slate-50/50 rounded-3xl p-6 border border-slate-50">
                            <p class="text-slate-600 leading-relaxed text-sm">
                                @if($book->deskripsi)
                                    {{ $book->deskripsi }}
                                @else
                                    <span class="italic text-slate-400">Tidak ada deskripsi tersedia untuk buku ini.</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="pt-6">
                        <p class="text-[10px] text-slate-400 font-medium italic">
                            * Data ini dicatatkan secara digital pada sistem LIBHUB. Perubahan pada metadata buku hanya dapat dilakukan melalui otoritas Admin atau Staff.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection