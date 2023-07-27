<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Display the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(): Response
    {
        return response(view('auth/login'));
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $input = $request->input('email_username');
        $password = $request->input('password');

        // Determine if the input is an email or username
        $fieldType = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Merge the validated data based on the field type
        $validatedData = [
            $fieldType => $input,
            'password' => $password,
        ];

        $rules = [
            'email_username' => 'required',
            'password' => 'required|max:255',
        ];

        // Validate the data
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($token = auth()->attempt($validatedData)) {
            return redirect('catalog')->header('Authorization', 'Bearer ' . $token);
        }

        return back()->with('loginError', 'Invalid credentials!')->withInput();
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        // Clear the cart session data
        session()->forget('cart');
        
        auth()->logout();

        $message = 'Successfully logged out';

        if (request()->expectsJson()) {
            return response()->json(['message' => $message]);
        } else {
            return redirect('/login')->with('message', $message);
        }
    }

    // /**
    //  * Get the token array structure.
    //  *
    //  * @param  string  $token
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // protected function respondWithToken($token)
    // {
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => auth()->factory()->getTTL() * 60,
    //     ]);
    // }
}
