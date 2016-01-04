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
			<td><button class="js-cancel-monthly" data-customer-id="{{$monthly->customer_id}}">Cancel Giving</button</td>
		</tr>

	@endforeach
	</tbody>
</table>
@stop
@section('footer-scripts')
<script type="text/javascript">
	$('.js-cancel-monthly').click(function(e){
		e.preventDefault();

		var customer_id = $(this).data('customer-id');

		$(this).addClass('disabled');

		$.post("{{route('admin.monthlies.delete')}}", 
			{ 	
				_token: "{{csrf_token()}}",
				customer_id: customer_id							
			})
			.done(function( data ) {

			}
		);
	})
</script>
@stop