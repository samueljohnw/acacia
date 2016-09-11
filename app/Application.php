<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
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
			public function isAccepted($email)
			{				
				return is_null(User::whereEmail($email)->first());
			}
}
