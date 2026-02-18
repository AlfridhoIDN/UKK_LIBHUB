@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Master Data Pengguna</h1>
            <p class="text-sm text-slate-500 font-medium">Manajemen data seluruh pengguna/anggota perpustakaan.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="bg-white px-6 py-3 rounded-2xl border border-slate-100 shadow-sm">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Pengguna</p>
                <p class="text-lg font-black text-indigo-600">{{ $users->total() }} Orang</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-50 flex flex-col md:flex-row gap-4 justify-between bg-slate-50/30">
            <form action="#" method="GET" class="relative w-full md:w-80">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </span>
                <input type="text" name="search" 
                    class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-2xl text-sm font-medium focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition outline-none" 
                    placeholder="Cari nama atau email...">
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/80 text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">
                    <tr>
                        <th class="px-8 py-4 w-20 text-center">No</th>
                        <th class="px-6 py-4">Informasi Pengguna</th>
                        <th class="px-6 py-4">Username</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50/50 transition group">
                        <td class="px-8 py-5 text-center font-bold text-slate-400 text-sm">
                            {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-sm group-hover:scale-110 transition shadow-sm">
                                    {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 text-sm tracking-tight leading-none mb-1">
                                        {{ $user->nama_lengkap }}
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        @if(method_exists($user, 'isOnline') && $user->isOnline())
                                            <span class="flex h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            <span class="text-[9px] font-black uppercase text-emerald-600 tracking-wider">Online</span>
                                        @else
                                            <span class="flex h-1.5 w-1.5 rounded-full bg-slate-300"></span>
                                            <span class="text-[9px] font-black uppercase text-slate-400 tracking-wider">Offline</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="px-3 py-1.5 bg-slate-100 rounded-lg text-xs font-bold text-slate-600">
                                @ {{ $user->username }}
                            </span>
                        </td>
                        <td class="px-6 py-5">
                            <span class="text-sm font-medium text-slate-500">{{ $user->email }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex justify-center gap-3">
                                {{-- {{ route('admin.pengguna.show', $user->id) }} --}}
                                <a href="" 
                                   class="w-9 h-9 flex items-center justify-center text-indigo-500 bg-indigo-50 hover:bg-indigo-600 hover:text-white rounded-xl transition-all shadow-sm border border-indigo-100" 
                                   title="Detail Pengguna">
                                    <i class="fa-solid fa-expand text-sm"></i>
                                </a>

                                {{-- {{ route('admin.pengguna.destroy', $user->id) }} --}}
                                <form action="" method="POST" 
                                      onsubmit="return confirm('Peringatan! Menghapus pengguna ini mungkin akan menghapus data terkait lainnya. Lanjutkan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-9 h-9 flex items-center justify-center text-red-500 bg-red-50 hover:bg-red-600 hover:text-white rounded-xl transition-all shadow-sm border border-red-100" 
                                            title="Hapus Pengguna">
                                        <i class="fa-solid fa-trash-can text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center justify-center opacity-40">
                                <i class="fa-solid fa-users-slash text-5xl mb-4"></i>
                                <p class="text-sm font-bold text-slate-500 uppercase tracking-widest">Tidak ada data pengguna ditemukan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Menampilkan {{ $users->count() }} dari {{ $users->total() }} User</p>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection