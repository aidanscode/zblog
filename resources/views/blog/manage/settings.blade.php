@extends('layouts.blog')

@section('title', 'Blog Settings')

@section('content')
<div class="container">
  <h1>Blog Settings</h1>

  <form action="{{ route('blog.manage.settings.save', ['blog' => $blog->subdomain]) }}" method="POST">
    @csrf

    <div class="row">
      <div class="col-12 col-md-6">
        <div class="form-group">
          <label for="display_name">Blog Name</label>
          <input type="text" class="form-control" name="display_name" id="display_name" placeholder="Your blog's name" value="{{ $blog->display_name }}" required />
        </div>
      </div>
    </div>

    <div class="text-center mt-5">
      <input type="submit" class="btn btn-primary" value="Save Settings" />
    </div>
  </form>
</div>
@endsection
