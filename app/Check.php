<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
	protected $table = 'checks';
    protected $fillable = ['user_id','first_name','last_name','check_number','amount'];

    public function user()
    {
        return $this->hasMany('App\User', 'id', 'user_id');

    }

		public function processed()
		{
			return $this->hasOne(CheckLog::class);
		}

}
