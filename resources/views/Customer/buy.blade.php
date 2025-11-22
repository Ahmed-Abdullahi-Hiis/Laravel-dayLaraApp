@extends('customer.layout')

@section('title', 'Buy Products')

@section('content')
<div class="p-6 max-w-6xl mx-auto">

    <h1 class="text-3xl font-bold mb-8 text-gray-800 text-center">Buy Products</h1>

    {{-- Messages --}}
    @if(session('status'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-center font-medium">{{ session('status') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4 text-center font-medium">{{ session('error') }}</div>
    @endif

    {{-- Products Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $product)
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-4 flex flex-col">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="rounded mb-4 h-48 object-cover w-full">
                <h2 class="text-xl font-semibold mb-2">{{ $product['name'] }}</h2>
                <p class="text-gray-600 mb-4 flex-grow">{{ $product['description'] }}</p>
                <div class="text-lg font-bold mb-2">Ksh {{ number_format($product['price']) }}</div>

                {{-- Buy Button --}}
                <button 
                    onclick="openModal('{{ $product['name'] }}', {{ $product['price'] }}, '{{ $product['image'] }}')"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 w-full rounded transition">
                    Buy
                </button>
            </div>
        @endforeach
    </div>
</div>

{{-- Modal --}}
<div id="buyModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg w-96 p-6 relative">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">&times;</button>

        <img id="modalImage" src="" alt="Product" class="rounded mb-4 h-48 w-full object-cover">
        <h2 id="modalName" class="text-xl font-semibold mb-2"></h2>
        <div id="modalPrice" class="text-lg font-bold mb-4"></div>

        <label class="block text-gray-700 mb-2">Phone Number (12 digits, e.g., 2547XXXXXXXX):</label>
        <input id="modalPhone" type="text" class="border border-gray-300 p-2 w-full rounded mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="254700000001">

        <button onclick="submitPayment()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 w-full rounded transition">
            Pay Now
        </button>
    </div>
</div>

<script>
let selectedAmount = 0;

function openModal(name, price, image) {
    selectedAmount = price;
    document.getElementById('modalName').textContent = name;
    document.getElementById('modalPrice').textContent = 'Ksh ' + price.toLocaleString();
    document.getElementById('modalImage').src = image;
    document.getElementById('modalPhone').value = '';
    document.getElementById('buyModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('buyModal').classList.add('hidden');
}

function submitPayment() {
    const phone = document.getElementById('modalPhone').value;
    if (!phone || phone.length !== 12 || !phone.startsWith('254')) {
        alert("Invalid phone number. Must be 12 digits and start with 254.");
        return;
    }

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = "{{ route('customer.pay') }}";

    const csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = "{{ csrf_token() }}";
    form.appendChild(csrf);

    const phoneInput = document.createElement('input');
    phoneInput.type = 'hidden';
    phoneInput.name = 'phone';
    phoneInput.value = phone;
    form.appendChild(phoneInput);

    const amountInput = document.createElement('input');
    amountInput.type = 'hidden';
    amountInput.name = 'amount';
    amountInput.value = selectedAmount;
    form.appendChild(amountInput);

    const productInput = document.createElement('input');
    productInput.type = 'hidden';
    productInput.name = 'product_name';
    productInput.value = document.getElementById('modalName').textContent;
    form.appendChild(productInput);

    document.body.appendChild(form);
    form.submit();
}
</script>
@endsection
