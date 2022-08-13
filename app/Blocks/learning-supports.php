<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function learn_support_block()
{
    Block::make(__('Supports'))
        ->add_fields(array(
            Field::make('image', 'background_image', __('Background Image')),
            Field::make('text', 'heading', __('Heading'))
                ->set_width(40),
            Field::make('text', 'text', __('Text'))
                ->set_width(60),
            Field::make('complex', 'support_links', __('Support Links'))
                ->add_fields(array(
                    Field::make('text', 'link_heading', __('Heading'))
                        ->set_width(40),
                    Field::make('text', 'button_text', __('Button Text'))
                        ->set_width(30),
                    Field::make('text', 'button_url', __('Button URL'))
                        ->set_width(30),
                ))
                ->set_layout('tabbed-vertical')
                ->setup_labels(array(
                    'plural_name' => 'Links',
                    'singular_name' => 'Link'
                ))
                ->set_header_template('<%- link_heading ? link_heading : $_index + 1 %>'),
        ))
        ->set_description(\__('Render the support link CTAs at the bottom of the Learn page'))
        ->set_category('cc-learn', \__('Learn'), 'welcome-learn-more')
        ->set_icon('admin-links')
        ->set_keywords([\__('custom'), \__('learn'), \__('layout')])
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            $backgroundImage = wp_get_attachment_image($fields['background_image'], 'testimonial-image', false);
            $heading = \sanitize_text_field($fields['heading']);
            $text = sanitize_text_field($fields['text']);
            $supportLinks = $fields['support_links'];
?>
        <section class="cc-learn-support">
            <div class="cc-learn-support__container cc-container--learn-support">
                <?php if ($backgroundImage) : ?>
                    <div class="cc-learn-support__background-image">
                        <?php echo $backgroundImage; ?>
                    </div>
                <?php endif; ?>

                <div class="cc-learn-support__content">
                    <?php if ($heading) : ?>
                        <h2 class="cc-learn-support__heading"><?php echo $heading; ?></h2>
                    <?php endif; ?>

                    <?php if ($text) : ?>
                        <p class="cc-learn-support__text cc-copy--large cc-copy--spaced"><?php echo $text; ?></p>
                    <?php endif; ?>

                    <div class="cc-learn-support__link-container">
                        <?php foreach ($supportLinks as $link) :
                            $heading = $link['link_heading'];
                            $buttonText = $link['button_text'];
                            $buttonUrl = $link['button_url'];
                        ?>
                            <?php if ($buttonText && $buttonUrl) : ?>
                                <div class="cc-learn-support__link">
                                    <div class="cc-learn-support__link-wrap">
                                        <?php if ($heading) : ?>
                                            <h3 class="cc-learn-support__link-heading"><?php echo $heading; ?></h3>
                                        <?php endif; ?>

                                        <div class="cc-learn-support__link-button">
                                            <a href="<?php echo $buttonUrl; ?>" class="btn"><?php echo $buttonText; ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
<?php
        });
}

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\learn_support_block');
?>
