<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
	protected $fillable = 
		[
	      "first_name",
	      "last_name",
	      "email",
	      "phone",
	      "address",
	      "city",
	      "state",
	      "zip",
	      "personalName",
	      "personalEmail",
	      "workName",
	      "workPhone",
	      "churchName",
	      "churchPhone",
	      "testimony",
	      "history",
	      "plans"
      	];
}
