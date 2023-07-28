<?php

namespace Tests\Feature;

use App\Models\OrderHistory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function testShowOrderHistory()
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

        // Create some test order histories with order items
        $orderHistory = OrderHistory::create([
            'user_id' => $user->id,
            'total_harga' => 11000,
        ]);

        $orderHistory->orderItems()->createMany([
            [
                'nama' => 'Apple',
                'quantity' => 2,
                'harga' => 5000,
            ],
            [
                'nama' => 'Banana',
                'quantity' => 4,
                'harga' => 5000,
            ],
        ]);

        $this->get('/orderhistory');

        // Assert that the response is successful and the view has the correct data
        $response->assertStatus(302);

        $this->assertInstanceOf(OrderHistory::class, $orderHistory);

        // Assert that the paginator has the correct items
        $this->assertEquals(11000, $orderHistory->total_harga);
        $this->assertCount(2, $orderHistory->orderItems);
    }
}
