<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function cc_home_video_text()
{
    Block::make(__('Video/Text Block'))
        ->add_fields(array(
            Field::make('image', 'video_placeholder', __('Video Placeholder Image')),
            Field::make('text', 'video_url', __('Video URL')),
            Field::make('text', 'heading', __('Heading')),
            Field::make('rich_text', 'text', __('Text')),
        ))
        ->set_description(__('Renders a 50/50 block with a video on the left and text on the right.'))
        ->set_category('custom-category', __('Home Page'), 'home')
        ->set_icon('cover-image')
        ->set_keywords([__('home'), __('home page'), __('video'), __('text')])
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            $image = wp_get_attachment_image($fields['video_placeholder'], 'homepage-video-placeholder', false);
            $url = $fields['video_url'];
            $heading = sanitize_text_field($fields['heading']);
            $text = apply_filters('the_content', $fields['text']);
?>
        <section class="cc-home-section cc-video-text">
            <div class="outer-stretch">
                <div class="inner-stretch inner-stretch--video-text">
                    <div class="cc-video-text__container">
                        <?php if ($image && $url) : ?>
                            <div class="cc-video-text__video-block">
                                <a href="" class="cc-video-text__video-link" data-bs-toggle="modal" data-tagVideo="<?php echo $url ?>" data-bs-target="#videoModal">
                                    <?php echo $image; ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ($heading || $text) : ?>
                            <div class="cc-video-text__text-block">
                                <div class="cc-video-text__text-wrap">
                                    <?php if ($heading) : ?>
                                        <h2 class="cc-video-text__heading"><?php echo $heading; ?></h2>
                                    <?php endif; ?>

                                    <?php if ($text) : ?>
                                        <div class="cc-video-text__text cc-copy--large cc-copy--spaced">
                                            <?php echo $text; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="ratio ratio-16x9">
                                <iframe src="" allow="autoplay;" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        });
}

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\cc_home_video_text'); ?>
