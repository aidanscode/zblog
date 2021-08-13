@extends('layouts.blog')

@section('title', $post->title)

@section('content')
<div class="container">
  <div class="d-block">
    <h1 class="float-start">{{ $post->title }}</h1>
    <button class="btn btn-danger float-end mt-2">Edit Post</button>
  </div>
  <div class="clearfix"></div>

  {{ $post->content }}
</div>
@endsection
