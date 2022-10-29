@extends('layouts.app')
@section('app_content')

<div class="p-0 p-md-5 py-3">
  <h1 class="pb-2 pb-md-3">Manage Users Access and Role</h1>
  <div class="bg-white p-3 p-md-4 r__10 mb-5">

    <div class="d-flex justify-content-between align-items-center pb-2">
      <h6 class="p-0 m-0">Pending Invites</h6>
      <button class="btn btn__b_blue px-5" data-bs-toggle="modal" data-bs-target="#inviteModal">
        Invite User
      </button>
    </div>

    <div class="table-responsive">
      <table class="table align-middle table-striped text-nowrap">
        <thead>
          <tr class="bg-light">
            <th scope="col">Email</th>
            <th scope="col">Invited Since</th>
            <th scope="col">Invite Status</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($invites as $invite)
          <tr>
            <td> {{$invite->invite_email}} </td>
            <td> {{ date_format($invite->created_at, 'd, M Y') }} </td>
            <td> {{$invite->deleted_at < now() ? 'Expired' : 'Active'}} </td>
            <td class="float__left gap-3">
              <btn class="btn btn-outline-danger" onclick="delete_invite('{{$invite->id}}')">Delete Invite</btn>
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

  <div class="bg-white p-3 p-md-4 r__10">
    <h6 class="p-0 m-0">All Users</h6>
    <div class="table-responsive">
      <table class="table align-middle table-striped text-nowrap">
        <thead>
          <tr class="bg-light">
            <th scope="col">Full Name</th>
            <th scope="col">Role</th>
            <th scope="col">Title</th>
            <th scope="col">Status</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <td> {{$user->fullname}} </td>
            <td> {{$user->is_admin ? 'Admin' : 'Staff'}} </td>
            <td> {{$user->job_title}} </td>
            <td> {{$user->trashed() ? 'Disabled' : 'Enabled'}} </td>
            <td class="float__left gap-3">
              @if (auth()->user()->id != $user->id)
              @if ($user->trashed())
              <btn class="btn btn-outline-success" onclick="enable_user('{{$user->id}}')">Enable Account</btn>
              @else
              <btn class="btn btn-outline-warning" onclick="disable_user('{{$user->id}}')">Disable Account</btn>
              @endif
              <btn class="btn btn-outline-danger" onclick="delete_user('{{$user->id}}')">Delete Account</btn>
              @else
              <p class="text__invisible">No Delete yourself</p>
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
<script>
  function delete_invite(user_id) {
    bootbox.confirm({
      title: "Delete Invite?",
      message: "Are you sure you want to delete this invitation?",
      callback: e => {
        if (e)
          $.ajax({
            url: "{{route('delete_invite')}}",
            method: 'POST',
            data: {
              invite_id: user_id,
              _token: '{{csrf_token()}}'
            },
            success: () => {
              window.location.href = "users"
            }
          })
      }
    });
  }

  function disable_user(user_id) {
    bootbox.confirm({
      title: "Disable User's Account?",
      message: "Disabling the Users Account will stop their access to the platform, but, all their shared files remain intact. <br/> Proceed?",
      callback: e => {
        if (e)
          $.ajax({
            url: "{{route('pause_user')}}",
            method: 'POST',
            data: {
              user_id: user_id,
              _token: '{{csrf_token()}}'
            },
            success: () => {
              window.location.href = "users"
            }
          })
      }
    });
  }

  function enable_user(user_id) {
    bootbox.confirm({
      title: "Enable User's Account?",
      message: "Enabling the Users Account will restore their access to the platform. <br/> Proceed?",
      callback: e => {
        if (e)
          $.ajax({
            url: "{{route('restore_user')}}",
            method: 'POST',
            data: {
              user_id: user_id,
              _token: '{{csrf_token()}}'
            },
            success: () => {
              window.location.href = "users"
            }
          })
      }
    });
  }

  function delete_user(user_id) {
    bootbox.confirm({
      title: "Delete User's Account?",
      message: "Are you sure you want to delete this 's account? All File share and activities will  This action is irrevesible. <br/> Proceed?",
      callback: e => {
        if (e)
          $.ajax({
            url: "{{route('delete_user')}}",
            method: 'POST',
            data: {
              user_id: user_id,
              _token: '{{csrf_token()}}'
            },
            success: () => {
              window.location.href = "users"
            }
          })
      }
    });
  }
</script>
@endpush

@endsection