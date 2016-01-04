<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\ApplyRequest;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{

    public function index()
    {
      
      return view('pages.public.home');
    }

    public function missionaries()
    {
      $users = User::where('type', '=', 'missionary')->where('status','=','active')->get();
      return view('pages.public.missionaries',compact('users'));
    }

    public function showProfile($slug)
    {
        $user = User::where('slug',$slug)->firstOrFail();
        return view('pages.public.profile',compact('user'));
    }

    public function apply()
    {
        return view('pages.public.apply');
    }

    public function submit_apply(ApplyRequest $r)
    {
        \App\Application::create($r->except('_token'));
        return redirect()->route('apply')->with('success','display:none');
    }

}
