@extends('layouts.app')

@section('contents')
<div class="pt-32 pb-16 px-4 max-w-7xl mx-auto" x-data="{ mobileFilterOpen: false }">
    
    <div class="flex flex-col md:flex-row gap-8">
        
        <aside 
    x-show="true"
    :class="mobileFilterOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
    class="fixed inset-y-0 left-0 z-[70] w-80 bg-white p-8 shadow-2xl transition-transform duration-300 md:static md:w-64 md:p-0 md:bg-transparent md:shadow-none md:z-0">
            
            <div class="bg-white md:p-6 rounded-[2.5rem] md:border md:border-emerald-50 md:shadow-sm sticky top-28">
                <div class="flex justify-between items-center mb-8 md:mb-6">
                    <h2 class="text-2xl md:text-xl font-black text-emerald-950 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        Filter
                    </h2>
                    
                    <button type="button" @click="mobileFilterOpen = false" class="md:hidden p-2 bg-red-50 text-red-500 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="space-y-6">
                    <div class="space-y-4">
                        <p class="font-black text-emerald-900 text-[10px] uppercase tracking-[0.2em]">Kategori Utama</p>
                        <div class="grid grid-cols-1 gap-3">
                            @foreach($categories as $category)
                            <label class="flex items-center group cursor-pointer p-2 -ml-2 rounded-xl hover:bg-emerald-50 transition">
                                <input type="checkbox" name="category" value="{{ strtolower($category->nama_kategori) }}" 
                                       class="category-checkbox h-5 w-5 rounded-md border-emerald-200 text-emerald-600 focus:ring-emerald-500 transition">
                                <span class="ml-3 text-emerald-800 font-bold group-hover:text-emerald-600 transition">{{ $category->nama_kategori }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <button id="reset-filter" class="w-full bg-slate-100 text-slate-500 py-3 rounded-2xl font-black hover:bg-red-50 hover:text-red-500 transition text-sm">
                        RESET FILTER
                    </button>
                </div>
            </div>
        </aside>

        <div x-show="mobileFilterOpen" 
             @click="mobileFilterOpen = false"
             class="fixed inset-0 bg-emerald-950/40 backdrop-blur-sm z-50 md:hidden"
             x-transition:enter="transition opacity-0"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition opacity-100"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
        </div>

        <div class="flex-1">
            <div class="mb-10 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-emerald-950 tracking-tighter">Koleksi Buku</h1>
                    <p class="text-emerald-500 font-bold text-sm uppercase tracking-widest mt-1" id="filter-count">Semua Kategori</p>
                </div>

                <button @click="mobileFilterOpen = true" 
                        class="md:hidden flex items-center gap-2 bg-[#0f766e] text-white px-5 py-3 rounded-2xl font-black shadow-lg shadow-emerald-200 active:scale-95 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                    Filter
                </button>
            </div>

            <div id="book-container" class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
                @forelse ($books as $book)
                <div class="book-item group" data-category="{{ $book->categories->pluck('nama_kategori')->map(fn($item) => strtolower($item))->join(',') }}">
                    <div class="relative aspect-[3/4.5] bg-emerald-100 rounded-[2rem] overflow-hidden mb-4 shadow-sm group-hover:shadow-2xl group-hover:shadow-emerald-200 transition-all duration-500">
                        <div class="absolute z-20 top-5 left-5 transition-all transform translate-y-2 group-hover:translate-y-0 group-hover:opacity-100">
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
                        <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                             <button class="w-full bg-white text-emerald-900 py-3 rounded-xl font-black text-xs tracking-wider">DETAIL BUKU</button>
                        </div>
                    </div>
                    <h3 class="font-black text-emerald-950 leading-tight line-clamp-1 group-hover:text-emerald-500 transition">{{$book->judul}}</h3>
                    <p class="text-emerald-400 font-bold text-[10px] uppercase tracking-widest mt-1">{{ $book->penulis}}</p>
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
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('.category-checkbox');
    const books = document.querySelectorAll('.book-item');
    const resetBtn = document.getElementById('reset-filter');
    const countDisplay = document.getElementById('filter-count');

    function updateFilter() {
        const activeCategory = Array.from(checkboxes).filter(c => c.checked).map(c => c.value);
        
        countDisplay.innerText = activeCategory.length > 0 ? activeCategory.join(' + ') : "Semua Kategori";

        books.forEach(book => {
            const category = book.getAttribute('data-category');
            if (activeCategory.length === 0 || activeCategory.includes(category)) {
                book.style.display = 'block';
                book.classList.add('animate-fade-in');
            } else {
                book.style.display = 'none';
            }
        });
    }

    checkboxes.forEach(cb => cb.addEventListener('change', updateFilter));
    resetBtn.addEventListener('click', () => {
        checkboxes.forEach(cb => cb.checked = false);
        updateFilter();
    });
});
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }
</style>
@endsection