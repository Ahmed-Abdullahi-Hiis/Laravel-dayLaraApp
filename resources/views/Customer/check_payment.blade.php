 @extends('customer.layout')

@section('title', 'Check Payment Status')

@section('content')
<div class="p-6 max-w-2xl mx-auto">

    <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Check Payment Status</h1>

    @if(session('status'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-center font-medium">{{ session('status') }}</div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4 text-center font-medium">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('customer.checkPayment') }}" class="mb-6">
        @csrf
        <input type="text" name="phone" placeholder="2547XXXXXXXX" 
               class="border border-gray-300 p-2 w-full rounded mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
               value="{{ old('phone', $phone ?? '') }}">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 w-full rounded transition">
            Check
        </button>
    </form>

    @isset($payments)
        <h2 class="text-xl font-bold mb-4">Payments for {{ $phone }}</h2>
        <table class="w-full bg-white shadow rounded">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-2">Product</th>
                    <th class="p-2">Amount</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr class="border-b">
                    <td class="p-2">{{ $payment->product_name }}</td>
                    <td class="p-2">Ksh {{ number_format($payment->amount) }}</td>
                    <td class="p-2 capitalize">{{ $payment->status }}</td>
                    <td class="p-2">{{ $payment->created_at->format('d M Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endisset

</div>
@endsection
