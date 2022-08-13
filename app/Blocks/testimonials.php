<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function cc_testimonial_block()
{
    Block::make(__('Testimonials Slider'))
        ->add_fields(array(
            Field::make('text', 'heading', __('Heading')),
            Field::make('image', 'background_image', __('Background Image'))
                ->set_width(50),
            Field::make('color', 'background_color', __('Background Color'))
                ->set_width(50)
                ->set_alpha_enabled(\true),
            Field::make('complex', 'testimonials', __('Testimonials'))
                ->add_fields(array(
                    Field::make('textarea', 'testimony', __('Testimony'))
                        ->set_rows(4)
                        ->set_width(50),
                    Field::make('text', 'name', __('Name'))
                        ->set_width(25),
                    Field::make('text', 'title', __('Title (optional)'))
                        ->set_width(25),
                ))
                ->set_layout('tabbed-vertical')
                ->setup_labels(array(
                    'plural_name' => 'Testimonials',
                    'singular_name' => 'Testimonial'
                ))
                ->set_header_template('<%- name ? name : $_index + 1 %>'),
        ))
        ->set_description(\__('Render a testimonial slider'))
        ->set_category('layout')
        ->set_icon('testimonial')
        ->set_keywords([\__('layout'), \__('testimonials'), \__('reviews'), \__('slider'), \__('custom')])
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            $heading = \sanitize_text_field($fields['heading']);
            $backgroundImage = wp_get_attachment_image($fields['background_image'], 'testimonial-background', \false);
            $backgroundColor = $fields['background_color'];
            $testimonials = $fields['testimonials'];
?>
        <section class="cc-testimonials">
            <div class="cc-testimonials__container cc-container--testimonials">
                <?php if ($backgroundImage) : ?>
                    <div class="cc-testimonials__background-image"><?php echo $backgroundImage; ?></div>
                <?php endif; ?>

                <?php if ($backgroundColor) : ?>
                    <div class="cc-testimonials__overlay" style="background-color: <?php echo $backgroundColor; ?>;"></div>
                <?php endif; ?>

                <div class="cc-testimonials__content">
                    <?php if ($heading) : ?>
                        <h3 class="cc-testimonials__heading"><?php echo $heading; ?></h3>
                    <?php endif; ?>

                    <div class="cc-testimonials__slider splide">
                        <div class="cc-testimonials__track splide__track">
                            <div class="cc-testimonials__list splide__list">
                                <?php foreach ($testimonials as $testimonial) :
                                    $testimony = \sanitize_textarea_field($testimonial['testimony']);
                                    $name = \sanitize_text_field($testimonial['name']);
                                    $title = \sanitize_text_field($testimonial['title']);
                                ?>
                                    <div class="cc-testimonials__testimonial splide__slide">
                                        <div class="cc-testimonials__testimonial-wrap">
                                            <div class="cc-testimonials__testimony">
                                                <p class="cc-copy--large cc-copy--spaced">"<?php echo $testimony; ?>"</p>
                                            </div>
                                            <?php if ($name) : ?>
                                                <div class="cc-testimonials__source">
                                                    <h5 class="cc-testimonials__name">- <?php echo $name; ?></h5>
                                                    <?php if ($title) : ?>
                                                        <span class="cc-testimonials__title cc-copy--large"><?php echo $title; ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
        });
}

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\cc_testimonial_block');
?>
