<header class="banner">
    <div class="banner__container">
        <div class="banner__logo">
            <a class="brand" href="{{ home_url('/') }}">
                @if (get_theme_mod('logo'))
                    <img src="{!! get_theme_mod('logo') !!}" alt="{{ bloginfo('name') }}">
                @else
                    {!! $siteName !!}
                @endif
            </a>
        </div>

        @if (has_nav_menu('primary_navigation'))
            <div class="banner__nav">
                <nav class="nav-primary" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
                    {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
                </nav>
            </div>
        @endif

        @if (get_theme_mod('nav_button_text') && get_theme_mod('nav_button_url'))
            <div class="banner__cta">
                <a href="{!! get_theme_mod('nav_button_url') !!}" class="btn">{{ get_theme_mod('nav_button_text') }}</a>
            </div>
        @endif
    </div>
</header>
