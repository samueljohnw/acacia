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

    public function delete($customer_id)
    {
		$cu = \Stripe\Customer::retrieve($customer_id);
		return $cu->delete();
    }

    public function invoice_failed()
    {
	
		$input = @file_get_contents("php://input");
		$event_json = json_decode($input);

	    return $event_json->data->object;

		http_response_code(200); 
    
    }
}