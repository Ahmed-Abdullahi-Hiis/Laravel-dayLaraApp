<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyBrand')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Navbar -->
    <header class="bg-white shadow-md fixed w-full top-0 z-50">
        <nav class="container mx-auto flex justify-between items-center py-4 px-6">
            <!-- Logo -->
            <h1 class="text-2xl font-bold text-blue-600">MyBrand</h1>

            <!-- Hamburger Button (Mobile) -->
            <button id="menu-btn" class="md:hidden block focus:outline-none">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Nav Links -->
            <ul id="menu" class="hidden md:flex space-x-6 font-medium">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-blue-600' : 'hover:text-blue-500' }}">Home</a></li>
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-blue-600' : 'hover:text-blue-500' }}">About</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-blue-600' : 'hover:text-blue-500' }}">Contact</a></li>
                 <li><a href="{{ route('blogs.index') }}" class="{{ request()->routeIs('blog') ? 'text-blue-600' : 'hover:text-blue-500' }}">Blog</a></li>
            </ul>
        </nav>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu" class="hidden md:hidden bg-white shadow-md">
            <ul class="flex flex-col items-center py-4 space-y-4 font-medium">
                <li><a href="{{ route('home') }}" class="hover:text-blue-500 {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">Home</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-blue-500 {{ request()->routeIs('about') ? 'text-blue-600' : '' }}">About</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-blue-500 {{ request()->routeIs('contact') ? 'text-blue-600' : '' }}">Contact</a></li>
                <li><a href="{{ route('blogs.index') }}" class="hover:text-blue-500 {{ request()->routeIs('blog') ? 'text-blue-600' : '' }}">Blog</a></li>

            </ul>
        </div>
    </header>

    <!-- Page Content -->
    <main class="pt-24 flex-grow">
        @yield('content')
        
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-6 text-center">
        <p>© {{ date('Y') }} MyBrand. All rights reserved.</p>
    </footer>

    <!-- Script for Mobile Menu Toggle -->
    <script>
        const btn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
