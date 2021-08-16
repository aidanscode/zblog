@extends('layouts.blog')

@section('title', 'Edit Post')

@section('scripts')
<script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>

<script>
  let editor;
  fetch('{{ $post->getContentUrl($blog) }}')
    .then(function(response) {
      return response.json();
    })
    .then(function(jsonResponse) {
      if (!jsonResponse.success) {
        document.getElementById('editor').innerText = 'Failed to load content! Please try again later...';
        document.getElementById('form-submit-btn').remove();
      } else {
        document.getElementById('title').value = jsonResponse.data.title;

        editor = new toastui.Editor({
          el: document.getElementById('editor'),
          usageStatistics: false,
          previewStyle: 'vertical',
          hideModeSwitch: true,
          previewHighlight: false,
          height: '500px',
          initialValue: jsonResponse.data.content
        });
      }
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
    <h1 class="float-start">Edit Post</h1>
    <button class="btn btn-danger float-end mt-2" data-bs-toggle="modal" data-bs-target="#delete-modal">
      Delete Post
    </button>
  </div>
  <div class="clearfix"></div>

  <form id="post-form" action="{{ $post->getUpdateUrl($blog) }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="form-group">
          <label for="title">Post Title</label>
          <input type="text" name="title" id="title" class="form-control" placeholder="Post Title" required />
        </div>
      </div>

      <div class="col-12 mt-4">
        <div id="editor"></div>
      </div>
    </div>

    <div class="text-center">
      <button type="submit" id="form-submit-btn" class="btn btn-primary mt-4">Update</button>
    </div>
  </form>
</div>

<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delete-modal-label">Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this post?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, go back</button>
        <form action="{{ $post->getDeleteUrl($blog) }}" method="POST">
          @csrf
          <input type="hidden" name="_method" value="DELETE" />
          <button type="submit" class="btn btn-danger">Yes, delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
