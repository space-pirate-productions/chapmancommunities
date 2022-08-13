<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function add_homepage_icon_cta()
{
    Block::make(__('Home Icon CTA'))
        ->add_fields(array(
            Field::make('complex', 'homepage_icon_cta', __('Home Icon CTA'))
                ->set_max(3)
                ->set_layout('tabbed-horizontal')
                ->setup_labels(array(
                    'plural_name' => 'Icon CTAs',
                    'singular_name' => 'Icon CTA'
                ))
                ->add_fields(array(
                    Field::make('text', 'cta_icon', __('Icon Code'))->set_help_text(__('Icon codes can be found at <a href="https://fontawesome.com/search?m=free&s=solid%2Cbrands">fontawesome.io</a>')),
                    Field::make('text', 'cta_heading', __('Heading')),
                    Field::make('text', 'cta_text', __('Text')),
                ))
                ->set_header_template('<%- cta_heading ? cta_heading : $_index + 1 %>')
        ))
        ->set_description(__('Renders the three wide icon CTA for the home page.'))
        ->set_category('custom-category', __('Home Page'), 'home')
        ->set_icon('ellipsis')
        ->set_keywords([__('home'), __('home page'), __('cta'), __('icon')])
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            $iconCtas = $fields['homepage_icon_cta'];
            if (!empty($iconCtas)) : ?>
            <section class="cc-home-icon-cta">
                <div id="main-slider" class="outer-stretch cc-slider cc-slider--mobile splide" aria-label="icon cta">
                    <div class="inner-stretch inner-stretch--icon-cta splide__track">
                        <div class="cc-home-icon-cta__container splide__list">
                            <?php foreach ($iconCtas as $key => $iconCta) :
                                $icon = $iconCta['cta_icon'];
                                $heading = sanitize_text_field($iconCta['cta_heading']);
                                $text = apply_filters('the_content', $iconCta['cta_text']);
                            ?>
                                <div class="cc-home-icon-cta__cta splide__slide">
                                    <?php if ($icon) : ?>
                                        <div class="cc-home-icon-cta__icon splide__slide__container">
                                            <?php echo $icon; ?>
                                        </div><!-- /.cc-home-icon-cta__icon -->
                                    <?php endif; ?>

                                    <?php if ($heading) : ?>
                                        <h2 class="cc-home-icon-cta__heading"><?php echo __($heading); ?></h2><!-- /.cc-home-icon-cta__heading -->
                                    <?php endif; ?>

                                    <?php if ($text) : ?>
                                        <div class="cc-home-icon-cta__text cc-copy--large cc-copy--spaced"><?php echo __($text); ?></div><!-- /.cc-home-icon-cta__text -->
                                    <?php endif; ?>

                                </div><!-- /.cc-home-icon-cta__cta -->
                            <?php endforeach; ?>
                        </div><!-- /.cc-home-icon-cta__container -->
                    </div><!-- /.inner-stretch inner-stretch--icon-cta -->
                </div><!-- /.outer-stretch -->
            </section><!-- /.cc-home-icon-cta -->
<?php endif;
        });
}

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\add_homepage_icon_cta');
