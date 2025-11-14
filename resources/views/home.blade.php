@extends('frontend.app')

@section('title', 'Home | MyBrand')

@section('content')
<!-- Hero Section -->
<section
    class="min-h-screen flex flex-col justify-center items-center text-center bg-cover bg-center relative"
    style="background-image: url('https://images.unsplash.com/photo-1503264116251-35a269479413?auto=format&fit=crop&w=1920&q=80');"
>
    <div class="bg-black bg-opacity-60 absolute inset-0"></div>
    <div class="relative z-10 max-w-2xl px-6">
        <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-4 drop-shadow-lg">
            Welcome to MyBrand
        </h1>
        <p class="text-gray-200 text-lg md:text-xl mb-8">
            We create modern and powerful digital solutions to elevate your business.
        </p>
        <a href="#login-section"
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg transition transform hover:scale-105">
           Login / Register
        </a>
    </div>
</section>

<!-- Login/Register Section -->
<section id="login-section" class="py-16 bg-gray-100">
    <div class="max-w-5xl mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Access Your Account</h2>
            <p class="text-gray-600 mt-2">Login or create a new account to get started.</p>
        </div>

        @guest
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Login Card -->
            <div class="bg-white rounded-3xl shadow-xl p-8 hover:shadow-2xl transition">
                <h3 class="text-2xl font-bold mb-6 text-gray-800">Login</h3>
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <input type="email" name="email" placeholder="Email" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <input type="password" name="password" placeholder="Password" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <button type="submit"
                            class="w-full bg-yellow-500 hover:bg-yellow-600 py-3 rounded-xl font-bold text-white transition transform hover:scale-105">
                        Login
                    </button>
                </form>
                <p class="mt-4 text-sm text-gray-500">Forgot password? <a href="{{ route('password.request') }}" class="underline text-yellow-500">Reset here</a></p>
            </div>

            <!-- Register Card -->
            <div class="bg-white rounded-3xl shadow-xl p-8 hover:shadow-2xl transition">
                <h3 class="text-2xl font-bold mb-6 text-gray-800">Register</h3>
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <input type="text" name="name" placeholder="Full Name" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400">
                    <input type="email" name="email" placeholder="Email" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400">
                    <input type="password" name="password" placeholder="Password" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400">
                    <button type="submit"
                            class="w-full bg-green-500 hover:bg-green-600 py-3 rounded-xl font-bold text-white transition transform hover:scale-105">
                        Register
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="bg-white rounded-3xl shadow-xl p-8 text-center">
            <p class="text-lg font-semibold text-gray-700">
                You are logged in as <span class="text-blue-600">{{ Auth::user()->name }}</span>.
            </p>
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit"
                        class="px-8 py-3 bg-red-500 hover:bg-red-600 rounded-xl text-white font-bold shadow-lg transition transform hover:scale-105">
                    Logout
                </button>
            </form>
        </div>
        @endguest
    </div>
</section>
@endsection
