<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Daftar Akun - LIBHUB</title>
</head>
<body class="bg-[#f0f4f3] min-h-screen flex flex-col p-4">

    <div class="max-w-7xl mx-auto w-full pt-4 md:pt-6">
        <a href="{{ route('landingpage') }}" class="inline-flex items-center gap-2 text-emerald-800/60 hover:text-emerald-600 transition group">
            <div class="p-2 rounded-full group-hover:bg-emerald-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </div>
            <span class="font-semibold text-sm">Kembali ke Beranda</span>
        </a>
    </div>

    <div class="flex-grow flex items-center justify-center py-10">
        <div class="bg-white shadow-[0_20px_50px_rgba(16,_185,_129,_0.1)] rounded-[2.5rem] overflow-hidden w-full max-w-md border border-emerald-50 p-8 md:p-12 relative">
            
            <div class="absolute -top-10 -left-10 w-32 h-32 bg-emerald-50 rounded-full blur-3xl"></div>

            <div class="text-center mb-8 relative">
                <h1 class="text-3xl font-black tracking-tighter text-[#0f766e]">LIB<span class="text-emerald-500">HUB</span></h1>
                <h2 class="text-xl font-bold text-slate-800 mt-2">Bergabung Sekarang</h2>
                <p class="text-emerald-800/50 text-xs font-medium uppercase tracking-widest mt-1">Mulai petualangan literasimu</p>
            </div>

            <form action="{{ route('account.store') }}" method="post" class="space-y-4 relative">
                @csrf
                <div>
                    <label class="block text-xs font-black text-emerald-900 uppercase tracking-wider ml-1 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama Anda" 
                        class="w-full px-5 py-3.5 rounded-2xl bg-emerald-50/50 border-2 border-transparent focus:border-emerald-500 focus:bg-white focus:outline-none transition-all placeholder:text-emerald-800/30
                        @error('nama_lengkap') border-red-500 @enderror">
                        @error('nama_lengkap') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-black text-emerald-900 uppercase tracking-wider ml-1 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@mail.com" 
                        class="w-full px-5 py-3.5 rounded-2xl bg-emerald-50/50 border-2 border-transparent focus:border-emerald-500 focus:bg-white focus:outline-none transition-all placeholder:text-emerald-800/30
                        @error('email') border-red-500 @enderror">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-black text-emerald-900 uppercase tracking-wider ml-1 mb-1.5">Password</label>
                    <input type="password" name="password" value="{{ old('password') }}" placeholder="Min. 8 karakter" 
                        class="w-full px-5 py-3.5 rounded-2xl bg-emerald-50/50 border-2 border-transparent focus:border-emerald-500 focus:bg-white focus:outline-none transition-all placeholder:text-emerald-800/30
                        @error('password') border-red-500 @enderror">
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="flex items-start gap-3 py-2">
                    <input type="checkbox" class="mt-1 w-4 h-4 rounded border-emerald-200 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                    <span class="text-[11px] text-emerald-800/60 leading-tight">
                        Saya menyetujui <a class="text-emerald-600 font-bold hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="text-emerald-600 font-bold hover:underline">Kebijakan Privasi</a> LIBHUB.
                    </span>
                </div>

                <button type="submit" class="w-full bg-[#0f766e] text-white py-4 rounded-2xl font-black text-lg hover:bg-[#0d645d] shadow-[0_10px_20px_rgba(15,_118,_110,_0.3)] transition-all transform active:scale-95 mt-2">
                    DAFTAR AKUN
                </button>
            </form>

            <p class="text-center text-emerald-800/70 mt-8 text-sm font-medium">
                Sudah punya akun? <a href="{{ route(name: 'login') }}" class="text-emerald-600 font-black hover:underline underline-offset-4">Masuk ke Sini</a>
            </p>
        </div>
    </div>

</body>
</html>