<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title') - {{ $blog->getDisplayName() }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
  </head>
  <body>
    @include('includes.navbar.blog')
    @include('includes.messages')

    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
  </body>
</html>
