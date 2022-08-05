<?php

namespace App\Widgets;

use Carbon_Fields\Field;
use Carbon_Fields\Widget;

class FooterAddress extends Widget
{
    function __construct()
    {
        $this->setup('footer_address_widget', __('Footer Address'), __('Displays formatted address and contact information in the site footer.'), array(
            Field::make('image', 'fci_image', __('Footer Logo'))
                ->set_width(50),
            Field::make('text', 'fci_image_link', __('Footer Logo Link'))
                ->set_width(50),
            Field::make('rich_text', 'fci_address', __('Address')),
            Field::make('complex', 'fci_contact', __('Contact Info'))
                ->setup_labels(array(
                    'plural_name'   => 'Contact Methods',
                    'singular_name' => 'Contact Method',
                ))
                ->add_fields('phone', __('Phone Number'), array(
                    Field::make('text', 'contact_method', __('Phone Number')),
                ))
                ->set_header_template('Phone')
                ->add_fields('email', __('Email Address'), array(
                    Field::make('text', 'contact_method', __('Email Address')),
                ))
                ->set_duplicate_groups_allowed(true)
                ->set_layout('tabbed-vertical')
                ->set_header_template('Email'),
        ));
    }

    function front_end($args, $instance)
    {
        $image = wp_get_attachment_image($instance['fci_image'], 'full');
        $imageLink = $instance['fci_image_link'];
        $addressLines   = $instance['fci_address'];
        $contactMethods = $instance['fci_contact'];

?>
<div class="cc-address-widget">
  <div class="cc-address-widget__container container--address-widget">
    <?php if ($image) : ?>
    <div class="cc-address-widget__logo">
      <?php if ($imageLink) : ?>
      <a href="<?php echo $imageLink; ?>">
        <?php endif; ?>
        <?php echo $image; ?>
        <?php if ($imageLink) : ?>
      </a>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php if ($addressLines) : ?>
    <div class="cc-address-widget__address cc-copy--large cc-copy--spaced">
      <?php echo apply_filters('the_content', $addressLines); ?>
    </div>
    <?php endif; ?>

    <div class="cc-address-widget__contact cc-copy--large cc-copy--spaced">
      <?php foreach ($contactMethods as $method) :
                        $contact = $method['contact_method'];
                        $type    = $method['_type'];
                        $href    = ($type == 'phone') ? preg_replace('/\D/', '', $contact) : $contact;
                        $prefix  = ($type == 'phone') ? 'tel:' : 'mailto:';
                        $icon    = ($type == 'phone') ? 'phone' : 'envelope';
                    ?>
      <p class="cc-address-widget__contact-line"><a class="cc-address-widget__contact-link" href="<?php echo $prefix . $href; ?>"><i class="<?php echo 'fa-solid fa-' . $icon; ?>"></i> <?php echo $contact; ?></a><!-- /.cc-address-widget__contact-link -->
      </p>
      <?php endforeach; ?>
    </div>
  </div><!-- /.cc-address-widget__container container--address-widget -->
</div><!-- /.cc-address-widget -->
<?php
    }
}