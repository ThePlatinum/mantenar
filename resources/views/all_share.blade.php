@extends('layouts.app')
@section('app_content')

<div class="p-0 p-md-5 py-3">
  <h1 class="pb-2 pb-md-3">All Files Shared</h1>
  <div class="bg-white p-3 p-md-4 r__10">
    <div class="table-responsive">
      <table data-toggle="table" data-search="true" data-sortable="true"  data-pagination="true"
        class="table align-middle table-striped text-nowrap">
        <thead>
          <tr class="bg-light">
            <th scope="col" data-sortable="true">Document Name</th>
            <th scope="col" data-sortable="true">Shared by</th>
            <th scope="col" data-sortable="true" data-sortable="true">Shared with</th>
            <th scope="col" data-sortable="true">Date</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($all as $file)
          <tr>
            <td> {{$file->name}} </td>
            <td> {{$file->owner->fullname}} </td>
            <td> {{$file->viewers[0]->fullname}}
              @if ($file->viewers->count() > 1)
              <span class="__others">+{{$file->viewers->count()-1}} others</span>
              @endif
            </td>
            <td> {{ date_format($file->created_at, DATE_RFC850) }} </td>
            <td class="float__left"><a href="{{route('viewshare', $file->slug)}}" class="btn btn__b_blue">View</a></td>
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
</div>

@endsection