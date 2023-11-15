<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function create()
    {
       return view('subscription', [
           'intent' => auth()->user()->createSetupIntent()
       ]);
    }

    public function store(String $paymentMethod)
    {
        auth()->user()->createOrGetStripeCustomer();

        auth()->user()->addPaymentMethod($paymentMethod);

        auth()->user()->newSubscription(
            'default', 'price_1NxslbCRBUY0dUDKDpyEwmw6'
        )->create($paymentMethod);
    }

    public function confirm()
    {
        return view('subscriptions.confirm');
    }
}

