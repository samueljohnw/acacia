@extends('template.layouts.fullwidth')

@section('content')

@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div data-alert class="alert-box warning">
          {{ $error }}
          <a href="#" class="close">&times;</a>
        </div>
    @endforeach
@endif

<form method="POST" action="{{route('login')}}">
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
        <button type="submit">Login</button>
    </div>
</form>
@stop