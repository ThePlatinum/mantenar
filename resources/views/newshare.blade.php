@extends('layouts.app')
@section('app_content')
<style>
  .dropbox {
    border: 1px dashed #CCC;
    padding: 3vh 5vw;
    border-radius: 10px;
    cursor: pointer;
    background-color: #EEE5;
  }
</style>
<script>
  function filedrop(name) {
    let input = document.createElement('input');
    input.type = 'file';
    input.name = name;
    input.id = name;
    input.onchange = _this => {
      let file_name = document.getElementById(name);
      let files = Array.from(input.files);
      file_name.textContent = files[0].name
    };
    input.click();
    document.getElementById('share_form').append(input)
    input.style.display = 'none';
  }
</script>

<div class="p-2 p-md-5 py-5">
  <h1 class="pb-2 pb-md-3">Share a new File</h1>
  <div class="bg-white p-3 p-md-5 r__10">
    <form action="{{route('make_newshare')}}" method="post" enctype='multipart/form-data' id="share_form">
      @csrf

      <div class="w-100 dropbox" onclick="filedrop('file')">
        <div class="text-center p-2">
          <h4>Choose the File to Share</h4>
        </div>
        <h5 class="text-center p-2" id='file'>No file chosen</h5>
      </div>
      @error('file')
      <span class="invalid-feedback" role="alert">
        <strong>{{$message}}</strong>
      </span>
      @enderror

      <label for="name" class="col-form-label py-2 pt-4">Document Name</label>
      <input id="name" placeholder="e.g. Documentation on New Project" class="form-control" name="name" autofocus value="{{old('name')}}"/>
      @error('name')
      <span class="invalid-feedback" role="alert">
        <strong>{{$message}}</strong>
      </span>
      @enderror

      <label for="viewers" class="col-form-label py-2 pt-4">Select Viewers <small>(who to share the file with)</small></label>
      <select multiple name="viewers[]" id="viewers" class="form-control">
        @forelse ($users as $user)
        <option value="{{$user->id}}">{{$user->fullname}} ({{$user->is_admin ? 'Admin' : 'Staff' }} | {{$user->job_title}})</option>
        @empty
        <option value="null" disabled>Oops... No user has been invited to the organization</option>
        @endforelse
      </select>
      @error('viewers')
      <span class="invalid-feedback" role="alert">
        <strong>{{$message}}</strong>
      </span>
      @enderror

      <label for="note" class="col-form-label py-2 pt-4">Note <small>(optional)</small></label>
      <textarea id="note" rows="10" placeholder="Add a desciptive note to the file share" class="form-control" name="note" autofocus>{{old('note')}}</textarea>
      @error('note')
      <span class="invalid-feedback" role="alert">
        <strong>{{$message}}</strong>
      </span>
      @enderror

      <div class="text-center">
        <button class="btn btn__b_blue px-5 mt-5 btn-lg">Share File</button>
      </div>

    </form>
  </div>
</div>

@push('scripts')
<script>
  const viewrs = $('#viewers').filterMultiSelect({
    placeholderText: "Select Viewers",
    filterText: "Search",
    selectAllText: "Select All",
    labelText: "",
    caseSensitive: false,
  })
</script>
@endpush
@endsection