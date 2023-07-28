<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    public function testValidRegister(): void
    {
        // Create a user data array to simulate the registration form data
        $userData = [
            'first_name' => 'Lewis',
            'last_name' => 'Hamilton',
            'username' => 'lewis44',
            'email' => 'lewis44@gmail.com',
            'password' => 'mercedes123',
        ];

        // Send a POST request to the register endpoint with the form data
        $response = $this->post(route('register'), $userData);

        // Assert that the user was created successfully
        $response->assertStatus(302);
        $response->assertRedirect('login');

        // Assert that the user is saved in the database
        $this->assertDatabaseHas('users', [
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'username' => $userData['username'],
            'email' => $userData['email'],
        ]);
    }

    public function testInvalidRegister(): void
    {
        // Create a user data array with an invalid email format
        $userData = [
            'first_name' => 'Lewis',
            'last_name' => 'Hamilton',
            'username' => 'lewis44',
            'email' => 'invalidemail', // Invalid email format
            'password' => 'mercedes123',
        ];

        // Send a POST request to the register endpoint with the form data
        $response = $this->post(route('register'), $userData);

        // Assert that the registration fails and returns back to the register page
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);

        // Assert that the user is not saved in the database
        $this->assertDatabaseMissing('users', [
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'username' => $userData['username'],
            'email' => $userData['email'],
        ]);
    }
}
