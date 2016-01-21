
<div class="errors"></div>

@if($user->verified != 'true')
<form action="{{route('users.account.update', $user->id)}}"  method="post" enctype="multipart/form-data">
	{!!csrf_field()!!}
	<input type="file" name="document" value="">
	<input type="text" name="first_name" placeholder="First Name" value="{{$acct->first_name}}">
	<input type="text" name="last_name" placeholder="Last Name" value="{{$acct->last_name}}">
	<input type="text" name="dobday" placeholder="DOB Day" value="{{$acct->dob->day}}">
	<input type="text" name="dobmonth" placeholder="DOB Month" value="{{$acct->dob->month}}">
	<input type="text" name="dobyear" placeholder="DOB Year" value="{{$acct->dob->year}}">
	<input type="text" name="line1" placeholder="Address" value="{{$acct->address->line1}}">
	<input type="text" name="city" placeholder="City" value="{{$acct->address->city}}">
	<input type="text" name="state" placeholder="State"  value="{{$acct->address->state}}">
	<input type="text" name="postal_code" placeholder="Posta Code"  value="{{$acct->address->postal_code}}">
	<input type="text" name="ssn" placeholder="SSN"  value="{{$acct->ssn_last_4_provided}}">
	<input type="text" name="personal_id_number" placeholder="Personal ID Number" value="{{$acct->personal_id_number_provided}}">

	<button type="submit" class="button button-raised">Submit</button>

</form>
@endif
<form action="{{route('users.reset-password', $user->id)}}" method="POST">
	{!!csrf_field()!!}
	<button type="submit" class="button button-raised button-action tiny float-right">Send Reset Password Request Email</button>
</form>
