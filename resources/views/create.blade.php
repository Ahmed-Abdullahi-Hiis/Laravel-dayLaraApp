 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white">
        <div class="p-6 text-xl font-bold border-b border-gray-700">Admin Panel</div>
        <nav class="mt-6">
            <a href="{{ route('blogs.create') }}" class="block py-2.5 px-4 hover:bg-gray-700">Create Blog</a>
            <a href="{{ route('blogs.index') }}" class="block py-2.5 px-4 hover:bg-gray-700">View Blogs</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <header class="bg-white shadow p-4">
            <h1 class="text-2xl font-semibold">Create, Edit, or Delete Blog</h1>
        </header>

        <main class="p-6 space-y-10">

            <!-- ✅ Safety check added -->
            @php
                $blogs = $blogs ?? collect();
            @endphp

            <!-- Create Blog Form -->
            <section>
                <form action="{{ route('blogs.store') }}" method="POST" class="bg-white p-6 rounded shadow w-full max-w-xl">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold">Title</label>
                        <input type="text" name="title" class="w-full mt-1 p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold">Description</label>
                        <textarea name="description" rows="4" class="w-full mt-1 p-2 border rounded" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold">Date</label>
                        <input type="date" name="date" class="w-full mt-1 p-2 border rounded" required>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create</button>
                </form>
            </section> .

            <!-- Existing Blogs with Edit/Delete -->
            <section>
                <h2 class="text-xl font-semibold mb-4">Existing Blogs</h2>

                @if($blogs->count() > 0)
                    <table class="min-w-full bg-white border rounded shadow">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="py-2 px-4 text-left">Title</th>
                                <th class="py-2 px-4 text-left">Description</th>
                                <th class="py-2 px-4 text-left">Date</th>
                                <th class="py-2 px-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $blog)
                                <tr class="border-t">
                                    <td class="py-2 px-4">{{ $blog->title }}</td>
                                    <td class="py-2 px-4">{{ Str::limit($blog->description, 50) }}</td>
                                    <td class="py-2 px-4">{{ $blog->date }}</td>
                                    <td class="py-2 px-4 text-center space-x-2">
                                        <a href="{{ route('blogs.edit', $blog->id) }}" 
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                           Edit
                                        </a>
                                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this blog?')" 
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $blogs->links() }}
                    </div>
                @else
                    <p class="text-gray-600">No blogs found.</p>
                @endif
            </section>
        </main>
    </div>
</div>

</body>
</html>