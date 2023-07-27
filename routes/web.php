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

// Authentication
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

Route::post('/addtocart', [CartController::class, 'addToCart'])
  ->name('addtocart')
  ->middleware('auth');

Route::patch('/updatecart', [CartController::class, 'updateCart'])
  ->name('updatecart')
  ->middleware('auth');

Route::delete('removefromcart', [CartController::class, 'removeFromCart'])
  ->name('removefromcart')
  ->middleware('auth');

// OrderHistory
Route::get('/orderhistory', [OrderHistoryController::class, 'showOrderHistory'])
  ->name('orderhistory')
  ->middleware('auth');

// About
Route::get('/about', [AboutController::class, 'showAbout'])
  ->name('about')
  ->middleware('auth');