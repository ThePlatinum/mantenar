@extends('layouts.app')
@section('app_content')

<div class="p-2 p-md-5 py-3">
  <h1 class="pb-2 pb-md-3">Manage Users Access and Role</h1>
  <div class="bg-white p-4 r__10 mb-5">

    <div class="d-flex justify-content-between align-items-center">
      <h6>Pending Invites</h6>
      <button class="btn btn__b_blue" data-bs-toggle="modal" data-bs-target="#inviteModal">
        Invite User
      </button>
    </div>

    <div class="table-responsive">
      <table class="table align-middle table-striped text-nowrap">
        <thead>
          <tr class="bg-light">
            <th scope="col">Email</th>
            <th scope="col">Invited Since</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($invites as $invite)
          <tr>
            <td> {{$invite->invite_email}} </td>
            <td> {{ date_format($invite->created_at, 'd, M Y') }} </td>
            <td class="float__left gap-3">
              <a class="btn btn-outline-danger">Delete Invite</a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="3" class="text-center p-3">
              You currently have no pending invites.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="bg-white p-4 r__10">
    <h6>All Users</h6>
    <div class="table-responsive">
      <table class="table align-middle table-striped text-nowrap">
        <thead>
          <tr class="bg-light">
            <th scope="col">Full Name</th>
            <th scope="col">Role</th>
            <th scope="col">Title</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <td> {{$user->fullname}} </td>
            <td> {{$user->is_admin ? 'Admin' : 'Staff'}} </td>
            <td> {{$user->job_title}} </td>
            <td class="float__left gap-3">
              @if (auth()->user()->id != $user->id)
              <a class="btn btn-outline-warning">Disable Account</a>
              <a class="btn btn-outline-danger">Delete Account</a>
              @else
              <p></p>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  @include('modals.invite')
</div>

@push('scripts')
@endpush

@endsection