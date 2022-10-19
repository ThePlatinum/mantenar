@extends('layouts.app')

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

      <h4>Login</h4>
      <form method="POST" action="{{ route('login') }}" >
        @csrf

        <input id="email" type="email" class="form-control setup_input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
        @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror

        <input id="password" type="password" class="form-control setup_input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
        @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror

        <div class="d-flex justify-content-between align-items-center py-4">

          <div>
            <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
            <label class="form-check-label" for="remember">
              {{ __('Remember Me') }}
            </label>
          </div>
          <button type="submit" class="btn btn__b_blue w-50"> Login </button>

        </div>

        @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}">
          Forgot Your Password?
        </a>
        @endif

        <p>Want to set up your own private file share? <a href="http://mantenar.com/" target="_blank" rel="noopener noreferrer">Get Started Here!</a></p>
      </form>
    </div>
  </div>

  <div class="col-md-2"></div>

</div>
@endsection