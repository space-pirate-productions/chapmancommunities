<?php

namespace App\Functions;

function cc_add_image_sizes()
{
    add_image_size('homepage-hero', 1800, 527, true);
    add_image_size('homepage-video-placeholder');
    add_image_size('homepage-signup-background', 1800, 496, true);
    add_image_size('homepage-image-cta', 409, 236, true);
}
