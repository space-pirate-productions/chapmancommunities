<?php

namespace App;

// include_once('Fields/theme-options.php');

add_action('after_setup_theme', __NAMESPACE__ . '\\cc_load_fields');
function cc_load_fields()
{
    require_once('Blocks/home-page-hero.php');
    require_once('Blocks/home-page-icon-cta.php');
    require_once('Blocks/home-page-video-text.php');
    require_once('Blocks/home-page-signup.php');
    require_once('Blocks/home-page-image-cta.php');
    require_once('Blocks/team-directory.php');
    require_once(CHAPMAN_DIR . '/vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
}

add_action('widgets_init', __NAMESPACE__ . '\\cc_load_carbon_widgets');
function cc_load_carbon_widgets()
{
    require_once(CHAPMAN_DIR . '/app/widgets/footer-address.php');
    require_once('Widgets/footer-signup.php');
    register_widget('App\Widgets\FooterAddress');
    register_widget('App\Widgets\FooterSignup');
}
