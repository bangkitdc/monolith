<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display the register form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegisterForm(): Response
    {
        return response(view('auth/register'));
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'username' => 'required|min:5|max:255|unique:users',
            'email' => 'required|email:dns|unique:users|max:255',
            'password' => 'required|min:5|max:255',
        ]);

        User::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'username' => request('username'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);

        return redirect('login')->with('success', 'Registration successful, Please sign in!');
    }
}
