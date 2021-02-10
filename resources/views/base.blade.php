<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="sheikhrusseldigitallab.gov.bd.com">
  <title>@yield('title')</title>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://kit.fontawesome.com/5b67dd8eb0.js" crossorigin="anonymous"></script>
    {{--    favicon--}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    {{--    favicon end--}}
  @yield('css')
</head>
<body>

    @yield('main')

  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
  @yield('js')

</body>
</html>
