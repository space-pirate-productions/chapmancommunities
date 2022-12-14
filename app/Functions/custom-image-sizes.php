<?php

namespace App\Functions;

function cc_add_image_sizes()
{
    add_image_size('homepage-hero', 1800, 527, true);
    add_image_size('homepage-video-placeholder');
    add_image_size('homepage-signup-background', 1800, 496, true);
    add_image_size('homepage-image-cta', 409, 236, true);
    add_image_size('featured-image', 1296, 495, true);
    add_image_size('team-member-headshot', 180, 212, true);
    add_image_size('half-image-text', 556, 503, true);
    add_image_size('blog-index', 531, 356, true);
    add_image_size('learn-header', 1800, 340, true);
    add_image_size('learn-image-text', 768, 713, true);
    add_image_size('learn-small-image', 388, 360, true);
    add_image_size('testimonial-image', 1800, 600, true);
    add_image_size('partnership-header', 1800, 787, true);
    add_image_size('footer-logo', 396, 0, true);
}