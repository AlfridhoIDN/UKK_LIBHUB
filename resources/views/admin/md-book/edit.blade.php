@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto">
    {{-- Header & Back Button --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('book.index') }}" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-blue-600 hover:border-blue-100 transition shadow-sm">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Edit Data Buku</h1>
            <p class="text-sm text-slate-500 font-medium">Perbarui informasi koleksi literasi digital.</p>
        </div>
    </div>

    <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm text-center">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-6">Cover Buku</label>
                
                <div class="relative group mx-auto w-full aspect-[3/4] bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200 overflow-hidden flex flex-col items-center justify-center transition-all hover:border-blue-300">
                    <img id="cover-preview" 
                         src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : '#' }}" 
                         alt="Preview" 
                         class="{{ $book->cover_image ? '' : 'hidden' }} absolute inset-0 w-full h-full object-cover">
                    
                    <div id="placeholder-text" class="{{ $book->cover_image ? 'hidden' : '' }} relative z-10 flex flex-col items-center">
                        <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-slate-300 mb-3">
                            <i class="fa-solid fa-image text-2xl"></i>
                        </div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Ganti Cover</p>
                    </div>

                    <input type="file" name="cover_image" id="cover_image" class="absolute inset-0 opacity-0 cursor-pointer" onchange="previewImage(this)">
                </div>
                
                <p class="mt-4 text-[10px] text-slate-400 font-medium italic">Klik gambar untuk mengganti cover baru</p>
                @error('cover_image')
                    <p class="text-rose-500 text-xs mt-2 font-bold">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-8 md:p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="md:col-span-2 group">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-2 ml-1">Judul Buku</label>
                        <input type="text" name="judul" value="{{ old('judul', $book->judul) }}" 
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-transparent focus:border-blue-500 focus:bg-white rounded-2xl text-slate-800 font-bold transition-all outline-none" required>
                        @error('judul') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="group">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-2 ml-1">Penulis</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-blue-500">
                                <i class="fa-solid fa-user-pen text-xs"></i>
                            </span>
                            <input type="text" name="penulis" value="{{ old('penulis', $book->penulis) }}" 
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border-2 border-transparent focus:border-blue-500 focus:bg-white rounded-2xl text-slate-800 font-bold transition-all outline-none" required>
                        </div>
                        @error('penulis') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="group">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-2 ml-1">Kategori</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-blue-500">
                                <i class="fa-solid fa-tags text-xs"></i>
                            </span>
                            <select name="category_id" class="w-full pl-12 pr-10 py-4 bg-slate-50 border-2 border-transparent focus:border-blue-500 focus:bg-white rounded-2xl text-slate-800 font-bold transition-all outline-none appearance-none cursor-pointer" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        {{ (old('category_id') == $category->id || $book->categories->contains($category->id)) ? 'selected' : '' }}>
                                        {{ $category->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-5 pointer-events-none text-slate-300">
                                <i class="fa-solid fa-chevron-down text-[10px]"></i>
                            </div>
                        </div>
                        @error('category_id') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="group">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-2 ml-1">Penerbit</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-blue-500">
                                <i class="fa-solid fa-building-columns text-xs"></i>
                            </span>
                            <input type="text" name="penerbit" value="{{ old('penerbit', $book->penerbit) }}" 
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border-2 border-transparent focus:border-blue-500 focus:bg-white rounded-2xl text-slate-800 font-bold transition-all outline-none" required>
                        </div>
                        @error('penerbit') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="group">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-2 ml-1">Tahun Terbit</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-blue-500">
                                <i class="fa-solid fa-calendar-days text-xs"></i>
                            </span>
                            <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $book->tahun_terbit) }}" 
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border-2 border-transparent focus:border-blue-500 focus:bg-white rounded-2xl text-slate-800 font-bold transition-all outline-none" required>
                        </div>
                        @error('tahun_terbit') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <div class="md:col-span-2 group mt-6">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-2 ml-1">Deskripsi / Sinopsis Buku</label>
                        <div class="relative">
                            <span class="absolute top-4 left-5 text-blue-500">
                                <i class="fa-solid fa-align-left text-xs"></i>
                            </span>
                            <textarea name="deskripsi" rows="5" placeholder="Tuliskan ringkasan atau deskripsi buku di sini..." 
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border-2 border-transparent focus:border-blue-500 focus:bg-white rounded-2xl text-slate-800 font-medium transition-all outline-none resize-none shadow-sm">{{ old('deskripsi', $book->deskripsi) }}</textarea>
                        </div>
                        @error('deskripsi') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-10 flex flex-col md:flex-row gap-4">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-black text-sm transition shadow-lg shadow-blue-200 uppercase tracking-widest flex items-center justify-center gap-2 active:scale-95">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('book.index') }}" class="md:w-1/3 bg-slate-100 hover:bg-slate-200 text-slate-500 py-4 rounded-2xl font-black text-sm transition text-center uppercase tracking-widest flex items-center justify-center">
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