<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Cashier\SubscriptionBuilder\RedirectToCheckoutResponse;
use Mollie\Laravel\Facades\Mollie;

class CreateSubscriptionController extends Controller
{

    public function preparePayment()
    {
        $user = auth()->user();

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => "30.00" // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            "description" => "STIR Lidmaatschap",
            "redirectUrl" => route('subscription.subscribed', ['user' => $user->id]),
            "webhookUrl" => route('subscription.paid'),
            "metadata" => [
                "user_id" => $user->id
            ],
        ]);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function handleWebhookNotification(Request $request) {
        $paymentId = $request->input('id');
        $payment = Mollie::api()->payments->get($paymentId);

        $user = User::find($payment->metadata->user_id);

        if ($payment->isPaid())
        {
            $user->member_until = now()->addYear();
            $user->save();
        }
    }

    public function subscribedView(Request $request) {
        $user = auth()->user();
        return view('products.subscribed', compact('user'));
    }
}
