<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;
    public function testShowCart()
    {
        // Ensure the showCart method returns a successful response (200 status code)
        $response = $this->get('/cart');
        $response->assertStatus(302);
    }

    public function testAddToCart()
    {
        // Create a test user with a known password
        $user = User::create([
            'first_name' => 'test123',
            'last_name' => 'test123',
            'username' => 'test123',
            'email' => 'test123@example.com',
            'password' => bcrypt('testpassword'),
        ]);

        $response = $this->post(route('login'), [
            'email_username' => 'test123@example.com', // Use the email as the input
            'password' => 'testpassword', // Use the known password
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Mock the API response for fetching the Barang details
        Http::fake([
            '*/barang-noauth/*' => Http::response([
                'data' => [
                    'id' => '027ebae8-29f1-453d-b9a0-e58777d141ef',
                    'nama' => 'Apple',
                    'harga' => 100,
                    'stok' => 10,
                    'perusahaan_id' => '12bac1f6-0cc3-4c48-a3bb-808632303db9',
                    'kode' => 'A001',
                ],
            ]),
        ]);

        // Send a POST request to addToCart endpoint with valid data
        $response = $this->post('/addtocart', [
            'id' => '027ebae8-29f1-453d-b9a0-e58777d141ef',
            'quantity' => 2,
        ]);

        // Ensure the item is added to the cart and the user is redirected back with success message
        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Barang added to cart successfully!');
    }

    public function testUpdateCart()
    {
        // Create a test user with a known password
        $user = User::create([
            'first_name' => 'test123',
            'last_name' => 'test123',
            'username' => 'test123',
            'email' => 'test123@example.com',
            'password' => bcrypt('testpassword'),
        ]);

        $response = $this->post(route('login'), [
            'email_username' => 'test123@example.com', // Use the email as the input
            'password' => 'testpassword', // Use the known password
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Mock the API response for fetching the Barang details
        Http::fake([
            '*/barang-noauth/*' => Http::response([
                'data' => [
                    'id' => '027ebae8-29f1-453d-b9a0-e58777d141ef',
                    'nama' => 'Apple',
                    'harga' => 100,
                    'stok' => 10,
                    'perusahaan_id' => '12bac1f6-0cc3-4c48-a3bb-808632303db9',
                    'kode' => 'A001',
                ],
            ]),
        ]);

        // Add the Barang to the cart
        $this->post('/addtocart', [
            'id' => '027ebae8-29f1-453d-b9a0-e58777d141ef',
            'quantity' => 1,
        ]);

        $response = $this->patch('/updatecart', [
            'id' => '027ebae8-29f1-453d-b9a0-e58777d141ef',
            'quantity' => 3,
        ]);

        // Ensure the cart is updated with the new quantity
        $response->assertStatus(200);
        $response->assertJson([
            'cart' => [
                '027ebae8-29f1-453d-b9a0-e58777d141ef' => [
                    'quantity' => 3,
                ],
            ],
        ]);
    }

    public function testRemoveFromCart()
    {
        // Create a test user with a known password
        $user = User::create([
            'first_name' => 'test123',
            'last_name' => 'test123',
            'username' => 'test123',
            'email' => 'test123@example.com',
            'password' => bcrypt('testpassword'),
        ]);

        $response = $this->post(route('login'), [
            'email_username' => 'test123@example.com', // Use the email as the input
            'password' => 'testpassword', // Use the known password
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Mock the API response for fetching the Barang details
        Http::fake([
            '*/barang-noauth/*' => Http::response([
                'data' => [
                    'id' => '027ebae8-29f1-453d-b9a0-e58777d141ef',
                    'nama' => 'Apple',
                    'harga' => 100,
                    'stok' => 10,
                    'perusahaan_id' => '12bac1f6-0cc3-4c48-a3bb-808632303db9',
                    'kode' => 'A001',
                ],
            ]),
        ]);

        // Add the Barang to the cart
        $this->post('/addtocart', [
            'id' => '027ebae8-29f1-453d-b9a0-e58777d141ef',
            'quantity' => 1,
        ]);

        // Send a DELETE request to removeFromCart endpoint to remove the item from the cart
        $response = $this->delete('/removefromcart', [
            'id' => '027ebae8-29f1-453d-b9a0-e58777d141ef',
        ]);

        // Ensure the item is removed from the cart and user is redirected back with success message
        $response->assertStatus(200);
        $response->assertSessionHas('success', 'Barang removed successfully!');
    }
}
