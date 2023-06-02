<?php
// namespace App\Http\Controllers\Admin; 
// use Illuminate\Support\Facades\Auth; //sama nambah ini tapi keknya ga ngaruh

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Admin\CategoryController;



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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'detail'])->name('categories-detail');

Route::get('/details/{id}', [App\Http\Controllers\Pembeli\DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [App\Http\Controllers\Pembeli\DetailController::class, 'add'])->name('detail-add');

Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart')->middleware(['cors']);
Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'delete'])->name('cart-delete');

Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');
    
Route::get('/success', [App\Http\Controllers\CartController::class, 'success'])->name('success');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/dashboard/products', [App\Http\Controllers\Penjual\DashboardProductController::class, 'index'])->name('dashboard-product');

Route::get('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductController::class, 'details'])->name('dashboard-product-details');
Route::get('/dashboard/products/add', [App\Http\Controllers\DashboardProductController::class, 'create'])->name('dashboard-product-create');

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

// Route::prefix('pembeli')
//     // ->namespace('Admin')
//     ->namespace('App\Http\Controllers\Pembeli')
//     // namespace aku ganti yang kedua, yang awal yang namespace baris pertama yg tak komen 
//     ->group(function() {
//         // Route::get('/', [App\Http\Controllers\Pembeli\HomeAdminController::class, 'index'])->name('admin-home');
//         Route::resource('detail', DetailController::class);
//         // Route::resource('toko', TokoController::class);
//         // Route::resource('user', UserController::class);
//         // Route::resource('product', ProductController::class);
//         // Route::resource('product-gallery', ProductGalleryController::class);
//     });
Route::get('/register', [App\Http\Controller\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');

Auth::routes();
// app\Http\Controllers\Auth\AuthenticatedSessionController.php
Route::post('/login/auth', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])->name('login.post');