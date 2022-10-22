@extends('layouts.app')
@section('app_content')

<div class="row py-4">
  <div class="col-md-8 pb-4 pb-md-0">
    <div class="r__10 p-3 bg-white">
      <div class="row">
        <div class="col-md-9 pb-3 pb-md-0">
          <h2> {{$share->name}} </h2>
          <h5>Shared by <b>{{$share->owner->fullname}}</b> with {{$share->viewers[0]->fullname}}
            @if ($share->viewers->count() > 1)
            <span class="__others">+{{$share->viewers->count()-1}} others</span>
            @endif
          </h5>
          <p class="m-0 p-0">{{$share->storage['size']}}{{$share->storage['type']}} | {{ date_format($share->created_at, 'd, M Y') }} </p>
        </div>
        <div class="col-md-3">
          <div class="d-flex gap-2 flex-md-column ">
            <a href="{{$share->file_url}}" download="{{\Str::slug($share->name, '_')}}" class="btn btn__b_outline_blue btn-sm">Download</a>
            @if ($share->owner == auth()->user() || auth()->user()->is_admin)
            <a href="" class="btn btn__b_outline_blue btn-sm">Edit Access</a>
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="r__10 filbox my-3 p-3">
      @switch(strtolower($share->type))
      @case('png')
      @case('jpeg')
      @case('jpg')
      <img src="{{$share->file_url}}" alt="{{$share->name}}" class="file__share" />
      @break
      @case('pdf')
      <iframe src="{{$share->file_url}}" class="file__share">Your browser isn't compatible with this file type download the file and open locally on your device</iframe>
      @break
      @default
      <div class="file__share p-5 text-center"> Can't display file type </div>
      @endswitch
    </div>
  </div>
  <div class="col-md-4">
    <div class="r__10 p-3 bg-white mb-4">
      <small>Shared Note</small>
      <hr class="mt-0 pt-0">
      <p> {{$share->note}} </p>
    </div>

    <div class="r__10 p-3 bg-white">
      <small>Comments</small>
      <hr class="mt-0 pt-0">
    </div>
  </div>
</div>
@endsection