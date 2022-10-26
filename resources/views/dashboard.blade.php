@extends('layouts.app')
@section('app_content')

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
            <div class="__icon"> <i class='bx bxs-hdd'></i> </div>
            <h4 class="__count"> {{$storage['size']}} {{$storage['type']}}</h4>
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
  <div class="col-md-6 pb-4 pb-md-0">
    <div class="r__10 p-3 bg-white">
      <h5>Sent</h5>
      <div class="table-responsive">
        <table class="table align-middle table-striped text-nowrap">
          <thead>
            <tr class="bg-light">
              <th scope="col">Document Name</th>
              <th scope="col">Shared with</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @forelse (auth()->user()->sent as $sent)
            <tr>
              <td> {{$sent->name}} </td>
              <td> {{$sent->viewers[0]->fullname}} 
                @if ($sent->viewers->count() > 1)
                <span class="__others">+{{$sent->viewers->count()-1}} others</span>
                @endif
              </td>
              <td class="float__left"><a href="{{route('viewshare', $sent->slug)}}" class="btn btn__b_blue">View</a></td>
            </tr>
            @empty
            <tr>
              <td colspan="3" class="text-center p-5">
                You currently have no shared file. <br> <a href="{{route('newshare')}}" class="btn btn__b_outline_blue px-4 mt-2">New Share</a>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="r__10 p-3 bg-white">
      <h5>Shared with me</h5>
      <div class="table-responsive">
        <table class="table align-middle table-striped text-nowrap">
          <thead>
            <tr class="bg-light">
              <th scope="col">Document Name</th>
              <th scope="col">Shared by</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @forelse (auth()->user()->recieved as $recieved)
            <tr>
              <td> {{$recieved->name}} </td>
              <td> {{$recieved->owner->fullname}} </td>
              <td class="float__left"><a href="{{route('viewshare', $recieved->slug)}}" class="btn btn__b_blue">View</a></td>
            </tr>
            @empty
            <tr>
              <td colspan="3" class="text-center p-5">
                No file has been shared with you.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection