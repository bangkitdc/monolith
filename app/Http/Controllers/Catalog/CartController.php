<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    /**
     * Display the cart
     *
     * @return \Illuminate\Http\Response
     */
    public function showCart(Request $request)
    {
        // Retrieve the cart data from the session
        $cart = $request->session()->get('cart', []);

        // Pass the $cart data to the view as an array
        return view('pages/cart', ['cart' => $cart]);
    }

    public function addToCart(Request $request, $id)
    {
        // Fetch the Barang details based on the given $id (Barang ID)
        // Make the HTTP request to the API endpoint with the page parameter
        $baseUrl = config('app.api_base_url');
        $response = Http::get($baseUrl . '/barang-noauth/' . $id);

        // Check if the request was successful
        if ($response->successful()) {
            // Retrieve the data from the response
            $data = $response->json();

            // Extract the necessary data for the table
            $barang = $data['data'];

            $cart = session()->get('cart', []);

            $validatedData = $request->validate([
                'quantity' => 'required',
            ]);

            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $validatedData['quantity'];
            } else {
                $cart[$id] = [
                    'nama' => $barang['nama'],
                    'harga' => intval($barang['harga']),
                    'stok' => intval($barang['stok']),
                    'perusahaan_id' => $barang['perusahaan_id'],
                    'kode' => $barang['kode'],
                    'quantity' => $validatedData['quantity']
                ];
            }

            if ($cart[$id]['quantity'] > $barang['stok']) {
                $cart[$id]['quantity'] -= $validatedData['quantity'];
                return redirect()->back()->with('error', 'Barang stock is not enough!');
            }

            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Barang added to cart successfully!');
        }
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);

            // Return the updated cart data as JSON response
            return response()->json(['cart' => $cart]);
        }
    }

    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Barang removed successfully!');
        }
    }
}
