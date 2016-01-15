@extends('template.layouts.fullwidth')
@section('content')
<h1>Contact</h1>

@if ($submitted == 'true')
  <h4>Thank you for contact us. We'll be with you shortly.</h4>
  <style media="screen">
    form.contact{display:none;}
  </style>
  <hr/>
@endif

@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <span class="alert label"><i class="fi-x-circle"></i>
          {{ $error }}
        </span><hr/>
    @endforeach
@endif

PH: <a target="_blank" href="tel:(816) 832-2244">(816) 832-2244</a><br/>
EM: <a target="_blank" href="mailto:hello@AcaciaMinistries.International">hello@AcaciaMinistries.International</a><br/>
FB: <a target="_blank" href="https://www.facebook.com/acacia.ministries.international">https://www.facebook.com/acacia.ministries.international</a>
<hr/>
<form class="contact" action="{{route('contact')}}" method="POST">
  {{csrf_field()}}
  <label>Full Name:
    <input name="full_name" type="text">
  </label>
  <label>Email Address:
    <input name="email" type="email">
  </label>
  <label>Phone Number
    <input name="phone" type="tel">
  </label>
  <label>Your Message:
    <textarea name="body" rows="8" cols="40"></textarea>
  </label>
  <button type="submit" class="button button-primary button-raised">Submit</button>
</form>
@stop
