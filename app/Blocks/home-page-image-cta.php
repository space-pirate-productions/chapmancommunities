<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function add_homepage_image_cta()
{
    Block::make(__('Image CTA'))
        ->add_fields(array(
            Field::make('text', 'section_heading', __('Section Heading'))
                ->set_width(50),
            Field::make('text', 'section_text', __('Section Text'))
                ->set_width(50),
            Field::make('complex', 'homepage_image_cta', __('Image CTA'))
                ->set_max(3)
                ->set_layout('tabbed-horizontal')
                ->setup_labels(array(
                    'plural_name' => 'Image CTAs',
                    'singular_name' => 'Image CTA'
                ))
                ->add_fields(array(
                    Field::make('image', 'cta_image', __('Image')),
                    Field::make('text', 'cta_heading', __('Heading')),
                    Field::make('text', 'cta_button_text', __('Button Text'))
                        ->set_width(50),
                    Field::make('text', 'cta_button_url', __('Button URL'))
                        ->set_width(50),
                ))
                ->set_header_template('<%- cta_heading ? cta_heading : $_index + 1 %>')
        ))
        ->set_description(__('Renders the three wide image CTA for the home page'))
        ->set_category('custom-category', __('Home Page'), 'home')
        ->set_icon('filter')
        ->set_keywords([__('home'), __('home page'), __('cta'), __('image')])
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            $sectionHeading = sanitize_text_field($fields['section_heading']);
            $sectionText = sanitize_text_field($fields['section_text']);
            $imageCtas = $fields['homepage_image_cta'];
?>
        <section class="cc-home-section cc-home-image-cta">
            <div class="outer-stretch">
                <div class="inner-stretch--home-image-cta">
                    <div class="cc-home-image-cta__container">
                        <?php if ($sectionHeading || $sectionText) : ?>
                            <div class="cc-home-image-cta__header">
                                <?php if ($sectionHeading) : ?>
                                    <h2 class="cc-home-image-cta__heading"><?php echo $sectionHeading; ?></h2>
                                <?php endif; ?>

                                <?php if ($sectionText) : ?>
                                    <p class="cc-home-image-cta__text"><?php echo $sectionText; ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($imageCtas)) : ?>
                            <div class="cc-slider cc-slider--mobile splide">
                                <div class="splide__track">
                                    <div class="cc-home-image-cta__ctas splide__list">
                                        <?php foreach ($imageCtas as $key => $imageCta) :
                                            $ctaImage = wp_get_attachment_image($imageCta['cta_image'], 'homepage-image-cta', \false);
                                            $ctaHeading = $imageCta['cta_heading'];
                                            $ctaText = $imageCta['cta_button_text'];
                                            $ctaUrl = $imageCta['cta_button_url'];
                                        ?>
                                            <div class="cc-home-image-cta__cta splide__slide">
                                                <?php if ($ctaImage) : ?>
                                                    <div class="cc-home-image-cta__image splide__slide__container">
                                                        <?php echo $ctaImage; ?>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="cc-home-image-cta__content">
                                                    <?php if ($ctaHeading) : ?>
                                                        <h3 class="h4 cc-home-image-cta__cta-heading"><?php echo $ctaHeading; ?></h3>
                                                    <?php endif; ?>

                                                    <?php if ($ctaText && $ctaUrl) : ?>
                                                        <div class="cc-home-image-cta__button">
                                                            <a href="<?php echo $ctaUrl; ?>" class="btn"><?php echo $ctaText; ?></a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
<?php
        });
}

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\add_homepage_image_cta');
?>
