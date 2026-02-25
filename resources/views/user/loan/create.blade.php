@extends('layouts.app')

@section('contents')
<div class="max-w-5xl mx-auto pt-24 md:pt-32 pb-20 px-4" 
     x-data="{ 
        days: 7, 
        startDate: '{{ date('Y-m-d') }}',
        get endDate() {
            let date = new Date(this.startDate);
            date.setDate(date.getDate() + parseInt(this.days));
            return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
        },
        get rawEndDate() {
            let date = new Date(this.startDate);
            date.setDate(date.getDate() + parseInt(this.days));
            return date.toISOString().split('T')[0];
        }
     }">
    
    <div class="mb-10 text-center md:text-left">
        <h1 class="text-3xl md:text-4xl font-black text-emerald-950 tracking-tighter uppercase">Konfirmasi Peminjaman</h1>
        <p class="text-slate-500 font-medium text-sm">Pilih durasi waktu baca yang sesuai dengan kebutuhan Anda.</p>
    </div>

    <form action="{{ route('book.loan.create') }}" method="POST">
        @csrf
        <input type="hidden" name="buku_id" value="{{ $book->id }}">
        <input type="hidden" name="tanggal_peminjaman" :value="startDate">
        <input type="hidden" name="tanggal_pengembalian" :value="rawEndDate">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            {{-- Sisi Kiri: Preview Buku --}}
            <div class="lg:col-span-4">
                <div class="bg-white p-5 rounded-[2.5rem] border border-emerald-50 shadow-sm">
                    <div class="aspect-[3/4.5] rounded-[2rem] overflow-hidden mb-6 shadow-md">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-full object-cover">
                    </div>
                    <div class="px-2">
                        <h3 class="font-black text-emerald-950 text-lg leading-tight">{{ $book->judul }}</h3>
                        <p class="text-emerald-500 font-bold text-xs mt-1 uppercase tracking-widest">{{ $book->penulis }}</p>
                    </div>
                </div>
            </div>

            {{-- Sisi Kanan: Pilihan Durasi --}}
            <div class="lg:col-span-8 space-y-6">
                
                <div class="bg-white p-8 rounded-[2.5rem] border border-emerald-50 shadow-sm space-y-6">
                    <h3 class="text-lg font-black text-emerald-950 flex items-center gap-3 mb-2">
                        <i class="fa-solid fa-user-check text-emerald-500"></i>
                        Informasi Peminjam
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Peminjam</label>
                            <p class="px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl font-bold text-slate-700">
                                {{ auth()->user()->username }}
                            </p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email Aktif</label>
                            <p class="px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl font-bold text-slate-700">
                                {{ auth()->user()->email }}
                            </p>
                        </div>
                        <div class="md:col-span-2 space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Terdaftar</label>
                            <p class="px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl font-bold text-slate-700">
                                {{ auth()->user()->address ?? 'Alamat belum diatur' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Durasi Picker --}}
                <div class="bg-white p-8 md:p-10 rounded-[3rem] border border-emerald-50 shadow-sm space-y-8">
                    <div>
                        <h3 class="text-xl font-black text-emerald-950 mb-1">Berapa lama ingin meminjam?</h3>
                        <p class="text-slate-400 text-sm font-medium">Pilih salah satu paket durasi di bawah ini.</p>
                    </div>

                    {{-- Card Pilihan Hari --}}
                    <div class="grid grid-cols-3 gap-4">
                        <template x-for="option in [7, 14, 28]">
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="duration" :value="option" x-model="days" class="sr-only">
                                <div :class="days == option ? 'bg-emerald-600 border-emerald-600 text-white shadow-xl shadow-emerald-100 scale-105' : 'bg-slate-50 border-transparent text-slate-400 hover:bg-emerald-50'" 
                                     class="p-6 rounded-[2rem] border-2 text-center transition-all duration-300">
                                    <p class="text-2xl font-black" x-text="option"></p>
                                    <p class="text-[10px] font-bold uppercase tracking-widest">Hari</p>
                                </div>
                                <div x-show="days == option" class="absolute -top-2 -right-2 w-6 h-6 bg-white text-emerald-600 rounded-full flex items-center justify-center shadow-md">
                                    <i class="fa-solid fa-check text-[10px]"></i>
                                </div>
                            </label>
                        </template>
                    </div>

                    {{-- Preview Timeline --}}
                    <div class="bg-emerald-50 rounded-[2rem] p-6 flex flex-col md:flex-row items-center justify-between gap-6 border border-emerald-100/50">
                        <div class="text-center md:text-left">
                            <p class="text-[10px] font-black text-emerald-600/50 uppercase tracking-widest mb-1">Tanggal Mulai</p>
                            <p class="font-black text-emerald-900 text-lg">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                        </div>
                        
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-emerald-300 shadow-sm rotate-90 md:rotate-0">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>

                        <div class="text-center md:text-right">
                            <p class="text-[10px] font-black text-emerald-600/50 uppercase tracking-widest mb-1">Batas Pengembalian</p>
                            <p class="font-black text-emerald-600 text-lg" x-text="endDate"></p>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-5 bg-emerald-950 text-white rounded-2xl font-black text-sm uppercase tracking-[0.2em] hover:bg-emerald-600 transition-all shadow-xl active:scale-95 flex items-center justify-center gap-3">
                        <i class="fa-solid fa-check"></i>
                        Konfirmasi Peminjaman
                    </button>
                    <p class="text-center text-[10px] text-emerald-400 font-bold mt-4 uppercase tracking-tighter">
                        *Peminjaman akan melalui tahap verifikasi admin
                    </p>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection