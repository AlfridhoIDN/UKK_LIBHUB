@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto">
    {{-- Header & Back Button --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('book.index') }}" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-emerald-600 hover:border-emerald-100 transition shadow-sm">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Tambah Koleksi Baru</h1>
            <p class="text-sm text-slate-500 font-medium">Input data literasi digital ke dalam sistem perpustakaan.</p>
        </div>
    </div>

    <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @csrf
        
        {{-- Sidebar: Cover Image Upload --}}
        <div class="space-y-6">
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm text-center">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-6">Cover Buku</label>
                
                <div class="relative group mx-auto w-full aspect-[3/4] bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200 overflow-hidden flex flex-col items-center justify-center transition-all hover:border-emerald-300">
                    {{-- Preview Container --}}
                    <img id="cover-preview" src="#" alt="Preview" class="hidden absolute inset-0 w-full h-full object-cover">
                    
                    <div id="placeholder-text" class="relative z-10 flex flex-col items-center">
                        <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-slate-300 mb-3">
                            <i class="fa-solid fa-cloud-arrow-up text-2xl"></i>
                        </div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Upload JPG/PNG</p>
                    </div>

                    <input type="file" name="cover_image" id="cover_image" class="absolute inset-0 opacity-0 cursor-pointer" onchange="previewImage(this)">
                </div>
                
                <p class="mt-4 text-[10px] text-slate-400 font-medium italic">Rekomendasi rasio 3:4 (Maks. 2MB)</p>
                @error('cover_image')
                    <p class="text-rose-500 text-xs mt-2 font-bold">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Main Form Content --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-8 md:p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Judul Buku (Full Width) --}}
                    <div class="md:col-span-2 group">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-2 ml-1">Judul Lengkap Buku</label>
                        <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Masukkan judul buku..." 
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-transparent focus:border-emerald-500 focus:bg-white rounded-2xl text-slate-800 font-bold transition-all outline-none" required>
                        @error('judul') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Penulis --}}
                    <div class="group">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-2 ml-1">Nama Penulis</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-emerald-500">
                                <i class="fa-solid fa-user-pen text-xs"></i>
                            </span>
                            <input type="text" name="penulis" value="{{ old('penulis') }}" placeholder="Nama penulis..." 
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border-2 border-transparent focus:border-emerald-500 focus:bg-white rounded-2xl text-slate-800 font-bold transition-all outline-none" required>
                        </div>
                        @error('penulis') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="group" x-data="{ open: false, selected: 'Pilih Kategori', selectedId: '' }">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-2 ml-1">Kategori Buku</label>
                        
                        <div class="relative">
                            <input type="hidden" name="category_id" :value="selectedId">

                            <button type="button" @click="open = !open" @click.away="open = false"
                                class="w-full pl-12 pr-10 py-4 bg-slate-50 border-2 border-transparent focus:border-emerald-500 focus:bg-white rounded-2xl text-slate-800 font-bold transition-all outline-none text-left flex items-center shadow-sm">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-emerald-500">
                                    <i class="fa-solid fa-layer-group text-xs"></i>
                                </span>
                                <span x-text="selected" :class="selected === 'Pilih Kategori' ? 'text-slate-300' : 'text-slate-800'"></span>
                                
                                <div class="absolute inset-y-0 right-0 flex items-center pr-5 text-slate-300 transition-transform duration-300" :class="open ? 'rotate-180' : ''">
                                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                </div>
                            </button>

                            <div x-show="open" 
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-[-10px]"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                class="absolute z-50 w-full mt-2 bg-white border border-slate-100 rounded-[1.5rem] shadow-[0_10px_30px_rgba(0,0,0,0.08)] overflow-hidden">
                                
                                <div class="max-h-60 overflow-y-auto p-2 space-y-1">
                                    @foreach($categories as $category)
                                    <div @click="selected = '{{ $category->nama_kategori }}'; selectedId = '{{ $category->id }}'; open = false"
                                        class="px-4 py-3 rounded-xl text-sm font-bold text-slate-600 cursor-pointer hover:bg-emerald-50 hover:text-emerald-600 transition flex items-center justify-between group/item">
                                        <span>{{ $category->nama_kategori }}</span>
                                        <i class="fa-solid fa-check text-[10px] opacity-0 group-hover/item:opacity-100 transition" x-show="selectedId == '{{ $category->id }}'"></i>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @error('category_id') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Tahun Terbit --}}
                    <div class="group">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-2 ml-1">Tahun Terbit</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-emerald-500">
                                <i class="fa-solid fa-calendar-days text-xs"></i>
                            </span>
                            <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', date('Y')) }}" placeholder="YYYY" 
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border-2 border-transparent focus:border-emerald-500 focus:bg-white rounded-2xl text-slate-800 font-bold transition-all outline-none" required>
                        </div>
                        @error('tahun_terbit') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Penerbit --}}
                    <div class="md:col-span-2 group">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-2 ml-1">Nama Penerbit</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-emerald-500">
                                <i class="fa-solid fa-building-columns text-xs"></i>
                            </span>
                            <input type="text" name="penerbit" value="{{ old('penerbit') }}" placeholder="Contoh: Gramedia, Balai Pustaka..." 
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border-2 border-transparent focus:border-emerald-500 focus:bg-white rounded-2xl text-slate-800 font-bold transition-all outline-none" required>
                        </div>
                        @error('penerbit') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2 group mt-6">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-2 ml-1">Deskripsi / Sinopsis Buku</label>
                        <div class="relative">
                            <span class="absolute top-4 left-5 text-emerald-500">
                                <i class="fa-solid fa-align-left text-xs"></i>
                            </span>
                            <textarea name="deskripsi" rows="5" placeholder="Tuliskan ringkasan atau deskripsi buku di sini..." 
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border-2 border-transparent focus:border-emerald-500 focus:bg-white rounded-2xl text-slate-800 font-medium transition-all outline-none resize-none shadow-sm">{{ old('deskripsi') }}</textarea>
                        </div>
                        @error('deskripsi') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-10 flex flex-col md:flex-row gap-4">
                    <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white py-4 rounded-2xl font-black text-sm transition shadow-lg shadow-emerald-200 uppercase tracking-widest flex items-center justify-center gap-2">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        Simpan Koleksi
                    </button>
                    <a href="{{ route('book.index') }}" class="md:w-1/3 bg-slate-100 hover:bg-slate-200 text-slate-500 py-4 rounded-2xl font-black text-sm transition text-center uppercase tracking-widest">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('cover-preview');
        const placeholder = document.getElementById('placeholder-text');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection