<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateSubscriptionController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        $name = 'main';

        $plan = 'stir-yearly';

        if(!$user->subscribed($name, $plan)) {

            $result = $user->newSubscriptionViaMollieCheckout($name, $plan)->create();

            if(is_a($result, RedirectToCheckoutResponse::class)) {
                return $result; // Redirect to Mollie checkout
            }

            return back()->with('status', 'Welcome to the ' . $plan . ' plan');
        }
        return route('posts.index');
    }
}
