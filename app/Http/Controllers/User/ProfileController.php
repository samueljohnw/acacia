<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Image;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function getIndex()
    {

   	    return view('user.profile');
    }
    public function postIndex(\App\Http\Requests\ProfileRequest $request)
    {
    	
    	$user = User::find(Auth::user()->id);
		$user->slug = $request->slug;
		$user->website = $request->website;
		$user->email = $request->email;
		$user->bio = $request->bio;
		$user->country = $request->country;
		
		if ($request->hasFile('image')){
			$filename = auth()->user()->id.'-'.$request->file('image')->getClientOriginalName();
			$img = Image::make($request->file('image'));
			
			$img->resize(400, 400, function ($constraint) {
				$constraint->aspectRatio();
			});

			$filepath = public_path().'/images/'.$filename;

			$img->save($filepath);
			$user->image = '/images/'.$filename;
		}

		$user->save();

		return redirect('/profile');

	}

  public function getDonations($year='',$month='')
  {
    return $month;
  }
}

