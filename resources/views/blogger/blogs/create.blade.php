@extends('blogger.layout')

@section('title', 'Create Blog')

@section('content')
<div class="p-6 max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Create Blog</h1>
        <a href="{{ route('blogger.blogs.index') }}"
           class="bg-gray-700 hover:bg-gray-800 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
            ← Back to My Blogs
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    {{-- Errors --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('blogger.blogs.store') }}" method="POST" enctype="multipart/form-data" 
          class="bg-white p-6 rounded-lg shadow-md space-y-4">
        @csrf

        <!-- Title -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <!-- Description -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Description</label>
            <textarea name="description" rows="4" required
                      class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300">{{ old('description') }}</textarea>
        </div>

        <!-- Date -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Date</label>
            <input type="date" name="date" value="{{ old('date') }}" required
                   class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <!-- Status -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Status</label>
            <select name="status" required 
                    class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300">
                <option value="draft" {{ old('status')=='draft' ? 'selected':'' }}>Draft</option>
                <option value="published" {{ old('status')=='published' ? 'selected':'' }}>Published</option>
            </select>
        </div>

        <!-- Image -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Image</label>
            <input type="file" name="image" accept="image/*" class="w-full">
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-2">
            <a href="{{ route('blogger.blogs.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded-lg shadow">
               Cancel
            </a>
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition transform hover:scale-105">
                Create Blog
            </button>
        </div>
    </form>
</div>
@endsection
