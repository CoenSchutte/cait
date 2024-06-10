<?php
use App\Http\Controllers\CreateSubscriptionController;
use App\Http\Controllers\ProductController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;


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


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/test-csrf', fn () => [1, 2, 3]);

    Route::post('logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->noContent();
    });


});

Route::post('/login', function(Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();


    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return response()->json([
        'token' => $user->createToken($request->device_name)->plainTextToken,
    ]);
});

Route::post('/register', function(Request $request) {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'student_number' => 'required|string|max:7',
        'device_name' => 'required'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'student_number' => $request->student_number,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));

    return response()->json([
        'token' => $user->createToken($request->device_name)->plainTextToken,
    ]);
});

Route::post('/forgot-password', function (Request $request) {
    $status = Password::sendResetLink(
        $request->only('email')
    );

    if($status != Password::RESET_LINK_SENT) {
        throw ValidationException::withMessages([
            'email' => [__($status)]
        ]);
    }

    return response()->json(['status' => __($status)]);

});



// group routes with prefix api
Route::prefix('v1')->middleware(['cors'])->group(function () {

    Route::get('posts' , function () {
        $posts = Post::where('is_featured', true)->where('is_published', true)->take(4)->orderBy('created_at', 'desc')->get();

        $posts->map(function ($post) {
            $post->image_url = $post->get16by9Attribute();
            $post->preview_url = $post->preview();
        });

        return response()->json($posts);
    });



});
