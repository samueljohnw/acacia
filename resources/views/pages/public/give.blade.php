@extends('template.layouts.fullwidth')

@section('header-scripts')
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

@stop

@section('content')


<center>
  <h1>{{ $user->display_name or $user->full_name() }}</h1>
  <img src="{{$user->image}}">
</center>
<h2 class="text-center">How would you like to give?</h2>
<p class="text-center"> One-time donation, monthly, or by a check in the mail. Please select your option and continue to fill out the form.</p>
<span class="payment-errors"></span>
@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div data-alert class="alert-box warning">
          {{ $error }}
          <a href="#" class="close">&times;</a>
        </div>
    @endforeach
@endif
<div class="row">
  <div class="small-8 small-centered columns css-giving-box">
    <ul class="tabs css-giving-tabs" data-tabs id="giving-tabs">
      <li class="tabs-title is-active"><a href="#one-time">One-Time</a></li>
      <li class="tabs-title"><a href="#monthly">Monthly</a></li>
      <li class="tabs-title"><a href="#check">Check</a></li>
    </ul>
    <div class="tabs-content" data-tabs-content="giving-tabs">
      <div class="tabs-panel content is-active" id="one-time">
          @include('pages.public.partials.payment_form',['monthly'=>''])
      </div>
      <div class="tabs-panel content" id="monthly">
        @include('pages.public.partials.payment_form',['monthly'=>'checked'])
      </div>
      <div class="tabs-panel content" id="check">

        <p style="padding:10px">
          To send checks to this missionary fill out the form below and we'll send you the instructions.
        </p>

          <form>
          <label>Full Name</label>
            <input type="text" id="check_full_name">
            <label>Email</label>
            <input type="email" id="check_email">
            <button class="button button-primary button-raised check-request">Submit</button>
          </form>
          <script type="text/javascript">
            $('.check-request').click(function(e)
            {
              e.preventDefault();
              var email = $('#check_email').val();
              var full_name = $('#check_full_name').val();
              $.post( "{{route('check.request')}}",
                {
                  _token: "{{csrf_token()}}",
                  full_name: full_name,
                  email: email,
                  user: "{{$user->first_name}} {{$user->last_name}}",
                }
              );
            });
          </script>
        </div>
    </div>
  </div>
</div>
@stop
@section('footer-scripts')
<script>

</script>
@stop
