@extends('layouts.blog')

@section('title', 'Post Version History')

@section('content')
<div class="container">
  <h1>Version History for Post</h1>

  @foreach($post->contents as $postContent)
    <p>
      Version {{ $postContent->version }}:
      <a href="{{ $post->getViewUrl($blog, $postContent->version) }}">{{ $postContent->getTitle() }}</a>
      (Posted {{ $postContent->created_at->toDateTimeString() }})
    </p>
  @endforeach
</div>
@endsection
