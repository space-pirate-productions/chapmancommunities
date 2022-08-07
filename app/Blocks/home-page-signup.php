<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function cc_home_signup()
{
    Block::make(__('Newsletter Sign Up'))
        ->add_fields(array(
            Field::make('text', 'signup_heading', __('Heading')),
            Field::make('text', 'signup_text', __('Text')),
            Field::make('image', 'signup_background', __('Background Image'))
        ))
        ->set_description(__('Renders a CTA with a background image and sign up form'))
        ->set_category('custom-category', __('Home Page'), 'home')
        ->set_icon('welcome-write-blog')
        ->set_keywords([__('home'), __('home page'), __('newsletter'), __('sign up'), __('cta')])
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            $heading = sanitize_text_field($fields['signup_heading']);
            $text = sanitize_text_field($fields['signup_text']);
            $image = wp_get_attachment_image($fields['signup_background'], 'homepage-signup-background', false);
            $imageSrc = (!empty($fields['signup_background'])) ? wp_get_attachment_image_url($fields['signup_background'], 'homepage-signup-background', false) : '';
?>
        <section class="cc-home-section cc-home-signup"></section>
        <div class="outer-stretch inner-stretch--home-signup">
            <div class="cc-home-signup__container" style="background-image: url(<?php echo $imageSrc; ?>);">
                <div class="cc-home-signup__content">
                    <?php if ($heading) : ?>
                        <h2 class="cc-home-signup__heading cc-copy--white"><?php echo $heading; ?></h2>
                    <?php endif; ?>
                    <?php if ($text) : ?>
                        <p class="cc-home-signup__text cc-copy--large cc-copy--white"><?php echo $text; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        </section>
<?php
        });
}

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\cc_home_signup');
?>
