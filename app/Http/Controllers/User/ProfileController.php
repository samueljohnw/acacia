<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Image;
use App\User;
use Auth;
use Illuminate\Contracts\Filesystem\Filesystem;

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

  			$img = Image::make($request->file('image'));

  			$img->resize(400, 400, function ($constraint) {
  				$constraint->aspectRatio();
  			});

        $imageName = $user->id.'-'.$request->file('image')->getClientOriginalName();

        $s3 = \Storage::disk('s3');

        $filePath = 'accounts/' . $imageName;

        $s3->put($filePath, (string)$img->encode(),'public');

  			$user->image = env('S3_LOCATION').$filePath;
  		}

		$user->save();

		return redirect('/profile');

	}

  public function getDonations($year='',$month='')
  {
    return $month;
  }
}
