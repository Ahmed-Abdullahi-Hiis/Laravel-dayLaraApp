@extends('blogger.layout')

@section('title', 'Edit Blog')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Blog</h1>
        <a href="{{ route('blogger.blogs.index') }}" 
           class="bg-gray-700 hover:bg-gray-800 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
            ← Back to My Blogs
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Form -->
    <form action="{{ route('blogger.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" 
          class="bg-white p-6 rounded-lg shadow-md max-w-2xl">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $blog->title) }}" required
                   class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Description</label>
            <textarea name="description" rows="4" required
                      class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300">{{ old('description', $blog->description) }}</textarea>
        </div>

        <!-- Date -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Date</label>
            <input type="date" name="date" value="{{ old('date', $blog->date) }}" required
                   class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Status</label>
            <select name="status" class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300" required>
                <option value="draft" {{ old('status', $blog->status)=='draft' ? 'selected':'' }}>Draft</option>
                <option value="published" {{ old('status', $blog->status)=='published' ? 'selected':'' }}>Published</option>
            </select>
        </div>

        <!-- Image -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Image</label>
            <input type="file" name="image" accept="image/*" class="w-full mb-2">

            @if($blog->image)
                <div class="flex items-center space-x-4 mt-2">
                    <img src="{{ asset('storage/'.$blog->image) }}" alt="Blog Image" class="h-24 w-24 object-cover rounded border">
                    <label class="inline-flex items-center space-x-2">
                        <input type="checkbox" name="remove_image" value="1">
                        <span class="text-gray-700">Remove current image</span>
                    </label>
                </div>
            @endif
        </div>

        <!-- Form Buttons -->
        <div class="flex justify-end space-x-2">
            <a href="{{ route('blogger.blogs.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded-lg shadow">Cancel</a>
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition transform hover:scale-105">
                Update Blog
            </button>
        </div>
    </form>
</div>
@endsection
