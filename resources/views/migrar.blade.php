@extends('layouts.app')
@section('app_content')
<div class="text-center p-5" style="height: 70vh;">
  <h1 class="py-4"> {{$status}} </h2>
  <h2 class="pb-4"> {{$message}} </h2>
  <a href="{{route('dashboard')}}" class="btn btn-outline-dark px-5 "> {{$action}} </a>
</div>
@endsection