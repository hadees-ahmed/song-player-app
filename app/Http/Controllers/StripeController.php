<?php

namespace App\Http\Controllers;

use Error;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function create(){
        $stripeSecretKey = 'sk_test_51Nxsk6CRBUY0dUDK05pv5eHQfCJ3Xvua9WttOj6qqFcr621HPzePeWOUcpyWwq49P0G3kecTGHLxzrm9fzmcvR7o00kCqzaj51';
        $stripe = new \Stripe\StripeClient($stripeSecretKey);

//        function calculateOrderAmount(array $items): int {
//            // Replace this constant with a calculation of the order's amount
//            // Calculate the order total on the server to prevent
//            // people from directly manipulating the amount on the client
//            return 1400;
//        }

        header('Content-Type: application/json');

        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            // Create a PaymentIntent with amount and currency
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => \request('price'),
                'currency' => 'gbp',
                // In the latest version of the API, specifying the `automatic_payment_methods` parameter is optional because Stripe enables its functionality by default.
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);


            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            echo json_encode($output);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }

    }
}
