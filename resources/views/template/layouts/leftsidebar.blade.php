<!doctype html>
<html class="no-js" lang="en">
  <head>
    @include('template.blocks.head')
    @yield('header-scripts')
  </head>
  <body class="left-sidebar {{$bodyclass or ''}}">

    <header>
      @include('template.blocks.header')
    </header>

    <main class="row">
      <div class="small-2 columns sidebar">
        @include('template.blocks.'.auth()->user()->type.'.sidebar')
      </div>
      <div class="small-10 columns content">
        @yield('content')
      </div>
    </main>

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
