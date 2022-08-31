<?php

use App\Http\Controllers\CreateSubscriptionController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('paid', [CreateSubscriptionController::class, 'handleWebhookNotification'])->name('subscription.paid');
Route::post('product/bought', [ProductController::class, 'handleWebhookNotification'])->name('products.paid');


