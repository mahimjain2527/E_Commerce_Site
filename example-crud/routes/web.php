<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureUserIsAuthenticated;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductlistController;
use App\Http\Controllers\ProductAjaxController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\OrderController;

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
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

// Route::middleware([EnsureUserIsAuthenticated::class])->group(function () {
//     Route::resource('products', ProductController::class)->except(["index ", "store"]);
//     Route::post('products/post', [ProductController::class, 'index'])->name('products.index.post'); 
//     Route::post('products/store', [ProductController::class, 'store'])->name('products.store');    
//     Route::post('/products/destroy', [ProductController::class, 'destroyAll'])->name('products.destroyAll');
//     Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroySingle');
// });

 Route::middleware(['auth.custom'])->group(function () {
    Route::get('products', [ProductController::class,'index']);
    
    // Route::post('products/post', [ProductController::class, 'index'])->name('products.index.post'); 
    // Route::post('products/store', [ProductController::class, 'store'])->name('products.store');    
    // Route::post('/products/destroy', [ProductController::class, 'destroyAll'])->name('products.destroyAll');
    // Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroySingle');
 });




require __DIR__.'/auth.php';

Auth::routes();
// Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ****** Verify Email Route *******
Route::get('/verify-email',[VerifyController::class, 'verifymail'])->name('products.verifymail');
Route::get('/email/verify/{id}', [VerifyController::class, 'verify'])->name('products.verify')->middleware('signed');


// Route::get('/login', 'Auth\LoginController@authenticated')->middleware('guest');



// Route::get('/products-ajax-crud', [ProductAjaxController::class, 'index'])->name('productAjax');
Route::resource('products-ajax-crud', ProductAjaxController::class);



// ***** New Category Route *****
Route::get('products/createCategory', [ProductController::class, 'createCategory'])->name('products.createCategory');
Route::post('/products/storeCategory', [ProductController::class, 'storeCategory'])->name('products.storeCategory');



// ***** ProductController Routes *****
// Route::resource('products', ProductController::class)->except(["index ", "store"]);
Route::get('products/index', [ProductController::class, 'index'])->name('products.index');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit'); 
Route::any('products/update/{id}', [ProductController::class, 'update'])->name('products.update'); 
Route::post('products/post', [ProductController::class, 'index'])->name('products.index.post'); 
Route::post('products/store', [ProductController::class, 'store'])->name('products.store');    
Route::post('/products/destroy', [ProductController::class, 'destroyAll'])->name('products.destroyAll');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroySingle');



// ***** Country,State,City Dropdown Route *****
Route::get('/get-countries', [CountryController::class, 'getCountries']);
Route::get('/get-states/{country}', [StateController::class, 'getStates']);
Route::get('/get-cities/{state}', [CityController::class, 'getCities']);




// ***** Add to cart Route *****
Route::get('/mainpage', [ProductlistController::class, 'index']);  
Route::get('cart', [ProductlistController::class, 'cart'])->name('cart');
// Route::patch('cart', [ProductlistController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductlistController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [ProductlistController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [ProductlistController::class, 'remove'])->name('remove.from.cart');



// ***** Razorpay Route *****
Route::get('/razorpay-payment', [RazorpayPaymentController::class, 'index'])->name('razorpay.payment.index');
Route::post('/razorpay-payment', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');



// ***** Sample Task Route ******
Route::get('/person', [PersonController::class, 'index'])->name('person.index');
Route::delete('/person/{person}', [PersonController::class, 'destroy'])->name('person.destroy');


Route::get('products/orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('products/orders/list', [OrderController::class, 'list'])->name('orders.list');




