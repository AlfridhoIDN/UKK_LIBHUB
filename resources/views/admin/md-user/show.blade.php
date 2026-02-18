@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('user.index') }}" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-emerald-600 hover:border-emerald-100 transition shadow-sm">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h1 class="text-2xl font-black text-slate-800 tracking-tight">Detail Pengguna</h1>
                <p class="text-sm text-slate-500 font-medium">Informasi lengkap dan profil anggota perpustakaan.</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="space-y-6">
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8 text-center relative overflow-hidden">
                <div class="relative inline-block mb-4">
                    <div class="w-24 h-24 rounded-[2rem] bg-emerald-100 text-emerald-600 flex items-center justify-center text-3xl font-black shadow-sm">
                        {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                    </div>
                    <span class="absolute bottom-1 right-1 w-6 h-6 border-4 border-white rounded-full {{ $user->isOnline() ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                </div>
                
                <h2 class="text-xl font-black text-slate-800 leading-tight">{{ $user->nama_lengkap }}</h2>

                <div class="grid grid-cols-2 gap-3 mt-8">
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 text-left">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Buku Pinjam</p>
                        <p class="text-lg font-black text-slate-800">12</p>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 text-left">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Total Denda</p>
                        <p class="text-lg font-black text-red-500">Rp 0</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.15em] mb-4 ml-1">Informasi Kontak</h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-2xl border border-slate-50">
                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-emerald-600 shadow-sm">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-[10px] font-bold text-slate-400 leading-none mb-1">EMAIL</p>
                            <p class="text-sm font-bold text-slate-700 truncate">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-2xl border border-slate-50">
                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-emerald-600 shadow-sm">
                            <i class="fa-solid fa-phone text-xs"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 leading-none mb-1">TELEPON/WA</p>
                            <p class="text-sm font-bold text-slate-700">{{ $user->telepon ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-50 bg-slate-50/30">
                    <h3 class="text-lg font-black text-slate-800 flex items-center gap-3">
                        <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                        Informasi Akun
                    </h3>
                </div>
                
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1.5 ml-1">Username Pengguna</label>
                            <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl flex items-center gap-2">
                                <span class="text-emerald-500 font-black">@</span>
                                <span class="text-sm font-bold text-slate-700">{{ $user->username }}</span>
                            </div>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1.5 ml-1">Tanggal Bergabung</label>
                            <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl flex items-center gap-2">
                                <i class="fa-solid fa-calendar text-slate-400 text-xs"></i>
                                <span class="text-sm font-bold text-slate-700">{{ $user->created_at->format('d F Y') }}</span>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1.5 ml-1">Alamat Tempat Tinggal</label>
                            <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl flex gap-3">
                                <i class="fa-solid fa-map-location-dot text-slate-400 text-xs mt-1"></i>
                                <p class="text-sm font-medium text-slate-600 leading-relaxed italic">
                                    {{ $user->alamat ?? 'Alamat lengkap belum dicantumkan oleh pengguna.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400">
                            <i class="fa-solid fa-clock-rotate-left text-xs"></i>
                        </div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Terakhir diperbarui: {{ $user->updated_at->diffForHumans() }}</p>
                    </div>
                    
                    <form action="" method="POST" onsubmit="return confirm('Hapus pengguna ini secara permanen?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs font-black text-red-500 hover:text-white hover:bg-red-500 border border-transparent hover:border-red-600 px-6 py-3 rounded-2xl transition-all uppercase tracking-widest">
                            Hapus Member
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-1.5 h-6 bg-slate-200 rounded-full"></div>
                    <h3 class="text-lg font-black text-slate-800">Riwayat Aktivitas</h3>
                </div>
                <div class="flex flex-col items-center justify-center py-10">
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-4 border border-slate-100">
                        <i class="fa-solid fa-inbox text-slate-200 text-2xl"></i>
                    </div>
                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">Belum ada riwayat peminjaman</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection