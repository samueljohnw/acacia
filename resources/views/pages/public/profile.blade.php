@extends('template.layouts.fullwidth')

@section('content')


	@if($user->display_name)
		<h1>{{$user->display_name}}<a href="/{{$user->slug}}/give" class="give-button button button-primary button-raised tiny">Give Now </a></h1>
	@else
		<h1>{{$user->full_name()}}<a href="/{{$user->slug}}/give" class="give-button button button-primary button-raised tiny">Give Now </a></h1>
	@endif

<div class="large-6 columns">
<img class="public-profile-image" src="{{$user->image}}">
</div>
<div class="large-6 columns">
  <a target="_blank" href="{{$user->website}}">{{$user->website}}</a>
</div>
<p>
  {!!$user->bio!!}
</p>

@endsection
