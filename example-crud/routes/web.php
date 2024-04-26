<?php

use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductlistController;
use App\Http\Controllers\ProductAjaxController;
use App\Http\Controllers\ResetPasswordController;

use App\Http\Controllers\RazorpayPaymentController;



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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});



require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Route::get('/products-ajax-crud', [ProductAjaxController::class, 'index'])->name('productAjax');
Route::resource('products-ajax-crud', ProductAjaxController::class);

Route::get('products/createCategory', [ProductController::class, 'createCategory'])->name('products.createCategory');
Route::post('/products/storeCategory', [ProductController::class, 'storeCategory'])->name('products.storeCategory');

Route::resource('products', ProductController::class)->except(["index ", "store"]);
Route::post('products', [ProductController::class, 'index'])->name('products.index.post'); 
Route::post('products/store', [ProductController::class, 'store'])->name('products.store');    

Route::post('/products/destroy', [ProductController::class, 'destroyAll'])->name('products.destroyAll');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroySingle');


Route::get('/get-countries', [CountryController::class, 'getCountries']);
Route::get('/get-states/{country}', [StateController::class, 'getStates']);
Route::get('/get-cities/{state}', [CityController::class, 'getCities']);


Route::get('/mainpage', [ProductlistController::class, 'index']);  
Route::get('cart', [ProductlistController::class, 'cart'])->name('cart');
// Route::patch('cart', [ProductlistController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductlistController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [ProductlistController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [ProductlistController::class, 'remove'])->name('remove.from.cart');


Route::get('/razorpay-payment', [RazorpayPaymentController::class, 'index'])->name('razorpay.payment.index');
Route::post('/razorpay-payment', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');

Route::get('/person', [PersonController::class, 'index'])->name('person.index');
Route::delete('/person/{person}', [PersonController::class, 'destroy'])->name('person.destroy');



