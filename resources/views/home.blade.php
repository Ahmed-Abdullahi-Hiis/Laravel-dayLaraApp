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

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#login-section"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg transition transform hover:scale-105">
               Login / Register
            </a>
            <a href="{{ route('customer.buy') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg transition transform hover:scale-105">
               Buy Products
            </a>
        </div>
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

<!-- FAQ Section -->
<section id="faq-section" class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 text-center mb-12">Frequently Asked Questions</h2>
        <div class="space-y-4">
            @php
                $faqs = [
                    ['question' => 'How do I create an account?', 'answer' => 'You can create an account by clicking the Register button and filling out the form.'],
                    ['question' => 'What payment methods are accepted?', 'answer' => 'We currently accept mobile payments via MPESA.'],
                    ['question' => 'How can I contact support?', 'answer' => 'You can contact us via email at support@mybrand.com or call +254 700 000 000.'],
                ];
            @endphp

            @foreach($faqs as $faq)
            <div x-data="{ open: false }" class="border-b border-gray-200 pb-4">
                <button @click="open = !open" class="w-full flex justify-between items-center text-left text-gray-800 font-medium">
                    {{ $faq['question'] }}
                    <span x-text="open ? '-' : '+' " class="text-xl"></span>
                </button>
                <div x-show="open" class="mt-2 text-gray-600">
                    {{ $faq['answer'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Help Center Section -->
<section id="help-center" class="py-16 bg-gray-100">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Need More Help?</h2>
        <p class="text-gray-600 mb-8">Visit our Help Center for detailed guides and support resources.</p>
        <a href="{{ route('help.center') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg transition transform hover:scale-105">
            Go to Help Center
        </a>
    </div>
</section>

<!-- Alpine.js for FAQ toggles -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
