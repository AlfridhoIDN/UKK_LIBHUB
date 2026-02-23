@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Master Koleksi Buku</h1>
            <p class="text-sm text-slate-500 font-medium">Manajemen seluruh pustaka dan literasi digital.</p>
        </div>
        <div>
            <a href="{{ route('book.create') }}" class="flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-2xl font-bold text-sm transition shadow-lg shadow-emerald-200 uppercase tracking-wider">
                <i class="fa-solid fa-plus text-xs"></i>
                Tambah Buku Baru
            </a>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-xl">
                <i class="fa-solid fa-book"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Buku</p>
                <p class="text-xl font-black text-slate-800">{{ $books->count() }} Buku</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-50 flex flex-col md:flex-row gap-4 justify-between bg-white">
            <form action="#" method="GET" class="relative w-full md:w-80">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </span>
                <input type="text" name="search" 
                    class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-emerald-500 transition outline-none" 
                    placeholder="Cari judul atau penulis...">
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/50 text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">
                    <tr>
                        <th class="px-8 py-4 w-20 text-center">No</th>
                        <th class="px-6 py-4">Cover</th>
                        <th class="px-6 py-4">Informasi Buku</th>
                        <th class="px-6 py-4">Penerbit</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($books as $book)
                    <tr class="hover:bg-slate-50/50 transition group">
                        <td class="px-8 py-5 text-center font-bold text-slate-400 text-sm">
                            {{ ($books->currentPage() - 1) * $books->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-5">
                            <div class="relative w-16 h-24 overflow-hidden rounded-xl shadow-md group-hover:shadow-emerald-100 transition duration-300">
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Cover">
                                @else
                                    <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                        <i class="fa-solid fa-book text-slate-300 text-xl"></i>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div>
                                <h3 class="font-black text-slate-800 text-sm leading-tight mb-1 group-hover:text-emerald-600 transition">
                                    {{ $book->judul }}
                                </h3>
                                <p class="text-[11px] font-bold text-emerald-500 uppercase tracking-wider flex items-center gap-1.5">
                                    <i class="fa-solid fa-user-pen text-[9px]"></i>
                                    {{ $book->penulis }}
                                </p>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="text-xs font-bold text-slate-500">
                                {{ $book->penerbit }}
                            </span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('book.show', $book->id) }}" class="w-9 h-9 flex items-center justify-center text-emerald-500 bg-white border border-slate-100 rounded-xl hover:bg-emerald-500 hover:text-white transition shadow-sm" title="Detail Buku">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </a>
                                <a href="{{ route('book.edit', $book->id) }}" class="w-9 h-9 flex items-center justify-center text-blue-500 bg-white border border-slate-100 rounded-xl hover:bg-blue-500 hover:text-white transition shadow-sm" title="Edit Buku">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <form action="{{ route('book.delete', $book->id) }}" method="POST" onsubmit="return confirm('Hapus buku ini dari koleksi?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-9 h-9 flex items-center justify-center text-red-500 bg-white border border-slate-100 rounded-xl hover:bg-red-500 hover:text-white transition shadow-sm" title="Hapus Buku">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-slate-50 rounded-[2rem] flex items-center justify-center mb-4 text-slate-200">
                                    <i class="fa-solid fa-book-open text-3xl"></i>
                                </div>
                                <p class="text-xs font-black text-slate-300 uppercase tracking-[0.2em]">Koleksi buku masih kosong</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-8 bg-slate-50/30 border-t border-slate-50 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                Menampilkan {{ $books->count() }} Koleksi
            </p>
            <div>
                {{-- {{ $books->links() }} --}}
            </div>
        </div>
    </div>
</div>
@endsection