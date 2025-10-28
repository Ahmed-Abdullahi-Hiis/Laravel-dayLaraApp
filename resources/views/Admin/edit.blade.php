@extends('admin.layout')

@section('title', 'Edit Blog')
.
@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-md rounded-lg p-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Blog</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-3 text-green-800 bg-green-100 border border-green-200 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="mb-4 p-3 text-red-800 bg-red-100 border border-red-200 rounded">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

   <form action="{{ route('admin.blogs.update', $blog) }}" method="POST">
    @csrf
    @method('PUT')

        <div>
            <label for="title" class="block text-gray-700 font-medium mb-1">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}"
                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
                required>
        </div>

        <div>
            <label for="description" class="block text-gray-700 font-medium mb-1">Description</label>
            <textarea id="description" name="description" rows="5"
                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
                required>{{ old('description', $blog->description) }}</textarea>
        </div>

        <div>
            <label for="date" class="block text-gray-700 font-medium mb-1">Date</label>
            <input type="date" id="date" name="date" value="{{ old('date', $blog->date) }}"
                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
                required>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('blogs.index') }}" class="text-gray-600 hover:text-gray-800 underline">
                ← Back to Blogs
            </a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
                Update Blog
            </button>
        </div>
    </form>
</div>
@endsection
