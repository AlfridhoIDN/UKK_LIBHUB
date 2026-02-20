<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - LIBHUB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <div class="flex min-h-screen" x-data="{ sidebarOpen: true }">
        
        <aside :class="sidebarOpen ? 'w-72' : 'w-20'" class="bg-[#0f766e] text-white transition-all duration-300 flex flex-col fixed h-full z-50 overflow-hidden">
            
            <div class="p-6 flex items-center gap-4 h-20 border-b border-emerald-800/50">
                <div class="bg-emerald-400 p-2 rounded-xl shrink-0">
                    <svg class="w-6 h-6 text-[#0f766e]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <span x-show="sidebarOpen" x-cloak class="text-xl font-black tracking-tighter uppercase">Libhub <span class="text-emerald-400">Adm</span></span>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-emerald-800 transition group">
                    <svg class="w-6 h-6 text-emerald-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" /></svg>
                    <span x-show="sidebarOpen" x-cloak class="font-bold text-sm">Dashboard</span>
                </a>
                <div class="h-3 border-b border-emerald-800/50 mb-4"></div>

                <p x-show="sidebarOpen" x-cloak class="text-[10px] font-bold text-emerald-300/50 uppercase tracking-[0.2em] px-4 mb-2">Master Data</p>
                
                <a href="{{ route('admin.staff.index') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-emerald-800 transition group">
                    <svg class="w-6 h-6 text-emerald-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span x-show="sidebarOpen" x-cloak class="font-bold text-sm">Data Staff</span>
                </a>

                <a href="{{ route('user.index') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-emerald-800 transition group">
                    <svg class="w-6 h-6 text-emerald-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"></path></svg>
                    <span x-show="sidebarOpen" x-cloak class="font-bold text-sm">Data Pengguna</span>
                </a>

                <a href="{{ route('category.index') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-emerald-800 transition group">
                    <svg class="w-6 h-6 text-emerald-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M11 7h.01M11 11h.01M11 15h.01M15 7h.01M15 11h.01M15 15h.01"></path></svg>
                    <span x-show="sidebarOpen" x-cloak class="font-bold text-sm">Data Kategori</span>
                </a>

                <a href="{{ route('book.index') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-emerald-800 transition group">
                    <svg class="w-6 h-6 text-emerald-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"></path></svg>
                    <span x-show="sidebarOpen" x-cloak class="font-bold text-sm">Data Buku</span>
                </a>

                <div class="h-6 border-b border-emerald-800/50 mb-4"></div>
                <p x-show="sidebarOpen" x-cloak class="text-[10px] font-bold text-emerald-300/50 uppercase tracking-[0.2em] px-4 mb-2">Transaksi</p>

                <a href="{{ route('loan.index') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-emerald-800 transition group">
                    <svg class="w-6 h-6 text-emerald-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span x-show="sidebarOpen" x-cloak class="font-bold text-sm">Peminjaman</span>
                </a>

                <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-emerald-800 transition group">
                    <svg class="w-6 h-6 text-emerald-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span x-show="sidebarOpen" x-cloak class="font-bold text-sm">Riwayat Pinjam</span>
                </a>

                <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-emerald-800 transition group">
                    <svg class="w-6 h-6 text-emerald-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.407-2.67-1M12 16.5L12 17"></path></svg>
                    <span x-show="sidebarOpen" x-cloak class="font-bold text-sm">Riwayat Denda</span>
                </a>
            </nav>

            <div class="p-10 bg-emerald-900/50 h-20 flex items-center shrink-0">
                <div class="flex items-center gap-3 overflow-hidden">
                    <i class="fa-solid fa-house"></i>
                    <div x-show="sidebarOpen" x-cloak class="truncate">
                        <a href="{{ route('landingpage') }}" class="text-[15px] text-emerald-400 uppercase font-black hover:text-white transition">Kembali Ke Halaman</a>
                    </div>
                </div>
            </div>
        </aside>

        <main :class="sidebarOpen ? 'ml-72' : 'ml-20'" class="flex-1 transition-all duration-300 min-h-screen flex flex-col">
            <header class="bg-white border-b border-slate-200 h-20 flex items-center justify-between px-8 sticky top-0 z-40 shrink-0">
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 bg-slate-100 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                </button>
                
                <div class="flex items-center gap-4 font-bold text-slate-500">
                    <span class="text-sm">05 Feb 2026</span>
                    <div class="w-px h-6 bg-slate-200"></div>
                    <div class="relative group">
                        <button class="flex items-center gap-3 pl-4 pr-2 py-1.5 bg-white border border-emerald-100 rounded-full hover:shadow-md transition">
                            <span class="font-bold text-emerald-900">{{ Auth::user()->username }}</span>
                            <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white text-xs font-black shadow-inner">
                                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                            </div>
                        </button>
                        
                        <div class="absolute right-0 mt-2 w-48 bg-white border border-emerald-50 shadow-2xl rounded-3xl py-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-[60]">
                            <form action="{{ route('account.logout') }}" method="get">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm font-bold text-red-500 hover:bg-red-50 transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-8 flex-1">
                @yield('admin-content')
            </div>
        </main>

    </div>
</body>
</html>