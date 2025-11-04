<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📊 Blogger Reports
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white shadow rounded-xl p-6 text-center">
                    <h3 class="text-gray-500 text-sm font-medium">Total Blogs</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">42</p>
                </div>
                <div class="bg-white shadow rounded-xl p-6 text-center">
                    <h3 class="text-gray-500 text-sm font-medium">Views</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">12,450</p>
                </div>
                <div class="bg-white shadow rounded-xl p-6 text-center">
                    <h3 class="text-gray-500 text-sm font-medium">Comments</h3>
                    <p class="text-3xl font-bold text-indigo-600 mt-2">380</p>
                </div>
                <div class="bg-white shadow rounded-xl p-6 text-center">
                    <h3 class="text-gray-500 text-sm font-medium">Pending Reviews</h3>
                    <p class="text-3xl font-bold text-red-500 mt-2">3</p>
                </div>
            </div>

            {{-- Filter + Table --}}
            <div class="bg-white shadow rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Recent Blog Reports</h3>
                    <div class="flex items-center space-x-2">
                        <input type="text" placeholder="Search..." class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <select class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option>All</option>
                            <option>Published</option>
                            <option>Draft</option>
                        </select>
                    </div>
                </div>

                <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Title</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Views</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Comments</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-3">Laravel 10 Tips</td>
                            <td class="px-6 py-3"><span class="text-green-600 font-medium">Published</span></td>
                            <td class="px-6 py-3">540</td>
                            <td class="px-6 py-3">24</td>
                            <td class="px-6 py-3 text-gray-500">Oct 22, 2025</td>
                        </tr>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-3">Deploying with Docker</td>
                            <td class="px-6 py-3"><span class="text-yellow-600 font-medium">Draft</span></td>
                            <td class="px-6 py-3">120</td>
                            <td class="px-6 py-3">3</td>
                            <td class="px-6 py-3 text-gray-500">Oct 20, 2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
