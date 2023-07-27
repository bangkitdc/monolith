@extends('layouts.app')

@section('content')
  <div class="py-10 md:mx-12 flex-grow relative">
    <div class="mb-10 mx-20 max-sm:mx-10 max-lg:mx-12">
      <h1 class="text-2xl font-bold mb-1">Cart Items</h1>
      <p class="text-sm text-gray-500">Check Items, Manage Orders, and Explore Related Products.</p>
    </div>
    @if (count($cart) > 0)
      <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
        <div class="rounded-lg md:w-2/3">
          @php 
            $subtotal = 0 
          @endphp
          @foreach ( array_reverse($cart) as $Id => $barang )
            <div class="mb-6 border rounded-lg bg-white p-6 shadow-sm flex justify-start">
              <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-100 lg:aspect-none group-hover:opacity-60 lg:h-40 lg:w-60 md:h-32 md:w-48 max-md:h-24 max-md:w-24 max-sm:h-20 max-sm:w-20">
                <img src="/paper-bag.jpg" class="h-full w-full object-cover object-center lg:h-full lg:w-full" alt="product-img">
              </div>
              <div class="ml-4 flex w-full justify-between">
                <div class="mt-5 max-md:mt-1">
                  <h2 class="text-lg max-md:text-base font-bold text-gray-900">{{ $barang['nama'] }}</h2>
                  <p class="mt-1 text-sm max-md:text-xs text-gray-700">{{ $barang['kode'] }}</p>
                  <p class="mt-1 text-sm max-md:text-xs text-gray-700">Stock left: {{ $barang['stok'] }}</p>
                </div>
                <div class="mt-5 max-md:mt-1 justify-between space-y-6 max-md:space-y-4 block space-x-6 max-md:space-x-2">
                  <div class="flex items-center justify-end border-gray-100">
                    <button 
                      aria-label="Decrement value"
                      type="button" 
                      class="cursor-pointer rounded-l bg-gray-100 py-1 px-2 w-8 duration-100 hover:bg-blue-800 hover:text-blue-50"
                      data-action="decrement"
                    >
                      <span class=""> - </span>
                    </button>
                    <input 
                      data-id="{{ $Id }}"
                      class="h-8 w-8 border bg-white text-center text-xs outline-none" 
                      type="number" 
                      value="{{ $barang['quantity'] }}" 
                      min="1" 
                      max="{{ $barang['stok'] }}"
                    />
                    <button 
                      aria-label="Increment value"
                      type="button" 
                      class="cursor-pointer rounded-r bg-gray-100 py-1 px-2 w-8 duration-100 hover:bg-blue-800 hover:text-blue-50"
                      data-action="increment"
                    >
                      <span class=""> + </span>
                    </button>
                  </div>
                  <div class="flex items-center space-x-4 max-md:space-x-2">
                    <p class="text-sm">Rp {{ $barang['harga'] }}</p>
                    <button aria-label="Remove Product from Cart" onclick="removeFromCart(this)" data-id="{{ $Id }}">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            @php $subtotal += $barang['harga'] * $barang['quantity'] @endphp
          @endforeach
        </div>
        <!-- Sub total -->
        <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-sm md:mt-0 md:w-1/3">
          <div class="mb-2 flex justify-between">
            <p class="text-gray-700">Subtotal</p>
            <p id="subtotal" class="text-gray-700">Rp {{ $subtotal }}</p>
          </div>
          <div class="flex justify-between">
            <p class="text-gray-700">Tax</p>
            <p id="tax" class="text-gray-700">Rp {{ $subtotal * 0.1 }}</p>
          </div>
          <hr class="my-4" />
          <div class="flex justify-between">
            <p class="text-lg font-bold">Total</p>
            <div class="">
              <p id="total" class="mb-1 text-lg font-bold">Rp {{ $subtotal + $subtotal * 0.1 }}</p>
            </div>
          </div>
          <form id="checkoutForm" method="POST" action="{{ route('catalog.put') }}">
            @method('PUT')
            @csrf
            <label for="checkout" class="sr-only">Check out</label>
            <button aria-label="Checkout" onclick="confirmCheckout(event)" class="mt-6 w-full rounded-md bg-blue-800 py-1.5 font-medium text-blue-50 hover:bg-blue-900">
              Check out
            </button>
          </form>
        </div>
      </div>
    @else
      <div class="mx-20 max-sm:mx-10 max-lg:mx-12">
        <p class="mb-4 text-sm text-gray-500">You have no items in cart.</p>
        <a href="/catalog" class="px-4 bg-blue-800 py-2 font-medium text-blue-50 hover:bg-blue-900 text-sm rounded">
          Go to Catalog
        </a>
      </div>
    @endif
  </div>
  <script>
    function confirmCheckout(event) {
      event.preventDefault();
      if (confirm('Are you sure you want to proceed with the checkout?')) {
        document.getElementById('checkoutForm').submit();
      }
    }

    function updateCartQuantity(input) {
      var cartId = input.getAttribute("data-id");
      var val = input.value;

      // Convert the input value to an integer
      const quantity = parseInt(val);
      
      fetch(`{{ route('updatecart') }}`, {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ id: cartId, quantity: val })
      })
      .then(response => response.json())
      .then(data => {
          // Handle the AJAX response and update the frontend
          let subtotal = 0;
          const cart = Object.values(data.cart);

          cart.forEach(barang => {
            subtotal += barang['harga'] * barang['quantity'];
          });

          // Update frontend (no refresh needed)
          const subtotalElement = document.getElementById('subtotal');
          subtotalElement.innerText = `Rp ${subtotal}`;

          const taxElement = document.getElementById('tax');
          taxElement.innerText = `Rp ${subtotal * 0.1}`;

          const totalElement = document.getElementById('total');
          totalElement.innerText = `Rp ${subtotal + subtotal * 0.1}`;
      })
      .catch(error => {
          console.error('Error:', error);
      });
    }

    function decrement(e) {
      const btn = e.target.parentNode.parentElement.querySelector(
        'button[data-action="decrement"]'
      );

      const target = btn.nextElementSibling;
      let value = parseInt(target.value, 10);
      if (value > parseInt(target.min, 10)) {
        value--;
      }
      target.value = value;
      updateCartQuantity(target);
    }

    function increment(e) {
      const btn = e.target.parentNode.parentElement.querySelector(
        'button[data-action="increment"]'
      );

      const target = btn.previousElementSibling;
      let value = parseInt(target.value, 10);
      if (value < parseInt(target.max, 10)) {
        value++;
      }
      target.value = value;
      updateCartQuantity(target);
    }

    const decrementButtons = document.querySelectorAll(
      `button[data-action="decrement"]`
    );

    const incrementButtons = document.querySelectorAll(
      `button[data-action="increment"]`
    );

    decrementButtons.forEach(btn => {
      btn.addEventListener("click", decrement);
    });

    incrementButtons.forEach(btn => {
      btn.addEventListener("click", increment);
    });

    function removeFromCart(button) {
        var cartId = button.getAttribute("data-id");

        if (confirm("Do you really want to remove?")) {
            fetch(`{{ route('removefromcart') }}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: cartId })
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    alert('Failed to remove from cart.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }
</script>
  <style>
    .cart-icon {
      fill: #1e40af;
    }
  </style>
@endsection