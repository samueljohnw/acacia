<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\Controller;
use App\User;
use Acacia\Billing\Accounts;
use Acacia\Email\Transactional;
use Illuminate\Contracts\Filesystem\Filesystem;
use Image;
use Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Transactional $transaction, Accounts $accounts)
    {
        $user_details = $request->only('first_name','last_name','email');
        $user_details['display_name'] = $request->input('first_name').' '.$request->input('last_name');
        $user_details['slug'] = str_slug($request->input('first_name').$request->input('last_name'));
        $user_details['type'] = 'missionary';
        $user_details['status'] = 'inactive';

        \DB::transaction(function () use($user_details, $accounts) {
          $account = $accounts->create($user_details['email']);

          $user_details['recipient_id'] = $account->id;
          $user_details['sk_token'] = $account->keys->secret;
          $user_details['pk_token'] = $account->keys->publishable;

          $user = User::create($user_details);

        });

        return redirect()->route('admin.users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find($id);
        // \Stripe\Stripe::setApiKey($user->sk_token);
        // $acct = \Stripe\Account::retrieve($user->recipient_id);
        // $acct = $acct->legal_entity;
        // dd($acct);
        if($user->verified != 'true'){
          \Stripe\Stripe::setApiKey($user->sk_token);

          $acct = \Stripe\Account::retrieve($user->recipient_id);
          $acct = $acct->legal_entity;
          if($acct->verification->status == 'verified'){
            $user->verified  = 'true';
            $user->save();
          }


        }

        return view('admin.users.edit',compact('user','acct'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {

        $r = $request->toArray();

        if(!isset($r['status']))
            $r['status'] = 'inactive';
        else
            $r['status'] = 'active';

        $user = User::find($id);
        $user->fill($r);
        $user->save();
        return redirect()->route('admin.users.edit', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function verify_account($id, Request $r)
    {

      $account_id = \App\User::find($id)->recipient_id;

      \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      $account = \Stripe\Account::retrieve($account_id);

      if($r->hasFile('document')){

        $img = Image::make($r->file('document'));

        $ext = $r->file('document')->getClientOriginalExtension();
        $img->save(public_path().'/images/'.$id.'verify.'.$ext);

        $upload = \Stripe\FileUpload::create(
          array(
            "purpose" => "identity_document",
            "file" => fopen(public_path().'/images/'.$id.'verify.'.$ext, 'r')
          ),
          array("stripe_account" => $account_id)
        );

        $account->legal_entity->verification->document = $upload->id;
        Storage::delete(public_path().'/images/'.$id.'verify.'.$ext);

      }

      $account->legal_entity->dob['day'] = $r->dobday;
      $account->legal_entity->dob['month'] = $r->dobmonth;
      $account->legal_entity->dob['year'] = $r->dobyear;
      $account->legal_entity->first_name = $r->first_name;
      $account->legal_entity->last_name = $r->first_name;
      $account->legal_entity->type = 'individual';
      $account->legal_entity->address['line1'] = $r->line1;
      $account->legal_entity->address['city'] = $r->city;
      $account->legal_entity->address['state']  = $r->state;
      $account->legal_entity->address['postal_code'] = $r->postal_code;
      $account->legal_entity->ssn_last_4  = $r->ssn;
      $account->legal_entity->personal_id_number  = $r->personal_id_number;
      $account->tos_acceptance->date = time();
      $account->tos_acceptance->ip = $_SERVER['REMOTE_ADDR'];
      $account->save();



      return back();
    }

    public function sendResetRequest($id, Transactional $transaction)
    {
        $user = \App\User::find($id);
        $transaction->sendResetRequest($user->first_name.' '.$user->first_name, $user->email);
        return redirect()->route('admin.users.edit',$id);

    }

    public function addToList()
    {
      # code...
    }
}
