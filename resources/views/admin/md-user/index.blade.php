@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Master Data Pengguna</h1>
            <p class="text-sm text-slate-500 font-medium">Manajemen data seluruh pengguna/anggota perpustakaan.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-xl">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Pengguna</p>
                    <p class="text-xl font-black text-slate-800">{{ $users->total() }} Orang</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-50 flex flex-col md:flex-row gap-4 justify-between">
            <form action="#" method="GET" class="relative w-full md:w-80">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </span>
                <input type="text" name="search" 
                    class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-emerald-500 transition outline-none" 
                    placeholder="Cari nama atau email...">
            </form>

            {{-- Tombol Export dengan Style yang Senada --}}
            <div class="flex items-center gap-2">
                <a href="#" class="flex items-center justify-center gap-2 bg-white border border-slate-200 hover:border-emerald-500 hover:text-emerald-600 text-slate-600 px-6 py-3 rounded-2xl font-bold text-sm transition shadow-sm">
                    <i class="fa-solid fa-file-export text-xs"></i>
                    EXPORT DATA
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50 text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">
                    <tr>
                        <th class="px-8 py-4 w-20 text-center">No</th>
                        <th class="px-6 py-4">Nama Lengkap</th>
                        <th class="px-6 py-4">Username</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-8 py-5 text-center font-bold text-slate-400 text-sm">
                            {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-xs shadow-sm">
                                        {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                                    </div>
                                    <span class="absolute -bottom-1 -right-1 w-3.5 h-3.5 border-2 border-white rounded-full {{ method_exists($user, 'isOnline') && $user->isOnline() ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 text-sm tracking-tight leading-none mb-1">
                                        {{ $user->nama_lengkap }}
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        @if(method_exists($user, 'isOnline') && $user->isOnline())
                                            <span class="flex h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            <span class="text-[10px] font-black uppercase text-emerald-600 tracking-wider">Online</span>
                                        @else
                                            <span class="flex h-1.5 w-1.5 rounded-full bg-slate-300"></span>
                                            <span class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Offline</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="text-sm font-medium text-slate-500">{{ $user->username }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <span class="text-sm font-medium text-slate-500">{{ $user->email }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('user.show', $user->id) }}" 
                                   class="w-9 h-9 flex items-center justify-center text-emerald-500 hover:bg-emerald-50 rounded-xl transition border border-slate-100 shadow-sm" 
                                   title="Lihat Detail">
                                    <i class="fa-solid fa-eye text-sm"></i>
                                </a>
                                
                                <form action="" method="POST" 
                                      onsubmit="return confirm('Peringatan! Menghapus pengguna ini mungkin akan menghapus data terkait lainnya. Lanjutkan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-9 h-9 flex items-center justify-center text-red-500 hover:bg-red-50 rounded-xl transition border border-slate-100 shadow-sm" 
                                            title="Hapus Pengguna">
                                        <i class="fa-solid fa-trash-can text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-10 text-center text-slate-400 font-medium">
                            Tidak ada data pengguna ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Menampilkan {{ $users->count() }} dari {{ $users->total() }} Pengguna</p>
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection