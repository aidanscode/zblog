@extends('layouts.blog')

@section('title', 'Manage')

@section('content')
<div class="container">
  <h1>Welcome to {{ $blog->display_name }}</h1>

  <h3 class="mt-3">Check out my recent posts!</h3>
  @forelse($posts as $post)
    <p><a href="{{ $post->getViewUrl($blog) }}">{{ $post->title }}</a> (Posted {{ $post->created_at->toDateTimeString() }})</p>
  @empty
    <p>No posts yet, stay tuned!</p>
  @endforelse
  {{ $posts->links() }}
</div>
@endsection
