<?php
// namespace App\Http\Controllers\Admin; 
// use Illuminate\Support\Facades\Auth; //sama nambah ini tapi keknya ga ngaruh

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pembeli\DashboardPembeliController;
use App\Http\Controllers\Admin\CategoryController;


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

// Route::get('/', 'HomeController@index')->name('home');

// Route::get('/', function () {
//     return view('pages.home');
// });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth:web,pembeli,penjual', 'verified'])->name('dashboard');

// Route::get('/index', function () {
//     return view('index');
// })->middleware(['auth:web,pembeli,penjual', 'verified'])->name('dashboard');

// Route::middleware('auth:web,pembeli,penjual')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__ . '/auth.php';

// Route::get('/details/{id}', 'DetailController@index')->name('detail');

// Route::get('/user/{id}', [UserController::class, 'show']);

// Route::get('/details/{id}', [App\Http\Controllers\Pembeli\DetailController::class, 'index']->name('detail'));

// home pembeli
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// route pembeli
Route::resource('/pembeli/dashboard', DashboardPembeliController::class);

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [CategoryController::class, 'detail'])->name('categories-detail');

Route::get('/details/{id}', [App\Http\Controllers\Pembeli\DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [App\Http\Controllers\Pembeli\DetailController::class, 'add'])->name('detail-add');

Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart')->middleware(['cors']);
Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'delete'])->name('cart-delete');

Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout');
Route::post('/checkout/callback', [App\Http\Controllers\CheckoutController::class, 'callback'])->name('midtrans-callback');
    
Route::get('/success', [App\Http\Controllers\CartController::class, 'success'])->name('success');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/dashboard/products', [App\Http\Controllers\DashboardProductController::class, 'index'])->name('dashboard-product');

Route::get('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductController::class, 'details'])->name('dashboard-product-details');
Route::get('/dashboard/products/add', [App\Http\Controllers\DashboardProductController::class, 'create'])->name('dashboard-product-create');

// Route::get('/dashboard/products/create', [App\Http\Controllers\DashboardProductController::class, 'create'])->name('dashboard-product-create');
Route::post('/dashboard/products', [App\Http\Controllers\DashboardProductController::class, 'store'])->name('dashboard-product-store');

Route::get('/dashboard/transactions', [App\Http\Controllers\DashboardTransactionController::class, 'index'])->name('dashboard-transaction');
Route::get('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionController::class, 'details'])->name('dashboard-transaction-details');

Route::get('/dashboard/settings', [App\Http\Controllers\DashboardSettingController::class, 'store'])->name('dashboard-settings-store');
Route::get('/dashboard/account', [App\Http\Controllers\DashboardSettingController::class, 'account'])->name('dashboard-settings-account');

Route::get('/register/success', [App\Http\Controller\Auth\RegisterController::class, 'success'])->name('register-success');

// Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');

// ->middleware(['auth', 'admin']);
Route::prefix('admin')
    // ->namespace('Admin')
    
    ->namespace('App\Http\Controllers\Admin')
    // namespace aku ganti yang kedua, yang awal yang namespace baris pertama yg tak komen 
    ->group(function() {
        Route::get('/', [App\Http\Controllers\Admin\HomeAdminController::class, 'index'])->name('admin-home');
        Route::resource('category', CategoryController::class);
        Route::resource('toko', TokoController::class);
        Route::resource('user', UserController::class);
        Route::resource('product', ProductController::class);
        Route::resource('product-gallery', ProductGalleryController::class);
    });


//     });
Route::get('/register', [App\Http\Controller\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');

Auth::routes();
// app\Http\Controllers\Auth\AuthenticatedSessionController.php
Route::post('/login/auth', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])->name('login.post');
Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
