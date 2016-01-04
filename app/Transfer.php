<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
	protected $table = 'transfers';

	protected $fillable = ['user_id','amount','transfer_id','transfer_date'];

}
