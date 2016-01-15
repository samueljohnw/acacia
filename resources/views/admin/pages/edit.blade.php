@extends('template.layouts.leftsidebar')
@section('header-scripts')
<script src="//cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
@stop
@section('content')
<h1>{{$page->title}}</h1>
<form action="{{route('admin.pages.update',$page->id)}}" method="POST">
	{!!csrf_field()!!}
	{!! method_field('put') !!}
	<select name="status">
		@if($page->status == 'pending')
		<option selected value="{{$page->status}}">
			{{ucfirst($page->status)}}
		</option>
		<option value="Live">
			Live
		</option>
		@else
		<option selected value="{{$page->status}}">
			{{ucfirst($page->status)}}
		</option>
		<option value="pending">
			Pending
		</option>
		@endif
	</select>
	<input type="text" name="title" placeholder="Title" value="{{$page->title}}">
	<input type="text" name="slug" placeholder="URL Slug" value="{{$page->slug}}" disabled>
	<input type="text" name="meta_title" placeholder="Meta Title" value="{{$page->meta_title}}">
	<input type="text" name="meta_description" placeholder="Meta Description" value="{{$page->meta_description}}">
	<input type="text" name="meta_keywords" placeholder="Meta Keywords" value="{{$page->meta_keywords}}">
	<textarea id="editor" cols="5" rows="15" name="body">{{$page->body}}</textarea><br/>
	<button type="submit" class="button button-raised button-action">Submit</button><br/>
</form>
<script>
		// Replace the <textarea id="editor1"> with a CKEditor
		// instance, using default configuration.
		CKEDITOR.replace( 'editor' );
</script>
@stop
