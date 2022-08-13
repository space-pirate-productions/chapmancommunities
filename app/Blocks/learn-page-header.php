<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function learn_header_block()
{
    Block::make(__('Header'))
        ->add_fields(array(
            Field::make('text', 'heading', __('Heading'))
                ->set_width(50),
            Field::make('text', 'sub_heading', __('Sub Heading'))
                ->set_width(50),
            Field::make('image', 'background_image', __('Background Image')),
        ))
        ->set_description(\__('Renders the header for the "Learn" landing page.'))
        ->set_category('cc-learn', \__('Learn'), 'welcome-learn-more')
        ->set_icon('table-row-before')
        ->set_keywords([\__('header'), \__('learn')])
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            $heading = \sanitize_text_field($fields['heading']);
            $subHeading = sanitize_text_field($fields['sub_heading']);
            $backgroundImage = wp_get_attachment_image($fields['background_image'], 'learn-header', \false, array('loading' => \false));
?>
        <section class="cc-learn-header">
            <div class="cc-learn-header__container cc-container--learn-header">
                <?php if ($backgroundImage) : ?>
                    <div class="cc-learn-header__background">
                        <?php echo $backgroundImage; ?>
                    </div>
                <?php endif; ?>
                <div class="cc-learn-header__overlay">
                    <?php if ($heading) : ?>
                        <div class="cc-learn-header__text">
                            <h1 class="cc-learn-header__heading"><?php echo $heading; ?></h1>
                            <?php if ($subHeading) : ?>
                                <p class="cc-learn-header__sub-heading"><?php echo $subHeading; ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
<?php
        });
}

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\learn_header_block');
?>
