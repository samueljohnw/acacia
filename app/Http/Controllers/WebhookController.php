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

    public function invoice_failed()
    {

    	// Grabing the customer data from the webhook
        $customer = $this->monthly->invoice_failed();
        $customer_id = $customer->customer;

        // Getting the monthly from our database
        $monthly = \App\Monthly::where('customer_id',$customer_id)->firstOrFail();

		// Delete from this month's donations table
		$donation = \App\Donation::where('transaction_id',$customer_id)->whereBetween('created_at',[Carbon::now()->firstOfMonth()->format('Y-n-d'),Carbon::now()->lastOfMonth()->format('Y-n-d')])->firstOrFail();
		$donation->delete();
        
        // Send Email to notify them their donation is stopped.
		$this->transaction->invoice_failed($monthly->name, $monthly->email);

        // Delete from monthlies table
		$monthly->delete();

        // Delete customer on Stripe
        $this->monthly->delete($customer_id);

    }

}
