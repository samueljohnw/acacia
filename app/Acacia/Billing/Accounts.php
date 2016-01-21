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

}
