@extends('layouts.settings')

@section('contents')
<div class="max-w-4xl mx-auto pt-10 pb-20">
    <div class="mb-10 px-4">
        <h1 class="text-3xl md:text-4xl font-black text-emerald-950 tracking-tighter uppercase">Setting Profil</h1>
        <p class="text-slate-500 font-medium">Kelola informasi data diri dan keamanan akun.</p>
    </div>

    <div class="space-y-6 px-4">
        <div class="bg-white rounded-[2.5rem] border border-emerald-50 shadow-sm p-6 md:p-10">
            <form action="#" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-emerald-800/40 uppercase tracking-widest ml-1">Username</label>
                        <input type="text" class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent focus:border-emerald-500 focus:bg-white rounded-2xl font-bold text-slate-700 transition outline-none" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-emerald-800/40 uppercase tracking-widest ml-1">Email</label>
                        <input type="email" class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent focus:border-emerald-500 focus:bg-white rounded-2xl font-bold text-slate-700 transition outline-none" value="{{ auth()->user()->email }}">
                    </div>
                    <div class="md:col-span-2 space-y-2">
                        <label class="text-[10px] font-black text-emerald-800/40 uppercase tracking-widest ml-1">Ganti Password</label>
                        <input type="password" placeholder="••••••••" class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent focus:border-emerald-500 focus:bg-white rounded-2xl font-bold text-slate-700 transition outline-none">
                    </div>
                </div>

                <button class="w-full md:w-auto px-10 py-4 bg-emerald-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">
                    Simpan Perubahan
                </button>
            </form>
        </div>

        <div class="bg-rose-50/50 rounded-[2rem] p-6 border border-rose-100 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="text-center md:text-left">
                <h4 class="text-rose-600 font-black">Hapus Akun</h4>
                <p class="text-rose-400 text-xs font-medium">Tindakan ini permanen dan tidak bisa dibatalkan.</p>
            </div>
            <button class="px-6 py-3 bg-white text-rose-500 border border-rose-200 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-rose-500 hover:text-white transition">
                Delete Account
            </button>
        </div>
    </div>
</div>
@endsection