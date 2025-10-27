@extends('admin.layout')

@section('title', 'Users')
@section('page-title', 'User Management')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">User Management</h1>

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
                <td class="py-3 px-6 text-left">{{ $user->role }}</td>
                <td class="py-3 px-6 text-center">
                    <a href="{{ route('admin.edit', $user->id) }}" class="text-blue-500 hover:underline"><strong>Edit</strong></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
