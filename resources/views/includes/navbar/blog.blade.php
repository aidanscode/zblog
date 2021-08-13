<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ $blog->getBlogIndexUrl() }}">{{ $blog->getDisplayName() }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="{{ $blog->getBlogIndexUrl() }}">Home</a>
        </li>
        <li class="nav-item">
          @if($blog->canUserManagePosts(auth()->user()))
          <a class="nav-link" href="{{ $blog->getBlogManageUrl() }}">Manage Posts</a>
          @endif
        </li>
      </ul>
      <div class="float-end">
        @if(auth()->check())
          <span class="navbar-text me-2">
            {{ auth()->user()->name }}
          </span>

          <a
            class="btn btn-light"
            href="{{ route('auth.logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          >
            Log Out
          </a>

          <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        @else
          <a class="btn btn-light" href="{{ route('auth.login') }}">Log In</a>
        @endif
      </div>
    </div>
  </div>
</nav>
