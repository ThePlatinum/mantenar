@extends('layouts.setup')
@section('setup')
@section('header_text')
<h1 class="text-white">Welcome to <a href="https://mantenar.com" target="_blank" rel="noopener noreferrer" class="b__p">Mantenar</a>! </h1>
@endsection
<h4>Get started with your Organization's Name</h4>

<form action="{{route('setup_organization')}}" method="post" class="pt-4">
  @csrf

  <input class="form-control setup_input @error('org_name') is-invalid @enderror" autocomplete autocapitalize type="text" name="org_name" id="org_name" placeholder="Organization's Name" required>
  @error('org_name')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror

  <input type="submit" value="Create Organization" class="btn btn__b_blue px-4 btn-lg mt-3">
</form>
@endsection