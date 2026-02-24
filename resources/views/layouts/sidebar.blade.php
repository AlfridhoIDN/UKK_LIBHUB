<aside 
    :class="sidebarOpen ? 'translate-x-0 w-72' : '-translate-x-full lg:translate-x-0 lg:w-20'"
    class="fixed top-0 left-0 h-full bg-white border-r border-emerald-50 z-[60] transition-all duration-300 ease-in-out shadow-sm lg:shadow-none"
>
    <div class="flex flex-col h-full overflow-x-hidden">
        <div class="p-6 mb-6 flex items-center gap-3">
            <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white shrink-0 shadow-lg shadow-emerald-100">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <a href="{{ route('landingpage') }}" x-show="sidebarOpen" x-transition class="text-3xl font-black tracking-tighter text-[#0f766e]">LIB<span class="text-emerald-500">HUB</span></a>
        </div>

        <nav class="flex-1 px-3 space-y-2">
            <a href="{{ route('user.dashboard') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl bg-emerald-50 text-emerald-600 font-black text-sm transition group">
                <i class="fa-solid fa-user-gear text-lg shrink-0"></i>
                <span x-show="sidebarOpen" x-transition class="whitespace-nowrap">Akun Ku</span>
            </a>
            
            <a href="{{ route('user.fav') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl text-slate-400 hover:bg-slate-50 hover:text-emerald-600 font-bold text-sm transition">
                <i class="fa-solid fa-heart text-lg shrink-0"></i>
                <span x-show="sidebarOpen" x-transition class="whitespace-nowrap">Favorite</span>
            </a>

            <a href="#" class="flex items-center gap-4 px-4 py-4 rounded-2xl text-slate-400 hover:bg-slate-50 hover:text-emerald-600 font-bold text-sm transition">
                <i class="fa-solid fa-clock-rotate-left text-lg shrink-0"></i>
                <span x-show="sidebarOpen" x-transition class="whitespace-nowrap">Riwayat</span>
            </a>
        </nav>

        <div class="p-3 mt-auto border-t border-slate-50">
            <button class="w-full flex items-center gap-4 px-4 py-4 rounded-2xl text-rose-400 hover:bg-rose-50 transition">
                <i class="fa-solid fa-right-from-bracket text-lg shrink-0"></i>
                <span x-show="sidebarOpen" x-transition class="font-bold text-sm whitespace-nowrap">Logout</span>
            </button>
        </div>
    </div>
</aside>

<div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/20 backdrop-blur-sm z-[50] lg:hidden" x-transition:outline></div>

<button @click="sidebarOpen = !sidebarOpen" class="lg:hidden fixed bottom-6 right-6 w-14 h-14 bg-emerald-600 text-white rounded-full shadow-2xl z-[100] flex items-center justify-center text-xl">
    <i class="fa-solid" :class="sidebarOpen ? 'fa-xmark' : 'fa-bars'"></i>
</button>