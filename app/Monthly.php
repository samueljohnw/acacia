<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monthly extends Model
{
	protected $table = 'monthlies';
	protected $fillable = ['user_id','first_name','last_name','email','amount','customer_id','subscription_id'];
    protected $name = ['first_name', 'last_name'];


    public function user()
    {
        return $this->hasMany('App\User', 'id', 'user_id');

    }

    public function getNameAttribute()
    {
	    return "$this->first_name $this->last_name";
    }

}
