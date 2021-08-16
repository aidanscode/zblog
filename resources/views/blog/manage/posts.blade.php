@extends('layouts.blog')

@section('title', 'Post Management')

@section('content')
<div class="container">
  <div class="d-block">
    <h1 class="float-start">Post Management</h1>
    <a href="{{ route('post.create', ['blog' => $blog->subdomain]) }}" class="btn btn-primary float-end mt-2">Create New Post</a>
  </div>
  <div class="clearfix"></div>

  <h2 class="mt-3">Recent Posts</h2>
  @forelse($posts as $post)
    <p><a href="{{ $post->getViewUrl($blog) }}">{{ $post->getLatestTitle() }}</a> (Posted {{ $post->created_at->toDateTimeString() }})</p>
  @empty
    <p>No posts yet...</p>
  @endforelse
  {{ $posts->links() }}
</div>
@endsection
