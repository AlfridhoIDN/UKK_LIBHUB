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
    @include('layouts.nav')
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

    <main>
        @yield('contents')
    </main>

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