<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
            ⚙️ Admin Settings
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-2xl p-8 space-y-10">

                {{-- Display Success/Error Messages --}}
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- General Site Settings (Demo Only) --}}
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4 flex items-center gap-2">
                        🌐 General Settings
                    </h3>
                    <form method="POST" action="#">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Website Name</label>
                                <input type="text" name="site_name" value="My Laravel Blog"
                                       class="border rounded-lg w-full px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Admin Email</label>
                                <input type="email" name="admin_email" value="admin@example.com"
                                       class="border rounded-lg w-full px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition"
                                    onclick="alert('General settings updated successfully (demo)'); return false;">
                                💾 Save Settings
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Password Update (Functional) --}}
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4 flex items-center gap-2">
                        🔒 Change Password
                    </h3>
                    <form method="POST" action="{{ route('admin.settings.password') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Current Password</label>
                                <input type="password" name="current_password"
                                       class="border rounded-lg w-full px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">New Password</label>
                                <input type="password" name="new_password"
                                       class="border rounded-lg w-full px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Confirm Password</label>
                                <input type="password" name="new_password_confirmation"
                                       class="border rounded-lg w-full px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                                🔁 Update Password
                            </button>
                        </div>
                    </form>
                </div>

                {{-- System Controls (Demo Only) --}}
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4 flex items-center gap-2">
                        ⚡ System Controls
                    </h3>
                    <form method="POST" action="#">
                        @csrf
                        <div class="flex items-center gap-4">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="maintenance_mode" class="rounded text-indigo-600" checked>
                                <span class="text-sm text-gray-700">Enable Maintenance Mode</span>
                            </label>

                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="email_notifications" class="rounded text-indigo-600">
                                <span class="text-sm text-gray-700">Email Notifications</span>
                            </label>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-rose-600 text-white px-6 py-2 rounded-lg hover:bg-rose-700 transition"
                                    onclick="alert('System settings updated successfully (demo)'); return false;">
                                ⚙️ Apply Changes
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
