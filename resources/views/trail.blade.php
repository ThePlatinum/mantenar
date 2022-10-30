@extends('layouts.app')
@section('app_content')

<div class="p-0 p-md-5 py-3">
  <h1>Audit Trails</h1>
  <p class="pb-2 pb-md-3"><small>See who did what and when?</small></p>

  <div class="bg-white p-3 p-md-4 r__10">
    <h6 class="p-0 m-0">All Users</h6>
    <div class="table-responsive">
      <table 
        data-toggle="table" data-search="true" data-sortable="true"
        class="table align-middle table-striped text-nowrap">
        <thead>
          <tr class="bg-light">
            <th scope="col">Action</th>
            <th scope="col" data-sortable="true">User</th>
            <th scope="col" data-sortable="true">Time</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($actions as $action)
          <tr>
            <td> {{$action->action}} </td>
            <td> {{$action->user->fullname}} </td>
            <td> {{date_format($action->created_at, 'd, M Y')}} </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection