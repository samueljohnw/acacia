<?php

namespace Acacia\Billing;

use Acacia\Billing\Stripe\RecipientHandler;

class Recipient
{

  function __construct(RecipientHandler $stripe) {
    $this->stripe = $stripe;
  }

  public function create_recipient($user, $type, $token)
  {
  	return $this->stripe->create_recipient($user, $type, $token);
  }

  public function verify_recipient($recipient_id, $tax_id)
  {
  	return $this->stripe->verify_recipient($recipient_id, $tax_id);
  }

}
