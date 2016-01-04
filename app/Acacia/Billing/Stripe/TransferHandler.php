<?php

namespace Acacia\Billing\Stripe;

/**
* Handling Stripe Transfers
*/
class TransferHandler
{
	
    function __construct()
    {
        \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));
    }

    public function transfer($recipient_id, $amount)
    {
		
        try {
			return \Stripe\Transfer::create(
				[
					"amount" => $amount,
					"currency" => "usd",
					"recipient" => $recipient_id
				]
			);
        } catch(\Stripe\Error $e) {

        }

    }
}