<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    public function paypal(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $reponse = $provider->createOrder([
            "intent" => "CAPTURE",
            'application_context' => [
                'return_url' => route('success'),
                'cancel_url' => route('cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->amount,
                    ]
                ]
            ]
        ]);
          // Check if 'id' key exists in the response array
          if (isset($reponse['id']) && $reponse['id'] !== null) {
            // Check if 'links' key exists in the response array
            if (isset($response['links'])) {
                foreach ($reponse['links'] as $link) {
                    // Check if 'rel' key exists in the link array
                    if (isset($link['rel']) && $link['rel'] === 'approve') {
                        session()->put('service', $request->service);
                        session()->put('product_quantity', $request->product_quantity);
                        return redirect()->away($link['href']);
                    }
                }
            }
        } else {
            return redirect()->route('cancel');
        }
    }
    public function success(Request $request)
    {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        // dd($response);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // Insert into DB
            $payment = new Payment();
            $payment->payment_id = $response['id'];
            $payment->product_name = session()->get('service');
            $payment->product_name = session()->get('product_quantity');
            $payment->first_name = session()->get('first_name');
            $payment->last_name = session()->get('last_name');
            $payment->phone = session()->get('phone');
            $payment->email = session()->get('email');
            $payment->date = session()->get('date');
            $payment->time = session()->get('time');
            $payment->product_quantity = session()->get('product_quantity');
            $payment->price = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $payment->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $payment->payer_name = $response['payer']['name']['given_name'];
            $payment->payer_email = $response['payer']['email_address'];
            $payment->payment_status = $response['status'];
            $payment->payment_method = 'PayPal';
            $payment->save();

            return 'Payement is Successfully';
            unset($_SESSION['service']);
            unset($_SESSION['product_quantity']);
        } else {
            return redirect()->route('cancel');
        }
    }
    public function cancel()
    {
        return 'Payment is Canncelled.';
    }
}
