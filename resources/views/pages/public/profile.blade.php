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
<meta property="og:description"        content="{{$user->bio}}" />
<meta property="og:image"              content="{{$user->image}}" />
<meta property="fb:app_id"             content="1710297782515101" />
@stop
@section('content')
<div class="small-8 medium-6 large-8 small-centered columns" style="box-shadow: 0 0 5px;padding: 0;">
  <button style="background:#3b5998;color:#fff;width:100%;padding:10px;" class="share-button expanded">Share This On Facebook </button>

  <img class="public-profile-image" src="{{$user->image}}">

  <a href="/{{$user->slug}}/give" class="expanded button button-primary button-raised tiny">Give Now </a>

  <div class="header panel">
    <br/>
    <div class="sign">
      	@if($user->display_name)
      		<h1>{{$user->display_name}}</h1>
      	@else
      		<h1>{{$user->full_name()}}</h1>
      	@endif
    </div>

      <center>
        <a target="_blank" href="{{$user->website}}">{{$user->website}}</a>
      </center>

      {!!$user->bio!!}

    </div>

</div>

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
