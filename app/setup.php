<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    bundle('app')->enqueue()->localize('paths', [
        'marker' => @\asset('images/marker-icon.png')->uri(),
        'marker2x' => @\asset('images/marker-icon-2x.png')->uri(),
        'shadow' => @\asset('images/marker-shadow.png')->uri(),
    ]);
}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();
}, 100);

add_action('admin_enqueue_scripts', function () {
    bundle('admin')->enqueue();
}, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from the Soil plugin if activated.
     *
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil', [
        'clean-up',
        'nav-walker',
        'nice-search',
        'relative-urls',
    ]);

    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');
    remove_theme_support('widgets-block-editor');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add custom image sizes;
     */
    require_once('Functions/custom-image-sizes.php');
    Functions\cc_add_image_sizes();
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    $footerConfig = [
        'before_widget' => '<section class="cc-footer-widget cc-footer__widget cc-footer__widget--column widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h4 class="cc-footer-widget__heading cc-footer-widget__heading--column cc-heading cc-heading--white">',
        'after_title' => '</h4>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer Column One', 'sage'),
        'id' => 'sidebar-footer-one',
    ] + $footerConfig);

    register_sidebar([
        'name' => __('Footer Column Two', 'sage'),
        'id' => 'sidebar-footer-two',
    ] + $footerConfig);

    register_sidebar([
        'name' => __('Footer Column Three', 'sage'),
        'id' => 'sidebar-footer-three',
    ] + $footerConfig);

    register_sidebar([
        'name' => __('Footer Column Four', 'sage'),
        'id' => 'sidebar-footer-four',
    ] + $footerConfig);

    register_sidebar([
        'name' => __('Footer Bottom Row', 'sage'),
        'id' => 'sidebar-footer-bottom',
        'before_widget' => '<section class="cc-footer-widget cc-footer__widget cc-footer__widget--row widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h4 class="cc-footer-widget__heading cc-footer-widget__heading--row cc-heading cc-heading--white">',
        'after_title' => '</h4>',
    ]);
});