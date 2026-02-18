@extends('layouts.app')

@section('contents')
<div class="pt-32 pb-16 px-4 max-w-7xl mx-auto" x-data="{ mobileFilterOpen: false }">
    
    <div class="flex flex-col md:flex-row gap-8">
        
        <aside 
    x-show="true" {{-- Biar tetep ada di DOM untuk desktop --}}
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
                        <p class="font-black text-emerald-900 text-[10px] uppercase tracking-[0.2em]">Genre Utama</p>
                        <div class="grid grid-cols-1 gap-3">
                            @foreach(['Romance', 'Action', 'Sci-Fi', 'Horror', 'Self Dev', 'History'] as $genre)
                            <label class="flex items-center group cursor-pointer p-2 -ml-2 rounded-xl hover:bg-emerald-50 transition">
                                <input type="checkbox" name="genre" value="{{ strtolower($genre) }}" 
                                       class="genre-checkbox h-5 w-5 rounded-md border-emerald-200 text-emerald-600 focus:ring-emerald-500 transition">
                                <span class="ml-3 text-emerald-800 font-bold group-hover:text-emerald-600 transition">{{ $genre }}</span>
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
                @for ($i = 1; $i <= 8; $i++)
                <div class="book-item group" data-genre="{{ $i % 2 == 0 ? 'romance' : 'action' }}">
                    <div class="relative aspect-[3/4.5] bg-emerald-100 rounded-[2rem] overflow-hidden mb-4 shadow-sm group-hover:shadow-2xl group-hover:shadow-emerald-200 transition-all duration-500">
                        <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&q=80&w=400" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                             <button class="w-full bg-white text-emerald-900 py-3 rounded-xl font-black text-xs tracking-wider">DETAIL BUKU</button>
                        </div>
                    </div>
                    <h3 class="font-black text-emerald-950 leading-tight line-clamp-1 group-hover:text-emerald-500 transition">Buku {{ $i % 2 == 0 ? 'Romance' : 'Action' }}</h3>
                    <p class="text-emerald-400 font-bold text-[10px] uppercase tracking-widest mt-1">{{ $i % 2 == 0 ? 'Romance' : 'Action' }}</p>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('.genre-checkbox');
    const books = document.querySelectorAll('.book-item');
    const resetBtn = document.getElementById('reset-filter');
    const countDisplay = document.getElementById('filter-count');

    function updateFilter() {
        const activeGenres = Array.from(checkboxes).filter(c => c.checked).map(c => c.value);
        
        countDisplay.innerText = activeGenres.length > 0 ? activeGenres.join(' + ') : "Semua Kategori";

        books.forEach(book => {
            const genre = book.getAttribute('data-genre');
            if (activeGenres.length === 0 || activeGenres.includes(genre)) {
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