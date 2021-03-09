<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>IT TEAM Kantor Pertanahan Kab. Boalemo</title>
  @include('layouts._script-css')
</head>
<body>
<script src="{{ asset('assets-admin/js/preloader.js') }}"></script>
  <div class="body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    @include('layouts.leftmenu')
    <!-- partial -->
    <div class="main-wrapper mdc-drawer-app-content">
      <!-- partial:partials/_navbar.html -->
      @include('layouts.header')
      <!-- partial -->
      @yield('pages')
    </div>
    @stack('ajax_crud')
  @include('layouts._script-js')
  
  @stack('js-pages')

</body>
</html> 