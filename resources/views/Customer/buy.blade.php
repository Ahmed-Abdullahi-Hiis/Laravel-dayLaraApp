@extends('customer.layout')

@section('title', 'Buy Products')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

    <h1 class="text-4xl font-extrabold mb-10 text-gray-900 text-center tracking-tight">
        Buy Your Favorite Products
    </h1>

    {{-- Messages --}}
    @if(session('status'))
        <div class="bg-green-100 border border-green-300 text-green-900 p-4 rounded mb-6 text-center font-medium shadow-sm">
            {{ session('status') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-900 p-4 rounded mb-6 text-center font-medium shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- Products Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($products as $product)
            <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 p-5 flex flex-col border border-gray-100">
                
                <div class="overflow-hidden rounded-lg mb-4">
                    <img src="{{ $product['image'] }}" 
                         alt="{{ $product['name'] }}" 
                         class="rounded-lg h-52 w-full object-cover hover:scale-110 transition duration-500">
                </div>

                <h2 class="text-2xl font-semibold mb-2 text-gray-900">{{ $product['name'] }}</h2>
                <p class="text-gray-600 mb-4 flex-grow leading-relaxed">{{ $product['description'] }}</p>
                
                <div class="text-xl font-bold mb-4 text-blue-700">
                    Ksh {{ number_format($product['price']) }}
                </div>

                {{-- Buy Button --}}
                <button 
                    onclick="openModal('{{ $product['name'] }}', {{ $product['price'] }}, '{{ $product['image'] }}')"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-3 w-full rounded-lg shadow-md transition transform hover:scale-[1.02]">
                    Buy Now
                </button>
            </div>
        @endforeach
    </div>
</div>

{{-- Modal --}}
<div id="buyModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-xl w-96 p-7 relative shadow-2xl animate-fadeIn">

        <button onclick="closeModal()" 
                class="absolute top-3 right-3 text-gray-500 hover:text-red-600 text-2xl font-bold">
            &times;
        </button>

        <img id="modalImage" src="" alt="Product" class="rounded-lg mb-4 h-48 w-full object-cover shadow">

        <h2 id="modalName" class="text-2xl font-bold mb-1 text-gray-900"></h2>
        <div id="modalPrice" class="text-xl font-semibold mb-5 text-blue-700"></div>

        <label class="block text-gray-700 mb-2 font-medium">Phone Number</label>
        <input id="modalPhone" 
            type="text" 
            class="border border-gray-300 p-3 w-full rounded-lg mb-5 focus:outline-none focus:ring-2 focus:ring-blue-500" 
            placeholder="254700000001">

        <button onclick="submitPayment()" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-3 w-full rounded-lg shadow-md transition transform hover:scale-[1.02]">
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

{{-- Smooth Modal Animation --}}
<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
    animation: fadeIn .4s ease-out;
}
</style>
@endsection
