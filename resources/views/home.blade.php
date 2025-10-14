@extends('frontend.app')

@section('title', 'home | MyBrand')

@section('content')
<section
  class="min-h-screen flex flex-col justify-center items-center text-center bg-cover bg-center"
  style="background-image: url('https://images.unsplash.com/photo-1503264116251-35a269479413?auto=format&fit=crop&w=1920&q=80');"
>
  <div class="bg-black bg-opacity-50 absolute inset-0"></div>
  <div class="relative z-10 max-w-2xl">
    <h1 class="text-5xl font-bold text-white mb-4">
      Welcome to MyBrand
    </h1>
    <p class="text-gray-200 text-lg mb-6">
      We create modern and powerful digital solutions.
    </p>
    <a
      href="{{ route('about') }}"
      class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition"
      >Learn More</a
    >
  </div>
</section>
@endsection
