@extends('template.layouts.leftsidebar')
@section('content')
<h1>Monthlies</h1>

<p>
If the charge day has past, this will only cancel donations afterwards. If the charge day hasn't happened yet, then the support will not be charged for this month.
</p>

	<table>
		<thead>
			<tr>
				<th width="200">Name</th>
				<th>For</th>
				<th width="150">Amount</th>
				<th width="150">Charge Day</th>
				<th width="150">*</th>
			</tr>
		</thead>
	<tbody>
	@foreach($monthlies as $monthly)

		<tr>
			<td>{{$monthly->first_name}} {{$monthly->last_name}}</td>
	        <td><a href="{{route('admin.users.edit', $monthly->user()->first()->id)}}"> {{$monthly->user()->first()->first_name}} {{$monthly->user()->first()->last_name}}</a></td>
			<td>{{$monthly->amount}}</td>
			<td>{{$monthly->created_at->format('dS')}}</td>	
		</tr>

	@endforeach
	</tbody>
</table>
@endsection
