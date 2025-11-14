@extends('admin.layout')

@section('title', 'Edit Blog')

@section('content')
<div class="p-6">

    <!-- Dashboard / Breadcrumb Bar -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Blog</h1>
        <a href="{{ route('admin.dashboard') }}" 
           class="bg-gray-700 hover:bg-gray-800 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
            ← Back to Dashboard
        </a>
    </div>

    <!-- Success message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Edit Blog Form -->
    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data"
          class="bg-white p-6 rounded-lg shadow-md max-w-2xl">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $blog->title) }}"
                   class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300" required>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Description</label>
            <textarea name="description" rows="4"
                      class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                      required>{{ old('description', $blog->description) }}</textarea>
        </div>

        <!-- Date -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Date</label>
            <input type="date" name="date" value="{{ old('date', $blog->date) }}"
                   class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300" required>
        </div>

        <!-- Category (string input) -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Category</label>
            <input type="text" name="category" value="{{ old('category', $blog->category) }}"
                   class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300" required>
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Status</label>
            <select name="status" class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300">
                <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>

        <!-- Image -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Blog Image</label>
            @if($blog->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="w-32 h-20 object-cover rounded">
                </div>
            @endif
            <input type="file" name="image" accept="image/*"
                   class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition transform hover:scale-105">
                Update Blog
            </button>
        </div>
    </form>
</div>
@endsection
