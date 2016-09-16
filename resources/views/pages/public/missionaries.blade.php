@extends('template.layouts.fullwidth')

@section('content')

<p>
	Acacia Ministries International helps missionaries of all organizations and denominations. We even support ministries. Search here, read about them, and give. Strengthen the missions movement by supporting these trusted missionaries and ministries.
</p>
<div id="missionaries">
	<input class="search" type="text" placeholder="Search For Missionary or Ministry">

	<span class="list row large-collapse">

		@foreach($users as $user)
		    <span class="large-3 medium-6 small-6 columns missionary-container">
		    	<a href="{{route('missionary',$user->slug)}}">
		    		<div class="missionary-image" style="background-image: url('{{$user->image}}')";></div>
		    		<div class="missionary-name name">{{$user->display_name or $user->full_name()}}</div>
		    	</a>
		    </span>
		@endforeach

	</span>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js"></script>
<script type="text/javascript">

	var options = {
	  valueNames: [ 'name']
	};

	var userList = new List('missionaries', options);


</script>
@endsection
