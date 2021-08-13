@extends('layouts.blog')

@section('title', 'Manage')

@section('content')
<div class="container">
  <div class="d-block">
    <h1 class="float-start">Post Management</h1>
    <button class="btn btn-primary float-end mt-2">Create New Post</button>
  </div>
  <div class="clearfix"></div>

  <h2 class="mt-3">Recent Posts</h2>
  @forelse($posts as $post)
    <p><a href="{{ $post->getViewUrl($blog) }}">{{ $post->title }}</a> (Posted {{ $post->created_at->toDateTimeString() }})</p>
  @empty
    <p>No posts yet...</p>
  @endforelse
  {{ $posts->links() }}
</div>
@endsection