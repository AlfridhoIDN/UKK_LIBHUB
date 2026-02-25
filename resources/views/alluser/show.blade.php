@extends('layouts.app')

@section('contents')
<div class="min-h-screen bg-white">
    <div class="relative w-full h-[450px] md:h-[550px] overflow-hidden">
        <div class="absolute inset-0 z-0">
            @if($book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-full object-cover scale-110 blur-1xl opacity-30">
            @else
                <div class="w-full h-full bg-emerald-100"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-white via-white/40 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-5 h-full flex flex-col justify-end pb-10">
            <div class="flex flex-col md:flex-row gap-8 items-center md:items-end">
                <div class="w-48 md:w-64 flex-shrink-0 shadow-2xl rounded-[2.5rem] overflow-hidden border-8 border-white ">
                    {{-- transform md:-mb-20  --}}
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full aspect-[3/4.5] object-cover">
                    @else
                        <div class="w-full aspect-[3/4.5] bg-emerald-50 flex items-center justify-center text-emerald-200">
                            <i class="fa-solid fa-book text-6xl"></i>
                        </div>
                    @endif
                </div>

                <div class="flex-1 text-center md:text-left space-y-4">
                    <nav class="flex items-center justify-center md:justify-start gap-2 text-xs font-bold text-slate-400 mb-2">
                        <a href="/">Home</a> <i class="fa-solid fa-chevron-right text-[8px]"></i>
                        <a href="/explore-category">Books</a> <i class="fa-solid fa-chevron-right text-[8px]"></i>
                        <span class="text-emerald-400">{{ $book->judul }}</span>
                    </nav>
                    
                    <h1 class="text-4xl md:text-6xl font-black tracking-tighter leading-none">{{ $book->judul }}</h1>
                    <p class="text-xl font-medium text-slate-500">{{ $book->penulis }}</p>
                    
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-3">
                        @foreach($book->categories as $category)
                            <span class="px-4 py-1.5 bg-white backdrop-blur-md border border-white/20 rounded-lg text-[10px] font-black uppercase tracking-widest text-emerald-400">
                                {{ $category->nama_kategori }}
                            </span>
                        @endforeach
                        <span class="px-4 py-1.5 bg-emerald-500 rounded-lg text-[10px] font-black uppercase tracking-widest text-slate-950">
                            {{ $book->tahun_terbit }}
                        </span>
                    </div>

                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-3">
                        <a href="{{ route('book.loan.index', $book->id) }}" class="px-8 py-4 bg-emerald-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-emerald-700 transition shadow-xl shadow-emerald-100 flex items-center gap-2 active:scale-95">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                            Pinjam Buku
                        </a>
                        <button class="px-8 py-4 bg-white border-2 border-slate-100 text-slate-400 rounded-2xl font-black text-xs uppercase tracking-widest hover:text-emerald-500 hover:border-emerald-100 transition flex items-center gap-2 active:scale-95 group">
                            <i class="fa-solid fa-bookmark"></i>
                            Tambah Favorit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-5 pt-28 md:pt-32 pb-20 grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <div class="lg:col-span-8 space-y-16">
            <div class="space-y-6">
                <h2 class="text-2xl font-black text-slate-900 flex items-center gap-3">
                    <span class="w-2 h-8 bg-emerald-500 rounded-full"></span>
                    Deskripsi
                </h2>
                <p class="text-slate-500 text-lg leading-relaxed font-medium">
                    {{ $book->deskripsi ?? 'Buku karya ' . $book->penulis . ' ini merupakan koleksi pilihan di LIBHUB yang menawarkan wawasan mendalam dengan pendekatan yang segar.' }}
                </p>
            </div>

            <div class="space-y-8 bg-slate-50 p-8 md:p-10 rounded-[3rem] border border-slate-100">
                <h2 class="text-2xl font-black text-slate-900">Ulasan Pembaca</h2>
                
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 space-y-4">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                            <i class="fa-solid fa-user-pen text-sm"></i>
                        </div>
                        <span class="font-bold text-slate-700 text-sm">Tulis ulasanmu...</span>
                    </div>
                    <textarea class="w-full bg-slate-50 border-2 border-transparent focus:border-emerald-500 focus:bg-white rounded-2xl p-4 text-slate-600 outline-none transition min-h-[100px] font-medium" placeholder="Apa pendapatmu tentang buku ini?"></textarea>
                    <div class="flex justify-end">
                        <button class="bg-slate-900 text-white px-6 py-3 rounded-xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-emerald-600 transition">
                            Kirim Komentar
                        </button>
                    </div>
                </div>

                <div class="space-y-4">
                    @forelse($comments ?? [] as $comment)
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 flex gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 flex-shrink-0">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div>
                                <h4 class="font-black text-slate-800 tracking-tight">{{ $comment->user->name }}</h4>
                                <p class="text-slate-500 text-sm mt-1 leading-relaxed">{{ $comment->content }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-slate-400 font-medium py-10">Belum ada ulasan untuk buku ini.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 space-y-8">
            <h2 class="text-xl font-black text-slate-900 flex items-center justify-between">
                <span>Mungkin Kamu Suka</span>
                <i class="fa-solid fa-wand-magic-sparkles text-emerald-500"></i>
            </h2>

            {{-- <div class="space-y-4">
                @foreach($relatedBooks as $related)
                <a href="{{ route('landing.book.show', $related->id) }}" class="group flex gap-4 p-3 bg-white rounded-3xl border border-transparent hover:border-emerald-100 hover:shadow-xl hover:shadow-emerald-50 transition-all duration-300">
                    <div class="w-20 h-28 flex-shrink-0 rounded-2xl overflow-hidden shadow-md">
                        <img src="{{ asset('storage/' . $related->cover_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <div class="flex flex-col justify-center">
                        <p class="text-[9px] font-black text-emerald-500 uppercase tracking-widest mb-1">
                            {{ $related->categories->first()->nama_kategori ?? 'Umum' }}
                        </p>
                        <h4 class="font-black text-slate-800 line-clamp-2 leading-tight group-hover:text-emerald-600 transition">
                            {{ $related->judul }}
                        </h4>
                        <div class="flex items-center gap-1.5 mt-2">
                            <i class="fa-solid fa-heart text-emerald-500 text-[10px]"></i>
                            <span class="text-slate-400 text-xs font-black">{{ number_format(rand(100, 900)) }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div> --}}
        </div>
    </div>
</div>
@endsection