<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\Controller;
use App\User;
use Acacia\Billing\Accounts;
use Acacia\Email\Transactional;

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
        $user_details['slug'] = $request->input('first_name').'.'.$request->input('last_name');
        $user_details['type'] = 'missionary';

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
        return view('admin.users.edit',compact('user'));
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

        if(is_null($request->status))
            $request->status = 'inactive';
        else
            $request->status = 'active';

        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->display_name = $request->display_name;
        $user->email = $request->email;
        $user->status = $request->status;
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

    // public function add_recipient(Recipient $recipient, Request $r, $id)
    // {
    //
    //     $user= \App\User::find($id)->toArray();
    //     $user['name'] = $user['first_name'].' '.$user['last_name'];
    //
    //     \DB::transaction(function () use ($user, $r, $recipient) {
    //         $recipient = $recipient->create_recipient($user,'individual',$r->stripeToken);
    //
    //         \DB::table('users')->where('id',$user['id'])->update(
    //           [
    //             'recipient_id' => $recipient->id,
    //             'sk_token'      =>$recipient->keys->secret,
    //             'pk_token'      =>$recipient->keys->publishable,
    //           ]);
    //     });
    //
    //     return redirect()->route('admin.users.edit',$id);
    // }
    //
    // public function verify_recipient(Recipient $recipient,Request $r, $id)
    // {
    //     $user = \App\User::find($id);
    //
    //     \DB::transaction(function () use ($user, $r, $recipient) {
    //         $recipient->verify_recipient($user->recipient_id, $r->tax_id);
    //         \DB::table('users')->where('id',$user['id'])->update(['verified' => 1]);
    //     });
    //
    //     return redirect()->route('admin.users.edit',$id);
    // }

    public function sendResetRequest($id, Transactional $transaction)
    {
        $user = \App\User::find($id);
        $transaction->sendResetRequest($user->first_name.' '.$user->first_name, $user->email);
        return redirect()->route('admin.users.edit',$id);
    }
}
