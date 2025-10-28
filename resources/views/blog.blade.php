@extends('frontend.app')

@section('title', 'Blogs | MyBrand')

@section('content')
@php
    // ✅ Safety check: ensures $blogs is always defined
    $blogs = $blogs ?? collect();
@endphp

<!-- Hero Section -->
<section
  class="min-h-[60vh] flex flex-col justify-center items-center text-center bg-cover bg-center relative"
  style="background-image: url('https://images.unsplash.com/photo-1521790361543-f645cf042ec4?auto=format&fit=crop&w=1920&q=80');"
>
  <div class="bg-black/60 absolute inset-0"></div>
  <div class="relative z-10 max-w-2xl px-4">
    <h1 class="text-5xl font-extrabold text-white mb-4 drop-shadow-lg">
      Explore Our Latest Blog Posts
    </h1>
    <p class="text-gray-200 text-lg mb-6">
      Insights, stories, and updates from the MyBrand team.
    </p>
    <a
      href="{{ route('contact') }}"
      class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-200"
    >
      Contact Us
    </a>
  </div>
</section>

<!-- Blog List Section -->
<section class="py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">
      Latest Articles
    </h2>

    @if($blogs->isEmpty())
      <p class="text-center text-gray-600">No blog posts available yet. Check back later!</p>
    @else
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($blogs as $blog)
          <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-shadow duration-300 overflow-hidden flex flex-col">
            <div class="p-6 flex-1 flex flex-col">
              <h3 class="text-2xl font-semibold text-gray-800 mb-3 hover:text-blue-600 transition-colors duration-200">
                {{ $blog->title }}
              </h3>
              <p class="text-gray-600 flex-1 mb-4 leading-relaxed">
                {{ Str::limit($blog->description, 140) }}
              </p>
            </div>
            <div class="border-t px-6 py-4 flex justify-between items-center bg-gray-50">
    <span class="text-sm text-gray-500">
        📅 {{ \Carbon\Carbon::parse($blog->date)->format('M d, Y') }}
    </span>

    <div class="flex gap-2">
        <!-- Edit Button -->
        <a href="{{ route('blogs.edit', $blog->id) }}"
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
           Edit
        </a>

        <!-- Delete Form -->
        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this blog?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                Delete
            </button>
        </form>
    </div>
</div>

            </div>
          </div>
        @endforeach
      </div>

      <!-- Pagination -->
      <div class="mt-12">
        {{ $blogs->links() }}
      </div>
    @endif
  </div>
</section>
@endsection .
