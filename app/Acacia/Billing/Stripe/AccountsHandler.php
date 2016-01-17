<?php
namespace Acacia\Billing\Stripe;

/**
*  Creating and Managing Stripe Recipient
*/

class AccountsHandler
{


    function __construct()
    {
        \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));
    }

    public function create($email)
    {
        try {
            return \Stripe\Account::create(array(
                      "managed" => true,
                      "country" => "US",
                      "email" => $email
                    ));
        } catch(\Stripe\Error\Card $e) {

        }

    }

    // public function verify_recipient($recipient_id, $tax_id)
    // {
    //     $recipient = $this->retrieve_recipient($recipient_id);
    //     $recipient->tax_id = $tax_id;
    //     $recipient->save();
    //     return $recipient;
    // }
    //
    // public function retrieve_recipient($recipient_id)
    // {
    //     return \Stripe\Recipient::retrieve($recipient_id);
    // }

}
