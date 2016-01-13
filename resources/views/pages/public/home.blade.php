@extends('template.layouts.wide')
@section('content')
<style media="screen">

</style>
<section class="video-intro">
	<p>
		Acacia Wood was used by the isralites in the wilderness to build the Tabernacle and the Ark of the Covenant.
	</p>
	<video width="100%" height="240" no-controls autoplay loop>
	  <source src="/trees.mp4" type="video/mp4">
	Your browser does not support the video tag.
	</video>

</section>

<section class="text-intro">
	<p>
		Acacia Ministries International is dedicated to using what God has planted and using it to bring His glory.
	</p>
</section>

<section class="missionaries">
	<h1>What Do We Do</h1>
	<p>
		We support missionaries and ministries all over the world.
	</p>
	@foreach($users as $user)
			<span class="large-4 medium-6 small-6 columns missionary-container">
				<a href="{{route('missionary',$user->slug)}}">
					<div class="missionary-image" style="background-image: url({{$user->image}})";></div>
					<div class="missionary-name name">{{$user->display_name or $user->full_name()}}</div>
				</a>
			</span>
	@endforeach

</section>
<section class="more-info">
	<h1>Want To Know More?</h1>
	<p>
		<a href="/who-are-we">Click here</a> to see what we do.
	</p>
</section>

@endsection
