@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6 max-w-4xl mx-auto">
    <div class="flex items-center gap-4">
        <a href="{{ route('category.index') }}" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-emerald-600 hover:border-emerald-100 transition shadow-sm">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Tambah Kategori</h1>
            <p class="text-sm text-slate-500 font-medium">Buat label kategori baru untuk koleksi buku.</p>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden relative">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-emerald-50 rounded-full blur-3xl opacity-50"></div>

        <form action="{{ route('category.store') }}" method="POST" class="p-8 md:p-12 relative z-10">
            @csrf
            <div class="space-y-8">
                <div class="group">
                    <label for="nama_kategori" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-3 ml-1">
                        Nama Kategori Buku
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-emerald-500">
                            <i class="fa-solid fa-tag text-sm"></i>
                        </span>
                        <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori') }}"
                            class="w-full pl-12 pr-6 py-4 bg-slate-50 border-2 border-transparent focus:border-emerald-500 focus:bg-white rounded-2xl text-slate-800 font-bold placeholder-slate-300 transition-all outline-none"
                            placeholder="Contoh: Pengembangan Diri, Teknologi, Fiksi..." required>
                    </div>
                    @error('nama_kategori')
                        <p class="text-rose-500 text-xs mt-2 ml-1 font-bold italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-emerald-50/50 border border-emerald-100 rounded-2xl p-4 flex gap-4">
                    <div class="w-10 h-10 bg-white rounded-xl flex-shrink-0 flex items-center justify-center text-emerald-500 shadow-sm">
                        <i class="fa-solid fa-circle-info"></i>
                    </div>
                    <p class="text-xs text-emerald-800/70 font-medium leading-relaxed">
                        Pastikan nama kategori belum pernah terdaftar sebelumnya. Nama kategori yang jelas akan memudahkan anggota dalam mencari buku.
                    </p>
                </div>

                <div class="pt-4 flex flex-col md:flex-row gap-3">
                    <button type="submit" 
                        class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white py-4 rounded-2xl font-black text-sm transition shadow-lg shadow-emerald-200 active:scale-[0.98] uppercase tracking-widest flex items-center justify-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Kategori
                    </button>
                    <a href="{{ route('category.index') }}" 
                        class="md:w-1/3 bg-slate-100 hover:bg-slate-200 text-slate-500 py-4 rounded-2xl font-black text-sm transition text-center uppercase tracking-widest">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection