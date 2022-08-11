<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <span class="entry-excerpt-link"><a href="%s">%s</a></span>', get_permalink(), __('Read More', 'sage'));
});

/**
 * Reduce the_excerpt() length
 */
add_filter('excerpt_length', function ($length) {
    return 30;
});

/**
 * Use Lozad (lazy loading) for attachments/featured images
 */
add_filter('wp_get_attachment_image_attributes', function ($attr, $attachment) {
    // Bail on admin
    if (is_admin()) {
        return $attr;
    }
    $attr['data-src'] = $attr['src'];
    $attr['class'] .= ' lozad';
    unset($attr['src']);
    return $attr;
}, 10, 2);

add_filter( 'body_class', function(array $classes) {
    if (is_home(  )) {
        $classes[] = 'post-index';
    }

    return $classes;
} );