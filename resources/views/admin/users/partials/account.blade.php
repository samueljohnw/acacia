<div class="errors"></div>

@if(empty($user->recipient_id ))
	<form id="create-recipient" action="{{route('admin.users.add_recipient',$user->id)}}" method="POST">
		{!!csrf_field()!!}
		<input type="text" name='account_number' placeholder="Bank Account Number" class="account_number">
		<input type="text" name='routing_number' placeholder="Routing Number" class="routing_number">
		<button class="button button-raised button-action submit-button" type="submit">Add Recipient</button>
	</form>
@endif

@if(empty($user->verified))
	@if(!empty($user->recipient_id ))

	<form id="verify-recipient" action="{{route('admin.users.verify_recipient',$user->id)}}" method="POST">
		{!!csrf_field()!!}
		<input type="text" name='tax_id' placeholder="SSN" class="ssn">
		<button class="button button-raised button-action submit-button float-left" type="submit">Verify Recipient</button><br/>
	</form>
	@endif
@endif

@if($user->verified == 1)
	@if(!empty($user->recipient_id ))
		Recipient created and verified.

	@endif
@endif

<form action="{{route('users.reset-password', $user->id)}}" method="POST">
	{!!csrf_field()!!}
	<button type="submit" class="button button-raised button-action tiny float-right">Send Reset Password Request Email</button>
</form>
