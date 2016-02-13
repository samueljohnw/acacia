<?php

namespace Acacia\Billing;

use Acacia\Billing\Stripe\PaymentHandler;

class Charge
{

  function __construct(PaymentHandler $stripe) {
    $this->stripe = $stripe;
  }

  public function charge($r, $id, $account_id)
  {
    if($r->monthly)
      return $this->stripe->monthlyCharge($r, $id, $account_id);

    return $this->stripe->singleCharge($r, $id, $account_id);
  }

  public function check($amount)
  {
    return $this->stripe->processCheck($amount);
  }

}
