@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Master Data Staff</h1>
            <p class="text-sm text-slate-500 font-medium">Kelola hak akses dan informasi personil perpustakaan.</p>
        </div>
        <a href="{{ route('admin.staff.create') }}" class="flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-2xl font-bold text-sm transition shadow-lg shadow-emerald-200">
            <i class="fa-solid fa-plus text-xs"></i>
            TAMBAH STAFF BARU
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-xl">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Staff</p>
                <p class="text-xl font-black text-slate-800">{{ $staffs->count() }} Orang</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-50 flex flex-col md:flex-row gap-4 justify-between">
            <div class="relative w-full md:w-80">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </span>
                <input type="text" class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-emerald-500 transition" placeholder="Cari staff...">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50 text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">
                    <tr>
                        <th class="px-8 py-4 w-20">No</th>
                        <th class="px-6 py-4">Nama Lengkap</th>
                        <th class="px-6 py-4">Username</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($staffs as $staff)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-8 py-5 font-bold text-slate-400 text-sm">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-xs shadow-sm">
                                        {{ strtoupper(substr($staff->nama_lengkap, 0, 1)) }}
                                    </div>
                                    <span class="absolute -bottom-1 -right-1 w-3.5 h-3.5 border-2 border-white rounded-full {{ $staff->isOnline() ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                </div>

                                <div>
                                    <div class="font-bold text-slate-800 text-sm tracking-tight leading-none mb-1">
                                        {{ $staff->nama_lengkap }}
                                    </div>
                                    
                                    <div class="flex items-center gap-1.5">
                                        @if($staff->isOnline())
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
                            <span class="text-sm font-medium text-slate-500">{{ $staff->username }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <span class="text-sm font-medium text-slate-500">{{ $staff->email }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.staff.show', $staff->id) }}" class="w-9 h-9 flex items-center justify-center text-emerald-500 hover:bg-emerald-50 rounded-xl transition border border-slate-100 shadow-sm" title="Lihat Detail">
                                    <i class="fa-solid fa-eye text-sm"></i>
                                </a>
                                <a href="{{ route('admin.staff.edit', $staff->id) }}" class="w-9 h-9 flex items-center justify-center text-blue-500 hover:bg-blue-50 rounded-xl transition border border-slate-100 shadow-sm" title="Edit Data">
                                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                                </a>
                                <form action="{{ route('admin.staff.delete', $staff->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus staff ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-9 h-9 flex items-center justify-center text-red-500 hover:bg-red-50 rounded-xl transition border border-slate-100 shadow-sm" title="Hapus">
                                        <i class="fa-solid fa-trash-can text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-10 text-center text-slate-400 font-medium">
                            Belum ada data staff yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total: {{ $staffs->total() ?? 0 }} Staff</p>
            {{ $staffs->links() }}
        </div>
    </div>
</div>
@endsection