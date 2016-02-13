<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
		protected $table = 'donations';
    protected $fillable = ['user_id','first_name','last_name','email','amount','transaction_id','category'];

    public function getNetAmountAttribute()
    {
        $fee = $this->amount * .05;

        if($this->category == 'C')
    	   $fee = $this->amount * .1;

    	$net_amount = $this->amount - $fee;
	    return money_format('%.2n', $net_amount);;
    }

    public function getMoneyAmountAttribute()
    {
        $amount = money_format('%.2n', $this->amount);
        return $amount;
    }

    public function getCategoryNameAttribute()
    {
        switch ($this->category) {
        case 'O':
            $category = 'One-Time';
            break;
        case 'M':
            $category = 'Monthly';
            break;
        case 'C':
            $category = 'Check';
            break;
        default:
            $category = 'One-Time';
        }

        return $category;
    }
}
