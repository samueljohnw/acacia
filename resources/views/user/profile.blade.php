@extends('template.layouts.leftsidebar')
@section('header-scripts')
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script>tinymce.init(
  {
    selector:'textarea',
    height:'350',
    plugins: [
        "advlist autolink lists link image charmap anchor"
    ],
    menubar: false,

    toolbar: "undo redo | bold italic | bullist numlist outdent indent"
  });
</script>
@stop
@section('content')
<h3>Your Profile</h3>
@if (count($errors) > 0)
<div class="alert callout" data-closable>
    @foreach ($errors->all() as $error)
        <div data-alert class="alert-box warning">
          {{ $error }}
        </div>
    @endforeach
    <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
	<form method="POST" action="/profile" enctype="multipart/form-data">

		<div class="medium-6 columns">
				{!! csrf_field() !!}
				<label>Shareable Url</label>
				<input type="text" name="slug" placeholder="URL" value="{{Auth::user()->slug}}">
				<label>Email Address</label>
				<input type="email" name="email" placeholder="Email" value="{{Auth::user()->email}}">
				<label>Website</label>
				<input type="url" name="website" placeholder="Website" value="{{Auth::user()->website}}">
				<label>Nation You Serve In</label>
				<select name="country">
					<option value="">
						- Select Nation
					</option>
					@foreach(config('countries') as $short_code => $country)
					<option value="{{$short_code}}" @if(auth()->user()->country == $short_code) selected @endif>
						{{$country}}
					</option>
					@endforeach
				</select>
		</div>
		<div class="medium-6 columns">
			<img style="width:100%;" src="{{auth()->user()->image}}">
			<button class="button button-primary button-raised expanded file-upload tiny expand left">
				  <input type="file" name="image" class="file-input">Upload New Image
			</button>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<textarea name="bio">{{Auth::user()->bio}}</textarea>
				<br/>
				<input type="submit" value="submit" class="button button-raised button-primary">
			</div>
		</div>
	</form><br/>
@stop
