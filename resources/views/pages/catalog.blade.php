@extends('layouts.app')

@section('content')
  <div class="pt-10 pb-16 md:mx-12 flex-grow relative">
    <div class="mx-20 max-sm:mx-10 max-lg:mx-12 flex flex-col max-sm:pb-4">
      <div>
        <h1 class="text-2xl font-bold mb-1">Catalog</h1>
        <p class="text-sm text-gray-500">View Products, Manage Favorites, and Discover New Arrivals.</p>
      </div>
      <div class="py-6 flex-grow">
        <div class="flex justify-end">
          <div class="relative max-sm:w-full">
            <input type="text" id="searchInput" class="border border-gray-500 rounded-lg bg-transparent h-9 max-md:h-8 px-3 pr-10 max-md:pr-8 text-sm focus:outline-none text-gray-700 placeholder:text-gray-400 hover:bg-gray-100 max-sm:w-full" placeholder="Search...">
            <button aria-label="Search" class="absolute right-0 top-0 mt-0.5 pt-1 max-md:pt-0.5 h-8 w-8 max-md:h-7 max-md:w-7 mx-2 max-md:mx-1 cursor-default">
              <i class="material-icons">search</i>
            </button>
          </div>
        </div>
        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
          @if ($barangs)
            @foreach ( $barangs as $barang )
              <div class="group relative cursor-pointer max-sm:pb-4 p-4 border shadow-sm rounded-lg" onclick="navigateToProductDetails('{{ $barang['id'] }}')">
                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-100 lg:aspect-none group-hover:opacity-60 lg:h-60 sm:h-60 max-sm:h-60">
                  <img src="/paper-bag.jpg" class="h-full w-full object-cover object-center lg:h-full lg:w-full" alt="product-img">
                </div>
                <div class="mt-4 flex justify-between">
                  <div>
                    <h2 class="text-sm text-gray-700">
                      {{ $barang['nama'] }}
                    </h2>
                    @if ($barang['stok'] > 0)
                      <p class="mt-1 text-left text-sm italic text-gray-500">stock: {{ $barang['stok'] }}</p>
                    @else
                      <p class="mt-1 text-left text-sm italic text-gray-500">not in stock</p>
                    @endif
                  </div>
                  <div>
                    <h2 class="text-sm text-right font-medium text-gray-900">
                      Rp {{ $barang['harga'] }}
                    </h2>
                  </div>
                </div>
              </div>
            @endforeach
          @else
            <p class="text-sm text-gray-500">Couldn't find barang.</p>
          @endif
        </div>
      </div>
    </div>
    <!-- Display the pagination links -->
    <div class="absolute bottom-0 right-0 left-0">
      <div class="flex items-center justify-between border-t pt-6 max-md:pt-5 max-sm:pt-4 w-full max-sm:flex-col">
        <div class="sm:ml-8">
          <p class="text-sm text-gray-700">
            Showing
            <span class="font-medium text-sm">{{ $barangs ? ($meta['current_page'] - 1) * 8 + 1 : 0 }}</span>
            to
            <span class="font-medium text-sm">{{ min($meta['current_page'] * 8, $meta['total']) }}</span>
            of
            <span class="font-medium text-sm">{{ $meta['total'] }}</span>
            results
          </p>
        </div>
        <div class="max-sm:pt-3 max-sm:max-w-full sm:mr-8">
          <nav class="isolate inline-flex -space-x-px shadow-sm" aria-label="Pagination">
            <button 
              aria-label="Go to First Page"
              onclick="gotoPage(1)"
              class="rounded-l-md box-page-arrow {{ ($meta['current_page'] === 1) ? 'cursor-default' : 'hover:bg-gray-100 cursor-pointer' }}"
              id="first-link"            
            >
              <i class="material-icons" style="font-size: 20px; color:#374151">keyboard_double_arrow_left</i>
            </button>
            <button 
              aria-label="Got to Previous Page"
              onclick="gotoPage({{ $meta['current_page'] - 1 }})"
              class="box-page-arrow {{ ($meta['current_page'] === 1) ? 'cursor-default' : 'hover:bg-gray-100' }}" 
              id="prev-link"
            >
              <i class="material-icons" style="font-size: 20px; color:#6b7280">chevron_left</i>
            </button>

            @if($meta['total_pages'] <= 5)
              @for ($i = 1; $i <= min($meta['total_pages'], 5); $i++)
                <button aria-label="Go To Page" onclick="gotoPage({{ $i }})" class="box-page {{ ($meta['current_page'] === $i) ? 'bg-gray-100 cursor-default' : '' }}">{{ $i }}</button>
              @endfor
            @else
              @if($meta['current_page'])
                @for ($i = 1; $i <= 3; $i++)
                  <button aria-label="Go To Page" onclick="gotoPage({{ $i }})" class="box-page {{ ($meta['current_page'] === $i) ? 'bg-gray-100 cursor-default' : '' }}">{{ $i }}</button>
                @endfor
              @elseif ($meta['current_page'] === $meta['total_pages'])
                @for ($i = 0; $i < 3; $i++)
                  <button aria-label="Go To Page" onclick="gotoPage({{ $meta['total_pages'] - $i }})" class="box-page {{ ($meta['current_page'] === $meta['total_pages'] - $i) ? 'bg-gray-100 cursor-default' : '' }}">{{ $meta['total_pages'] - $i }}</button>
                @endfor
              @else
                @for ($i = -1; $i <= 1; $i++)
                  <button aria-label="Go To Page" onclick="gotoPage({{ $meta['total_pages'] + $i }})" class="box-page {{ ($meta['current_page'] === $meta['current_page'] + $i) ? 'bg-gray-100 cursor-default' : '' }}">{{ $meta['current_page'] + $i }}</button>
                @endfor
              @endif
            @endif

            <button 
              aria-label="Go to Next Page"
              onclick="gotoPage({{ $meta['current_page'] + 1 }})"
              class="box-page-arrow {{ ($meta['current_page'] === $meta['total_pages']) ? 'cursor-default' : 'hover:bg-gray-100' }}"
              id="next-link"
            >
              <i class="material-icons" style="font-size: 20px; color:#6b7280">chevron_right</i>
            </button>
            <button 
              aria-label="Go to Last Page"
              onclick="gotoPage({{ $meta['total_pages'] }})"
              class="rounded-r-md box-page-arrow {{ ($meta['current_page'] === $meta['total_pages']) ? 'cursor-default' : 'hover:bg-gray-100' }}"
              id="last-link"
            >
              <i class="material-icons" style="font-size: 20px; color:#374151">keyboard_double_arrow_right</i>
            </button>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function gotoPage(page) {
      if ({{ $meta['current_page'] }} !== page && page > 0 && page <= {{ $meta['total_pages'] }}) {
        window.location.href = "{{ route('catalog', ['page' => '']) }}" + page;
      }
    }

    function navigateToProductDetails(id) {
      const url = "{{ route('productDetails', ['id' => ':id']) }}".replace(':id', id);
      window.location.href = url;
    }

    // Debounce Search
    // Debounce function to delay the search execution
    function debounce(func, wait) {
      let timeout;
      return function () {
        const context = this;
        const args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function () {
          func.apply(context, args);
        }, wait);
      };
    }

    // Function to perform the search and update results
    function performSearch() {
      const q = $('#searchInput').val();

      // AJAX request to the PHP script
      window.location.href = "{{ route('catalog', ['q' => '']) }}" + q;
    }

    // Attach event listener to the search input field with debounce
    const searchInput = $('#searchInput');
    searchInput.on('input', debounce(performSearch, 1000)); // debounce time
    // Set the initial value of the search input field on page load
    $(document).ready(function() {
      const initialValue = {!! json_encode($q) !!};

      if (initialValue !== null) {
        searchInput.focus();
      }
      searchInput.val(initialValue);
    });

    // Function to reload the page
    function refreshPage() {
        window.location.reload(true);
    }

    // Refresh the page every 5 minutes (300,000 milliseconds)
    setInterval(refreshPage, 300000);
  </script>

  <style>
    .catalog {
      color: #1e40af;
    }
  </style>
@endsection