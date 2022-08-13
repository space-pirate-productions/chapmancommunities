<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function learn_image_text_block()
{
    Block::make(__('Image/Text'))
        ->add_fields(array(
            Field::make('image', 'image', __('Image')),
            Field::make('text', 'heading', __('Heading')),
            Field::make('rich_text', 'text', __('Text')),
            Field::make('text', 'button_text', __('Button Text'))
                ->set_width(50),
            Field::make('text', 'button_url', __('Button URL'))
                ->set_width(50),
        ))
        ->set_description(\__('Renders an image and text column side by side on the "Learn" page.'))
        ->set_category('cc-learn', \__('Learn'), 'welcome-learn-more')
        ->set_icon('align-pull-left')
        ->set_keywords([\__('layout'), \__('text'), \__('image'), \__('custom'), \__('learn')])
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            $image = wp_get_attachment_image($fields['image'], 'learn-image-text', \false);
            $heading = \sanitize_text_field($fields['heading']);
            $text = \apply_filters('the-content', $fields['text']);
            $buttonText = \sanitize_text_field($fields['button_text']);
            $buttonUrl = \sanitize_text_field($fields['button_url']);
?>
        <section class="cc-learn-image-text">
            <div class="cc-learn-image-text__container cc-container--learn-image-text">
                <?php if ($image) : ?>
                    <div class="cc-learn-image-text__block cc-learn-image-text__block--image cc-learn-image-text__image">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>
                <?php if ($text) : ?>
                    <div class="cc-learn-image-text__block cc-learn-image-text__block--text cc-learn-image-text__text">
                        <div class="cc-learn-image-text__text-wrap">
                            <?php if ($heading) : ?>
                                <h2 class="cc-learn-image-text__heading"><?php echo $heading; ?></h2>
                            <?php endif; ?>
                            <div class="cc-learn-image-text__content"><?php echo $text; ?></div>
                            <?php if ($buttonText && $buttonUrl) : ?>
                                <div class="cc-learn-image-text__button">
                                    <a href="<?php echo $buttonUrl; ?>" class="btn"><?php echo $buttonText; ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
<?php
        });
}

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\learn_image_text_block');
