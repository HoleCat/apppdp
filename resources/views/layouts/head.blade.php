<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'AppContador') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script type="text/javascript" src="{{ asset('assets/js/proyecto/caja/caja_ini.js')}}"></script>
  <!-- Fonts -->
    <link rel="shortcut icon" href="{{ asset('assets/img/image_logo.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/img/image_logo.png') }}" type="image/x-icon">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/fonts/mont-heavy.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200&family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
</head>