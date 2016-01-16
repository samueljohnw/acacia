<?php

namespace Acacia\Billing;

use Acacia\Billing\Stripe\PaymentHandler;

class Charge
{

  function __construct(PaymentHandler $stripe) {
    $this->stripe = $stripe;
  }

  public function charge($r, $id)
  {
    if($r->monthly)
      return $this->stripe->monthlyCharge($r, $id);

    return $this->stripe->singleCharge($r, $id);
  }

}
