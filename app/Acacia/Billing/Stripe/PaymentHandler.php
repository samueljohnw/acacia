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

    public function singleCharge($r, $id, $account_id)
    {

        $fee = $this->getFee($r->amount);

        try {

          return \Stripe\Charge::create(
            array(
              "amount" => $r->amount * 100,
              "currency" => "usd",
              "source" => $r->stripeToken,
              "description" => 'From '.$r->email,
              "application_fee" => $fee
            ),
            array("stripe_account" => $account_id));
          } catch(\Stripe\Error\Card $e) {

          }

    }

    public function monthlyCharge($r, $id, $account_id)
    {


        $plan = $this->retrievePlan($r->amount, $account_id);

        if(is_null($plan))
            $plan = $this->createPlan($r->amount, $account_id);

        return \Stripe\Customer::create(array(
          "source" => $r->stripeToken,
          "plan" => $plan->id,
          "email" => $r->email,
          "application_fee_percent" => 2
        ),['stripe_account'=>$account_id]
        );

    }

    public function retrievePlan($plan, $account_id)
    {

        try {
            return \Stripe\Plan::retrieve($plan, ['stripe_account'=>$account_id]);
        } catch (\Stripe\Error\InvalidRequest $e) {

        }
    }

    public function createPlan($plan, $account_id)
    {

        return \Stripe\Plan::create(array(
          "amount" => $plan * 100,
          "interval" => "month",
          "name" => $plan,
          "currency" => "usd",
          "id" => $plan,
        ),['stripe_account'=>$account_id]
        );

    }

    public function getFee($total)
    {
      $admin_fee = ($total * .05) * 100;
      $stripe_fee = $total * .029;
      $stripe_fee = ($stripe_fee * 100) + 30;
      $admin_fee = $admin_fee - $stripe_fee;
      return ceil($admin_fee);
    }

    public function processCheck($amount, $user)
    {
      $user = \App\User::find($user);

      $amount = $amount * 100;
      $fee = $amount * .1;

      $amount = $amount - $fee;

      try{
        return \Stripe\Charge::create(array(
          "amount"   => $amount,
          "currency" => "usd",
          "customer" => env('HOST_CUSTOMER')
        ),['stripe_account'=>$user->recipient_id]
        );
      } catch (\Stripe\Error\InvalidRequest $e) {
        dd($e);
      }
    }
}
