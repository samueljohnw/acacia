<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Image;
use App\User;
use Auth;
use \Carbon\Carbon;
/**
* 
*/
class DashboardController extends Controller
{

	public function dashboard()
	{

		$today = Carbon::now();	
		$x = 0;
		$donations = [];
		$lastSixMonths = $this->lastSixMonths();
		$totalDonations = '';

		while($x < 6)
		{
			$first = new Carbon('first day of '.$today->copy()->subMonth($x)->format('F Y'), 'America/Chicago');
			$last = new Carbon('last day of '.$today->copy()->subMonth($x)->format('F Y'), 'America/Chicago');
			$donations = \App\Donation::whereBetween('created_at', [$first,$last])->where('user_id','=',auth()->user()->id)->get();
			$donations = $this->calculate_fees($donations);
			$totalDonations .= $donations->pluck('amount')->sum().',';
			$x++;
		}

		$allDonations = \App\Donation::where('user_id',auth()->user()->id)->orderBy('created_at','DESC')->get();
		return view('user.dashboard',compact('lastSixMonths','totalDonations','allDonations'));
	}


	public function lastSixMonths()
	{
		$previous6Months = [];
		array_push($previous6Months,Carbon::now()->format('F'));
		
		$x = 1;
		$months = "";
		while($x < 6)
		{
			array_push($previous6Months,Carbon::now()->subMonth($x)->format('F'));
			$x++;
		}
		foreach($previous6Months as $month)
		{
			$months .= '"'.$month.'",';
		}
		return rtrim($months,',');
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
	public function amountSum($donations)
	{
		// print_r($donations);
		foreach($donations as $donation)
		{
			$donation['amount'] = $donation['amount'] + $donation['amount'];
		}
		return $donations;
	} 

}