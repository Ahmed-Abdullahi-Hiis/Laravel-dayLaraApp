@extends('frontend.app')

@section('title', 'Contact | MyBrand')

@section('content')
<!-- Hero Section -->
<section class="relative h-[60vh] flex items-center justify-center bg-cover bg-center"
         style="background-image: url('https://images.unsplash.com/photo-1521790361543-f645cf042ec4?auto=format&fit=crop&w=1950&q=80');">
  <div class="absolute inset-0 bg-blue-900 bg-opacity-60"></div>
  <div class="relative z-10 text-center text-white px-6">
    <h1 class="text-4xl md:text-5xl font-bold mb-4">Get in Touch</h1>
    <p class="max-w-xl mx-auto text-lg md:text-xl">
      We’d love to hear from you! Let’s create something amazing together.
    </p>
  </div>
</section>

<!-- Contact Section -->
<section class="py-20 bg-gray-50">
  <div class="container mx-auto px-6 grid md:grid-cols-2 gap-10 items-start">

    <!-- Contact Form -->
    <div class="bg-white p-8 rounded-2xl shadow-lg">
      <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Send Us a Message</h2>
      <form>
        <input
          type="text"
          placeholder="Your Name"
          class="w-full mb-4 px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          required
        />
        <input
          type="email"
          placeholder="Your Email"
          class="w-full mb-4 px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          required
        />
        <textarea
          rows="5"
          placeholder="Your Message"
          class="w-full mb-4 px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          required
        ></textarea>
        <button
          type="submit"
          class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold w-full transition"
        >
          Send Message
        </button>
      </form>
    </div>

    <!-- Contact Info -->
    <div class="text-center md:text-left">
      <h3 class="text-2xl font-bold text-gray-800 mb-6">Contact Information</h3>
      <p class="text-gray-600 mb-4">
        Feel free to reach out via email or phone — we’ll get back to you as soon as possible.
      </p>

      <div class="space-y-4">
        <div class="flex items-center justify-center md:justify-start space-x-3">
          <!-- Email Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l4-4m-4 4l4 4m4-4H8"/>
          </svg>
          <span class="text-gray-700">info@mybrand.com</span>
        </div>

        <div class="flex items-center justify-center md:justify-start space-x-3">
          <!-- Phone Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h2l2 5l-2 2l5 5l2-2l5 2v2a1 1 0 01-1 1h-2a10 10 0 01-10-10V6a1 1 0 011-1z"/>
          </svg>
          <span class="text-gray-700">+254 796 739 051</span>
        </div>

        <div class="flex items-center justify-center md:justify-start space-x-3">
          <!-- Location Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3zm0 0c-5 0-9 2.239-9 5v2h18v-2c0-2.761-4-5-9-5z"/>
          </svg>
          <span class="text-gray-700">Nairobi, Kenya</span>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection
