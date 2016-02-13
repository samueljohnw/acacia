@extends('template.layouts.fullwidth')
@section('header-scripts')
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1710297782515101',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<meta property="og:url"                content="https://acaciaministries.international/{{$user->slug}}" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="Help Support {{$user->display_name or $user->full_name}}" />
<meta property="og:description"        content="{!!$user->bio!!}" />
<meta property="og:image"              content="{{$user->image}}" />
<meta propertu="fb:app_id"             content="1710297782515101">
@stop
@section('content')

	<button class="share-button">Click Here to Share On Facebook</button>


	@if($user->display_name)
		<h1>{{$user->display_name}}<a href="/{{$user->slug}}/give" class="give-button button button-primary button-raised tiny">Give Now </a></h1>
	@else
		<h1>{{$user->full_name()}}<a href="/{{$user->slug}}/give" class="give-button button button-primary button-raised tiny">Give Now </a></h1>
	@endif

<div class="large-6 medium-6 columns">
<img class="public-profile-image" src="{{$user->image}}">
</div>
<div class="large-6 medium-6 columns">
  <a target="_blank" href="{{$user->website}}">{{$user->website}}</a>
</div>
<p>
  {!!$user->bio!!}
</p>

@stop
@section('footer-scripts')
<script type="text/javascript">
	$('.share-button').click(function(){
		FB.ui({
			method: 'share',
			href: '{{request()->url()}}',
		}, function(response){});
	});
</script>
@stop
