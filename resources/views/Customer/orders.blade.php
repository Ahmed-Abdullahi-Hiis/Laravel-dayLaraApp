@extends('customer.layout')

@section('title', 'My Orders')

@section('content')
<div class="p-6 max-w-6xl mx-auto">

    <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">My Orders</h1>

    @if(isset($orders) && $orders->count() > 0)
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Order ID</th>
                        <th class="py-3 px-6 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Product</th>
                        <th class="py-3 px-6 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Amount</th>
                        <th class="py-3 px-6 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="py-3 px-6 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-6 text-gray-700">{{ $order->id }}</td>
                            <td class="py-4 px-6 text-gray-700">{{ $order->product_name }}</td>
                            <td class="py-4 px-6 text-gray-700">Ksh {{ number_format($order->amount) }}</td>
                            <td class="py-4 px-6">
                                <span class="px-2 py-1 rounded-full text-sm font-semibold
                                    @if($order->status == 'pending') bg-yellow-200 text-yellow-800
                                    @elseif($order->status == 'completed') bg-green-200 text-green-800
                                    @elseif($order->status == 'cancelled') bg-red-200 text-red-800
                                    @else bg-gray-200 text-gray-800
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white p-6 rounded shadow text-center">
            <p class="text-gray-700 text-lg">You have no orders yet.</p>
        </div>
    @endif
</div>
@endsection
