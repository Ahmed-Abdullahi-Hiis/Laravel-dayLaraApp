@extends('customer.layout')

@section('title', 'Dashboard')

@section('content')

<div class="flex min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col justify-between shadow-xl">

        <!-- Profile Section -->
        <div>
            <div class="p-6 text-center border-b border-gray-700 bg-gray-800">
                <h2 class="text-xl font-extrabold tracking-wide">{{ auth()->user()->name }}</h2>
                <span class="text-sm text-gray-400 capitalize tracking-wide">
                    {{ auth()->user()->role }}
                </span>
            </div>

            <!-- Navigation -->
            <nav class="p-6 space-y-2 text-gray-300 font-medium">
                <a href="{{ route('customer.dashboard') }}"
                   class="flex items-center gap-3 py-2.5 px-4 rounded-lg hover:bg-gray-800 transition">
                    <span class="material-icons">dashboard</span> Dashboard
                </a>
                <a href="{{ route('customer.buy') }}"
                   class="flex items-center gap-3 py-2.5 px-4 rounded-lg hover:bg-gray-800 transition">
                    <span class="material-icons">shopping_cart</span> Buy
                </a>
                <a href="{{ route('customer.orders') }}"
                   class="flex items-center gap-3 py-2.5 px-4 rounded-lg hover:bg-gray-800 transition">
                    <span class="material-icons">receipt</span> Orders
                </a>
            </nav>
        </div>

        <!-- Logout -->
        <div class="p-6 border-t border-gray-700">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full py-2.5 rounded-lg bg-red-600 hover:bg-red-700 font-semibold transition shadow-md">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- Main Area -->
    <main class="flex-1 p-10 animate-fadeIn">

        <!-- Header Bar -->
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-extrabold text-gray-800">
                Dashboard Overview
            </h1>

            <!-- Profile Dropdown -->
            <div class="relative">
                <button onclick="toggleDropdown()" 
                    class="flex items-center gap-3 bg-white shadow px-4 py-2 rounded-lg hover:shadow-md transition">
                    <span class="material-icons text-gray-600">person</span>
                    <span class="font-semibold text-gray-700">{{ auth()->user()->name }}</span>
                    <span class="material-icons text-gray-600">expand_more</span>
                </button>

                <div id="profileDropdown" 
                     class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg hidden border">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">

            <div class="bg-white shadow-lg rounded-xl p-6 border-l-8 border-blue-500 hover:shadow-xl transition transform hover:-translate-y-1">
                <h3 class="text-xl font-bold text-gray-700 mb-2 flex items-center gap-2">
                    <span class="material-icons text-blue-500">shopping_bag</span>
                    Total Orders
                </h3>
                <p class="text-3xl font-extrabold text-gray-900">12</p>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-6 border-l-8 border-green-500 hover:shadow-xl transition transform hover:-translate-y-1">
                <h3 class="text-xl font-bold text-gray-700 mb-2 flex items-center gap-2">
                    <span class="material-icons text-green-500">check_circle</span>
                    Completed
                </h3>
                <p class="text-3xl font-extrabold text-gray-900">8</p>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-6 border-l-8 border-yellow-500 hover:shadow-xl transition transform hover:-translate-y-1">
                <h3 class="text-xl font-bold text-gray-700 mb-2 flex items-center gap-2">
                    <span class="material-icons text-yellow-500">pending</span>
                    Pending
                </h3>
                <p class="text-3xl font-extrabold text-gray-900">4</p>
            </div>

        </div>

        <!-- Existing Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white shadow-lg rounded-xl p-6 border-l-8 border-blue-500 hover:shadow-xl transition">
                <h3 class="text-xl font-bold text-gray-700 mb-2">Welcome</h3>
                <p class="text-gray-600 leading-relaxed">
                    Hello {{ auth()->user()->name }}, this is your customer dashboard.
                </p>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-6 border-l-8 border-green-500 hover:shadow-xl transition">
                <h3 class="text-xl font-bold text-gray-700 mb-2">Your Orders</h3>
                <p class="text-gray-600 leading-relaxed">
                    View and manage your orders.
                </p>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-6 border-l-8 border-yellow-500 hover:shadow-xl transition">
                <h3 class="text-xl font-bold text-gray-700 mb-2">Buy Products</h3>
                <p class="text-gray-600 leading-relaxed">
                    Explore available products and buy instantly.
                </p>
            </div>
        </div>

    </main>
</div>

<!-- Dropdown Script -->
<script>
function toggleDropdown() {
    document.getElementById('profileDropdown').classList.toggle('hidden');
}
</script>

<!-- Fade Animation -->
<style>
@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(10px); }
    100% { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
    animation: fadeIn .6s ease-out;
}
</style>

@endsection
