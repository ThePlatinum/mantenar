@extends('layouts.theme')
@section('content')
<div id="app">
  <div class="bg__blue r__10 p-3 d-flex justify-content-between align-items-center">
    <a href="{{route('dashboard')}}"><img src="{{ asset('images/mantenar_logo.svg') }}" alt="Mantenar Logo" class="brand__"></a>

    <!-- Large -->
    <div class="gap-3 d-none d-md-flex ">
      @admin
      <button class="btn btn-outline-light __dropdown">
        <i class="bx bx-menu"></i>
        <div class="dropdown__content">
          <div class="dropdown__item">
            <a href="{{route('all_files')}}" class="btn">All Shared Files</a>
          </div>
          <div class="dropdown__item">
            <a href="{{route('staffs')}}" class="btn">Manage Users</a>
          </div>
          <div class="dropdown__item">
            <a href="{{route('trail')}}" class="btn">Audit Trail</a>
          </div>
          <!-- <div class="dropdown__item">
            <a href="" class="btn">Settings</a>
          </div> -->
        </div>
      </button>
      @endadmin
      <a href="{{route('newshare')}}" class="btn btn-outline-light px-4">New Share</a>
      @if(!request()->routeIs('dashboard'))
      <a href="{{route('dashboard')}}" class="btn btn-outline-light">
        <i class='bx bxs-home'></i>
      </a>
      @endif
      <a class="btn btn-outline-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bx bx-log-out"></i>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </div>

    <!-- Mobile -->
    <div class="d-block d-md-none">
      <button class="btn btn-outline-light __dropdown">
        <i class="bx bx-menu"></i>
        <div class="dropdown__content">
          @if(!request()->routeIs('dashboard'))
          <div class="dropdown__item">
            <a href="{{route('dashboard')}}" class="btn">Dashboard</a>
          </div>
          @endif
          @admin
          <div class="dropdown__item">
            <a href="{{route('all_files')}}" class="btn">All Shared Files</a>
          </div>
          <div class="dropdown__item">
            <a href="{{route('staffs')}}" class="btn">Manage Users</a>
          </div>
          <div class="dropdown__item">
            <a href="{{route('trail')}}" class="btn">Audit Trail</a>
          </div>
          <!-- <div class="dropdown__item">
            <a href="" class="btn">Settings</a>
          </div> -->
          @endadmin

          <div class="dropdown__item">
            <a href="{{route('newshare')}}" class="btn">New Share</a>
          </div>
          <div class="dropdown__item">
            <a class="btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
          </div>
        </div>
      </button>
    </div>
  </div>

  @yield('app_content')
</div>
@endsection