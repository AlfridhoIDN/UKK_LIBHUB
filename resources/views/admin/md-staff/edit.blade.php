@extends('layouts.admin')

@section('admin-content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.staff.index') }}" class="text-emerald-600 font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all mb-2">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Staff
        </a>
        <h1 class="text-2xl font-black text-slate-800 tracking-tight">Edit Data Staff</h1>
        <p class="text-sm text-slate-500 font-medium">Memperbarui informasi untuk <strong>{{ $staff->nama_lengkap }}</strong></p>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
        <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST" class="p-8 md:p-12">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="role" value="staff">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="space-y-2">
                    <label class="block text-sm font-black text-slate-700 uppercase tracking-wider ml-1">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fa-solid fa-id-card"></i>
                        </span>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $staff->nama_lengkap) }}" required
                            class="w-full pl-11 pr-4 py-4 bg-slate-50 border-2 border-transparent rounded-2xl text-sm font-bold focus:border-blue-500 focus:bg-white focus:ring-0 transition-all outline-none">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-black text-slate-700 uppercase tracking-wider ml-1">Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fa-solid fa-at"></i>
                        </span>
                        <input type="text" name="username" value="{{ old('username', $staff->username) }}" required
                            class="w-full pl-11 pr-4 py-4 bg-slate-50 border-2 border-transparent rounded-2xl text-sm font-bold focus:border-blue-500 focus:bg-white focus:ring-0 transition-all outline-none">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-black text-slate-700 uppercase tracking-wider ml-1">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email', $staff->email) }}" required
                            class="w-full pl-11 pr-4 py-4 bg-slate-50 border-2 border-transparent rounded-2xl text-sm font-bold focus:border-blue-500 focus:bg-white focus:ring-0 transition-all outline-none">
                    </div>
                </div>

                <div class="space-y-2" x-data="{ show: false }">
                    <label class="block text-sm font-black text-slate-700 uppercase tracking-wider ml-1">Password Baru</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input :type="show ? 'text' : 'password'" name="password"
                            class="w-full pl-11 pr-12 py-4 bg-slate-50 border-2 border-transparent rounded-2xl text-sm font-bold focus:border-blue-500 focus:bg-white focus:ring-0 transition-all outline-none"
                            placeholder="Kosongkan jika tidak ganti">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400">
                            <i class="fa-solid" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                    <p class="text-[10px] text-slate-400 ml-1 font-medium">*Isi hanya jika ingin mengganti password</p>
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label class="block text-sm font-black text-slate-700 uppercase tracking-wider ml-1">Alamat Lengkap</label>
                    <div class="relative">
                        <span class="absolute top-4 left-4 text-slate-400">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </span>
                        <textarea name="alamat" rows="3" required
                            class="w-full pl-11 pr-4 py-4 bg-slate-50 border-2 border-transparent rounded-2xl text-sm font-bold focus:border-blue-500 focus:bg-white focus:ring-0 transition-all outline-none resize-none">{{ old('alamat', $staff->alamat) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex flex-col md:flex-row items-center justify-end gap-4 border-t border-slate-50 pt-8">
                <a href="{{ route('admin.staff.index') }}" class="w-full md:w-auto px-8 py-4 text-sm font-bold text-slate-400 hover:text-slate-600 transition text-center">
                    BATAL
                </a>
                <button type="submit" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-bold text-sm transition shadow-lg shadow-blue-100 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-rotate text-xs"></i>
                    PERBARUI DATA
                </button>
            </div>
        </form>
    </div>
</div>
@endsection