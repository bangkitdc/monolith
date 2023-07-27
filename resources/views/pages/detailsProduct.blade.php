@extends('layouts.app')

@section('content')
  <div class="pt-10 mx-20 max-sm:mx-10 max-lg:mx-12 flex-grow">
    <div class="container mx-auto px-6 flex flex-col">
      <div class="md:flex md:items-center">
        <div class="w-full h-64 md:w-1/2 lg:h-96">
          <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="/paper-bag.jpg" alt="Product Image Main">
        </div>
        <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
          <h1 class="text-gray-700 text-lg">{{ $barang['nama'] }} | {{ $barang['kode'] }}</h3>
          <span class="text-gray-500 mt-3">Rp {{ $barang['harga'] }}</span>
          <hr class="my-3">
          <div class="mt-2">
            @if($barang['stok'] > 0)
              <p class="text-gray-500 text-sm italic pb-3">Available stocks: {{ $barang['stok'] }}</p>
              <form method="POST" action="{{ route('addtocart') }}" class="flex gap-4">
                @csrf
                <!-- Hidden input field to include the 'id' in the request body -->
                <input type="hidden" name="id" value="{{ $barang['id'] }}">
                <div class="input-counter flex items-center border-gray-100">
                  <label for="quantity" class="sr-only">Quantity</label>
                  <button 
                    aria-label="Decrement value"
                    type="button" 
                    class="minus cursor-pointer rounded-l bg-gray-100 py-2 px-3.5 w-10 duration-100 hover:bg-blue-800 hover:text-blue-50"
                  >
                    <span class=""> - </span>
                  </button>
                  <input 
                    class="h-10 w-10 border bg-white text-center text-xs outline-none" 
                    type="number" 
                    name="quantity" 
                    id="quantity" 
                    min="1" 
                    value="1"
                  />
                  <button 
                    aria-label="Increment value"
                    type="button" 
                    class="plus cursor-pointer rounded-r bg-gray-100 py-2 px-3.5 w-10 duration-100 hover:bg-blue-800 hover:text-blue-50"
                    data-action="increment"
                  >
                    <span class=""> + </span>
                  </button>
                </div>
                <button aria-label="Submit Form" type="submit" class="px-6 bg-blue-800 py-1.5 font-medium text-blue-50 hover:bg-blue-900 text-sm rounded">
                  Add to Cart
                </button>
              </form>
            @else
              <p class="text-sm">No stock available.</p>
            @endif
          </div>
          <hr class="my-3">
          <h1 class="text-gray-900 font-medium text-sm pb-1">Description</h4>
          <p class="text-gray-500 font-normal text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Explicabo animi, libero deleniti impedit reiciendis perferendis architecto vitae consequatur veniam fuga.</p>
          
          <hr class="my-3">
          <h1 class="text-gray-900 font-medium text-sm pb-1">Contact Us</h4>
          <p class="text-gray-500 font-normal text-sm">{{ $perusahaan['nama'] }}, {{ $perusahaan['no_telp'] }}</p>
          <p class="text-gray-500 font-normal text-sm">{{ $perusahaan['alamat'] }}</p>
        </div>
      </div>
      @if ($recommendations)
        <div class="my-8">
          <h1 class="text-2xl font-medium pb-1">More Products For You</h1>
          <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 mt-6">
            @foreach ($recommendations as $recommendation)
              <div class="w-full max-w-sm mx-auto rounded-md shadow-sm border overflow-hidden" onclick="navigateToProductDetails('{{ $recommendation['id'] }}')">
                <div class="flex items-end justify-end h-56 w-full bg-cover bg-center" style="background-image: url('/paper-bag.jpg')" alt="Product Image Recommendation">
                  <button aria-label="Cart" class="p-2 rounded-full bg-blue-800 text-white mx-5 -mb-4 hover:bg-blue-900">
                    <svg class="cart-icon" width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path fill="#F9F9F9" d="M16.5463 13C17.2963 13 17.9563 12.59 18.2963 11.97L21.8763 5.48C22.2463 4.82 21.7663 4 21.0063 4H6.20629L5.26629 2H1.99629V4H3.99629L7.59629 11.59L6.24629 14.03C5.51629 15.37 6.47629 17 7.99629 17H19.9963V15H7.99629L9.09629 13H16.5463ZM7.15629 6H19.3063L16.5463 11H9.52629L7.15629 6ZM7.99629 18C6.89629 18 6.00629 18.9 6.00629 20C6.00629 21.1 6.89629 22 7.99629 22C9.09629 22 9.99629 21.1 9.99629 20C9.99629 18.9 9.09629 18 7.99629 18ZM17.9963 18C16.8963 18 16.0063 18.9 16.0063 20C16.0063 21.1 16.8963 22 17.9963 22C19.0963 22 19.9963 21.1 19.9963 20C19.9963 18.9 19.0963 18 17.9963 18Z"/>
                    </svg>
                  </button>
                </div>
                <div class="px-5 py-3 border-t">
                  <h2 class="text-gray-700 text-sm">{{ $recommendation['nama'] }}</h3>
                  <span class="text-gray-500 mt-2 text-sm">Rp {{ $recommendation['harga'] }}</span>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif

  <script>
    function navigateToProductDetails(id) {
      const url = "{{ route('productDetails', ['id' => ':id']) }}".replace(':id', id);
      window.location.href = url;
    }

    document.addEventListener("DOMContentLoaded", function() {
      const inputCounter = document.querySelector(".input-counter input");
      const plusButton = document.querySelector(".input-counter .plus");
      const minusButton = document.querySelector(".input-counter .minus");
      const max = parseInt(inputCounter.parentElement.getAttribute("data-stok")) || Infinity;
      
      plusButton.addEventListener("click", function() {
        incrementValue(inputCounter);
      });
      
      minusButton.addEventListener("click", function() {
        decrementValue(inputCounter);
      });
      
      function incrementValue(input) {
        const value = parseInt(input.value);
        if (value < max) {
          input.value = value + 1;
        }
      }
      
      function decrementValue(input) {
        const min = 1;
        const value = parseInt(input.value);
        if (value > min) {
          input.value = value - 1;
        }
      }
    });
  </script>
@endsection