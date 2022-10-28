@extends('layouts.setup')
@section('setup')
@section('header_text')
<h1 class="text-white">You have been Invited to share files with, <span class="b__p"> {{ $org_name }} </span>! </h1>
@endsection
<h4>Create your profile to get started</h4>

<form action="{{route('register_invite')}}" method="post" class="pt-4">
  @csrf
  <input type="hidden" name="invite_id" value="{{$invite_id}}">

  <div class="row">
    <div class="col-12">
      <input class="form-control setup_input @error('email') is-invalid @enderror" autocapitalize autocomplete type="email" name="email" placeholder="Email" readonly value="{{$email}}">
      @error('email')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="col-md-6">
      <input class="form-control setup_input @error('firstname') is-invalid @enderror" autocomplete name="firstname" placeholder="First Name" required value="{{old('firstname')}}">
      @error('firstname')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="col-md-6">
      <input class="form-control setup_input @error('lastname') is-invalid @enderror" autocomplete name="lastname" placeholder="Last Name" required value="{{old('lastname')}}">
      @error('lastname')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="col-md-6">
      <input class="form-control setup_input @error('job_title') is-invalid @enderror" autocomplete name="job_title" placeholder="Job Title" required value="{{old('job_title')}}">
      @error('job_title')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="col-md-6">
      <input class="form-control setup_input @error('password') is-invalid @enderror" autocomplete name="password" id="password" placeholder="Choose Password" required>
      @error('password')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

  </div>

  <input type="submit" value="Create Administrator" class="btn btn__b_blue px-4 btn-lg mt-3">
</form>
@endsection