<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Catalog\CartController;
use App\Http\Controllers\Catalog\CatalogController;
use App\Http\Controllers\Catalog\OrderHistoryController;
use Illuminate\Http\RedirectResponse;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return new RedirectResponse('/login');
});

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])
  ->name('login');
Route::post('/login', [LoginController::class, 'login'])
  ->name('login.post');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])
  ->name('register');
Route::post('/register', [RegisterController::class, 'register'])
  ->name('register.post');

Route::post('/logout', [LoginController::class, 'logout'])
  ->name('logout');

// Catalog
Route::get('/catalog', [CatalogController::class, 'showCatalog'])
  ->name('catalog')
  ->middleware('auth');

Route::put('/catalog', [CatalogController::class, 'updateCatalog'])
  ->name('catalog.put')
  ->middleware('auth');

Route::get('/catalog/{id}', [CatalogController::class, 'showProductDetails'])
  ->name('productDetails')
  ->middleware('auth');

// Cart
Route::get('/cart', [CartController::class, 'showCart'])
  ->name('cart')
  ->middleware('auth');

Route::post('/addToCart/{id}', [CartController::class, 'addToCart'])
  ->name('addToCart')
  ->middleware('auth');

Route::patch('/updateCart', [CartController::class, 'updateCart'])
  ->name('updateCart')
  ->middleware('auth');

Route::delete('removeFromCart', [CartController::class, 'removeFromCart'])
  ->name('removeFromCart')
  ->middleware('auth');

// Order-History
Route::get('/orderHistory', [OrderHistoryController::class, 'showOrderHistory'])
  ->name('orderHistory')
  ->middleware('auth');

// About
Route::get('/about', [AboutController::class, 'showAbout'])
  ->name('about')
  ->middleware('auth');