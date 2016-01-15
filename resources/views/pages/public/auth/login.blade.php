@extends('template.layouts.fullwidth')

@section('content')

@if (count($errors) > 0)
<center>
  <div class="alert callout" data-closable>
    @foreach ($errors->all() as $error)
        <div class="alert label"><i class="fi-x-circle"></i>
          {{ $error }}
        </div>
    @endforeach
    <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</center>
@endif

<form method="POST" action="{{route('login')}}" class="authentication-form">
    {!! csrf_field() !!}

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button class="button" type="submit">Login</button>
    </div>
</form>
@stop
