@extends('admin.layout')

@section('title', 'All Blogs')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
        <!-- Dashboard Back Icon -->
        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">All Blogs</h1>
    </div>

    <a href="{{ route('admin.blogs.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow-md transition transform hover:scale-105">
        + Add Blog
    </a>
</div>


    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($blogs->count() > 0)
        <table class="min-w-full bg-white border rounded shadow">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-2 px-4 text-left">Title</th>
                    <th class="py-2 px-4 text-left">Date</th>
                    <th class="py-2 px-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                    <tr class="border-t">
                        <td class="py-2 px-4">{{ $blog->title }}</td>
                        <td class="py-2 px-4">{{ \Carbon\Carbon::parse($blog->date)->format('M j, Y') }}</td>
                        <td class="py-2 px-4 text-center space-x-2">
                            <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a>
                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this blog?')" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-600">No blogs available.</p>
    @endif
</div>
@endsection
