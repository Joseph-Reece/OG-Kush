<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe;
use Session;

class StripePaymentController extends Controller
{
    /**
     * payment view
     */
    public function handleGet()
    {
        return view('frontend.stripe.index');
    }

    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {
        Stripe\Stripe::setApiKey('sk_test_51HvfnBAL3Kt2Ge9VHgaRW031DQ94SnqNz4FolcXhK83isdnlvyXEFGLZ2DBdwcHPVFrCc6lmmUsgBMBItYyyTML4009RXCoSFb');
        Stripe\Charge::create ([
            "amount" => 100 * 150,
            "currency" => "inr",
            "source" => $request->stripeToken,
            "description" => "Making test payment."
        ]);

        Session::flash('success', 'Payment has been successfully processed.');

        return back();
    }
}