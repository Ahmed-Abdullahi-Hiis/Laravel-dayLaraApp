@extends('frontend.app')

@section('title', $blog->title . ' | MyBrand')

@section('content')
<!-- Single Blog Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">
        
        <!-- Blog Header -->
        <div class="mb-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-2">{{ $blog->title }}</h1>
            <p class="text-sm text-gray-500">
                📅 {{ \Carbon\Carbon::parse($blog->date)->format('F d, Y') }}
                @if($blog->category)
                    | <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full text-xs">{{ $blog->category }}</span>
                @endif
                @if($blog->user)
                    | By <span class="font-semibold">{{ $blog->user->name }}</span>
                @endif
            </p>
        </div>

        <!-- Blog Image -->
        @if($blog->image)
            <div class="mb-8">
                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full rounded-2xl shadow-md object-cover">
            </div>
        @endif

        <!-- Blog Content -->
        <div class="prose max-w-none text-gray-700">
            {!! nl2br(e($blog->description)) !!}
        </div>

        <!-- Back Button -->
        <div class="mt-12 text-center">
            <a href="{{ route('frontend.blogs.index') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200">
               ← Back to Blogs
            </a>
        </div>
    </div>
</section>
@endsection
