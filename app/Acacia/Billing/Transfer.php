<?php 

namespace Acacia\Billing;

use Acacia\Billing\Stripe\TransferHandler;

/**
* For Handling Direct Deposit
*/
class Transfer
{
	
	function __construct(TransferHandler $stripe)
	{
		$this->stripe = $stripe;
	}

	public function transfer($recipient_id,$amount)
	{
		return $this->stripe->transfer($recipient_id, $amount);
	}

}