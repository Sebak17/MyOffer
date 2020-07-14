<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} {{ isset($titleExt) ? " | " . $titleExt : "" }}</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/icons/favicon-32x32.png') }}">
    
    <link href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/admin-lte/adminlte.min.css') }}" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  </head>

  <body class="hold-transition sidebar-mini">
    
    <div class="wrapper">

      @include('admin.panel.core.navbar')
      @include('admin.panel.core.sidebar')

      <div class="content-wrapper">
        @yield('content')
      </div>

      @include('admin.panel.core.footer')
    </div>
    
    <script src="{{ asset('assets/js/addons/jquery-3.4.1.min.js') }}" charset="utf-8"></script>
    <script src="{{ asset('assets/plugins/admin-lte/bootstrap.bundle.min.js') }}" charset="utf-8"></script>
    <script src="{{ asset('assets/plugins/admin-lte/adminlte.min.js') }}" charset="utf-8"></script>
    <script src="{{ asset('assets/js/utils.js') }}" charset="utf-8"></script>
    @yield('javascripts')
    
  </body>
</html>