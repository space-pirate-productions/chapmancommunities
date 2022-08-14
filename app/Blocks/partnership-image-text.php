<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function add_current_partners()
{
    Block::make(__('Current Partners'))
        ->add_fields(array(
            Field::make('image', 'current_partner_image', __('Image'))
                ->set_width(50)
                ->set_classes('image'),
            Field::make('text', 'current_partner_heading', __('Heading'))
                ->set_width(50)
                ->set_classes('heading'),
            Field::make('complex', 'current_partner_partners', __('Partners'))
                ->add_fields(array(
                    Field::make('text', 'partner_type', __('Partner Type')),
                    Field::make('complex', 'partner_names', __('Partner Names'))
                        ->add_fields(array(
                            Field::make('text', 'partner_name', __('Name')),
                        ))
                        ->set_layout('tabbed-vertical')
                        ->setup_labels(array(
                            'plural_name' => 'Partner Names',
                            'singular_name' => 'Partner Name'
                        ))
                        ->set_header_template('<%- partner_name ? partner_name : $_index + 1 %>'),
                ))
                ->set_layout('tabbed-horizontal')
                ->setup_labels(array(
                    'plural_name' => 'Partner Types',
                    'singular_name' => 'Partner Type'
                ))
                ->set_header_template('<%- partner_type ? partner_type : $_index + 1 %>')
                ->set_classes('partners'),
        ))
        ->set_description('Renders the current partner list for the partner page.')
        ->set_category('cc-partnership', \__('Partnership'), 'networking')
        ->set_icon('groups')
        ->set_keywords([\__('custom'), \__('layout'), \__('image'), \__('text')])
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            $image = wp_get_attachment_image($fields['current_partner_image'], 'learn-image-text', \false);
            $heading = \sanitize_text_field($fields['current_partner_heading']);
            $partnerTypes = $fields['current_partner_partners'];
?>
        <section class="cc-current-partners">
            <div class="cc-current-partners__container">
                <?php if ($image) : ?>
                    <div class="cc-current-partners__image">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>

                <div class="cc-current-partners__content">
                    <div class="cc-current-partners__content-wrap">
                        <?php if ($heading) : ?>
                            <h2 class="cc-current-partners__heading"><?php echo $heading; ?></h2>
                        <?php endif; ?>

                        <?php if ($partnerTypes) : ?>
                            <div class="cc-current-partners__partners">
                                <?php foreach ($partnerTypes as $partnerType) :
                                    $type = sanitize_text_field($partnerType['partner_type']);
                                    $partnerNames = $partnerType['partner_names'];
                                ?>
                                    <div class="cc-current-partners__partner_type">
                                        <?php if ($type) : ?>
                                            <strong class="cc-current-partners__type-name"><?php echo $type; ?>:</strong>
                                        <?php endif; ?>
                                        <?php if ($partnerNames) : ?>
                                            <ul class="cc-current-partners__partner-names">
                                                <?php foreach ($partnerNames as $partnerName) :
                                                    $name = sanitize_text_field($partnerName['partner_name']);
                                                ?>
                                                    <li class="cc-current-partners__partner-name cc-copy--large cc-copy--spaced"><?php echo $name; ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
<?php
        });
}

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\add_current_partners');
?>
