<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;
use DB;
use Acacia\Billing\Transfer;

class TransferController extends Controller
{
    public function show($year = NULL, $month = NULL)
    {
    	if(is_null($month)){
			$month = Carbon::now()->format('n');	
    	}
    	if(is_null($year))
    	{
			$year = Carbon::now()->format('Y');	    		
    	}

    	$between = $this->calculate_dates($year,$month);
    	$transfer_date = Carbon::createFromDate($year,$month,'01')->format('Y-m-d');

    	$donations = DB::table('donations')
			->select(DB::raw('user_id, users.recipient_id, amount, donations.category, users.first_name,users.last_name'))
			->join('users', 'donations.user_id', '=', 'users.id')
			->whereBetween('donations.created_at',[$between['first'], $between['last'] ])
			->where('users.recipient_id','<>','')
			->get();

		$total_donations = count($donations);
		$profit = $this->calculate_profit($donations);
		$donations = $this->calculate_fees($donations);
		$donations = $this->group_users($donations);
		$donations = $this->check_transfers($donations, $transfer_date);
		$self_transfer = $this->check_self_transfers($donations, $transfer_date);

		$next = \Carbon\Carbon::createFromDate($year, $month)->addMonth(1)->format('Y/n');
		$previous = \Carbon\Carbon::createFromDate($year, $month)->subMonth(1)->format('Y/n');

		$date_links = ['next'=>$next,'previous'=>$previous];

    	return view('admin.transfers.show',compact('donations','date_links','transfer_date','year','month','profit','total_donations','self_transfer'));
    }

	public function group_users($donations)
	{
		
		$all = new \Illuminate\Database\Eloquent\Collection;
		$users = collect($donations);
		$users = $users->groupBy('user_id');

		foreach ($users as $user) {	
		$arr = [	
			'total_donations' => $user->count('amount'),
			'net_amount' => $user->sum('amount'),
			'first_name' => $user->pluck('first_name')->first(),
			'last_name' => $user->pluck('last_name')->first(),
			'recipient_id' => $user->pluck('recipient_id')->first(),
			'user_id' => $user->pluck('user_id')->first()
			];

			$all->put($user->pluck('user_id')->first() ,collect($arr));
			
		}

		return $all;
	}

	public function calculate_fees($donations)
	{

		foreach($donations as $donation)
		{
			$amount = $donation->amount;
			switch ($donation->category) {
		        case 'O':
		            $fee = .05;
		            break;
		        case 'M':
		            $fee = .05;
		            break;
		        case 'C':
		            $fee = .10;
		            break;
		        default:
		            $fee = .05;
	        }

			$net_amount = $amount * $fee;
	        $donation->amount = $amount - $net_amount;
	    }
	    return $donations;
                
	}

    public function transfer(Request $r, Transfer $transfer)
    {

    	$recipient_id = $r->get('recipient_id');
    	$amount = $r->get('amount')*100;

		$user_id = $r->get('user_id');

		if(is_null($user_id))
			$user_id = 0;

		$transfer_date = $r->get('transfer_date');

	    \DB::transaction(function () use($user_id, $recipient_id, $transfer, $amount, $transfer_date) 
	    	{

				$transfer = $transfer->transfer($recipient_id, $amount);

				$insert = [
								'transfer_id'	=>	$transfer->id,
								'user_id'		=>	$user_id,
								'amount'		=>	$amount,
								'transfer_date'	=>	$transfer_date
							];
	            \App\Transfer::create($insert);
	    	});
    }

    public function calculate_dates($year,$month)
    {
		
		$date = Carbon::createFromDate($year, $month);

		$first = new Carbon('first day of '.$date->copy()->format('F Y'));
		$last = new Carbon('last day of '.$date->copy()->format('F Y'));

		return ['first'=>$first,'last'=>$last];
    }

    public function calculate_profit($donations)
    {
	        $donation_profit = [];

		foreach($donations as $key => $donation)
		{

			$amount = $donation->amount;

			switch ($donation->category) {
		        case 'O':
		            $percent_fee = .02;
		            $transaction_fee = .3;
		            break;
		        case 'M':
		            $percent_fee = .02;
		            $transaction_fee = .3;
		            break;
		        case 'C':
		            $percent_fee = .00;
		            $transaction_fee = .00;
		            break;
		        default:
		            $percent_fee = .02;
		            $transaction_fee = .3;
	        }

	        $net_amount = $amount * $percent_fee;
	        $profit = $net_amount - $transaction_fee;
	        $donation_profit[] = $profit;

	    }
	    return collect($donation_profit)->sum();


    } 

    public function check_self_transfers($donations, $transfer_date)
    {

		$transfers = DB::table('transfers')
			->where('transfer_date', '=', $transfer_date)
			->where('user_id','=',0)
			->get();

		return $transfers;
    } 


    public function check_transfers($donations, $transfer_date)
    {
		foreach($donations as $donation)
		{
			$transfers = DB::table('transfers')
				->where('transfer_date', '=', $transfer_date)
				->where('user_id','=',$donation['user_id'])
				->get();

	    	if(!empty($transfers))
	    		$donation['transferred'] = 'true';	 
		}

		return $donations;
    } 
}
