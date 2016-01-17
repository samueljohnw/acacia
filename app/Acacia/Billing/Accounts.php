<?php

namespace Acacia\Billing;

use Acacia\Billing\Stripe\AccountsHandler;

class Accounts
{

  function __construct(AccountsHandler $account) {
    $this->account = $account;
  }

  public function create($email)
  {
  	return $this->account->create($email);
  }

  // public function verify_recipient($recipient_id, $tax_id)
  // {
  // 	return $this->stripe->verify_recipient($recipient_id, $tax_id);
  // }

}
