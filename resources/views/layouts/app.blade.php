<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title') - {{ env('APP_NAME') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
  </head>
  <body>
    @include('includes.navbar')

    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
  </body>
</html>
