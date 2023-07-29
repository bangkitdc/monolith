<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Bondowify is an Ecommerce Website">
  <meta name="keywords" content="bondowify, ecommerce, shopping">
  <meta name="author" content="bangkitdc">
  <meta name="robots" content="index, follow">
  <meta property="og:title" content="Bondowify">
  <meta property="og:description" content="Bondowify is an Ecommerce Website">
  <meta property="og:image" content="/public/paper-bag.jpg">
  <meta property="og:url" content="http://bondowify.com">
  <title>App</title>
  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>

<body>
  <div class="min-h-screen flex flex-col">
    <header>
      <nav class="mx-auto flex items-center justify-between p-6 lg:px-8 border-b md:mx-12" aria-label="Global">
        <div class="flex lg:flex-1">
          <div class="-m-1.5 p-1.5">
            <p class="font-medium text-blue-800">bondowify</p>
          </div>
        </div>
        <div class="flex lg:hidden gap-4">
          <a href="{{ route('cart') }}"
            class="text-sm font-semibold leading-6 gap-2 text-gray-900 flex relative -m-1.5 p-1.5">
            <svg class="cart-icon" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M16.5463 13C17.2963 13 17.9563 12.59 18.2963 11.97L21.8763 5.48C22.2463 4.82 21.7663 4 21.0063 4H6.20629L5.26629 2H1.99629V4H3.99629L7.59629 11.59L6.24629 14.03C5.51629 15.37 6.47629 17 7.99629 17H19.9963V15H7.99629L9.09629 13H16.5463ZM7.15629 6H19.3063L16.5463 11H9.52629L7.15629 6ZM7.99629 18C6.89629 18 6.00629 18.9 6.00629 20C6.00629 21.1 6.89629 22 7.99629 22C9.09629 22 9.99629 21.1 9.99629 20C9.99629 18.9 9.09629 18 7.99629 18ZM17.9963 18C16.8963 18 16.0063 18.9 16.0063 20C16.0063 21.1 16.8963 22 17.9963 22C19.0963 22 19.9963 21.1 19.9963 20C19.9963 18.9 19.0963 18 17.9963 18Z"/>
            </svg>

            @if (count((array) session('cart')) > 0)
              <span class="absolute right-0 top-0 rounded-full bg-red-600 w-4 h-4 top right p-0 m-0 text-white font-mono text-sm leading-tight text-center">
                {{ count((array) session('cart')) }}
              </span>
            @endif
          </a>
          <button 
            aria-label="Open Menu"
            type="button"
            class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
            id="openModal"  
          >
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
              aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
          </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
          <a href="/catalog" class="catalog text-sm font-semibold leading-6 text-gray-900">Catalog</a>
          <a href="/orderhistory" class="orderhistory text-sm font-semibold leading-6 text-gray-900">Order History</a>
          <a href="/about" class="about text-sm font-semibold leading-6 text-gray-900">About</a>
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end gap-4">
          <a href="{{ route('cart') }}"
            class="text-sm font-semibold leading-6 gap-2 text-gray-900 flex relative -m-1.5 p-1.5">
            <svg class="cart-icon" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M16.5463 13C17.2963 13 17.9563 12.59 18.2963 11.97L21.8763 5.48C22.2463 4.82 21.7663 4 21.0063 4H6.20629L5.26629 2H1.99629V4H3.99629L7.59629 11.59L6.24629 14.03C5.51629 15.37 6.47629 17 7.99629 17H19.9963V15H7.99629L9.09629 13H16.5463ZM7.15629 6H19.3063L16.5463 11H9.52629L7.15629 6ZM7.99629 18C6.89629 18 6.00629 18.9 6.00629 20C6.00629 21.1 6.89629 22 7.99629 22C9.09629 22 9.99629 21.1 9.99629 20C9.99629 18.9 9.09629 18 7.99629 18ZM17.9963 18C16.8963 18 16.0063 18.9 16.0063 20C16.0063 21.1 16.8963 22 17.9963 22C19.0963 22 19.9963 21.1 19.9963 20C19.9963 18.9 19.0963 18 17.9963 18Z"/>
            </svg>

            @if (count((array) session('cart')) > 0)
              <span class="absolute right-0 top-0 rounded-full bg-red-600 w-4 h-4 top right p-0 m-0 text-white font-mono text-sm leading-tight text-center">
                {{ count((array) session('cart')) }}
              </span>
            @endif
          </a>
          <form class="text-sm font-semibold leading-6 text-gray-900" action="{{ route('logout') }}" method="POST">
            @csrf
            <button aria-label="Log Out" type="submit" class="flex items-center text-center justify-center">
              Log out
              <i class="material-icons ml-1 mt-0.5" style="font-size: 18px; color:#111827;">logout</i>
            </button>
          </form>
        </div>
      </nav>

      {{-- STATE OPEN/ CLOSE --}}
      <div class="hidden" role="dialog" aria-modal="true" id="modal">
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div class="fixed inset-0 z-10"></div>
        <div class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
          <div class="flex items-center justify-between">
            <div class="-m-1.5 p-1.5">
              <p class="font-medium text-blue-800">bondowify</p>
            </div>
            <button aria-label="Burger Button" type="button" id="closeModal" class="-m-2.5 rounded-md p-2.5 text-gray-700">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="mt-6 flow-root">
            <div class="-my-6 divide-y divide-gray-500/10">
              <div class="space-y-2 py-6">
                <a href="/catalog" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Catalog</a>
                <a href="/orderhistory" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Order History</a>
                <a href="/about" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">About</a>
              </div>
              <div class="py-6">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button aria-label="Submit" type="submit" class="-mx-3 flex items-center justify-start rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                    Log out
                    <i class="material-icons ml-2 mt-0.5" style="font-size: 18px; color:#111827;">logout</i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    @if (session()->has('success'))
      <div role="alert" id="success-alert" class="flex fixed top-20 max-sm:top-10 right-10 max-sm:left-1/2 max-sm:transform max-sm:-translate-x-1/2 items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow z-10">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
          </svg>
        </div>
        <div class="ml-3 text-sm font-normal">{{ session('success') }}</div>
        <button aria-label="Close" type="button" data-dismiss="alert" class="close-button ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-success" aria-label="Close">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
        </button>
      </div>
    @endif

    @if ($errors->has('error'))
      <div role="alert" id="error-alert" class="flex fixed top-20 max-sm:top-10 right-10 max-sm:left-1/2 max-sm:transform max-sm:-translate-x-1/2 items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow z-10">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
          </svg>
        </div>
        <div class="ml-3 text-sm font-normal">{{ $errors->first('error') }}</div>
        <button aria-label="Close" type="button" data-dismiss="alert" class="close-button ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-success" aria-label="Close">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
        </button>
      </div>
    @endif  

    <main class="flex-grow flex pb-6">
      @yield('content')
    </main>

  </div>

  <style>
    input[type='number']::-webkit-inner-spin-button,
    input[type='number']::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var closeButtons = document.querySelectorAll('.close-button');

      closeButtons.forEach(function(closeButton) {
        closeButton.addEventListener('click', function() {
          var alertElement = this.parentNode;
          if (alertElement) {
            alertElement.style.display = 'none';
          }
        });
      });
    });

    document.addEventListener("DOMContentLoaded", function () {
      const toggleModalButton = document.getElementById("openModal");
      const closeButton = document.getElementById("closeModal");
      const modal = document.getElementById("modal");

      toggleModalButton.addEventListener("click", function () {
        modal.classList.remove("hidden");
      });

      closeButton.addEventListener("click", function () {
        modal.classList.add("hidden");
      });
    });
  </script>
</body>

</html>
