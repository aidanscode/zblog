@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container">
  <div>
    <h1 class="float-start">My Blogs</h1>
    @if(auth()->user()->canCreateNewBlog())
    <a href="{{ route('profile.create_blog') }}" class="btn btn-primary float-end">
      Create Blog
    </a>
    @endif
  </div>

  <table class="table text-center">
    <thead>
      <tr>
        <th>Name</th>
        <th>Subdomain</th>
        <th>Created</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      @foreach($blogs as $blog)
      <tr>
        <td>{{ $blog->display_name }}</td>
        <td>{{ $blog->subdomain }}</td>
        <td>{{ $blog->created_at }}</td>
        <td><a href="{{ $blog->getBlogIndexUrl() }}" target="_blank">{{ $blog->getBlogIndexUrl() }}</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
