<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function showAmountInputForm()
    {
        return view('payment.input-amount');
    }

    public function checkout(CheckoutRequest $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $amount = $request->input('amount');
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => '飲食店予約の決済',
                    ],
                    'unit_amount' => $amount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);
        return redirect($session->url);
    }

    public function success()
    {
        return view('payment.success');
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}
