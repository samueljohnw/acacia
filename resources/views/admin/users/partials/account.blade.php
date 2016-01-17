<div class="errors"></div>


<form action="{{route('users.reset-password', $user->id)}}" method="POST">
	{!!csrf_field()!!}
	<button type="submit" class="button button-raised button-action tiny float-right">Send Reset Password Request Email</button>
</form>
