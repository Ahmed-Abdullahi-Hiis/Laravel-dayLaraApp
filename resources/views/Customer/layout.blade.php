<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Customer Panel</title>
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <div class="font-bold text-lg">Customer Panel</div>
        <div>
            <a href="{{ route('customer.dashboard') }}" 
               class="mr-4 px-3 py-2 rounded hover:bg-blue-100 {{ request()->routeIs('customer.dashboard') ? 'bg-blue-500 text-white' : 'text-gray-700' }}">
               Dashboard
            </a>
            <a href="{{ route('customer.buy') }}" 
               class="mr-4 px-3 py-2 rounded hover:bg-blue-100 {{ request()->routeIs('customer.buy') ? 'bg-blue-500 text-white' : 'text-gray-700' }}">
               Buy
            </a>
            <a href="{{ route('customer.orders') }}" 
               class="mr-4 px-3 py-2 rounded hover:bg-blue-100 {{ request()->routeIs('customer.orders') ? 'bg-blue-500 text-white' : 'text-gray-700' }}">
               Orders
            </a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="px-3 py-2 rounded hover:bg-red-100 text-red-600 font-semibold">
               Logout
            </a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto mt-6 flex-1">
        @yield('content')
    </main>

</body>
</html>
