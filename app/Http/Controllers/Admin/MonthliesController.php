<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Acacia\Billing\Monthlies;

class MonthliesController extends Controller
{


    public function show()
    {
    	$monthlies = \App\Monthly::all();
    	return view('admin.monthlies.show',compact('monthlies'));
    }

    public function delete(Request $r, Monthlies $monthlies)
    {
  		$monthly = \App\Monthly::where('customer_id',$r->customer_id)->first();
      $account_id = \App\User::find($monthly->user_id)->recipient_id;
      $monthly->delete();
      $monthlies->delete($r->customer_id, $account_id);
    }
}
