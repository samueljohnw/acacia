<?php
namespace Acacia\Billing\Stripe;

/**
*  Handling Stripe Payments
*/

class PaymentHandler
{


    function __construct()
    {
        \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));
    }

    public function singleCharge($r, $id)
    {
        try {
          return \Stripe\Charge::create(array(
                "amount" => $r->amount * 100,
                "currency" => "usd",
                "source" => $r->stripeToken,
                "description" => $r->email
            ));

        } catch(\Stripe\Error\Card $e) {
        
        }

    }

    public function monthlyCharge($r, $id)
    {

        $plan = $this->retrievePlan($r->amount);

        if(is_null($plan))
            $plan = $this->createPlan($r->amount);

        return \Stripe\Customer::create(array(
          "source" => $r->stripeToken,
          "plan" => $plan->id,
          "email" => $r->email)
        );

    }

    public function retrievePlan($plan)
    {

        try {
            return \Stripe\Plan::retrieve($plan);
        } catch (\Stripe\Error\InvalidRequest $e) {

        }
    }

    public function createPlan($plan)
    {

        return \Stripe\Plan::create(array(
          "amount" => $plan * 100,
          "interval" => "month",
          "name" => $plan,
          "currency" => "usd",
          "id" => $plan)
        );

    }

}
