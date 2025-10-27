@extends('admin.layout')

@section('title', 'Edit User')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-md rounded-lg p-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit User</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-3 text-green-800 bg-green-100 border border-green-200 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Messages -->
    @if($errors->any())
        <div class="mb-4 p-3 text-red-800 bg-red-100 border border-red-200 rounded">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.update', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="name" class="block text-gray-700 font-medium mb-1">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
                required>
        </div>

        <div>
            <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
                required>
        </div>

        <div>
            <label for="role" class="block text-gray-700 font-medium mb-1">Role</label>
            <select id="role" name="role"
                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm">
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="employee" {{ $user->role === 'employee' ? 'selected' : '' }}>Employee</option>
                <option value="client" {{ $user->role === 'client' ? 'selected' : '' }}>Client</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-800 underline">
                ← Back to Users
            </a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
                Update User
            </button>
        </div>
    </form>
</div>
@endsection
