<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\ApplyRequest;
use App\Http\Requests\ContactFormRequest;
use App\Http\Controllers\Controller;
use Acacia\Email\Transactional;

class PagesController extends Controller
{

    public function index()
    {
      $users = User::whereType('missionary')->where('status','=','active')->take(3)->orderByRaw("RAND()")->get();

      return view('pages.public.home',compact('users'));
    }

    public function missionaries()
    {
      $users = User::where('type', 'missionary')->where('image','!=','')->whereStatus('active')->get();
      return view('pages.public.missionaries',compact('users'));
    }

    public function show($slug)
    {
        $page = \App\Page::whereSlug($slug)->first();

        if($page){
          $body = $page->body;
          $title = $page->title;
          return view('pages.public.page',compact('body','title'));
        }

        $user = User::where('slug',$slug)->firstOrFail();
        return view('pages.public.profile',compact('user'));
    }

    public function apply()
    {
        return view('pages.public.apply');
    }

    public function submit_apply(ApplyRequest $r, Transactional $transaction)
    {
        \App\Application::create($r->except('_token'));

        $transaction->confirm_application($r->first_name.' '.$r->last_name,$r->email, $r->except('_token'));

        return redirect()->route('apply')->with('success','display:none');
    }

    public function contact()
    {
      return view('pages.public.contact',['submitted'=>'false']);
    }

    public function submit_contact(ContactFormRequest $request, Transactional $transaction)
    {
      $transaction->contact_form($request);
      return view('pages.public.contact',['submitted'=>'true']);
    }
    public function submit_more_info(Request $request, Transactional $transaction)
    {
      $transaction->more_info($request);
    }

    public function ywam()
    {
      return view('pages.public.ywam');
    }
    public function ywamrocks()
    {
      return '<center><h1>YWAM ROCKS. THANK YOU!</h1><br/><a href="/ywam-together">back to form</a></center>';
    }
}
