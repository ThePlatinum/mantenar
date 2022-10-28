@extends('layouts.theme')
@section('content')
<div id="setup">
  <div class="bg__blue r__10 p-4 min_vh_50">
    <img src="{{ asset('images/mantenar_logo.svg') }}" alt="Mantenar Logo">
  </div>
  <div class="row d-flex justify-content-center">
    <div class="mt__neg__ col-11 col-md-9 text-center">
      <div class="py-5">
        <h2 class="text-danger pb-5"> Oops! Something's wrong</h2>
        <div class="r__10 bg-white p-3 p-md-5">
          <h4> The invitation link has expired or not valid, please contact <span class="b__p">{{ \App\Models\Setting::org_name() }}</span> </h4>
          <a class="btn btn__b_outline_blue px-4 btn-lg mt-3" href="{{route('login')}}"> Go To Login </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection