@extends('admin.layout')

@section('title', 'Create Blog')

@section('content')
<div class="p-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Create Blog</h1>
        <a href="{{ route('admin.blogs.index') }}"
           class="bg-gray-700 hover:bg-gray-800 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
            ← Back to All Blogs
        </a>
    </div>

    <!-- ✅ Success message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- 📝 Create Blog Form -->
    <form action="{{ route('admin.blogs.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-2xl">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                   required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Description</label>
            <textarea name="description" rows="4"
                      class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                      required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Date</label>
            <input type="date" name="date" value="{{ old('date') }}"
                   class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                   required>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition transform hover:scale-105">
                Create Blog
            </button>
        </div>
    </form>
</div>
@endsection
