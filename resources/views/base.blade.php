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
  @yield('css')
</head>
<body>
  
    @yield('main')
  
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
  @yield('js')
  
</body>
</html>