@extends('frontend.app')

@section('title', 'Blogs | MyBrand')

@section('content')
@php
    $blogs = $blogs ?? collect();
@endphp

<!-- Hero Section -->
<section
    class="relative flex flex-col items-center justify-center min-h-[60vh] bg-cover bg-center text-center"
    style="background-image: url('https://images.unsplash.com/photo-1521790361543-f645cf042ec4?auto=format&fit=crop&w=1920&q=80');"
>
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="relative z-10 max-w-3xl px-6">
        <h1 class="text-5xl font-extrabold text-white drop-shadow-lg mb-4">Explore Our Latest Blogs</h1>
        <p class="text-gray-200 text-lg mb-6">
            Insights, stories, and updates from the MyBrand team.
        </p>
        <a href="{{ route('contact') }}"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200">
            Contact Us
        </a>
    </div>
</section>

<!-- Blog Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Latest Articles</h2>

        @if($blogs->isEmpty())
            <p class="text-center text-gray-600 text-lg">No blog posts available yet. Please check back later!</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($blogs as $blog)
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden flex flex-col border border-gray-100">
                        <!-- Optional Image Placeholder -->
                        <div class="h-48 bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center text-white text-2xl font-bold">
                            {{ strtoupper(substr($blog->title, 0, 1)) }}
                        </div>

                        <div class="p-6 flex flex-col flex-1">
                            <h3 class="text-2xl font-semibold text-gray-800 mb-3 hover:text-blue-600 transition-colors duration-200">
                                {{ $blog->title }}
                            </h3>
                            <p class="text-gray-600 flex-1 mb-4 leading-relaxed">
                                {{ Str::limit($blog->description, 150) }}
                            </p>
                        </div>

                        <div class="border-t px-6 py-4 bg-gray-50 flex justify-between items-center">
                            <span class="text-sm text-gray-500">
                                📅 {{ \Carbon\Carbon::parse($blog->date)->format('M d, Y') }}
                            </span>

                            <div class="flex gap-2">
                                <a href="{{ route('blogs.edit', $blog->id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-3 py-1 rounded transition">
                                   ✏️ Edit
                                </a>

                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded transition">
                                        🗑 Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $blogs->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
