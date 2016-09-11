@extends('template.layouts.leftsidebar')
@section('content')
<br/>
	<form action="{{route('admin.users.store')}}" method="POST">
	    {!! csrf_field() !!}
	    <input  type="text" name="first_name" placeholder="First Name" value="{{$application['first_name']}}" required>
	    <input  type="text" name="last_name" placeholder="Last Name" value="{{$application['last_name']}}" required>
	    <input  type="email" name="email" placeholder="Email Address" value="{{$application['email']}}" required>
			@if(\App\Application::find($application['id'])->isAccepted($application['email']))
	    	<button class="primary button" type="submit">Accept Application</button>
			@else
				<span class="success label">Application Accepted</span>
			@endif
	</form>

	<hr/>
	<h1>{{$application['first_name']}} {{$application['last_name']}}</h1>
	@foreach($application as $applicant => $value)
		<b>{{ucwords(str_replace('_',' ',$applicant))}}</b> - {{$value}}<br/>
	@endforeach

@stop
