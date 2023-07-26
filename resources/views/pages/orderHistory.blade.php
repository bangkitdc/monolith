@extends('layouts.app')

@section('content')
  <div class="pt-10 pb-16 md:mx-12 flex-grow relative">
    <div class="mx-20 max-sm:mx-10 max-lg:mx-12 flex flex-col">
      <div>
        <h1 class="text-2xl font-bold mb-1">Order History</h1>
        <p class="text-sm text-gray-500">Check the status of recent orders, manage returns, and discover similar products.</p>
      </div>
      <div class="py-6 flex-grow">
        <div class="flex justify-end">
          <div class="relative max-sm:w-full">
            <input type="text" id="searchInput" class="border border-gray-500 rounded-lg bg-transparent h-9 max-md:h-8 px-3 pr-10 max-md:pr-8 text-sm focus:outline-none text-gray-700 placeholder:text-gray-400 hover:bg-gray-100 max-sm:w-full" placeholder="Search...">
            <button class="absolute right-0 top-0 mt-0.5 pt-1 max-md:pt-0.5 h-8 w-8 max-md:h-7 max-md:w-7 mx-2 max-md:mx-1 cursor-default">
              <i class="material-icons">search</i>
            </button>
          </div>
        </div>
        <div class="mt-6">
          @if ($orderHistory->total())
            @foreach ($orderHistory as $order)
              <div class="w-full mb-6 border rounded-lg py-6 shadow-sm">
                <div class="grid grid-cols-3 w-full px-6">
                  <div class="mt-0">
                    <h2 class="text-sm font-medium text-gray-900">Order number</h2>
                    <p class="mt-1 text-sm text-gray-500">{{ $order->id }}</p>
                  </div>
                  <div class="mt-0">
                    <h2 class="text-sm text-center font-medium text-gray-900">Date placed</h2>
                    @php
                      $date = new DateTime($order->created_at);
                      $formattedDate = $date->format("M j, Y");
                    @endphp
                    <p class="mt-1 text-sm text-center text-gray-500">{{ $formattedDate }}</p>
                  </div>
                  <div class="mt-0">
                    <h2 class="text-sm text-right font-medium text-gray-900">Total amount <span class="text-sm font-normal text-gray-500">(incl. tax)</span></h2>
                    <p class="mt-1 text-sm font-medium text-right text-gray-900">Rp{{ $order->total_harga }}</p>
                  </div>
                </div>

                <hr class="my-6">
                @foreach ($order->orderItems as $orderItem)
                  <div class="mx-6 my-3 flex justify-start">
                    <div class="h-24 w-36">
                      <img src="/paper-bag.jpg" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                    </div>
                    <div class="flex flex-col ml-4 flex-grow">
                      <div class="flex justify-between">
                        <p class="text-sm font-medium text-gray-900">
                          {{ $orderItem->nama }}
                        </p>
                        <p class="text-sm font-medium text-gray-900">
                          Rp{{ $orderItem->quantity * $orderItem->harga }}
                        </p>
                      </div>
                      <p class="text-sm my-1 text-gray-500">
                        Rp{{ $orderItem->harga }}&nbsp;&nbsp;|&nbsp;&nbsp;Qty: {{ $orderItem->quantity }}
                      </p>
                      <p class="text-sm text-gray-500 custom-truncate">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Explicabo animi, libero deleniti impedit reiciendis perferendis architecto vitae consequatur veniam fuga.
                      </p>
                    </div>
                  </div>
                  @if (!$loop->last)
                    <hr class="my-6">
                  @endif
                @endforeach
              </div>
            @endforeach
          @else
            <p class="text-sm text-gray-500">Couldn't find order.</p>
          @endif
        </div>
      </div>
      <!-- Display the pagination links -->
      <div class="absolute bottom-0 right-0 left-0">
        <div class="flex items-center justify-between border-t pt-6 max-md:pt-5 max-sm:pt-4 w-full max-sm:flex-col">
          <div class="sm:ml-8">
            <p class="text-sm text-gray-700">
              Showing
              <span class="font-medium text-sm">{{ $orderHistory->total() ? ($orderHistory->currentPage() - 1) * 3 + 1 : 0 }}</span>
              to
              <span class="font-medium text-sm">{{ min($orderHistory->currentPage() * 3, $orderHistory->total()) }}</span>
              of
              <span class="font-medium text-sm">{{ $orderHistory->total() }}</span>
              results
            </p>
          </div>
          <div class="max-sm:pt-3 max-sm:max-w-full sm:mr-8">
            <nav class="isolate inline-flex -space-x-px shadow-sm" aria-label="Pagination">
              <button 
                onclick="gotoPage(1)"
                class="rounded-l-md box-page-arrow {{ ($orderHistory->currentPage() === 1) ? 'cursor-default' : 'hover:bg-gray-100 cursor-pointer' }}"
                id="first-link"            
              >
                <i class="material-icons" style="font-size: 20px; color:#374151">keyboard_double_arrow_left</i>
              </button>
              <button 
                onclick="gotoPage({{ $orderHistory->currentPage() - 1 }})"
                class="box-page-arrow {{ ($orderHistory->currentPage() === 1) ? 'cursor-default' : 'hover:bg-gray-100' }}" 
                id="prev-link"
              >
                <i class="material-icons" style="font-size: 20px; color:#6b7280">chevron_left</i>
              </button>

              @if(ceil($orderHistory->total() / 3) <= 5)
                @for ($i = 1; $i <= min(ceil($orderHistory->total() / 3), 5); $i++)
                  <button onclick="gotoPage({{ $i }})" class="box-page {{ ($orderHistory->currentPage() === $i) ? 'bg-gray-100 cursor-default' : '' }}">{{ $i }}</button>
                @endfor
              @else
                @if($orderHistory->currentPage())
                  @for ($i = 1; $i <= 3; $i++)
                    <button onclick="gotoPage({{ $i }})" class="box-page {{ ($orderHistory->currentPage() === $i) ? 'bg-gray-100 cursor-default' : '' }}">{{ $i }}</button>
                  @endfor
                @elseif ($orderHistory->currentPage() == ceil($orderHistory->total() / 3))
                  @for ($i = 0; $i < 3; $i++)
                    <button onclick="gotoPage({{ ceil($orderHistory->total() / 3) - $i }})" class="box-page {{ ($orderHistory->currentPage() == ceil($orderHistory->total() / 3) - $i) ? 'bg-gray-100 cursor-default' : '' }}">{{ ceil($orderHistory->total() / 3) - $i }}</button>
                  @endfor
                @else
                  @for ($i = -1; $i <= 1; $i++)
                    <button onclick="gotoPage({{ ceil($orderHistory->total() / 3) + $i }})" class="box-page {{ ($orderHistory->currentPage() === $orderHistory->currentPage() + $i) ? 'bg-gray-100 cursor-default' : '' }}">{{ $orderHistory->currentPage() + $i }}</button>
                  @endfor
                @endif
              @endif

              <button 
                onclick="gotoPage({{ $orderHistory->currentPage() + 1 }})"
                class="box-page-arrow {{ ($orderHistory->currentPage() == ceil($orderHistory->total() / 3)) ? 'cursor-default' : 'hover:bg-gray-100' }}"
                id="next-link"
              >
                <i class="material-icons" style="font-size: 20px; color:#6b7280">chevron_right</i>
              </button>
              <button 
                onclick="gotoPage({{ ceil($orderHistory->total() / 3) }})"
                class="rounded-r-md box-page-arrow {{ ($orderHistory->currentPage() == ceil($orderHistory->total() / 3)) ? 'cursor-default' : 'hover:bg-gray-100' }}"
                id="last-link"
              >
                <i class="material-icons" style="font-size: 20px; color:#374151">keyboard_double_arrow_right</i>
              </button>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function gotoPage(page) {
      if ({{ $orderHistory->currentPage() }} !== page && page > 0 && page <= {{ $orderHistory->lastPage() }}) {
        window.location.href = "{{ route('orderHistory', ['page' => '']) }}" + page;
      }
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
      window.location.href = "{{ route('orderHistory', ['q' => '']) }}" + q;
    }

    // Attach event listener to the search input field with debounce
    const searchInput = $('#searchInput');
    searchInput.on('input', debounce(performSearch, 1000)); // 300ms debounce time
    // Set the initial value of the search input field on page load
    $(document).ready(function() {
      const initialValue = {!! json_encode($q) !!};

      if (initialValue !== null) {
        searchInput.focus();
      }
      searchInput.val(initialValue);
    });
    
  </script>

  <style>
    .orderHistory {
      color: #3b82f6;
    }

    .custom-truncate {
      display: -webkit-box;
      -webkit-line-clamp: 2; /* Number of lines to show before truncating */
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
    }
  </style>
@endsection