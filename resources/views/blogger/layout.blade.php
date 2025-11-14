<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | My Blog App</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <header class="bg-white shadow p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">My Blog App</h1>
            <nav>
                <a href="{{ route('blogger.dashboard') }}" class="text-gray-700 hover:text-gray-900 mx-2">Dashboard</a>
                <a href="{{ route('blogger.blogs.index') }}" class="text-gray-700 hover:text-gray-900 mx-2">My Blogs</a>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="text-red-600 hover:text-red-800 mx-2">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-auto">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow p-4 text-center text-gray-600">
        &copy; {{ date('Y') }} My Blog App. All rights reserved.
    </footer>

</body>
</html>
