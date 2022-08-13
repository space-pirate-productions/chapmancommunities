<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function learn_class_structure()
{
    Block::make(__('Class Structure'))
        ->add_fields(array(
            Field::make('text', 'heading', __('Heading'))
                ->set_width(50),
            Field::make('rich_text', 'text', __('Text'))
                ->set_width(50),
            Field::make('complex', 'days', __('Days'))
                ->add_fields(array(
                    Field::make('text', 'activity', __('Activity')),
                ))
                ->set_layout('tabbed-vertical')
                ->setup_labels(array(
                    'plural_name' => 'Days',
                    'singular_name' => 'Day'
                ))
                ->set_header_template('Day <%- $_index + 1 %>'),
        ))
        ->set_description(\__('Renders the daily class structure section of the "Learn" page.'))
        ->set_category('cc-learn', \__('Learn'), 'wecome-learn-more')
        ->set_icon('calendar-alt')
        ->set_keywords([\__('layout'), \__('learn'), \__('schedule')])
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            $heading = sanitize_text_field($fields['heading']);
            $text = \apply_filters('the_content', $fields['text']);
            $days = $fields['days'];
?>
        <section class="cc-learn-structure">
            <div class="cc-learn-structure__container cc-container--learn-structure">
                <?php if ($heading) : ?>
                    <h2 class="cc-learn-structure__heading"><?php echo $heading; ?></h2>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <div class="cc-learn-structure__content cc-copy--large cc-copy--spaced">
                        <?php echo $text; ?>
                    </div>
                <?php endif; ?>

                <?php if ($days) : ?>
                    <div class="cc-learn-structure__structure">
                        <ul class="cc-learn-structure__days">
                            <?php foreach ($days as $daynumber => $day) : ?>
                                <li class="cc-learn-structure__day cc-copy--large cc-copy--spaced">
                                    <strong class="cc-learn-structure__day-number">Day <?php echo $daynumber + 1; ?></strong><span class="cc-learn-day__activity"><?php echo $day['activity']; ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </section>
<?php
        });
}

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\learn_class_structure');
?>
