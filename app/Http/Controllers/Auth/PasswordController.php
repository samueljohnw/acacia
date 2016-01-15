<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Acacia\Email\Transactional;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    protected $redirectTo = '/dashboard';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getEmail($email=NULL)
    {
        return view('pages.public.password.email',compact('email'));
    }
    public function getReset($token)
    {
        return view('pages.public.password.reset',compact('token'));
    }
    public function postEmail(Request $r, Transactional $transactional)
    {

        $user = \App\User::whereEmail($r->email)->first();

        // If email doesn't match in the table send them back.
        if(is_null($user))
            return redirect()->to('/password/email')->with('fail','Can\'t find that email address. Did you type it in correctly?');

        // Generate token and reset_link, insert into database, and sendResetLink
        $token = str_random(65);
        $reset_link = env('URL').'/password/reset/'.$token;
        $timestamp = \Carbon\Carbon::now()->toDateTimeString();

        \DB::insert('insert into password_resets (email, token, created_at) values (?, ?, ?)', [$user->email, $token, $timestamp]);

        $transactional->sendResetLink($user->first_name.' '.$user->last_name,$user->email,$reset_link);

        return redirect()->to('/password/email')->with('success','You\'re password reset link is on it\'s way. Give it about 5 minutes.');

    }
}
