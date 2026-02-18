@extends('layouts.admin')

@section('admin-content')
<div class="max-w-4xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <a href="{{ route('admin.staff.index') }}" class="text-emerald-600 font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all mb-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
            </a>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Profil Detail Staff</h1>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.staff.edit', $staff->id) }}" class="bg-blue-50 text-blue-600 px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-blue-100 transition flex items-center gap-2">
                <i class="fa-solid fa-pen-to-square"></i> Edit Profil
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="space-y-6">
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 text-center">
                <div class="w-24 h-24 bg-emerald-500 text-white rounded-[2rem] flex items-center justify-center text-3xl font-black mx-auto mb-4 shadow-lg shadow-emerald-200">
                    {{ strtoupper(substr($staff->nama_lengkap, 0, 1)) }}
                </div>
                <h2 class="text-lg font-black text-slate-800 leading-tight">{{ $staff->nama_lengkap }}</h2>
                <p class="text-xs font-bold text-emerald-600 uppercase tracking-widest mt-1">{{ $staff->role }}</p>
                
                <div class="mt-6 pt-6 border-t border-slate-50">
                    <div class="flex items-center justify-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span class="text-xs font-bold text-slate-500 uppercase">Akun Aktif</span>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800 p-6 rounded-[2rem] text-white">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Informasi Sistem</p>
                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] text-slate-400">ID Staff</p>
                        <p class="text-sm font-mono font-bold text-emerald-400">#STF-{{ str_pad($staff->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400">Bergabung Sejak</p>
                        <p class="text-sm font-bold">{{ $staff->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:col-span-2 space-y-6">
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                <div class="p-8 md:p-10">
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-8 flex items-center gap-3">
                        <i class="fa-solid fa-address-card text-emerald-500"></i>
                        Informasi Pribadi
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Username</label>
                            <p class="text-sm font-bold text-slate-700">@ {{ $staff->username }}</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Email Address</label>
                            <p class="text-sm font-bold text-slate-700">{{ $staff->email }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Alamat Lengkap</label>
                            <p class="text-sm font-bold text-slate-700 leading-relaxed italic">
                                "{{ $staff->alamat }}"
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-emerald-50 rounded-[2rem] p-6 flex items-center justify-between border border-emerald-100">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-emerald-600 shadow-sm">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-emerald-800 uppercase tracking-wider">Update Terakhir</p>
                        <p class="text-xs font-medium text-emerald-600">{{ $staff->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection