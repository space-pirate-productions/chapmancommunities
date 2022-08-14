<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function add_partnership_header()
{
    Block::make(__('Partnership Header'))
        ->add_fields(array(
            Field::make('image', 'partner_header_image', __('Background Image'))
                ->set_classes('background-image'),
            Field::make('text', 'partner_header_heading', __('Heading'))
                ->set_width(50)
                ->set_classes('heading'),
            Field::make('textarea', 'partner_header_text', __('Text'))
                ->set_width(50)
                ->set_rows(3)
                ->set_classes('text'),
            Field::make('complex', 'partner_header_options', __('Options'))
                ->add_fields(array(
                    Field::make('text', 'partner_options_option', __('Option'))
                        ->set_width(30),
                    Field::make('rich_text', 'partner_options_details', __('Details'))
                        ->set_width(70),
                ))
                ->set_layout('tabbed-vertical')
                ->setup_labels(array(
                    'plural_name' => 'Options',
                    'singular_name' => 'Option'
                ))
                ->set_header_template('<%- partner_options_option ? partner_options_option : $_index + 1 %>')
                ->set_classes('options'),
        ))
        ->set_description(\__('Render the header for the partnership page.'))
        ->set_category('cc-partnership', \__('Partnership'), 'networking')
        ->set_icon('cover-image')
        ->set_keywords([\__('custom'), \__('layout')])
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            $image = wp_get_attachment_image($fields['partner_header_image'], 'partnership-header', false, array('loading' => false));
            $heading = sanitize_text_field($fields['partner_header_heading']);
            $text = sanitize_textarea_field($fields['partner_header_text']);
            $options = $fields['partner_header_options'];
?>
        <section class="cc-partner-header">
            <div class="cc-partner-header__container">
                <?php if ($image) : ?>
                    <div class="cc-partner-header__background"><?php echo $image; ?></div>
                <?php endif; ?>

                <div class="cc-partner-header__overlay">
                    <div class="cc-partner-header__content">
                        <div class="cc-partner-header__content-wrap">
                            <?php if ($heading) : ?>
                                <h1 class="h3 cc-partner-header__heading"><?php echo $heading; ?></h1>
                            <?php endif; ?>

                            <?php if ($text) : ?>
                                <div class="cc-partner-header__text cc-copy--large cc-copy--spaced"><?php echo $text; ?></div>
                            <?php endif; ?>

                            <?php if ($options) : ?>
                                <div class="cc-partner-header__options">
                                    <?php foreach ($options as $option) :
                                        $name = \sanitize_text_field($option['partner_options_option']);
                                        $details = \apply_filters('the_content', $option['partner_options_details']);
                                    ?>
                                        <div class="cc-partner-header__option cc-partner-option cc-copy--large cc-copy--spaced">
                                            <strong class="cc-partner-option__name"><?php echo $name; ?></strong><?php echo '<span class="cc-partner-option__divider">-</span>' . $details; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
        });
}

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\add_partnership_header');
