<?php
use App\Http\Controllers\CreateSubscriptionController;
use App\Http\Controllers\ProductController;
use App\Models\EventRegistration;
use App\Models\Post;
use App\Models\User;
use App\Models\UserEventRegistration;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    Route::post('/events/{eventId}/register', function ($eventId)
    {
        $user = Auth::user();
        $event = EventRegistration::findOrFail($eventId);

        if ($event->registration_start <= now() && $event->registration_end >= now()) {
            if ($event->attendees()->where('user_id', $user->id)->exists()) {
                return response()->json(['message' => 'Je bent al aangeneld'], 400);
            }

            if ($event->availableSeats() > 0) {
                // Create a new UserEventRegistration entry
                UserEventRegistration::create([
                    'user_id' => $user->id,
                    'event_registration_id' => $event->id,
                ]);

                return response()->json(['message' => 'Aanmelding succesvol']);
            } else {
                return response()->json(['message' => 'Geen plek meer beschikbaar'], 400);
            }
        }

        return response()->json(['message' => 'De registratie is niet geopend'], 400);
    });

    Route::delete('/events/{eventId}/unregister', function ($eventId){
        $user = Auth::user();
        $event = EventRegistration::findOrFail($eventId);

        if ($event->attendees()->where('user_id', $user->id)->exists()) {
            $event->attendees()->where('user_id', $user->id)->delete();
            return response()->json(['message' => 'Je bent afgemeld']);
        }

        return response()->json(['message' => 'Je bent niet aangemeld voor dit evenement'], 400);
    }
    );

    Route::get('posts/{post}' , function ($id) {
        $post = Post::where('id', $id)->first();

        $post->image_url = $post->get16by9Attribute();
        $post->preview_url = $post->preview();
        $post->registration = $post->registration;

        if($post->registration) {
            $post->registration->available_seats = $post->registration->availableSeats();
        }

        // Check if the user is registered for this event
        $user = Auth::user();
        if ($user && $post->registration) {
            $post->registration->is_registered = $post->registration->attendees()->where('user_id', $user->id)->exists();
        }

        return response()->json($post);
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

Route::get('posts', function () {
    $posts = Post::where('is_published', true)
        ->orderBy('created_at', 'desc')
        ->with('media') // Eager load the media relationship
        ->get();

    $posts->map(function ($post) {
        $post->image_url = $post->get16by9Attribute();
        $post->preview_url = $post->preview();
    });

    return response()->json($posts);
});






// group routes with prefix api
Route::prefix('v1')->middleware(['cors'])->group(function () {





});
