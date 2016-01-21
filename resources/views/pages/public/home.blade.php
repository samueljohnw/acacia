@extends('template.layouts.wide')
@section('content')
<style media="screen">

</style>
<section class="video-intro">
	<p>
		Acacia Wood Was Used By The Isralites in the Desert to Build the Tabernacle and The Ark of the Covenant.
	</p>
	<video width="100%" height="240" no-controls autoplay loop>
	  <source src="https://s3-us-west-2.amazonaws.com/acacia-ministries/images/acacia-home-bg.mp4" type="video/mp4">
	Your browser does not support the video tag.
	</video>

</section>

<section class="text-intro">
	<p>
		Acacia Ministries International is Dedicated to Using What God Has Planted to Bring His Glory in the Dry places.
	</p>
</section>

<section class="missionaries">
	<h1>What Do We Do</h1>
	<p>
		We support missionaries and ministries all over the world.
	</p>
	<div class="row small-up-1 medium-up-1 large-up-3">
		@foreach($users as $user)
				<div class="column missionary-container">
					<a href="{{route('missionary',$user->slug)}}">
						<div class="missionary-image" style="background-image: url({{$user->image}})";></div>
						<div class="missionary-name name">{{$user->display_name or $user->full_name()}}</div>
					</a>
				</div>
		@endforeach
	</div>
</section>
<section class="more-info">
	<h1>Want To Know More?</h1>
	<p>
		We'll send you more information on about how we're impacting missionary's lives all over the world. Just enter your email address below.
	</p>
	<form class="more-information" action="" method="post">
		{{csrf_field()}}
		<label>First Name
			<input type="text" name="first_name" class="first_name">
		</label>
		<label>Email Address
			<input type="email" name="email" class="email">
		</label>

		<button type="button" class="button button-raised button-primary more-info-request button">Give Me More Info</button>
	</form>
	<center><b><span class="form-response"></span></b></center>
</section>

@stop
@section('footer-scripts')
<script type="text/javascript">
	$('.more-info-request').click(function(e){
		e.preventDefault();
		$.post("{{route('information.post')}}",
			{
				_token: "{{csrf_token()}}",
				first_name: $('.first_name').val(),
				email:$('.email').val()
			});
			$(this).closest('form').fadeOut().queue(function(n)
			{
				$('.form-response').html('Thanks. More information on it\'s way.');
			}).fadeIn(500);
	});

</script>
@stop
