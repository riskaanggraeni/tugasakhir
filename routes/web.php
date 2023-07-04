<?php
// namespace App\Http\Controllers\Admin;
// use Illuminate\Support\Facades\Auth; //sama nambah ini tapi keknya ga ngaruh

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pembeli\DashboardPembeliController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardTransactionController;
use App\Models\Role;

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

Route::prefix('categories')->group(function () {
    Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
    Route::get('/{id}', [App\Http\Controllers\CategoryController::class, 'detail'])->name('categories-detail');
});

Route::prefix('details')->group(function () {
    Route::get('/{id}', [App\Http\Controllers\Pembeli\DetailController::class, 'index'])->name('detail');
    Route::post('/{id}', [App\Http\Controllers\Pembeli\DetailController::class, 'add'])->name('detail-add');
});


Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart')->middleware(['cors']);
Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'delete'])->name('cart-delete');

Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout');
Route::post('/checkout/callback', [App\Http\Controllers\CheckoutController::class, 'callback'])->name('midtrans-callback');

Route::get('/success', [App\Http\Controllers\CartController::class, 'success'])->name('success');

Route::prefix('dashboard')->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('products')->group(function () {
        Route::get('/', [App\Http\Controllers\DashboardProductController::class, 'index'])->name('dashboard-product');
        Route::get('/{id}/detail', [App\Http\Controllers\DashboardProductController::class, 'details'])->name('dashboard-product-details');
        Route::get('/create', [App\Http\Controllers\DashboardProductController::class, 'create'])->name('dashboard-product-create');
        Route::post('/store', [App\Http\Controllers\DashboardProductController::class, 'store'])->name('dashboard-product-store');
        Route::post('/{id}/edit', [App\Http\Controllers\DashboardProductController::class, 'update'])->name('dashboard-product-update');

        Route::prefix('galleries')->group(function () {
            Route::post('/upload', [App\Http\Controllers\DashboardProductController::class, 'uploadGallery'])->name('dashboard-product-gallery-upload');
            Route::post('/{id}', [App\Http\Controllers\DashboardProductController::class, 'deleteGallery'])->name('dashboard-product-gallery-delete');
        });
    });
    
    // Route::patch('/orders/{orderId}/mark-as-received', [OrderController::class, 'markAsReceived'])->name('orders.markAsReceived');



    Route::get('/transactions', [App\Http\Controllers\DashboardTransactionController::class, 'index'])->name('dashboard-transaction');
    Route::post('/transactions/confirm/{id}', [App\Http\Controllers\DashboardTransactionController::class, 'confirm'])->name('dashboard-transaction-confirm');
    Route::get('/transactions/{id}', [App\Http\Controllers\DashboardTransactionController::class, 'details'])->name('dashboard-transaction-details');
    Route::get('/transactions/{id}/update', [App\Http\Controllers\DashboardTransactionController::class, 'update'])->name('dashboard-transaction-update');

    Route::get('/settings', [App\Http\Controllers\DashboardSettingController::class, 'store'])->name('dashboard-settings-store');
    Route::get('/account', [App\Http\Controllers\DashboardSettingController::class, 'account'])->name('dashboard-settings-account');
    Route::get('/account{redirect}', [App\Http\Controllers\DashboardSettingController::class, 'update'])->name('dashboard-settings-redirect');
});



// Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');

// ->middleware(['auth', 'admin']);
Route::prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    // ->middleware('auth', 'admin')
    ->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\HomeAdminController::class, 'index'])->name('admin-home');
        Route::resource('category', CategoryController::class);
        Route::resource('toko', TokoController::class);
        Route::resource('user', UserController::class);
        Route::resource('product', ProductController::class);
        Route::resource('product-gallery', ProductGalleryController::class);
        Route::resource('transaction', TransactionController::class);
    });


//     });
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::get('/register/success', [RegisterController::class, 'success'])->name('register-success');
Auth::routes();


// app\Http\Controllers\Auth\AuthenticatedSessionController.php
Route::post('/login/auth', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])->name('login.post');
Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
