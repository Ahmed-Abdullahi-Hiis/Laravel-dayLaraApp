@extends('customer.layout')

@section('title', 'My Orders')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

    <h1 class="text-4xl font-extrabold mb-10 text-gray-900 text-center tracking-tight">
        My Orders
    </h1>

    @if($orders->count() > 0)

        <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-100">
            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-4 px-6 text-left text-sm font-bold text-gray-700 uppercase">Order ID</th>
                        <th class="py-4 px-6 text-left text-sm font-bold text-gray-700 uppercase">Product</th>
                        <th class="py-4 px-6 text-left text-sm font-bold text-gray-700 uppercase">Amount</th>
                        <th class="py-4 px-6 text-left text-sm font-bold text-gray-700 uppercase">Payment Status</th>
                        <th class="py-4 px-6 text-left text-sm font-bold text-gray-700 uppercase">Date</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($orders as $order)
                        @php
                            $payment = $order->payment;
                            $status = $payment ? strtolower($payment->status) : strtolower($order->status);
                        @endphp

                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="py-4 px-6 text-gray-800 font-medium">#{{ $order->id }}</td>
                            <td class="py-4 px-6 text-gray-700">{{ $order->product_name }}</td>
                            <td class="py-4 px-6 text-gray-800 font-semibold">Ksh {{ number_format($order->amount) }}</td>

                            <td class="py-4 px-6">
                                <span class="px-4 py-1 rounded-full text-sm font-semibold shadow-sm inline-flex items-center
                                    @if($status == 'pending')
                                        bg-yellow-100 text-yellow-800 border border-yellow-300
                                    @elseif($status == 'completed' || $status == 'success')
                                        bg-green-100 text-green-800 border border-green-300
                                    @elseif($status == 'cancelled')
                                        bg-red-100 text-red-800 border border-red-300
                                    @else
                                        bg-gray-100 text-gray-800 border border-gray-300
                                    @endif">
                                    @if($status == 'pending')
                                        ⏳ Pending
                                    @elseif($status == 'completed' || $status == 'success')
                                        ✔️ Paid
                                    @elseif($status == 'cancelled')
                                        ❌ Cancelled
                                    @else
                                        {{ ucfirst($status) }}
                                    @endif
                                </span>
                            </td>

                            <td class="py-4 px-6 text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    @else
        <div class="bg-white p-10 rounded-xl shadow-lg text-center border border-gray-100">
            <p class="text-gray-700 text-xl font-medium">You have no orders yet.</p>
        </div>
    @endif

</div>
@endsection
