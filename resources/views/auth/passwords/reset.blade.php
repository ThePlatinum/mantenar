@extends('layouts.theme')

@section('content')
<div class="row">

  <div class="col-md-2"></div>
  <div class="col-2">
    <div class="bg__blue p-4 r__10 h-100"></div>
  </div>

  <div class="col-10 col-md-6 py-5">
    <img src="{{ asset('images/mantenar_logo.svg') }}" alt="Mantenar Logo">

    <div class="bg-white ml__neg__ p-4 pe-5 mt-4 r__10">

      <div class="pb-4">
        <small class="text-muted">Organization</small>
        <h1> {{ \App\Models\Setting::org_name() ?? '' }} </h1>
      </div>

      <h4>Reset Password</h4>
      <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror

        <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror

        <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        
        <button type="submit" class="btn btn-primary mt-3">
          {{ __('Reset Password') }}
        </button>
      </form>
    </div>
  </div>
  <div class="col-md-2"></div>
</div>
@endsection