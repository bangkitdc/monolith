<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
  /**
   * Display the about
   *
   * @return \Illuminate\Http\Response
   */
  public function showAbout(Request $request)
  {
    // Get the currently authenticated user
    $user = $request->user();

    // Pass the $cart data to the view as an array
    return view('pages/about', ['user' => $user]);
  }
}
