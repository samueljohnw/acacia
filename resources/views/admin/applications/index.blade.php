@extends('template.layouts.leftsidebar')
@section('content')
<h1>Applications</h1>


<table>
  <thead>
    <tr>
      <th width="200">Name</th>
      <th width="200">Date</th>
    </tr>
  </thead>
  <tbody>
	@foreach($applications as $application)
<tr>
	<td>
	<a href="{{route('admin.applications.show',$application->id)}}">{{$application->first_name}} {{$application->last_name}}</a>
	</td>
	<td>
	{{$application->created_at->format('F j, Y')}}
	</td>
  <td>
    @if(!$application->isAccepted($application->email))
      <span class="success label">Accepted</span>
    @endif
  </td>
</tr>
	@endforeach

  </tbody>
</table>
@stop
