<?php

namespace App\Widgets;

use Carbon_Fields\Field;
use Carbon_Fields\Widget;

class FooterSignup extends Widget
{
    function __construct()
    {
        $this->setup('footer_signup_widget', __('Newsletter Sign Up'), __('Displays a formatted newsletter sign up widget.'), array(
            Field::make('text', 'title', __('Title')),
            Field::make('rich_text', 'content', __('Text')),
            Field::make('text', 'button_text', __('Button Text')),
            Field::make('text', 'button_url', __('Button URL'))
        ));
    }

    function front_end($args, $instance)
    {
        $title = $instance['title'];
        $content = $instance['content'];
        $buttonText = $instance['button_text'];
        $buttonUrl = $instance['button_url'];
?>
<div class="cc-signup-widget">
  <div class="cc-signup-widget__container">
    <?php if ($title) : ?>
    <?php echo $args['before_title'] . $title . $args['after_title']; ?>
    <?php endif; ?>

    <?php if ($content) : ?>
    <div class="cc-signup-widget__content cc-copy--large cc-copy--spaced">
      <?php echo apply_filters('the_content', $content); ?>
    </div>
    <?php endif; ?>

    <?php if ($buttonText && $buttonUrl) : ?>
    <div class="cc-signup-widget__button">
      <a href="<?php echo $buttonUrl; ?>" class="btn btn--reverse"><?php echo $buttonText; ?></a>
    </div>
    <?php endif; ?>
  </div>
</div>
<?php
    }
}


?>