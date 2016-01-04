@extends('template.layouts.leftsidebar')
@section('header-scripts')
@if(\Carbon\Carbon::now()->format('Y/n') == $year.'/'.$month)
	<style type="text/css">
		.transfer{
			display:none;
		}	    
	</style>
@endif
@stop
@section('content')
Transfers
<div class="row">
	<div class="large-4 columns">
		<a href="{{route('admin.transfers.show',$date_links['previous'])}}">Back</a>
	</div>
	<div class="large-4 columns text-center">
	<b>{{ \Carbon\Carbon::createFromDate($year,$month)->format('F Y') }}</b>
	</div>
	<div class="large-4 columns">
		<a class="right" href="{{route('admin.transfers.show',$date_links['next'])}}">Next</a>
	</div>
</div>
<table style="width:100%;">
    <thead>
      <tr>
        <th width="150">Name</th>
        <th width="150">Total Donations</th>
        <th>Net Amount</th>
        <th width="150"></th>
      </tr>
    </thead>
    <tbody>
    	<tr style="background:#26FF94;">
			<td>
				Profit
			</td>
			<td>
				{{$total_donations}}
			</td>
			<td>
				{{$profit}}
			 </td>
			 <td>
 			 @if(!empty($self_transfer))
		 		<span class="success label" style="width:100%;">Transferred</span>
		 	@elseif($profit > '0' )			
		 		<button class="transfer right tiny" data-transfer-date="{{$transfer_date}}" data-recipient-id="self" data-amount="{{$profit}}">Transfer</button>
		 	@endif
			 </td>
    	</tr>
		@foreach($donations as $donation)
		<tr>
			<td>
				<a href="{{route('admin.users.edit',$donation['user_id'])}}#donations">{{$donation['first_name']}} {{$donation['last_name']}} </a>
			</td>
			<td>
				{{$donation['total_donations']}} 
			</td>
			<td>
			 	${{money_format('%.2n', $donation['net_amount'])}} 
			 </td>
			 <td>
			 @if(isset($donation['transferred']))
			 		<span class="success label" style="width:100%;">Transferred</span>
			 @else 
			 		<button class="transfer right tiny" data-transfer-date="{{$transfer_date}}" data-user-id="{{$donation['user_id']}}" data-recipient-id="{{$donation['recipient_id']}}" data-amount="{{money_format('%.2n', $donation['net_amount'])}}">Transfer</button>
			 @endif
			 </td>
		</tr>
		@endforeach
	</tbody>
</table>
@stop
@section('footer-scripts')
<script type="text/javascript">
	$('.transfer').click(function(e){
		e.preventDefault();
		var amount = $(this).data('amount');
		var recipient_id = $(this).data('recipient-id');
		var user_id = $(this).data('user-id');
		var transfer_date = $(this).data('transfer-date');
				$(this).addClass('disabled');
		$.post("{{route('admin.transfer')}}", 
			{ 	
				amount: amount, 
				recipient_id: recipient_id,
				user_id: user_id,
				transfer_date: transfer_date,
				_token: "{{csrf_token()}}",
			})
			.done(function( data ) {

		});
	})
</script>
@stop