<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Acacia\Billing\Charge;
use Acacia\Email\Transactional;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{

    function __construct(Charge $billing, Transactional $transaction)
    {
      $this->billing = $billing;
      $this->transaction = $transaction;
    }


    public function show($slug)
    {
      $user = \App\User::where('slug',$slug)->firstOrFail();
      return view('pages.public.give',['user'=>$user]);
    }

    public function process(Request $r, $id)
    {
       
      $r->amount = str_replace('$', '', $r->amount);
      \DB::transaction(function () use($r, $id) {

          $category = 'O';
          $user = \App\User::find($id);

          $charge = $this->billing->charge($r, $id, $user->recipient_id);

          if($r->monthly){
            $category = 'M';;
            $last4 = $charge->sources->data[0]->last4;
          }else {
            $fee = $r->amount *.05;
            $last4 = $charge->source->last4;
          }

          $singleDonation =
            [
              'user_id'         =>  $id,
              'first_name'      =>  $r->first_name,
              'last_name'       =>  $r->last_name,
              'email'           =>  $r->email,
              'amount'          =>  $r->amount,
              'transaction_id'  =>  $charge['id'],
              'category'        =>  $category,
              'created_at'     =>  \Carbon\Carbon::now()
            ];

            \App\Donation::create($singleDonation);

            $monthlyDonation =
            [
              'user_id'         =>  $id,
              'first_name'      =>  $r->first_name,
              'last_name'       =>  $r->last_name,
              'email'           =>  $r->email,
              'amount'          =>  $r->amount,
              'customer_id'     =>  $charge['id'],
            ];

          if($r->monthly)
            \App\Monthly::create($monthlyDonation);

          $name = $r->first_name.' '.$r->last_name;
          $user = \App\User::find($id);
          $missionary = $user->first_name.' '.$user->last_name;
          $this->transaction->sendReceipt($name, $r->email, $r->amount, \Carbon\Carbon::now()->format('F j, Y'), $missionary, $last4);
      });

      return redirect('thank-you');

    }

    public function check_request(Request $r)
    {
      return $this->transaction->check_request($r->name,$r->email, $r->user);
    }

    public function processCheck(Request $r)
    {
        $check_id = $r->check_id;
        $processed = \App\CheckLog::where('check_id',$check_id)->first();

        if(is_null($processed) ){
          \DB::transaction(function () use ($check_id) {
            $check = \App\Check::find($check_id);
            $this->billing->check($check->amount);
            return \App\CheckLog::create(['check_id' =>  $check->id]);
          });
        }

        return;

    }

}
