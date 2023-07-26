<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\OrderHistory;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class OrderHistoryController extends Controller
{
  /**
   * Display the order-history
   *
   * @return \Illuminate\Http\Response
   */
  public function showOrderHistory(Request $request)
  {
    // Get the currently authenticated user
    $user = $request->user();

    // Get query from request
    $q = $request->input('q');

    // Retrieve the order history for the user
    $orderHistoryQuery = OrderHistory::where('user_id', $user->id);

    // Determine if the query is a number (year search) or a string (name search)
    if (is_numeric($q)) {
      // Search by year
      $orderHistoryQuery->whereYear('created_at', $q);
    } elseif ($q) {
      // Search by name
      $orderHistoryQuery->whereHas('orderItems',
        function ($orderItemsQuery) use ($q) {
          $orderItemsQuery->where('nama', 'like', '%' . $q . '%'); // Use 'like' for case-insensitive search in MySQL
        }
      );
    }

    // Eager load the orderItems relationship for each order history
    $orderHistoryQuery->with('orderItems');

    $orderHistoryQuery->latest('id');

    // Get the order history with the applied filters
    $filteredOrderHistory = $orderHistoryQuery->get();

    // Paginate the filtered order history
    $perPage = 3;
    $currentPage = $request->query('page', 1);
    $orderHistory = new LengthAwarePaginator(
      $filteredOrderHistory->forPage($currentPage, $perPage),
      $filteredOrderHistory->count(),
      $perPage,
      $currentPage,
      ['path' => $request->url(), 'query' => $request->query()]
    );
    
    // Pass the order history data to the view and return the view
    return view('pages/orderHistory', compact('orderHistory', 'q'));
  }
}