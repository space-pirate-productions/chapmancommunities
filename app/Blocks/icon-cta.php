<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function cc_icon_cta()
{
    Block::make(__('Icon CTA Slider'))
        ->add_fields(array(
            Field::make('complex', 'cc_icon_cta', __('Icon CTA'))
                ->set_max(3)
                ->set_layout('tabbed-horizontal')
                ->setup_labels(array(
                    'plural_name' => 'Icon CTAs',
                    'singular_name' => 'Icon CTA'
                ))
                ->add_fields(array(
                    Field::make('text', 'cta_icon', __('Icon Code'))->set_help_text(__('Icon codes can be found at <a href="https://fontawesome.com/search?m=free&s=solid%2Cbrands">fontawesome.com</a>'))
                        ->set_width(50),
                    Field::make('text', 'cta_heading', __('Heading'))
                        ->set_width(50),
                    Field::make('text', 'cta_text', __('Text')),
                    Field::make('text', 'button_text', __('Button Text'))
                        ->set_width(50),
                    Field::make('text', 'button_url', __('Button URL'))
                        ->set_width(50),
                ))
                ->set_header_template('<%- cta_heading ? cta_heading : $_index + 1 %>')
        ))
        ->set_description(__('Renders a three wide icon CTA.'))
        ->set_category('layout')
        ->set_icon('slides')
        ->set_keywords([__('custom'), __('layout'), __('cta'), __('icon')])
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            $iconCtas = $fields['cc_icon_cta'];
?>
        <section class="cc-icon-cta">
            <div class="cc-icon-cta__slider cc-icon-cta__slider--mobile splide" aria-label="icon cta">
                <div class="cc-icon-cta__track splide__track">
                    <div class="cc-icon-cta__list splide__list">
                        <?php foreach ($iconCtas as $key => $iconCta) :
                            $icon = $iconCta['cta_icon'];
                            $heading = sanitize_text_field($iconCta['cta_heading']);
                            $text = apply_filters('the_content', $iconCta['cta_text']);
                            $buttonText = \sanitize_text_field($iconCta['button_text']);
                            $buttonUrl = \sanitize_text_field($iconCta['button_url']);
                        ?>
                            <div class="cc-icon-cta__cta splide__slide">
                                <?php if ($icon) : ?>
                                    <div class="cc-icon-cta__icon splide__slide__container">
                                        <?php echo $icon; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($heading) : ?>
                                    <h2 class="cc-icon-cta__heading"><?php echo __($heading); ?></h2>
                                <?php endif; ?>

                                <?php if ($text) : ?>
                                    <div class="cc-icon-cta__text cc-copy--large cc-copy--spaced"><?php echo __($text); ?></div>
                                <?php endif; ?>

                                <?php if ($buttonText && $buttonUrl) : ?>
                                    <div class="cc-icon-cta__button">
                                        <a href="<?php echo $buttonUrl; ?>" class="btn"><?php echo $buttonText; ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
<?php
        });
}

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\cc_icon_cta');
?>
