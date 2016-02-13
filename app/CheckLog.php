<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckLog extends Model
{
  protected $table = 'checks_log';


  protected $fillable = ['check_id'];

}
