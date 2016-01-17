<?php

namespace Acacia\Billing;

use Acacia\Billing\Stripe\MonthliesHandler;

class Monthlies
{

	function __construct(MonthliesHandler $stripe) {
		$this->stripe = $stripe;
	}

	public function delete($customer_id, $account_id)
	{
		return $this->stripe->delete($customer_id, $account_id);
	}

	public function invoice_failed()
  	{
  		return $this->stripe->invoice_failed();
  	}

}
