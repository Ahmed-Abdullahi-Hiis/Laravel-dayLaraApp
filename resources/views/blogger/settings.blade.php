<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ⚙️ Blogger Settings
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-8 space-y-8">

                {{-- Profile Settings --}}
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Profile Information</h3>
                    <form method="POST" action="#">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Full Name</label>
                                <input type="text" name="name" value="Ahmed Blogger" class="border rounded-lg w-full px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                                <input type="email" name="email" value="ahmed@example.com" class="border rounded-lg w-full px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="mt-6">
                            <button class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                                Save Profile
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Password Update --}}
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Change Password</h3>
                    <form method="POST" action="#">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Current Password</label>
                                <input type="password" name="current_password" class="border rounded-lg w-full px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">New Password</label>
                                <input type="password" name="new_password" class="border rounded-lg w-full px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Confirm Password</label>
                                <input type="password" name="confirm_password" class="border rounded-lg w-full px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="mt-6">
                            <button class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
