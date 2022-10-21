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

<div class="row pt-4">
  <div class="col-md-6 pb-4 pb-md-0">
    <div class=" r__10 p-3 bg-white d-flex gap-3">
      <div class="__icon"> <i class='bx bx-user'></i> </div>
      <div>
        <h4>{{ auth()->user()->fullname }}</h4>
        <h6> {{auth()->user()->is_admin ? 'Admin' : 'Staff' }} | {{auth()->user()->job_title}} </h6>
        <h6> {{auth()->user()->email}} </h6>
      </div>
    </div>
  </div>

  <div class="col-6 col-md-3">
    <div class="r__10 p-3 bg-white">
      <small>Sent</small>
      <div class="d-flex gap-3 align-items-center pt-2">
        <div class="__icon"> <i class='bx bx-up-arrow-alt'></i> </div>
        <h4 class="__count">{{ auth()->user()->sent->count() }}</h4>
      </div>
    </div>
  </div>

  <div class="col-6 col-md-3">
    <div class=" r__10 p-3 bg-white">
      <small>Shared with me</small>
      <div class="d-flex gap-3 align-items-center pt-2">
        <div class="__icon"> <i class='bx bx-down-arrow-alt'></i> </div>
        <h4 class="__count">{{ auth()->user()->recieved->count() }}</h4>
      </div>
    </div>
  </div>
</div>

@admin
<div class="row pt-4">
  <div class="col-md-6 pb-4 pb-md-0">
    <div class="r__10 p-4 bg-white">
      <div class="row">
        <div class="col-md-6 pb-4 pb-md-0">
          <small>All Files</small>
          <div class="d-flex gap-3 align-items-center pt-2">
            <div class="__icon"> <i class='bx bxs-file'></i> </div>
            <h4 class="__count"> {{$shares}} </h4>
          </div>
        </div>

        <div class="col-md-6">
          <small>Stroage Used</small>
          <div class="d-flex gap-3 align-items-center pt-2">
            <div class="__icon"> <i class='bx bxs-hdd' ></i> </div>
            <h4 class="__count"> {{$storage}} </h4>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class=" r__10 p-4 bg-white">

      <div class="row">
        <div class="col-md-6 pb-4 pb-md-0">
          <small>Admins</small>
          <div class="d-flex gap-3 align-items-center pt-2">
            <div class="__icon"> <i class='bx bx-user-pin'></i> </div>
            <h4 class="__count"> {{$admins}} </h4>
          </div>
        </div>

        <div class="col-md-6">
          <small>Staffs</small>
          <div class="d-flex gap-3 align-items-center pt-2">
            <div class="__icon"> <i class='bx bxs-user-badge'></i> </div>
            <h4 class="__count"> {{$staffs}} </h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endadmin

<div class="row pt-4">
  <div class="col-md-6">
    <div class=" r__10 p-3 bg-white">
      <h5>Sent</h5>
      @forelse (auth()->user()->recieved as $recieved)

      @empty
      <div class="py-5 text-center">
        You currently have no shared file. <br> <a href="" class="btn btn__b_outline_blue px-4 mt-1">New Share</a>
      </div>
      @endforelse
    </div>
  </div>

  <div class="col-md-6">
    <div class=" r__10 p-3 bg-white">
      <h5>Shared with me</h5>
      @forelse (auth()->user()->sent as $sent)

      @empty
      <div class="py-5 text-center">
        You currently have no file shared with you. <br>
      </div>
      @endforelse
    </div>
  </div>
</div>

@endsection