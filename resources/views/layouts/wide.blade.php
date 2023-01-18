<a class="sr-only focus:not-sr-only" href="#main">
  {{ __('Skip to content') }}
</a>

@include('sections.header')

<main id="main" class="main">
  <div id="intersection-checker"></div>
  @include('sections.widehero')
  <div class="document cc-container--wide">
    @yield('content')
  </div>
</main>

@hasSection('sidebar')
<aside class="sidebar">
  @yield('sidebar')
</aside>
@endif

@include('sections.footer')
