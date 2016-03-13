<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Acacia\Billing\Charge;
use Acacia\Billing\Monthlies;
use \Carbon\Carbon;
use \Acacia\Email\Transactional;

class WebhookController extends Controller
{

    function __construct(Charge $charge, Monthlies $monthlies, Transactional $transaction) {
        $this->charge = $charge;
        $this->monthly = $monthlies;
        $this->transaction = $transaction;
    }

    public function invoice_succeed()
    {
      http_response_code(200);
      $input = @file_get_contents("php://input");
      $event_json = json_decode($input);

      return $event_json->data->object;
    }

    public function invoice_failed()
    {

    	// Grabing the customer data from the webhook
      $customer = $this->monthly->invoice_failed();

      // $customer_id = 'cus_7jUwnLVSfxsrg2';
      $customer_id = $customer->customer;


      // Getting the monthly from our database
      $monthly = \App\Monthly::where('customer_id',$customer_id)->firstOrFail();
      $account_id = \App\User::find($monthly->user_id)->recipient_id;

  		// Delete from this month's donations table
  		$donation = \App\Donation::where('transaction_id',$customer_id)->whereBetween('created_at',[Carbon::now()->firstOfMonth()->format('Y-n-d'),Carbon::now()->lastOfMonth()->format('Y-n-d')])->firstOrFail();
  		$donation->delete();

      // Send Email to notify them their donation is stopped.
  		$this->transaction->invoice_failed($monthly->name, $monthly->email, $account_id);

      // Delete from monthlies table
  		$monthly->delete();

      // Delete customer on Stripe
      $this->monthly->delete($customer_id, $account_id);

    }

}
