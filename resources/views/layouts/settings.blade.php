<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>LIBHUB - Literasi Digital Masa Kini</title>
</head>
<body class="bg-[#f8faf9] text-emerald-950">
    <body class="bg-[#f8faf9] text-emerald-950 font-['Plus_Jakarta_Sans']">
        <div x-data="{ sidebarOpen: true }" class="relative min-h-screen">
            
            @include('layouts.sidebar')

            <div :class="sidebarOpen ? 'lg:ml-72' : 'lg:ml-20'" class="transition-all duration-300">
                <nav class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-emerald-50 px-4 md:px-8 py-4">
                    <div class="flex items-center justify-between">
                        
                        <div class="flex items-center gap-4">
                            <button @click="sidebarOpen = true" class="lg:hidden w-10 h-10 flex items-center justify-center text-emerald-600 bg-emerald-50 rounded-xl" x-show="!sidebarOpen">
                                <i class="fa-solid fa-bars-staggered"></i>
                            </button>

                            <div class="hidden md:block">
                                <h4 class="text-sm font-black text-emerald-950 uppercase tracking-tighter">Panel Pengguna</h4>
                                <p class="text-[10px] font-bold text-emerald-500/60 uppercase tracking-widest">LibHub / Dashboard</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 md:gap-6">
                            <div class="flex items-center gap-3 pl-3 md:pl-6 border-l border-slate-100">
                                <div class="hidden md:block text-right">
                                    <div class="flex items-center gap-3 pl-4 pr-2 py-1.5 bg-white border border-emerald-100 rounded-full hover:shadow-md transition">
                                        <span class="font-bold text-emerald-900">{{ Auth::user()->username }}</span>
                                        <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white text-xs font-black shadow-inner">
                                            {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="fixed top-4 left-1/2 -translate-x-1/2 z-[100] w-[90%] md:w-[400px]">
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
                <main class="p-4 md:p-8">
                    @yield('contents')
                </main>
            </div>
        </div>
    </body>
    <script>
        const btn = document.getElementById('mobile-btn');
        const menu = document.getElementById('mobile-menu');
        btn.addEventListener('click', () => menu.classList.toggle('hidden'));

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
</body>
</html>