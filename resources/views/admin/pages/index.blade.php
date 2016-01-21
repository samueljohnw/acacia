@extends('template.layouts.leftsidebar')
@section('content')
<h1>Pages Manager</h1>
<a href="#" data-open="pagesModal" class="button button-raised">Create New Page</a>

<div id="pagesModal" class="reveal" data-reveal>
	Enter the page name here.
<form action="{{route('admin.pages.store')}}" method="POST">
	{!!csrf_field()!!}
	<input type="text" name="title" placeholder="Page Name">
	<button class="button button-primary button-raised" type="submit">Create Page</button>
</form>
</div>
<hr/>
<table>
  <thead>
    <tr>
      <th width="200">Page Title</th>
    </tr>
  </thead>
  <tbody>
	@foreach($pages as $page)
		<tr>
			<td>
				<a href="{{route('admin.pages.edit',$page->id)}}"> {{$page->title}}</a>
			</td>
		</tr>
	@endforeach
  </tbody>
</table>

@stop
