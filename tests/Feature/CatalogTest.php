<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CatalogTest extends TestCase
{
    use RefreshDatabase;

    public function testShowCatalog()
    {
        // Make sure to mock the HTTP response for the API request
        Http::fake([
            '*/barang-paginate*' => Http::response([
                'data' => [
                    'data' => [
                        // Mocked data for the barangs
                        // ...
                    ],
                    'meta' => [
                        // Mocked meta data
                        // ...
                    ],
                ],
            ]),
        ]);

        $response = $this->get('/catalog');
        $response->assertStatus(302);
    }

    public function testShowProductDetails()
    {
        // Make sure to mock the HTTP response for the API request
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
            '*/perusahaan-noauth/*' => Http::response([
                'data' => [
                    // Mocked data for the perusahaan
                    // ...
                ],
            ]),
        ]);

        $barangId = '027ebae8-29f1-453d-b9a0-e58777d141ef';
        $response = $this->get('/catalog/' . $barangId);

        $response->assertStatus(302);
    }

    public function testUpdateCatalog()
    {
        // Make sure to mock the HTTP response for the API request
        Http::fake([
            '*/barang-noauth/*' => Http::response([
                'success' => true, // Mock a successful response from the API
            ]),
        ]);

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

        // Create a test cart with some items
        $cart = [
            '027ebae8-29f1-453d-b9a0-e58777d141ef' => [
                'nama' => 'Product 1',
                'harga' => 10000,
                'quantity' => 2,
            ],
            '027ebae8-29f1-453d-b9a0-e58777d14123' => [
                'nama' => 'Product 2',
                'harga' => 15000,
                'quantity' => 1,
            ],
        ];

        // Set the cart data into the session
        $this->actingAs($user)
            ->withSession(['cart' => $cart]);

        // Make the request to update the catalog using PUT method
        $response = $this->put('/catalog');

        // Assert that the response is a redirect
        $response->assertStatus(302);
        $response->assertRedirect('/catalog');

        // Assert that the session cart has been cleared
        $this->assertEmpty(session('cart'));
    }
}
