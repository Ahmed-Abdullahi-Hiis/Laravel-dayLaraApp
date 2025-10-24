 <!-- resources/views/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="flex h-screen">
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
            <h1 class="text-2xl font-semibold">Create Blog Post</h1>
        </header>

        <main class="p-6">
            <form action="{{ route('blogs.store') }}" method="POST" class="bg-white p-6 rounded shadow w-full max-w-xl">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Title</label>
                    <input type="text" name="title" class="w-full mt-1 p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Description</label>
                    <textarea name="description" rows="4" class="w-full mt-1 p-2 border rounded" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Date</label>
                    <input type="date" name="date" class="w-full mt-1 p-2 border rounded" required>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create</button>
            </form>
        </main>
    </div>
</div>

</body>
</html>