@extends('layouts.blog')

@section('title', 'Create Post')

@section('scripts')
<script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>

<script>
  const editor = new toastui.Editor({
    el: document.getElementById('editor'),
    usageStatistics: false,
    previewStyle: 'vertical',
    hideModeSwitch: true,
    previewHighlight: false,
    height: '500px'
  });

  document.getElementById('post-form').addEventListener('submit', function(e) {
    const markdownInput = editor.getMarkdown();
    if (markdownInput.trim().length === 0) {
      e.preventDefault();
      alert('Your post has no content!');
    }

    const content = document.createElement('input');
    content.setAttribute('name', 'content');
    content.setAttribute('type', 'hidden');
    content.setAttribute('value', markdownInput);
    this.appendChild(content);
  });
</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />
@endsection

@section('content')
<div class="container">
  <div class="d-block">
    <h1 class="float-start">Create Post</h1>
  </div>
  <div class="clearfix"></div>

  <form id="post-form" action="{{ route('post.store', ['blog' => $blog->subdomain]) }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="form-group">
          <label for="title">Post Title</label>
          <input type="text" name="title" id="title" class="form-control" placeholder="Post Title" value="{{ old('title') }}" required autofocus />
        </div>
      </div>

      <div class="col-12 mt-4">
        <div id="editor"></div>
      </div>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-primary mt-4">Publish</button>
    </div>
  </form>
</div>
@endsection
