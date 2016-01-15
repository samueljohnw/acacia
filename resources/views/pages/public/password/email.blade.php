@extends('template.layouts.fullwidth')
@section('content')
<p class="text-center">
    Put in your email address and you'll receive a link to reset your password.
</p>

@if (session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    <style type="text/css">form{display:none;}</style>
@endif

<form method="POST" action="/password/email" class="authentication-form">
    {!! csrf_field() !!}

        @if (session('fail'))
            {{session('fail')}}
        @endif

    <div>
        Email
        <input type="email" name="email" value="{{ $email or old('email') }}">
    </div>

    <div>
        <button type="submit" class="button button-raised button-primary">
            Send Password Reset Link
        </button>
    </div>
</form>
@stop
