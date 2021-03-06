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


    <script src="{{ elixir('js/all.js') }}"></script>    
    <script>
      $(document).foundation();
    </script>
    @yield('footer-scripts')
  </body>
</html>
