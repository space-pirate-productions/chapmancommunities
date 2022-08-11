<header class="cc-banner">
  <div class="cc-banner__container navbar navbar-expand-lg">
    <div class="cc-banner__logo">
      <a class="navbar-brand" href="{{ home_url('/') }}">
        @if (get_theme_mod('logo'))
        <img src="{!! get_theme_mod('logo') !!}" alt="{{ bloginfo('name') }}">
        @else
        {!! $siteName !!}
        @endif
      </a>
    </div>

    @if (has_nav_menu('primary_navigation') || (get_theme_mod('nav_button_text') && get_theme_mod('nav_button_url')))
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#cc-primary-nav" aria-controls="cc-primary-nav" aria-expanded="false" aria-label="Toggle Navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="cc-banner__nav collapse navbar-collapse justify-content-lg-end" id="cc-primary-nav">
      <div class="cc-banner__nav-wrap">
      @if (has_nav_menu('primary_navigation'))
      <nav class="nav-primary" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
        {!! wp_nav_menu([
        'theme_location' => 'primary_navigation',
        'container' => false,
        'menu_class' => '',
        'fallback_cb' => '__return_false',
        'items_wrap' => '<ul id="%1$s" class="navbar-nav %2$s">%3$s</ul>',
        'depth' => 3,
        'walker' => new App\bootstrap_5_wp_nav_menu_walker(),
        ]) !!}
      </nav>
      @endif
      @if (get_theme_mod('nav_button_text') && get_theme_mod('nav_button_url'))
      <div class="cc-banner__cta">
        <a href="{!! get_theme_mod('nav_button_url') !!}" class="btn">{{ get_theme_mod('nav_button_text') }}</a>
      </div>
      @endif
    </div>
    </div>
    @endif

  </div>
</header>
