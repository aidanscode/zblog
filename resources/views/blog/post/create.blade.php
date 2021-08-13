@extends('layouts.blog')

@section('title', 'Create Post')

@section('content')
<div class="container">
  <div class="d-block">
    <h1 class="float-start">Create Post</h1>
  </div>
  <div class="clearfix"></div>

  <form action="{{ route('post.store', ['blog' => $blog->subdomain]) }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="form-group">
          <label for="title">Post Title</label>
          <input type="text" name="title" id="title" class="form-control" placeholder="Post Title" value="{{ old('title') }}" required />
        </div>
      </div>

      <div class="col-12 mt-4">
        <div class="form-group">
          <label for="content">Post Content</label>
          <textarea name="content" id="content" class="form-control" placeholder="Your beautiful post..." required>{{ old('content') }}</textarea>
        </div>
      </div>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-primary mt-4">Publish</button>
    </div>
  </form>
</div>
@endsection
