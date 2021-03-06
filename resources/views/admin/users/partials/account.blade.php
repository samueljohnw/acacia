<h3>Verify {{$user->first_name}}'s ID</h3>
<div class="errors"></div>

@if($user->verified == 0)
<form action="{{route('users.account.update', $user->id)}}"  method="post" enctype="multipart/form-data">
	{!!csrf_field()!!}

	<label><b>Picture ID (Passport or Driver's License)</b>
		<input type="file" name="document" value="">
	</label>

	<div class="row">
		<div class="large-6 columns">
			<label>First Name
				<input type="text" name="first_name" placeholder="First Name" value="{{$acct->first_name}}">
			</label>
		</div>
		<div class="large-6 columns">
			<label>Last Name
				<input type="text" name="last_name" placeholder="Last Name" value="{{$acct->last_name}}">
			</label>
		</div>
	</div>


	<div class="row">
		<div class="large-4 columns">
			<label>D.O.B Day
				<select class="" name="dobday">
					<option value="{{$acct->dob['day'] or ''}}">{{$acct->dob['day'] or 'Select Day of the Month'}}</option>
					@for ($i = 01; $i <= 31; $i++)
							<option value="{{$i}}">{{$i}}</option>
					@endfor
				</select>
			</label>
		</div>
		<div class="large-4 columns">
			<label>D.O.B Month
				<select class="" name="dobmonth">
					<option value="{{$acct->dob['month'] or ''}}">{{$acct->dob['month'] or 'Select Month'}}</option>
					@for ($i = 01; $i <= 12; $i++)
							<option value="{{$i}}">{{$i}}</option>
					@endfor
				</select>
			</label>
		</div>
		<div class="large-4 columns">
			<label>D.O.B Year
				<select class="" name="dobyear">
					<option value="{{$acct->dob['year'] or ''}}">{{$acct->dob['year'] or 'Select Year'}}</option>
					@for ($i = 1950; $i < date('Y')-18; $i++)
							<option value="{{$i}}">{{$i}}</option>
					@endfor
				</select>
			</label>
		</div>
	</div>




	<div class="row">
		<div class="large-4 columns">
			<label>Address Line 1
				<input type="text" name="line1" placeholder="Address" value="{{$acct->address->line1}}">
			</label>
		</div>
		<div class="large-4 columns">
			<label>City
				<input type="text" name="city" placeholder="City" value="{{$acct->address->city}}">
			</label>
		</div>
		<div class="large-2 columns">
			<label>State
				<input type="text" name="state" placeholder="State"  value="{{$acct->address->state}}">
			</label>
		</div>
		<div class="large-2 columns">
			<label>Zip
				<input type="text" name="postal_code" placeholder="Posta Code"  value="{{$acct->address->postal_code}}">
			</label>

		</div>
	</div>
	<div class="row">
		<div class="large-6 columns">
			@if($acct->ssn_last_4_provided != 1)
			<label>Last 4 of SSN
				<input type="text" name="ssn" placeholder="SSN"  value="{{$acct->ssn_last_4_provided}}">
			</label>
			@else
				Last 4 of SSN Verified
			@endif
		</div>
		<div class="large-6 columns">
			@if($acct->personal_id_number_provided != 1)
			<input type="text" name="personal_id_number" placeholder="Personal ID Number" value="{{$acct->personal_id_number_provided}}">
			@else
				SSN Provided
			@endif
		</div>
	</div>



	<button type="submit" class="button button-raised">Submit</button>

</form>
@else

	<span class="secondary label"><i class="fi-check"></i> {{ucfirst($user->first_name)}} has been verified.</span>

@endif
