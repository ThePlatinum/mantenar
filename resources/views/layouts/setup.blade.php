@extends('layouts.theme')
@section('content')
<div id="setup" class="__setup">
  <div class="bg__blue r__10 p-4 p-md-5 min_vh_50">
    <img src="{{ asset('images/mantenar_logo.svg') }}" alt="Mantenar Logo" width="250" height="85">
  </div>
  <div class="row d-flex justify-content-center">
    <div class="mt__neg__ col-11 col-md-9">
      <div class="py-5"> @yield('header_text') </h4>
      <div class="bg-white r__10 p-4 p-md-5">@yield('setup')</div>
    </div>
  </div>
</div>
@endsection