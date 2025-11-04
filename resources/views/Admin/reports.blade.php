<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
            📊 Admin Reports Dashboard
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $cards = [
                        ['title'=>'Total Users','value'=>'1,245','color'=>'indigo'],
                        ['title'=>'Active Bloggers','value'=>'237','color'=>'emerald'],
                        ['title'=>'Total Posts','value'=>'3,894','color'=>'blue'],
                        ['title'=>'Pending Approvals','value'=>'12','color'=>'rose'],
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div class="bg-white shadow-sm rounded-xl p-6 text-center border border-gray-100 hover:shadow-md transition transform hover:-translate-y-1 duration-300">
                        <h3 class="text-gray-500 text-sm font-medium">{{ $card['title'] }}</h3>
                        <p class="text-3xl font-extrabold text-{{ $card['color'] }}-600 mt-2">{{ $card['value'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Reports Table --}}
            <div class="bg-white shadow-sm rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 00-2-2H4m16 0h-3a2 2 0 00-2 2v6M9 17h6m0 0v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2"/>
                        </svg>
                        Recent Activity Reports
                    </h3>

                    <div class="flex items-center space-x-2">
                        <input type="text" placeholder="Search reports..." class="border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        <select class="border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            <option>All</option>
                            <option>Users</option>
                            <option>Posts</option>
                            <option>Comments</option>
                        </select>
                    </div>
                </div>

                <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Report Type</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Details</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-3 text-gray-700 font-medium">User Registration</td>
                            <td class="px-6 py-3 text-gray-600">New user <strong>Jane Doe</strong> registered</td>
                            <td class="px-6 py-3"><span class="text-green-600 font-medium">Verified</span></td>
                            <td class="px-6 py-3 text-gray-500">Nov 3, 2025</td>
                        </tr>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-3 text-gray-700 font-medium">Post Approval</td>
                            <td class="px-6 py-3 text-gray-600">Post <strong>“Laravel Tips 2025”</strong> awaiting review</td>
                            <td class="px-6 py-3"><span class="text-yellow-600 font-medium">Pending</span></td>
                            <td class="px-6 py-3 text-gray-500">Nov 2, 2025</td>
                        </tr>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-3 text-gray-700 font-medium">Comment Moderation</td>
                            <td class="px-6 py-3 text-gray-600">Flagged comment on <strong>“AI Trends”</strong></td>
                            <td class="px-6 py-3"><span class="text-rose-600 font-medium">Action Needed</span></td>
                            <td class="px-6 py-3 text-gray-500">Nov 1, 2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
