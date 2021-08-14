@extends('layouts.blog')

@section('title', $post->title)

@section('scripts')
<script src="https://uicdn.toast.com/editor/latest/toastui-editor-viewer.js"></script>

<script>
  const Viewer = toastui.Editor;
  const viewer = new toastui.Editor({
    el: document.getElementById('viewer'),
    usageStatistics: false,
    initialValue: 'Loading...'
  });

  fetch('{{ $post->getContentUrl($blog) }}')
    .then(function(response) {
      return response.json()
    })
    .then(function(jsonResponse) {
      let contentToDisplay;
      if (!jsonResponse.success) {
        contentToDisplay = 'Failed to load post! Please try again later.';
      } else {
        contentToDisplay = jsonResponse.data.content;
      }

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
    <h1 class="float-start">{{ $post->title }}</h1>
    {{-- TODO <button class="btn btn-danger float-end mt-2">Edit Post</button> --}}
  </div>
  <div class="clearfix"></div>

  <div id="viewer"></div>
</div>
@endsection
