<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tzsk\Payu\Facade\Payment;
use Tzsk\Payu\Facades\Payu;
class PaymentController extends Controller
{
    // public function showPaymentForm()
    // {
    //     // Your logic to prepare data for the payment form
    //     $paymentData = [
    //         'txnid' => 'your_transaction_id',
    //         'amount' => 'your_amount',
    //         // ... other parameters
    //     ];

    //     // Create a payment instance
    //     $payment = Payment::make($paymentData);

    //     // Redirect to the payment gateway
    //     return $payment->redirect();
    // }
    // public function handleCallback(Request $request)
    // {
    //     // Your logic to handle the callback from the payment gateway
    //     $response = Payment::capture();

    //     // Check the payment status and update your application accordingly
    //     if ($response->isSuccess()) {
    //         // Payment was successful
    //         return response()->json(['message' => 'Payment successful']);
    //     } else {
    //         // Payment failed
    //         return response()->json(['message' => 'Payment failed']);
    //     }
    // }

    public function index()
    {
        return view('Frontend.pay-with-Payumoney');
    }
    public function success(Request $request)
    {
        dd($request);
    }
    public function error()
    {
        dd('Your Payment Has Been Cancel');
    }
}
