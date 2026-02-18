@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Master Kategori Buku</h1>
            <p class="text-sm text-slate-500 font-medium">Kelola kategori untuk pengelompokan koleksi buku.</p>
        </div>
        <div class="flex items-center gap-3">
            {{-- Tombol Tambah Kategori --}}
            <button onclick="/* Logic buka modal atau link ke page create */" 
                class="flex items-center justify-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-4 rounded-3xl font-bold text-sm transition shadow-lg shadow-emerald-200 active:scale-95 uppercase tracking-widest">
                <i class="fa-solid fa-plus text-xs"></i>
                Tambah Kategori
            </button>
        </div>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        {{-- Toolbar: Search & Filter --}}
        <div class="p-6 border-b border-slate-50 flex flex-col md:flex-row gap-4 justify-between bg-white">
            <form action="#" method="GET" class="relative w-full md:w-80">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </span>
                <input type="text" name="search" 
                    class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-emerald-500 transition outline-none" 
                    placeholder="Cari kategori...">
            </form>
            
            <div class="flex items-center gap-2">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total: {{ $categories->total() ?? 0 }} Data</p>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50 text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">
                    <tr>
                        <th class="px-8 py-4 w-24 text-center">No</th>
                        <th class="px-6 py-4">Nama Kategori</th>
                        <th class="px-6 py-4">Jumlah Koleksi</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($categories as $category)
                    <tr class="hover:bg-slate-50/50 transition group">
                        <td class="px-8 py-5 text-center font-bold text-slate-400 text-sm">
                            {{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-emerald-400"></div>
                                <span class="font-bold text-slate-700 text-sm tracking-tight">{{ $category->nama_kategori }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="px-3 py-1 bg-slate-100 rounded-lg text-xs font-bold text-slate-500">
                                {{ $category->books_count ?? 0 }} Buku
                            </span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex justify-center gap-2">
                                {{-- Tombol Edit (Opsional, tapi biasanya ada di master data) --}}
                                <a href="#" class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-emerald-500 hover:bg-emerald-50 rounded-xl transition border border-slate-100 shadow-sm">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </a>

                                {{-- Tombol Hapus --}}
                                <form action="" method="POST" 
                                      onsubmit="return confirm('Hapus kategori ini? Buku yang terhubung mungkin akan kehilangan kategori.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition border border-slate-100 shadow-sm" 
                                            title="Hapus Kategori">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-4 border border-slate-100 text-slate-200">
                                    <i class="fa-solid fa-tag text-2xl"></i>
                                </div>
                                <p class="text-xs font-black text-slate-300 uppercase tracking-[0.2em]">Kategori belum tersedia</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer/Pagination --}}
        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                Menampilkan {{ $categories->count() }} Kategori
            </p>
            <div class="pagination-container">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection