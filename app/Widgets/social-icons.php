<?php

namespace App\Widgets;

use Carbon_Fields\Field;
use Carbon_Fields\Widget;

class SocialIcons extends Widget
{
    function __construct()
    {
        $this->setup('chapman_social_icon_widget', __('Social Icons'), __('Displays social media icons linked to their appropriate page.'), array(
            Field::make('text', 'siw_title', __('Title')),
            Field::make('complex', 'siw_icons', __('Icons'))
                ->add_fields(array(
                    Field::make('select', 'siw_platform', __('Platform'))
                        ->set_options(array(
                            'Facebook' => __('Facebook'),
                            'Twitter' => __('Twitter'),
                            'LinkedIn' => __('LinkedIn'),
                            'Pinterest' => __('Pinterest'),
                            'Instagram' => __('Instagram'),
                            'YouTube' => __('YouTube'),
                        )),
                    Field::make('text', 'siw_url', __('URL'))
                        ->set_attribute('type', 'url'),
                ))
                ->setup_labels(array(
                    'plural_name' => 'Icons',
                    'singular_name' => 'Icon'
                ))
                ->set_duplicate_groups_allowed(true)
                ->set_layout('tabbed-vertical')
                ->set_header_template('<%- siw_platform ? siw_platform : $_index + 1 %>'),
        ));
    }

    function front_end($args, $instance)
    {
        $title = $instance['siw_title'];
        $icons = $instance['siw_icons'];
?>
<div class="cc-social-icons">
  <div class="cc-social-icons__container container--social-icons">
    <?php echo $args['before_title'] . $title . $args['after_title']; ?>

    <ul class="cc-social-icons__list">
      <?php foreach ($icons as $icon) :
                        $platform = strtolower($icon['siw_platform']);
                        $url = $icon['siw_url'];
                    ?>
      <li class="cc-social-icons__item">
        <a href="<?php echo $url; ?>" class="cc-social-icons__link">
          <i class="cc-social-icons__icon fa-brands <?php echo 'fa-' . $platform; ?>"></i>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
<?php
    }
}