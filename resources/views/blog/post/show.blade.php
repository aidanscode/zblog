@extends('layouts.blog')

@section('title', $post->getLatestTitle())

@section('scripts')
<script src="https://uicdn.toast.com/editor/latest/toastui-editor-viewer.js"></script>

<script>
  const Viewer = toastui.Editor;
  const viewer = new toastui.Editor({
    el: document.getElementById('viewer'),
    usageStatistics: false,
    initialValue: 'Loading...'
  });

  fetch('{{ $post->getContentUrl($blog, $version) }}')
    .then(function(response) {
      return response.json()
    })
    .then(function(jsonResponse) {
      let contentToDisplay, title;

      if (!jsonResponse.success) {
        title = 'Failed!';
        contentToDisplay = 'Failed to load post! Please try again later.';
      } else {
        title = jsonResponse.data.title;
        contentToDisplay = jsonResponse.data.content;
      }

      document.getElementById('post-title').innerText = title;
      viewer.setMarkdown(contentToDisplay);
    });
</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor-viewer.min.css" />
@endsection

@section('content')
<div class="container">
  <div class="d-block">
    <h1 class="float-start mb-0 pb-0" id="post-title">Loading...</h1>
    @if($blog->canUserManageBlog(auth()->user()))
    <a href="{{ $post->getEditUrl($blog) }}" class="btn btn-danger float-end mt-2">Edit Post</a>
    @endif
  </div>
  <div class="clearfix"></div>
  <small class="text-muted mt-0 pt-0">
    Posted by {{ $post->author->name }} on {{ $post->created_at->toDateTimeString() }}
    @if($post->contents->count() > 1)
    (Last edited on {{ $post->contents->last()->created_at->toDateTimeString() }}, <a href="{{ $post->getVersionHistoryUrl($blog) }}" class="text-muted p-0 m-0">see version history</a>)
    @endif
  </small>

  <div id="viewer"></div>
</div>
@endsection
