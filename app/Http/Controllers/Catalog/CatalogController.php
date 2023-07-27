<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\OrderHistory;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class CatalogController extends Controller
{
  /**
   * Display the catalog
   *
   * @return \Illuminate\Http\Response
   */
  public function showCatalog(Request $request)
  {
    $page = $request->input('page', 1); // Get the current page from the request query parameter

    $q = $request->input('q');

    // Make the HTTP request to the API endpoint with the page parameter
    $baseUrl = config('app.api_base_url');
    $response = Http::get($baseUrl . '/barang-paginate?page=' . $page . '&q=' . $q);

    // Check if the request was successful
    if ($response->successful()) {
      // Retrieve the data from the response
      $data = $response->json();

      // Extract the necessary data for the table
      $barangs = $data['data']['data'];
      $meta = $data['data']['meta'];

      if ($barangs === null) {
        $barangs = [];
      }

      // Pass the barangs and page information to the view
      return view('pages/catalog', compact('barangs', 'page', 'meta', 'q'));
    }

    // Handle the case when the request fails
    abort(500, 'Failed to fetch data from the API endpoint');
  }

  // New method to show product details
  public function showProductDetails(Request $request, $id)
  {
    // Fetch the product details based on the given $id (product ID)
    // Make the HTTP request to the API endpoint with the page parameter
    $baseUrl = config('app.api_base_url');
    $response = Http::get($baseUrl . '/barang-noauth/' . $id);

    // Check if the request was successful
    if ($response->successful()) {
      // Retrieve the data from the response
      $data = $response->json();

      // Extract the necessary data for the table
      $barang = $data['data'];

      // For perusahaan data
      $response_2 = Http::get($baseUrl . '/perusahaan-noauth/' . $barang['perusahaan_id']);

      if ($response_2->successful()) {
        // Retrieve the data from the response
        $data_2 = $response_2->json();

        // Extract the necessary data for the table
        $perusahaan = $data_2['data'];

        // Recommendations
        $recommendations = $this->getRecommendation($request, $barang['nama']);

        // Pass the barang, perusahaan, and page information to the view
        return view('pages/detailsProduct', compact('barang', 'perusahaan', 'recommendations'));
      }
    }

    // Handle the case when the request fails
    abort(500, 'Failed to fetch data from the API endpoint');
  }

  // Method to handle the form submission
  public function updateCatalog(Request $request)
  {
    // Retrieve the cart data from the session
    $cart = $request->session()->get('cart', []);

    try {
      // Create the OrderHistory record (initialize as null)
      $orderhistory = null;

      // Calculate the total price of the order
      $totalHarga = 0;

      // Post data to the API endpoint using Http client
      $baseUrl = config('app.api_base_url');
      foreach ($cart as $id => $barang) {
        // Make the HTTP PUT request to update the catalog item
        $response = Http::put($baseUrl . '/barang-noauth/' . $id, [
          'quantity' => intval($barang['quantity'])
        ]);

        if ($response->successful()) {

          // Create the OrderHistory if not created already
          if (!$orderhistory) {
            $orderhistory = OrderHistory::create([
              'user_id' => $request->user()->id,
              'total_harga' => 0,
            ]);
          }

          // Create the OrderItem record and associate it with the OrderHistory
          $orderItem = new OrderItem([
            'nama' => $barang['nama'],
            'quantity' => $barang['quantity'],
            'harga' => $barang['harga'],
          ]);

          $orderhistory->orderItems()->save($orderItem);

          $totalHarga += intval($barang['harga']) * intval($barang['quantity']);

        } else {
          // If any item update fails, delete the created OrderHistory and OrderItem records
          if ($orderhistory) {
            $orderhistory->delete();
          }

          // Set an error flash message with the actual error message from the API response
          $errorMessage = $response->json()['message'] ?? 'Error occurred in the server';
          return back()->with('error', $errorMessage);
        }
      }

      // Update the total price in the OrderHistory record
      if ($orderhistory) {
        $orderhistory->update(['total_harga' => $totalHarga + $totalHarga * 0.1]);
      }

      // All items updated successfully, clear the cart from the session
      $request->session()->forget('cart');

      // Set a success flash message
      return redirect('catalog')->with('success', 'Checkout successfully');
    } catch (\Exception $e) {
      // If any exception occurs, delete the created OrderHistory and OrderItem records
      if ($orderhistory) {
        $orderhistory->delete();
      }

      // Set an error flash message with the actual error message from the exception
      return back()->with('error', $e->getMessage());
    }
  }

  public function getRecommendation(Request $request, $except) {
    // Get the currently authenticated user
    $user = $request->user();

    // Retrieve the last OrderHistory for the user
    $orderhistory = $user->orderhistory()->latest()->first();

    if ($orderhistory) {
      // Get the order items for the last OrderHistory
      $orderItems = $orderhistory->orderItems;

      // Shuffle the array of order items randomly
      $shuffledOrderItems = $orderItems->shuffle();
      $randomOrderItem = $shuffledOrderItems->take(1);

      // Get the names ('nama') of the random order item
      $randomOrderItemName = $randomOrderItem->pluck('nama')->first();

      // Make the HTTP request to the API endpoint with the page parameter
      $baseUrl = config('app.api_base_url');
      $response = Http::get($baseUrl . '/barang-noauth-recommendation?nama=' . $randomOrderItemName . '&except=' . $except);

      // Check if the request was successful
      if ($response->successful()) {
        // Retrieve the data from the response
        $data = $response->json();

        // Extract the necessary data for the table
        $barangs = $data['data'];

        $recommendation = [];
        foreach ($barangs as $barang) {
          if ($barang['nama'] != $except) {
            array_push($recommendation, $barang);
          }
        }

        return $recommendation;
      }
    } else {
      return [];
    }
    return [];

    // Handle the case when the request fails
    abort(500, 'Failed to fetch data from the API endpoint');
  }
}
