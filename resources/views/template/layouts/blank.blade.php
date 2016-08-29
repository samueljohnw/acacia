<!doctype html>
<html class="no-js" lang="en">
  <head>
    @include('template.blocks.head')
    @yield('header-scripts')
    <style media="screen">
      header{display:none;}
    </style>
  </head>
  <body {{$bodyclass or ''}}>
    <center><img width="200" src="https://s3-us-west-2.amazonaws.com/acacia-ministries/images/acacia-logo.png"></center>
    <header>
      @include('template.blocks.header')
    </header>

    @yield('content')

    <script src="{{ elixir('js/all.js') }}"></script>
    <script>
      $(document).foundation();
    </script>
    @yield('footer-scripts')
  </body>
</html>
