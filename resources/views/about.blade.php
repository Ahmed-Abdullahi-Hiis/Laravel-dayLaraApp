@extends('frontend.app')

@section('title', 'About | MyBrand')

@section('content')
<!-- Hero Section -->
<section class="relative h-[70vh] flex items-center justify-center bg-cover bg-center" 
         style="background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1950&q=80');">
  <div class="absolute inset-0 bg-black bg-opacity-50"></div>
  <div class="relative z-10 text-center text-white px-6">
    <h1 class="text-4xl md:text-5xl font-bold mb-4">Who We Are</h1>
    <p class="max-w-2xl mx-auto text-lg md:text-xl">
      We’re passionate creators helping brands grow through design, development, and innovation.
    </p>
  </div>
</section>



<!-- About Content -->
<section class="py-20 bg-gray-50 text-center">
  <div class="container mx-auto px-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">About MyBrand</h2>
    <p class="text-gray-600 max-w-3xl mx-auto leading-relaxed mb-10">
      MyBrand is a creative digital agency specializing in web design, software development, and branding.
      Our mission is to empower businesses with innovative technology and design solutions that connect them
      with their audiences in meaningful ways.
    </p>

    <div class="grid md:grid-cols-3 gap-8 mt-10">
      <!-- Design Card -->
      <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
        <div class="flex justify-center mb-4">
          <!-- 🎨 Design Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L15 12l-5.25-5"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2 text-blue-600">Creative Design</h3>
        <p class="text-gray-600 text-sm">
          We craft stunning and user-friendly designs that make your brand stand out online.
        </p>
      </div>

      <!-- Development Card -->
      <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
        <div class="flex justify-center mb-4">
          <!-- 💻 Code Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 18l6-6-6-6M8 6l-6 6 6 6"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2 text-blue-600">Web Development</h3>
        <p class="text-gray-600 text-sm">
          From modern websites to full-scale systems, we develop scalable digital solutions.
        </p>
      </div>

      <!-- Branding Card -->
      <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
        <div class="flex justify-center mb-4">
          <!-- 🚀 Branding Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l2 7h7l-5.5 4 2 7-5.5-4-5.5 4 2-7L3 9h7l2-7z"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2 text-blue-600">Brand Strategy</h3>
        <p class="text-gray-600 text-sm">
          We help brands build strong identities and meaningful connections with their audience.
        </p>
      </div>
    </div>
  </div>
</section>
@endsection
