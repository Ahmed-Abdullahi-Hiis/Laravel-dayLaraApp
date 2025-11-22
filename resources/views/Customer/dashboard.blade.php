@extends('customer.layout')

@section('title', 'Dashboard')

@section('content')
<div class="flex min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col justify-between">
        <!-- Top Section -->
        <div>
            <div class="p-6 text-center border-b border-gray-700">
                <h2 class="text-xl font-bold">{{ auth()->user()->name }}</h2>
                <span class="text-sm text-gray-400 capitalize">{{ auth()->user()->role }}</span>
            </div>
            <nav class="p-6">
                <a href="{{ route('customer.dashboard') }}" 
                   class="block py-2 px-4 rounded hover:bg-gray-800 mb-2 font-semibold">Dashboard</a>
                <a href="{{ route('customer.buy') }}" 
                   class="block py-2 px-4 rounded hover:bg-gray-800 mb-2 font-semibold">Buy</a>
                <a href="{{ route('customer.orders') }}" 
                   class="block py-2 px-4 rounded hover:bg-gray-800 mb-2 font-semibold">Orders</a>
            </nav>
        </div>

        <!-- Bottom Logout -->
        <div class="p-6 border-t border-gray-700">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-2 px-4 rounded bg-red-600 hover:bg-red-700 font-semibold">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Card 1 -->
            <div class="bg-white shadow rounded p-6 border-l-4 border-blue-500">
                <h3 class="text-lg font-bold text-gray-700 mb-2">Welcome</h3>
                <p class="text-gray-600">Hello, {{ auth()->user()->name }}! This is your customer dashboard.</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white shadow rounded p-6 border-l-4 border-green-500">
                <h3 class="text-lg font-bold text-gray-700 mb-2">Your Orders</h3>
                <p class="text-gray-600">You can view and manage your orders here.</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white shadow rounded p-6 border-l-4 border-yellow-500">
                <h3 class="text-lg font-bold text-gray-700 mb-2">Buy Products</h3>
                <p class="text-gray-600">Browse products and make purchases easily.</p>
            </div>

        </div>
    </main>
</div>
@endsection
