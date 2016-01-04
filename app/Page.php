<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	protected $fillable = ['title','meta_title','meta_description','meta_keywords','body','slug','status'];
}
