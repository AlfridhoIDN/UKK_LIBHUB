<nav class="bg-white/80 backdrop-blur-md border-b border-emerald-100 fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            
            <div class="hidden md:flex flex-1 items-center gap-6">
                <a href="{{ route('category') }}" class="flex items-center gap-2 text-emerald-800 font-bold hover:text-emerald-500 transition group">
                    <div class="p-2 bg-emerald-50 rounded-xl group-hover:bg-emerald-100 transition">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </div>
                    <span>Jelajah Kategori</span>
                </a>

                <div class="relative w-64 group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <svg class="h-5 w-5 text-emerald-400 group-focus-within:text-emerald-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" class="block w-full pl-10 pr-3 py-2 bg-emerald-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 transition sm:text-sm" placeholder="Cari judul buku...">
                </div>
            </div>

            <div class="flex-shrink-0">
                <a href="{{ route('landingpage') }}" class="text-3xl font-black tracking-tighter text-[#0f766e]">LIB<span class="text-emerald-500">HUB</span></a>
            </div>

            <div class="hidden md:flex flex-1 justify-end items-center gap-6">
                @if (Auth::check())
                    <div class="relative group">
                        <button class="flex items-center gap-3 pl-4 pr-2 py-1.5 bg-white border border-emerald-100 rounded-full hover:shadow-md transition">
                            <span class="font-bold text-emerald-900">{{ Auth::user()->username }}</span>
                            <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white text-xs font-black shadow-inner">
                                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                            </div>
                        </button>
                        
                        <div class="absolute right-0 mt-2 w-48 bg-white border border-emerald-50 shadow-2xl rounded-3xl py-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-[60]">
                            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-emerald-800 hover:bg-emerald-50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Profil Saya
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-emerald-800 hover:bg-emerald-50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                                Favorit
                            </a>
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                            <hr class="my-2 border-emerald-50">
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-emerald-800 hover:bg-emerald-50 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                                    Dashboard
                                    @if(Auth::user()->role == 'admin')
                                    Admin
                                    @elseif(Auth::user()->role == 'petugas')
                                    Staff
                                    @endif
                                </a>
                            @endif
                            <hr class="my-2 border-emerald-50">
                            <form action="{{ route('account.logout') }}" method="get">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm font-bold text-red-500 hover:bg-red-50 transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="font-bold text-emerald-800 hover:text-emerald-500 transition">Masuk</a>
                    <a href="{{ route('account.create') }}" class="bg-[#0f766e] text-white px-7 py-3 rounded-2xl font-black hover:bg-[#0d645d] shadow-lg shadow-emerald-200 transition transform active:scale-95 text-sm uppercase tracking-wider">Daftar</a>
                @endif
            </div>

            <div class="md:hidden flex items-center">
                <button id="mobile-btn" class="p-2 text-emerald-900 focus:outline-none"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg></button>
            </div>
        </div>
    </div>
    
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-emerald-50 p-6 space-y-6 shadow-2xl animate-fade-in-down">
        <div class="flex flex-col gap-4">
            <a href="{{ route('category') }}" class="flex items-center gap-4 p-4 bg-emerald-50 rounded-2xl font-bold text-emerald-900">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                Jelajah Kategori
            </a>
            <input type="text" class="w-full pl-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500" placeholder="Cari buku...">
        </div>
        
        <div class="pt-4 border-t border-emerald-50">
            @if (Auth::check())
                <a href="#" class="flex items-center gap-4 p-2">
                    <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center text-white font-black text-xl shadow-lg">
                        {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-black text-emerald-900 leading-none text-lg">{{ Auth::user()->name }}</p>
                        <p class="text-emerald-500 text-sm mt-1 font-bold">Lihat Profil & Koleksi</p>
                    </div>
                </a>
            @else
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('login') }}" class="text-center py-4 font-black text-emerald-800 border-2 border-emerald-50 rounded-2xl">Masuk</a>
                    <a href="{{ route('account.create') }}" class="text-center py-4 bg-[#0f766e] text-white font-black rounded-2xl shadow-lg shadow-emerald-100">Daftar</a>
                </div>
            @endif
        </div>
        @if(Auth::check())
        <div class="border-t border-emerald-50">
            <hr class="border-emerald-50">
            <form action="{{ route('account.logout') }}" method="get">
                @csrf
                <button type="submit" class="w-full text-left px-4 mt-4 text-sm font-bold text-red-500 hover:bg-red-50 transition">
                    Logout
                </button>
            </form>
        </div>
        @endif
    </div>
</nav>