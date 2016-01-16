@extends('template.layouts.fullwidth')
@section('content')

<h1>Apply Now</h1>

@if (session('success'))
    <style>
        form
        {
        	{{ session('success') }}
        }
    </style>
    <h1>We got your application!</h1>
    <p>
    	We'll be in touch soon. Thank you.
    </p>
@endif

<form method="POST" action="{{route('apply.create')}}">
{!!csrf_field()!!}
<div class="row">
  <div class="large-6 columns">
    <fieldset>
      <legend>Personal Information</legend>

  <label id="firstName">First Name
    <input name="first_name" type="text" class="form-control" placeholder="" value="">
  </label>

  <label id="lastName">Last Name
    <input name="last_name" type="text" class="form-control" placeholder="" value="">
  </label>

  <label id="email">Email
    <input name="email" type="text" class="form-control" placeholder="" value="">
  </label>

  <label id="phone">Phone
    <input name="phone" type="text" class="form-control" placeholder="" value="">
  </label>

  <label id="address">Address
    <input name="address" type="text" class="form-control" placeholder="" value="">
  </label>

  <label id="city">City
    <input name="city" type="text" class="form-control" placeholder="" value="">
  </label>

  <label id="state">State
    <input name="state" type="text" class="form-control" placeholder="" value="">
  </label>

  <label id="zip">Zip
    <input name="zip" type="text" class="form-control" placeholder="" value="">
  </label>
  </fieldset>
  </div>
  <div class="large-6 columns">
    <fieldset>
      <legend>References</legend>

  <label id="personalName">Personal Recommendation Name(Friend or family)
    <input name="personalName" type="text" class="form-control" placeholder="" value="">
  </label>

  <label id="personalEmail">Personal Recommendation Contact Email
    <input name="personalEmail" type="text" class="form-control" placeholder="" value="">
  </label>

  <label id="workName">Work Recommendation Name
    <input name="workName" type="text" class="form-control" placeholder="" value="">
  </label>

  <label id="workPhone">Work Recommendation Contact Phone Number
    <input name="workPhone" type="text" class="form-control" placeholder="" value="">
  </label>

  <label id="churchName">Church Recommendation Name(Pastor or Spiritual Mentor)
    <input name="churchName" type="text" class="form-control" placeholder="" value="">
  </label>

  <label id="churchPhone">Church Recommendation Contact Phone Number
    <input name="churchPhone" type="text" class="form-control" placeholder="" value="">
  </label>
    </fieldset>
  </div>
</div>
<label id="testimony"><b>Your Testimony</b>
  <textarea name="testimony" cols="50" rows="10"></textarea>
</label>
<label id="churchHistory"><b>Your Church History</b>
  <textarea name="history" cols="50" rows="10"></textarea>
</label>
<label id="churchHistory"><b>Current/Future Ministry Postion </b>(What organization and nation are you working or plan on working in)?
  <textarea name="plans" cols="50" rows="10"></textarea>
</label>
<input class="button button-raised button-primary expanded" type="submit" value="Submit">

</form>

@stop
