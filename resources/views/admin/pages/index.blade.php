@extends('template.layouts.leftsidebar')
@section('content')
<h1>Pages Manager</h1>
<a href="#" data-reveal-id="pagesModal">Create New Page</a>

<div id="pagesModal" class="reveal-modal" data-reveal aria-labelledby="NewPage" aria-hidden="true" role="dialog">
<form action="{{route('admin.pages.store')}}" method="POST">
	{!!csrf_field()!!}
	<input type="text" name="title" placeholder="Page Name">
	<button type="submit">Create Page</button>
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