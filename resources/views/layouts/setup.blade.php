@extends('layouts.theme')
@section('content')
<div id="setup">
  <div class="bg__blue r__10 p-4 min_vh_50">
    <img src="{{ asset('images/mantenar_logo.svg') }}" alt="Mantenar Logo">
  </div>
  <div class="row d-flex justify-content-center">
    <div class="mt__neg__ p- col-11 col-md-9">
      <div class="py-4"> @yield('header_text') </h4>
      <div class="bg-white r__10 min_vh_50 p-4">@yield('setup')</div>
    </div>
  </div>
</div>
@endsection