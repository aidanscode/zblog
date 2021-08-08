@extends('layouts.app')

@section('title', 'Create Blog')

@section('content')
<div class="container">
  <h1>Create Blog</h1>

  <form action="{{ route('profile.store_blog') }}" method="POST">
    @csrf

    <div class="row">
      <div class="col-12 col-md-6">
        <div class="form-group">
          <label for="display_name">Blog Name</label>
          <input type="text" name="display_name" id="display_name" placeholder="Your blog's name!" class="form-control" value="{{ old('display_name') }}" />
        </div>
      </div>

      <div class="col-12 col-md-6">
        <label for="subdomain" class="form-label mb-0">Subdomain</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="subdomain" id="subdomain" placeholder="Must be unique!" value="{{ old('subdomain') }}">
          <span class="input-group-text">.{{ \App\Libraries\Helpers::stripProtocolAndPortFromDomain(env('APP_URL')) }}</span>
        </div>
      </div>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-primary">Create Blog!</button>
    </div>
  </form>
</div>
@endsection
