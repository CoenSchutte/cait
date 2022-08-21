<?php

use App\Http\Controllers\CreateSubscriptionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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


    Route::get('/about', function () {
        return view('about');
    })->name('about');

    Route::resource('posts', PostController::class);


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
        Route::get('/pay', CreateSubscriptionController::class)->name('subscription.create');

        Route::prefix('user')->group(function () {
            Route::post('/update', [UserController::class, 'update'])->name('user.update');

        });
    });

});
