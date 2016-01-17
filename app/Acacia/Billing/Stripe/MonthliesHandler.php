<?php
namespace Acacia\Billing\Stripe;

/**
*  Handling Stripe Payments
*/

class MonthliesHandler
{


    function __construct()
    {
        \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));
    }

    public function delete($customer_id, $account_id)
    {
		$cu = \Stripe\Customer::retrieve($customer_id,['stripe_account'=> $account_id]);
		return $cu->delete();
    }

    public function invoice_failed()
    {
      http_response_code(200);
  		$input = @file_get_contents("php://input");
  		$event_json = json_decode($input);

  	  return $event_json->data->object;

    }
}
