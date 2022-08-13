<?php

namespace App;

// include_once('Fields/theme-options.php');

add_action('after_setup_theme', __NAMESPACE__ . '\\cc_load_fields');
function cc_load_fields()
{
    $blocks = array(
        'Blocks/home-page-hero.php',
        'Blocks/home-page-icon-cta.php',
        'Blocks/home-page-video-text.php',
        'Blocks/home-page-signup.php',
        'Blocks/home-page-image-cta.php',
        'Blocks/team-directory.php',
        'Blocks/half-text-image.php',
        'Blocks/learn-page-header.php',
        'Blocks/learn-image-text.php',
    );

    foreach ($blocks as $block) {
        require_once($block);
    }

    require_once(CHAPMAN_DIR . '/vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
}

add_action('widgets_init', __NAMESPACE__ . '\\cc_load_carbon_widgets');
function cc_load_carbon_widgets()
{
    require_once('Widgets/footer-address.php');
    require_once('Widgets/footer-signup.php');
    register_widget('App\Widgets\FooterAddress');
    register_widget('App\Widgets\FooterSignup');
}
