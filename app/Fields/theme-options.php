<?php
  namespace App;

  use Carbon_Fields\Container;
  use Carbon_Fields\Field;

  function cc_attach_theme_options() {
    Container::make( 'theme_options', __( 'Theme Options' ) )
    ->add_fields( array(
        Field::make('complex', 'fci_address', __('Address'))
            ->add_fields(array(
                Field::make('text', 'address_line',)
            ))
            ->set_header_template('Line <%- $_index + 1 %>')
            ->set_layout('tabbed-vertical'),
        Field::make('complex', 'fci_contact', __('Contact Info'))
            ->add_fields('phone', __('Phone Number'), array(
                Field::make('text', 'phone_number', __('Phone Number'))
            ))
            ->set_header_template('Phone')
            ->add_fields('email', __('Email Address'), array(
                Field::make('text', 'email_address', __('Email Address'))
            ))
            ->set_duplicate_groups_allowed(true)
            ->set_layout('tabbed-vertical')
            ->set_header_template('Email')
    ) );
  }

  add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\cc_attach_theme_options');
?>
