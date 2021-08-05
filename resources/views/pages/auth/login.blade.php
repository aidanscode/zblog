@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row text-center">
  <div class="col-12 col-md-4 offset-md-4">
    <p class="display-3">Log In</p>

    <div class="border border-dark border-1 rounded">
      <a class="btn btn-light my-3 mx-auto border border-secondary border-1"  href="{{ route('auth.provider.out', ['provider' => 'google']) }}">
        <i class="bi bi-google"></i>
        Log in With Google
      </a>
      <br />

      <a class="btn btn-dark mb-3 mx-auto" href="{{ route('auth.provider.out', ['provider' => 'github']) }}">
        <i class="bi bi-github"></i>
        Log in With GitHub
      </a>
    </div>
  </div>
</div>
@endsection
