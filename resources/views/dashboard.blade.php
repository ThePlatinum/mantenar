@extends('layouts.theme')
@section('content')
<div class="bg__blue r__10 p-3 d-flex justify-content-between align-items-center">
  <img src="{{ asset('images/mantenar_logo.svg') }}" alt="Mantenar Logo" class="brand__">
  <div class="d-flex gap-3">
    @admin
    <button class="btn btn-outline-light __dropdown">
      <i class="bx bx-menu"></i>
      <div class="dropdown__content">
        <div class="dropdown__item">
          <a href="" class="btn">Manage Staffs</a>
       </div>
        <div class="dropdown__item">
          <a href="" class="btn">Settings</a>
       </div>
      </div>
    </button>
    @endadmin
    <a href="" class="btn btn-outline-light px-4">New Share</a>
    <a class="btn btn-outline-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="bx bx-log-out"></i>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </div>
</div>

<div class="row py-4">
  <div class="col-md-6">
    <div class=" r__10 p-3 bg-white">
    </div>
  </div>

  <div class="col-6 col-md-3">
    <div class="r__10 p-3 bg-white">
      <small>Sent</small>
    </div>
  </div>


  <div class="col-6 col-md-3">
    <div class=" r__10 p-3 bg-white">
      <small>Shared with me</small>
    </div>
  </div>
</div>

@admin
<div class="row pt-4">
  <div class="col-md-6">
    <div class=" r__10 p-4 d-flex justify-content-between bg-white"></div>
  </div>

  <div class="col-md-6">
    <div class=" r__10 p-4 d-flex justify-content-between bg-white"></div>
  </div>
</div>
@endadmin

<div class="row pt-4">
  <div class="col-md-6">
    <div class=" r__10 p-3 bg-white">
      <h5>Sent</h5>
    </div>
  </div>

  <div class="col-md-6">
    <div class=" r__10 p-3 bg-white">
      <h5>Shared with me</h5>
    </div>
  </div>
</div>

@endsection