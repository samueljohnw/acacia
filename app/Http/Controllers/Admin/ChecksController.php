<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ChecksController extends Controller
{
    public function show()
    {
    	$users = \App\User::where('status','!=','inactive')->where('type','!=','supporter')->get();
    	$checks = \App\Check::orderBy('created_at','Desc')->get();

    	return view('admin.checks.show',compact('users','checks'));
    }

    public function create(Request $r)
    {

    	$check = $r->except('_token');

		$donation = 
		[
		  'user_id'         =>  $r->user_id,
		  'first_name'      =>  $r->first_name,
		  'last_name'       =>  $r->last_name,
		  'amount'          =>  $r->amount,
		  'category'        =>  'C',
		  'created_at'      =>  \Carbon\Carbon::now()
		];

        \App\Donation::create($donation);

    	\App\Check::create($check);

    	return redirect()->route('admin.checks.show');
    }
}
