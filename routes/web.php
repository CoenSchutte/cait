<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserEventRegistrationsController;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('welcome');

    Route::get('/membership', function () {
        return view('membership');
    })->name('membership');

    Route::get('/shop', function () {
        return redirect()->route('products.index');
    });


//    Route::get('/about', function () {
//        return view('about');
//    })->name('about');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    Route::get('/partners', function () {
        return view('partners');
    })->name('partners');



    Route::resource('post', PostController::class);

    Route::resource('products', ProductController::class);

    Route::post('/products/add-to-cart', [CartController::class, 'addToCart'])->name('products.add-to-cart');
    Route::post('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('products.remove-from-cart');

    Route::post('events/{event}/register', [UserEventRegistrationsController::class, 'store'])->name('events.register');
    Route::delete('events/{event}/unregister', [UserEventRegistrationsController::class, 'destroy'])->name('events.unregister');

    Route::get('/vacatures', [PostController::class, 'vacatures'])->name('post.vacatures');


    Route::post('/change-password', [UserController::class, 'changePassword'])->name('user.change-password');



    //auth middleware
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/pay', [\App\Http\Controllers\CreateSubscriptionController::class, 'preparePayment'])->name('subscription.create');
        Route::get('/subscribed', [\App\Http\Controllers\CreateSubscriptionController::class, 'subscribedView'])->name('subscription.subscribed');

        Route::get('/checkout', [ProductController::class, 'checkout'])->name('products.checkout');

        Route::post('products/buy', [ProductController::class, 'preparePayment'])->name('products.buy');

        Route::get('/success/{invoice}', [ProductController::class, 'success'])->name('products.success');


        Route::prefix('user')->group(function () {
            Route::post('/update', [UserController::class, 'update'])->name('user.update');

            Route::get('profile', function () {
                $invoices = \App\Models\Invoice::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);
                $user = auth()->user();
                return view('profile.show', compact('user', 'invoices'));
            })->name('profile.show');
        });
    });

});
