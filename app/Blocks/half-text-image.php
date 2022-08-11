<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function cc_half_text_image()
{
    Block::make(__('Image/Text Row'))
        ->add_fields(array(
            Field::make('image', 'image', __('Image')),
            Field::make('text', 'heading', __('Heading')),
            Field::make('rich_text', 'content', __('Content')),
            Field::make('text', 'button_text', __('Button Text'))
                ->set_width(50),
            Field::make('text', 'button_url', __('Button URL'))
                ->set_width(50),
            Field::make('radio', 'layout', __('Layout'))
                ->set_options(array(
                    'image-left' => 'Image Left/Text Right',
                    'image-right' => 'Image Right/Text Left'
                ))
                ->set_default_value('image-left'),
        ))
        ->set_icon('align-pull-left')
        ->set_category('layout')
        ->set_description(__('Renders a row with text on one half and an image on the other.'))
        ->set_keywords([\__('layout'), \__('text'), \__('image'), \__('custom')])
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            $image = wp_get_attachment_image($fields['image'], 'half-image-text', false);
            $heading = \sanitize_text_field($fields['heading']);
            $content = \apply_filters('the_content', $fields['content']);
            $buttonText = \sanitize_text_field($fields['button_text']);
            $buttonUrl = \sanitize_text_field($fields['button_url']);
            $layout = $fields['layout']; ?>
        <section class="cc-half-text-image cc-half-text-image--<?php echo $layout; ?>">
            <div class="cc-half-text-image__container">
                <div class="cc-half-text-image__image">
                    <div class="cc-half-text-image__image-wrap">
                        <?php echo $image ?: ''; ?>
                    </div>
                </div>
                <div class="cc-half-text-image__text">
                    <div class="cc-half-text-image__text-wrap">
                        <?php if ($heading) : ?>
                            <h3 class="cc-half-text-image__heading"><?php echo $heading; ?></h3>
                        <?php endif; ?>

                        <?php if ($content) : ?>
                            <div class="cc-half-text-image__content"><?php echo $content; ?></div>
                        <?php endif; ?>

                        <?php if ($buttonText && $buttonUrl) : ?>
                            <div class="cc-half-text-image__button"><a href="<?php echo $buttonUrl; ?>" class="btn"><?php echo $buttonText; ?></a></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
<?php
        });
}

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\cc_half_text_image');
