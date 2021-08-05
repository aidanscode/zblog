<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="{{ route('page.index') }}">{{ env('APP_NAME') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('page.index') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
      </ul>
      <div class="float-end">
        @if(auth()->check())
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
