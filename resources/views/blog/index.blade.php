@extends('layouts.blog')

@section('title', 'Home')

@section('content')
<div class="container">
  <h1 class="float-start">Welcome to {{ $blog->getDisplayName() }}!</h1>
</div>
@endsection
