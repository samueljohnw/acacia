@extends('template.layouts.leftsidebar')
@section('content')
<h3>Checks</h3>

<form method="POST" action="{{route('admin.checks.create')}}" accept-charset="UTF-8" >
{!!csrf_field()!!}
<fieldset>
  <legend>Add Check</legend>
<div class="row">
  <div class="large-6 columns">
    <label>From First Name
      <input name="first_name" type="text" required>
    </label>
  </div>
  <div class="large-6 columns">
    <label>From Last Name
      <input name="last_name" type="text" required>
    </label>
  </div>
</div>


<div class="row">
  <div class="large-4 columns">
    <label>Check#
      <input name="check_number" type="text" required>
    </label>
  </div>
  <div class="large-4 columns">
    <label>Amount
      <input name="amount" type="text" required>
    </label>
  </div>
  <div class="large-4 columns" >
    <label>To
    <select name="user_id" required>
    	<option value=""> - Select Missionary</option>
		@foreach($users as $user)
			<option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
		@endforeach
	</select>
    </label>
  </div>
</div>
<input class="button button-primary button-raised" type="submit" value="Enter">

</fieldset>
</form>
<table>
  <thead>
    <tr>
      <th width="200">Date</th>
      <th width="200">Name</th>
      <th>For</th>
      <th width="150">Amount</th>
      <th width="150">Check #</th>
      <th width="150">Processed</th>
    </tr>
  </thead>
  <tbody>
    @foreach($checks as $check)
        <tr>
          <td>{{$check->created_at->format('M d, Y')}}</td>
          <td>{{$check->first_name}} {{$check->last_name}}</td>
          <td><a href="{{route('admin.users.edit', $check->user()->first()->id)}}#donations"> {{$check->user()->first()->first_name}} {{$check->user()->first()->last_name}}</a></td>
          <td>${{$check->amount}}</td>
          <td>{{$check->check_number}}</td>
          <td>
            @if(!$check->processed)
              <button data-checkid="{{$check->id}}" data-userid="{{$check->user()->first()->id}}" class="button button-primary button-raised process-check">Process</button>
            @endif
          </td>
        </tr>
    @endforeach
  </tbody>
</table>


@endsection
@section('footer-scripts')
<script type="text/javascript">
  $('.process-check').click(function(e){
    e.preventDefault();
    $(this).addClass('disabled');

    $.post("{{route('admin.check.process')}}",
      {
        _token: "{{csrf_token()}}",
        check_id: $(this).data('checkid'),
        user: $(this).data('userid')
      })
      .done(function( data ) {
        console.log(data);
      });
  });
</script>
@endsection
