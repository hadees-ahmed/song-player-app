<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Billable;

use Stripe\Customer;
use Stripe\PaymentMethod;
use Stripe\Stripe;
use Stripe\Subscription;


class SubscriptionController extends Controller
{
    public function create(){
        return view('subscribtion', ['intent'=> auth()->user()->createSetupIntent()]);
    }

    public function subscription(Request $request){
        dd($request->all(), auth()->user()->paymentMethods());
//        auth()->user()->newSubscription(
//            'default', 'price_1NxslbCRBUY0dUDKDpyEwmw6'
//        )->create($request->);
        Stripe::setApiKey('sk_test_51Nxsk6CRBUY0dUDK05pv5eHQfCJ3Xvua9WttOj6qqFcr621HPzePeWOUcpyWwq49P0G3kecTGHLxzrm9fzmcvR7o00kCqzaj51');

        $customer = auth()->user()->createOrGetStripeCustomer();

        $paymentMethod = PaymentMethod::retrieve('pm_1O00BOCRBUY0dUDKod0dRNuz');

        $paymentMethod->attach(['customer' => $customer->id]);



        // Set your Stripe API key
//        Stripe::setApiKey(config('services.stripe.secret'));

// Create a subscription
        $subscription = Subscription::create([
            'customer' => $customer->id, // The Stripe customer ID
            'items' => [
                [
                    'price' => 'price_1NxslbCRBUY0dUDKDpyEwmw6', // The price ID from your Stripe plan
                ],
            ],
        ]);
    }

}
