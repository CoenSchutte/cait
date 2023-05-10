<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserEventRegistrationsController;
use App\Models\Product;
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

    //get /shop and redirect to products.index
    Route::get('/shop', function () {
        return redirect()->route('products.index');
    });

    Route::get('happen', function () {
        $product = Product::where('is_displayed', 1)->where('name', 'LIKE', '%happen met stir%')->orderBy('created_at', 'desc')->first();
        return redirect()->route('products.show', ['product' => $product]);
    });

    Route::get('kerst', function () {
        $product = Product::where('is_displayed', 1)->where('name', 'LIKE', '%kerstdiner%')->orderBy('created_at', 'desc')->first();

        if (!$product) {
            return redirect()->route('products.index');
        }

        return redirect()->route('products.show', ['product' => $product]);
    });

    Route::get('casino', function () {
        $post = Post::where('title', 'LIKE', '%casino%')->orderBy('created_at', 'desc')->first();
        return redirect()->route('posts.show', ['post' => $post]);
    });

    Route::get('netwerkdiner', function () {
        $post = Post::where('title', 'LIKE', '%netwerkdiner%')->orderBy('created_at', 'desc')->first();
        return redirect()->route('posts.show', ['post' => $post]);
    });

    Route::get('movie', function () {
        $post = Post::where('title', 'LIKE', '%movie night%')->orderBy('created_at', 'desc')->first();
        return redirect()->route('posts.show', ['post' => $post]);
    });


    Route::get('akida', function () {
        $post = Post::where('subtitle', 'LIKE', '%akida%')->orderBy('created_at', 'desc')->first();
        $post->image_url = $post->fileUrl();
        $registration = $post->registration;
        return view('posts.show', compact('post', 'registration'));
    });

    Route::get('user/profile', function () {
        $invoices = \App\Models\Invoice::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);
        $user = auth()->user();
        return view('profile.show', compact('user', 'invoices'));
    })->name('profile.show');

//    Route::get('/about', function () {
//        return view('about');
//    })->name('about');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    Route::get('/partners', function () {
        return view('partners');
    })->name('partners');

    //get /enquete and redirect to https://forms.gle/ZHYJydLfkvXsoH7D8
    Route::get('/enquete', function () {
        return redirect('https://forms.gle/ZHYJydLfkvXsoH7D8');
    });

    Route::get('/13dec', function () {
        $post = Post::where('title', 'LIKE', '%Gastcollege Exact%')->orderBy('created_at', 'desc')->first();
        return redirect()->route('posts.show', ['post' => $post]);
    });


    Route::resource('posts', PostController::class);

    Route::resource('products', ProductController::class);

    Route::post('/products/add-to-cart', [CartController::class, 'addToCart'])->name('products.add-to-cart');
    Route::post('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('products.remove-from-cart');

    Route::post('events/{event}/register', [UserEventRegistrationsController::class, 'store'])->name('events.register');
    Route::delete('events/{event}/unregister', [UserEventRegistrationsController::class, 'destroy'])->name('events.unregister');

    Route::get('/vacatures', [PostController::class, 'vacatures'])->name('posts.vacatures');


    Route::post('/change-password', [UserController::class, 'changePassword'])->name('user.change-password');

    Route::group(['middleware' => ['admin']], function () {
        Route::prefix('admin')->group(function () {

            //Niet zo interessant, alleen ter demonstratie dat je routes kan afschermen
            Route::get('/posts', function () {
                $posts = Post::orderByDesc('created_at')->get();

                $posts->map(function ($post) {
                    $post->image_url = $post->get4by3Attribute();
                });
                return view('posts.index', compact('posts'));
            });
        });
    });


    //auth middleware
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/pay', [\App\Http\Controllers\CreateSubscriptionController::class, 'preparePayment'])->name('subscription.create');
        Route::get('/subscribed', [\App\Http\Controllers\CreateSubscriptionController::class, 'subscribedView'])->name('subscription.subscribed');

        Route::get('/checkout', [ProductController::class, 'checkout'])->name('products.checkout');

        Route::post('products/buy', [ProductController::class, 'preparePayment'])->name('products.buy');

        Route::get('/success/{invoice}', [ProductController::class, 'success'])->name('products.success');


        Route::prefix('user')->group(function () {
            Route::post('/update', [UserController::class, 'update'])->name('user.update');


        });
    });

});
