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
      <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="row mb-3">
          <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

          <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="row mb-0">
          <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
              {{ __('Send Password Reset Link') }}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="col-md-2"></div>

</div>
@endsection