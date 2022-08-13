<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function learn_education_block()
{
    Block::make(__('Education'))
        ->add_fields(array(
            Field::make('text', 'heading', __('Heading'))
                ->set_width(40),
            Field::make('rich_text', 'text', __('Text'))
                ->set_width(60),
            Field::make('complex', 'topics', __('Topics'))
                ->add_fields(array(
                    Field::make('image', 'image', __('Image'))
                        ->set_width(30),
                    Field::make('text', 'heading', __('Heading'))
                        ->set_width(70),
                    Field::make('rich_text', 'text', __('Text')),
                    Field::make('text', 'button_text', __('Button Text'))
                        ->set_width(50),
                    Field::make('text', 'button_url', __('Button URL'))
                        ->set_width(50),
                ))
                ->set_layout('tabbed-vertical')
                ->setup_labels(array(
                    'plural_name' => 'Topics',
                    'singular_name' => 'Topic'
                ))
                ->set_header_template('<%- heading ? heading : $_index + 1 %>'),
        ))
        ->set_description(\__('Renders the "Education" section of the Learn page'))
        ->set_category('cc-learn', \__('Learn'), 'welcome-learn-more')
        ->set_icon('editor-ul')
        ->set_keywords([\__('layout'), \__('custom')])
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            $heading = \sanitize_text_field($fields['heading']);
            $text = \apply_filters('the_content', $fields['text']);
            $topics = $fields['topics'];
?>
        <section class="cc-learn-education">
            <div class="cc-learn-education__container cc-container--learn-education">
                <?php if ($heading) : ?>
                    <h2 class="cc-learn-education__heading"><?php echo $heading; ?></h2>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <div class="cc-learn-education__text cc-copy--large cc-copy--spaced"><?php echo $text; ?></div>
                <?php endif; ?>

                <div class="cc-learn-education__topics">
                    <?php foreach ($topics as $topic) :
                        $image = wp_get_attachment_image($topic['image'], 'learn-small-image', \false);
                        $heading = \sanitize_text_field($topic['heading']);
                        $text = \apply_filters('the_content', $topic['text']);
                        $buttonText = \sanitize_text_field($topic['button_text']);
                        $buttonUrl = \sanitize_text_field($topic['button_url']);
                    ?>
                        <div class="cc-learn-education__topic">
                            <?php if ($image) : ?>
                                <div class="cc-learn-education__topic-image">
                                    <?php echo $image; ?>
                                </div>
                            <?php endif; ?>
                            <div class="cc-learn-education__topic-content">
                                <div class="cc-learn-education__topic-content-wrap"> <?php if ($heading) : ?>
                                        <h4 class="cc-learn-education__topic-heading"><?php echo $heading; ?></h4>
                                    <?php endif; ?>
                                    <?php if ($text) : ?>
                                        <div class="cc-learn-education__topic-text cc-copy--large cc-copy--spaced"><?php echo $text; ?></div>
                                    <?php endif; ?>
                                    <?php if ($buttonText && $buttonUrl) : ?>
                                        <div class="cc-learn-education__topic-button">
                                            <a href="<?php echo $buttonUrl; ?>" class="btn"><?php echo $buttonText; ?></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
<?php
        });
}

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\learn_education_block');
?>
