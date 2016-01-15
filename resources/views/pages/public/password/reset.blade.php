@extends('template.layouts.fullwidth')
@section('content')
<p class="text-center">
    Enter in your email address and the desired password to reset your password.
</p>

<form method="POST" action="/password/reset" class="authentication-form">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password">
    </div>

    <div>
        Confirm Password
        <input type="password" name="password_confirmation">
    </div>

    <div>
      <button type="submit" class="button button-raised button-primary">
            Reset Password
        </button>
    </div>
</form>
@stop
