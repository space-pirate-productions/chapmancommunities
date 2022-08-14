<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function add_partnership_process()
{
    Block::make(__('Partnership Process'))
        ->add_fields(array(
            Field::make('text', 'partner_process_heading', __('Heading'))
                ->set_width(50)
                ->set_classes('heading'),
            Field::make('rich_text', 'partner_process_opening', __('Text'))
                ->set_width(50)
                ->set_classes('text'),
            Field::make('complex', 'partner_process_steps', __('Steps'))
                ->set_classes('steps')
                ->add_fields(array(
                    Field::make('text', 'partner_step_heading', __('Heading'))
                        ->set_width('30'),
                    Field::make('textarea', 'partner_step_details', __('Details'))
                        ->set_width('70')
                        ->set_rows(2),
                ))
                ->set_layout('tabbed-vertical')
                ->setup_labels(array(
                    'plural_name' => 'Steps',
                    'singular_name' => 'Step'
                ))
                ->set_header_template('<%- partner_step_heading ? partner_step_heading : $_index + 1 %>'),
        ))
        ->set_category('cc-partnership', \__('Partnership'), 'networking')
        ->set_description('Renders the partner process block for the partner page.')
        ->set_icon('editor-ol')
        ->set_keywords([\__('custom'), \__('layout')])
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            $heading = \sanitize_text_field($fields['partner_process_heading']);
            $text = \apply_filters('the_content', $fields['partner_process_opening']);
            $steps = $fields['partner_process_steps'];
?>
        <section class="cc-partner-process">
            <div class="cc-partner-process__container">
                <?php if ($heading) : ?>
                    <h2 class="cc-partner-process__heading"><?php echo $heading; ?></h2>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <div class="cc-partner-process__opening cc-copy--large cc-copy--spaced"><?php echo $text; ?></div>
                <?php endif; ?>

                <?php if ($steps) : ?>
                    <div class="cc-partner-process__steps">
                        <?php foreach ($steps as $step) :
                            $stepHeading = sanitize_text_field($step['partner_step_heading']);
                            $stepText = sanitize_textarea_field($step['partner_step_details']);
                        ?>
                            <div class="cc-partner-process__step">
                                <?php if ($stepHeading) : ?>
                                    <strong class="cc-partner-process__step-heading"><?php echo $stepHeading; ?></strong>
                                <?php endif; ?>
                                <?php if ($stepText) : ?>
                                    <div class="cc-partner-process__step-details cc-copy--large">
                                        <p><?php echo $stepText; ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
<?php
        });
}

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\add_partnership_process');
?>
