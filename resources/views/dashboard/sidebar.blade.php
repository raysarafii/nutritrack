<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'NutriTrack')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @yield('head')
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 font-['Poppins'] overflow-x-hidden">
    <!-- Mobile Toggle Button -->
    <div class="lg:hidden p-4">
        <button id="sidebar-toggle" class="bg-white p-2 rounded shadow">
            <i class="fas fa-bars text-xl text-gray-700"></i>
        </button>
    </div>
    
    <!-- Backdrop for Mobile Sidebar -->
    <div id="mobile-backdrop" class="fixed inset-0 bg-gray-700 opacity-50 hidden z-30"></div>
    
    <div class="flex h-screen">
        <!-- Sidebar for Desktop & Mobile -->
        <aside id="sidebar" class="bg-white shadow-md flex flex-col w-64 fixed top-0 left-0 h-full z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="flex justify-between px-6 py-4 text-2xl font-bold text-[#007AAF]">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 flex-shrink-0">
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-[#007AFF] to-[#00D26A] bg-clip-text text-transparent ml-3">
                        NutriTrack
                    </h1>
                </div>
                <!-- Close Button for Mobile Sidebar -->
                <button id="sidebar-close" class="text-xl text-gray-700 p-2 lg:hidden">
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 space-y-1 mt-4 text-gray-700">
                <a href="/dashboard" class="flex items-center px-6 py-3 hover:bg-gray-100">
                    <i class="fas fa-columns w-5"></i><span class="ml-3">Dashboard</span>
                </a>
                <a href="/profil" class="flex items-center px-6 py-3 hover:bg-gray-100">
                    <i class="fas fa-user w-5"></i><span class="ml-3">Profil</span>
                </a>
                <a href="/asupan" class="flex items-center px-6 py-3 hover:bg-gray-100">
                    <i class="fas fa-clipboard-list w-5"></i><span class="ml-3">Catatan Asupan</span>
                </a>
                <a href="/sehat" class="flex items-center px-6 py-3 bg-gradient-to-r from-[#007AFF] to-[#00D26A] text-white rounded-r-full">
                    <i class="fas fa-utensils w-5"></i><span class="ml-3">Pilihan Sehat</span>
                </a>
               <a href="{{ (auth()->check() && (auth()->user()->role == 'dokter_pencegahan' || auth()->user()->role == 'dokter_pengobatan')) ? '/konsultasi/messages' : '/konsultasi' }}" class="flex items-center px-6 py-3 hover:bg-gray-100">
                <i class="fas fa-comment-dots w-5"></i><span class="ml-3">Konsultasi</span>
                </a>
                <a href="/laporan" class="flex items-center px-6 py-3 hover:bg-gray-100">
                    <i class="fas fa-file-alt w-5"></i><span class="ml-3">Laporan</span>
                </a>
             <form method="POST" action="{{ route('logout') }}">
             @csrf
             <button type="submit" class="flex items-center px-6 py-3 hover:bg-gray-100 w-full text-left">
         <i class="fas fa-sign-out-alt w-5"></i>
        <span class="ml-3">Keluar</span>
         </button>
        </form>


            <img src="{{ asset('images/healthy-food.png') }}" alt="Decoration" class="w-full h-auto px-6 py-4">

            <div class="px-6 py-4">
                <div class="flex items-center">
                    <div>
                        <p class="text-sm font-bold">{{ Auth::user()->name }}</p>
                    </div>
                </div>
            </div>
        </aside>
        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col w-full lg:ml-64">
            @include('dashboard.topbar')
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const toggleBtn = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const closeBtn = document.getElementById('sidebar-close');
        const backdrop = document.getElementById('mobile-backdrop');

        // Toggle Sidebar visibility on mobile
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        });

        // Close Sidebar on mobile
        closeBtn.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('hidden');
        });

        // Close Sidebar if backdrop is clicked
        backdrop.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('hidden');
        });
    </script>
</body>
</html>
