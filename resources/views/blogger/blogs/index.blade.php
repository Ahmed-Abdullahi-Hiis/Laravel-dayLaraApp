@extends('blogger.layout')

@section('title', 'My Blogs')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

    {{-- Top Bar --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">My Blogs</h1>
        <a href="{{ route('blogger.blogs.create') }}"
           class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
            + Add Blog
        </a>
    </div>

    {{-- Search & Filter --}}
    <form method="GET" action="{{ route('blogger.blogs.index') }}" class="flex flex-wrap items-center gap-4 mb-4">
        <input type="text" name="search" placeholder="Search by title or description"
               value="{{ request('search') }}"
               class="border p-2 rounded focus:outline-none focus:ring focus:ring-blue-300 flex-1 min-w-[200px]">

        <select name="status" class="border p-2 rounded focus:outline-none focus:ring focus:ring-blue-300">
            <option value="">All Status</option>
            <option value="draft" {{ request('status')=='draft' ? 'selected':'' }}>Draft</option>
            <option value="published" {{ request('status')=='published' ? 'selected':'' }}>Published</option>
        </select>

        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
            Filter
        </button>
        <a href="{{ route('blogger.blogs.index') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">
           Reset
        </a>
    </form>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Blogs Table --}}
    @if($blogs->count())
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">#</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Image</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Title</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Description</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Date</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($blogs as $index => $blog)
                    <tr>
                        <td class="px-4 py-2">{{ $blogs->firstItem() + $index }}</td>
                        <td class="px-4 py-2">
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image"
                                     class="w-20 h-12 object-cover rounded">
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $blog->title }}</td>
                        <td class="px-4 py-2">{{ Str::limit($blog->description, 50) }}</td>
                        <td class="px-4 py-2">
                            @if($blog->status === 'published')
                                <span class="bg-green-100 text-green-800 px-2 py-0.5 rounded-full text-xs">Published</span>
                            @else
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded-full text-xs">Draft</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($blog->date)->format('M d, Y') }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('blogger.blogs.edit', $blog->id) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded shadow text-sm">
                               Edit
                            </a>
                            <form action="{{ route('blogger.blogs.destroy', $blog->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded shadow text-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $blogs->appends(request()->query())->links() }}
    </div>

    @else
        <p class="text-gray-500 mt-4">No blogs found.</p>
    @endif
</div>
@endsection
