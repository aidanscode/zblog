@extends('layouts.blog')

@section('title', 'Blog Management')

@section('content')
<div class="container">
  <h1>Blog Management</h1>

  <h2 class="mt-3">Actions</h2>
  <p><a href="{{ route('blog.manage.posts', ['blog' => $blog->subdomain]) }}">Post Management</a></p>
  <p><a href="{{ route('blog.manage.posts', ['blog' => $blog->subdomain]) }}">Edit Blog Settings</a></p>
  <p>Blog Data Export (Coming soon!)</p>
  <p>Delete Blog (Coming soon!)</p>
</div>
@endsection
