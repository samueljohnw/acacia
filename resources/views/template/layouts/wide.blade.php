<!doctype html>
<html class="no-js" lang="en">
  <head>
    @include('template.blocks.head')
    @yield('header-scripts')
  </head>
  <body {{$bodyclass or ''}}>
    <header>
      @include('template.blocks.header')
    </header>

    @yield('content')

    <footer>
      @include('template.blocks.footer')
    </footer>


    <script asyc src="/js/all.js"></script>
    @yield('footer-scripts')
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
