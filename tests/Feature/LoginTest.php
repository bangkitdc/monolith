<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    public function testValidLogin(): void
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

        $response->assertStatus(302);
        $response->assertRedirect('catalog');
        $this->assertAuthenticatedAs($user); // Ensure the user is authenticated
    }

    public function testInvalidLogin(): void
    {
        $response = $this->post(route('login'), [
            'email_username' => 'asdfgh@example.com', // Use a non-existent email
            'password' => 'asdfghjkl', // Use an invalid password
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['loginError']); // Ensure login error message exists in the session

        $this->assertGuest(); // Ensure no user is authenticated
    }
}
