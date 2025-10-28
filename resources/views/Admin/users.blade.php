@extends('admin.layout')

@section('title', 'Users')
@section('page-title', 'User Management')
.
@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">User Management</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Name</th>
                <th class="py-3 px-6 text-left">Email</th>
                <th class="py-3 px-6 text-left">Role</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($users as $user)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left">{{ $user->name }}</td>
                <td class="py-3 px-6 text-left">{{ $user->email }}</td>
                <td class="py-3 px-6 text-left capitalize">{{ $user->role }}</td>
                <td class="py-3 px-6 text-center flex items-center justify-center space-x-3">
                    
                    <!-- Add Blog -->
                    <a href="{{ route('blogs.create') }}?user_id={{ $user->id }}" 
                       class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                        Add Blog
                    </a>

                    <!-- Edit User -->
                    <a href="{{ route('admin.users.edit', $user->id) }}" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                        Edit
                    </a>

                    <!-- Delete User -->
                    <form action="{{ route('admin.users.destroy', $user->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this user?');" 
                          class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
