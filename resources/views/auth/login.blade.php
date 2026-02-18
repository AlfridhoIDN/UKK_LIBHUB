<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login - LIBHUB</title>
</head>
<body class="bg-[#f0f4f3] min-h-screen flex flex-col p-4">
    <div class="fixed top-4 left-1/2 -translate-x-1/2 z-[100] w-[90%] md:w-[400px]">
        @if (session('error'))
            <div id="alert-error" class="flex items-start p-4 mb-4 text-rose-800 rounded-3xl bg-white border border-rose-100 shadow-[0_15px_30px_rgba(244,_63,_94,_0.15)] animate-bounce-subtle">
                <div class="flex-shrink-0 w-10 h-10 bg-rose-50 text-rose-500 rounded-2xl flex items-center justify-center mr-3">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <div class="flex-1 pt-0.5">
                    <p class="text-[10px] font-black uppercase tracking-[0.1em] text-rose-400 leading-none mb-1">Akses Terbatas</p>
                    <div class="text-sm font-bold leading-tight">{{ session('error') }}</div>
                </div>
                <button type="button" onclick="closeAlert('alert-error')" class="ml-2 text-rose-300 hover:text-rose-500 transition">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
        @endif
        @if (session('success'))
            <div id="alert-success" class="flex items-start p-4 mb-4 text-emerald-800 rounded-3xl bg-white border border-emerald-100 shadow-[0_15px_30px_rgba(16,_185,_129,_0.15)]">
                <div class="flex-shrink-0 w-10 h-10 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center mr-3">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="flex-1 pt-0.5">
                    <p class="text-[10px] font-black uppercase tracking-[0.1em] text-emerald-400 leading-none mb-1">Berhasil</p>
                    <div class="text-sm font-bold leading-tight">{{ session('success') }}</div>
                </div>
                <button type="button" onclick="closeAlert('alert-success')" class="ml-2 text-emerald-300 hover:text-emerald-500 transition">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
        @endif
    </div>

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
            
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-emerald-50 rounded-full blur-3xl"></div>

            <div class="text-center mb-10 relative">
                <h1 class="text-4xl font-black tracking-tighter text-[#0f766e]">LIB<span class="text-emerald-500">HUB</span></h1>
                <div class="w-12 h-1 bg-emerald-500 mx-auto mt-2 rounded-full"></div>
            </div>

            <div class="d-grid">
                <a href="{{ route('account.google.redirect') }}" class="w-full flex items-center justify-center gap-3 bg-white border-2 border-emerald-100 py-3 rounded-2xl text-emerald-900 font-bold hover:bg-emerald-50 hover:border-emerald-200 transition-all mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48">
                        <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                        <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                        <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                        <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571l.001-.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
                    </svg>
                    Continue with Google
                </a>
            </div>

            <div class="relative mb-8">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-emerald-100"></div></div>
                <div class="relative flex justify-center text-xs uppercase"><span class="px-4 bg-white text-emerald-400 font-bold tracking-widest">Atau email</span></div>
            </div>

            <form action="{{ route('account.authenticate') }}" method="post" class="space-y-5 relative">
                @csrf
                <div>
                    <label class="block text-xs font-black text-emerald-900 uppercase tracking-wider ml-1 mb-2">Email Perpustakaan</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" 
                        class="w-full px-5 py-4 rounded-2xl bg-emerald-50/50 border-2 border-transparent focus:border-emerald-500 focus:bg-white focus:outline-none transition-all
                        @error('email') border-red-500 @enderror">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-xs font-black text-emerald-900 uppercase tracking-wider ml-1">Password</label>
                        <a href="#" class="text-xs text-emerald-600 font-bold hover:text-emerald-800 transition">Lupa?</a>
                    </div>
                    <input type="password" name="password" placeholder="••••••••" 
                        class="w-full px-5 py-4 rounded-2xl bg-emerald-50/50 border-2 border-transparent focus:border-emerald-500 focus:bg-white focus:outline-none transition-all">
                </div>
                
                <button type="submit" class="w-full bg-[#0f766e] text-white py-4 rounded-2xl font-black text-lg hover:bg-[#0d645d] shadow-[0_10px_20px_rgba(15,_118,_110,_0.3)] transition-all transform active:scale-95 mt-4">
                    MASUK SEKARANG
                </button>
            </form>

            <p class="text-center text-emerald-800/70 mt-10 text-sm font-medium">
                Baru mengenal LIBHUB? <a href="{{ route('account.create') }}" class="text-emerald-600 font-black hover:underline underline-offset-4">Buat Akun</a>
            </p>
        </div>
    </div>
</body>
<script>
    function closeAlert(id) {
        const alert = document.getElementById(id);
        if (alert) {
            alert.style.transform = "translateY(-20px)";
            alert.style.opacity = "0";
            alert.style.transition = "all 0.5s ease";
            setTimeout(() => alert.remove(), 500);
        }
    }

    // Auto close setelah 5 detik
    setTimeout(() => {
        const errorAlert = document.getElementById('alert-error');
        const successAlert = document.getElementById('alert-success');
        if(errorAlert) closeAlert('alert-error');
        if(successAlert) closeAlert('alert-success');
    }, 5000);
</script>
</html>