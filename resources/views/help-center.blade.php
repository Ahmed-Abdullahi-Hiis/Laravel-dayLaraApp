@extends('frontend.app')

@section('title', 'Help Center | MyBrand')

@section('content')

<!-- Hero Section -->
<section class="min-h-screen bg-blue-50 flex flex-col justify-center items-center text-center py-16">
    <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Help Center</h1>
    <p class="text-gray-600 text-lg max-w-2xl">
        Find answers to frequently asked questions, guides, and resources to help you get the most out of MyBrand.
    </p>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Frequently Asked Questions</h2>
        <div class="space-y-4">
            @php
                $faqs = [
                    ['question' => 'How do I create an account?', 'answer' => 'Click on the Register button and fill in your details. You will receive a confirmation email.'],
                    ['question' => 'How can I purchase products?', 'answer' => 'Go to the Buy Products section, select a product, and follow the payment instructions.'],
                    ['question' => 'What payment methods do you support?', 'answer' => 'Currently, we support mobile money payments and card payments.'],
                    ['question' => 'How can I reset my password?', 'answer' => 'Click on Forgot Password on the login form and follow the instructions.'],
                    ['question' => 'How do I contact support?', 'answer' => 'You can email us at support@mybrand.com or call +254 700 000 000.']
                ];
            @endphp

            @foreach($faqs as $faq)
            <div x-data="{ open: false }" class="border rounded-lg p-4">
                <button @click="open = !open" class="flex justify-between w-full text-left font-semibold text-gray-800">
                    {{ $faq['question'] }}
                    <span x-text="open ? '-' : '+' " class="text-xl"></span>
                </button>
                <div x-show="open" class="mt-2 text-gray-600" x-cloak>
                    {{ $faq['answer'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-16 bg-blue-50">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Need More Help?</h2>
        <p class="text-gray-600 mb-6">
            Our support team is here to assist you with any questions or issues.
        </p>
        <a href="mailto:support@mybrand.com"
           class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg transition transform hover:scale-105">
            Contact Support
        </a>
    </div>
</section>

@endsection
