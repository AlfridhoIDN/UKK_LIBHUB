@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Master Kategori</h1>
            <p class="text-sm text-slate-500 font-medium">Kelola kategori koleksi buku perpustakaan.</p>
        </div>
        <div>
            <a href="{{ route('category.create') }}" class="flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-2xl font-bold text-sm transition shadow-lg shadow-emerald-200 uppercase tracking-wider">
                <i class="fa-solid fa-plus text-xs"></i>
                TAMBAH KATEGORI
            </a>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-xl">
                <i class="fa-solid fa-database"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total kategori</p>
                <p class="text-xl font-black text-slate-800">{{ $categories->count() }} Kategori</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-50 flex flex-col md:flex-row gap-4 justify-between">
            <div class="relative w-full md:w-80">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </span>
                <input type="text" class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-emerald-500 transition" placeholder="Cari kategori...">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50 text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">
                    <tr>
                        <th class="px-8 py-4 w-20 text-center">No</th>
                        <th class="px-6 py-4">Nama Kategori</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($categories as $category)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-8 py-5 text-center font-bold text-slate-400 text-sm">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                <span class="font-bold text-slate-700 text-sm tracking-tight">{{ $category->nama_kategori }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('category.edit', $category->id) }}" class="w-9 h-9 flex items-center justify-center text-blue-500 hover:bg-blue-50 rounded-xl transition border border-slate-100 shadow-sm" title="Edit Kategori">
                                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                                </a>

                                <form action="{{ route('category.delete', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-9 h-9 flex items-center justify-center text-red-500 hover:bg-red-50 rounded-xl transition border border-slate-100 shadow-sm" title="Hapus Kategori">
                                        <i class="fa-solid fa-trash-can text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-8 py-10 text-center text-slate-400 font-medium">
                            Belum ada data kategori yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total: {{ $categories->count() }} Kategori</p>
        </div>
    </div>
</div>
@endsection