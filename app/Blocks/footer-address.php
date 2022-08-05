<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function add_footer_address_block()
{
    Block::make(__('Footer Contact Info'))
        ->add_fields(array(
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
        ))
        ->set_description(__('Block for formatting the address and contact information in the site footer.'))
        ->set_category('formatting')
        ->set_icon('location-alt')
        ->set_keywords([__('footer'), __('contact'), __('format'), __('address')])
        ->set_mode('edit')
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
?>
<div class="cc-footer-contact">
</div>
<?php
        });
}
add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\add_footer_address_block');
?>