<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function cc_home_page_hero()
{
    Block::make(__('Hero Image'))
        ->add_fields(array(
            Field::make('image', 'hero_image', __('Hero Image'))
            ->set_classes('hero-image'),
            Field::make('text', 'hero_text', __('Overlay Text'))
            ->set_classes('hero-text'),
            Field::make('text', 'hero_button_text', __('Hero Button Text'))
            ->set_width(50)
            ->set_classes('button-text'),
            Field::make('text', 'hero_button_url', __('Hero Button Url'))
            ->set_width(50)
            ->set_classes('button-url'),
        ))
        ->set_description(__('Renders the hero image for the home page'))
        ->set_category('custom-category', __('Home Page'), 'home')
        ->set_icon('cover-image')
        ->set_keywords([__('home'), __('home page'), __('hero'), __('image')])
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            $image = wp_get_attachment_image($fields['hero_image'], 'homepage-hero', false, array('loading' => false));
            $heroText = $fields['hero_text'];
            $buttonText = $fields['hero_button_text'];
            $buttonUrl = $fields['hero_button_url'];
?>
        <div class="cc-home-hero">
            <div class="outer-stretch">
                <div class="inner-stretch inner-stretch--home-hero">
                    <div class="cc-home-hero__container">
                        <div class="cc-home-hero__image">
                            <?php echo $image; ?>
                        </div><!-- /.cc-home-hero__image -->
                        <div class="cc-home-hero__overlay">
                            <?php if ($heroText || ($buttonText && $buttonUrl)) : ?>
                                <div class="cc-home-hero__text">
                                    <?php if ($heroText) : ?>
                                        <h1 class="cc-home-hero__heading"><?php echo $heroText; ?></h1><!-- /.cc-home-hero__heading -->
                                    <?php endif; ?>

                                    <?php if ($buttonText && $buttonUrl) : ?>
                                        <a href="<?php echo $buttonUrl; ?>" class="btn cc-home-hero__button"><?php echo $buttonText; ?></a><!-- /.btn cc-home-hero__button -->
                                    <?php endif; ?>
                                </div><!-- /.cc-home-hero__text -->
                            <?php endif; ?>
                        </div><!-- /.cc-home-hero__overlay -->
                    </div><!-- /.cc-home-hero__container -->
                </div><!-- /.inner-stretch inner-stretch--home-hero -->
            </div><!-- /.outer-stretch -->
        </div><!-- /.cc-home-hero -->
<?php
        });
}

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\cc_home_page_hero');
?>
