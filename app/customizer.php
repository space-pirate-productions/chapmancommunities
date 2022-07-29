<?php
function chapman_customize($wp_customize)
{
    $wp_customize->add_setting(
        'logo'
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'logo',
            array(
                'label'    => 'Site Logo',
                'section'  => 'title_tagline',
                'settings' => 'logo',
            )
        )
    );
    $wp_customize->get_setting('logo')->transport = 'postMessage';

    $wp_customize->add_setting('nav_button_text');
    $wp_customize->add_control('nav_button_text', array(
        'label' => 'Banner Button Text',
        'description' => 'Display text for the button that appears to the right of the primary navigation menu.',
        'section' => 'title_tagline',
        'type' => 'text',
    ));
    $wp_customize->get_setting('nav_button_text')->transport = 'postMessage';

    $wp_customize->add_setting('nav_button_url');
    $wp_customize->add_control('nav_button_url', array(
        'label' => 'Banner Button URL',
        'description' => 'URL for the button that appears to the right of the primary navigation menu.',
        'section' => 'title_tagline',
        'type' => 'text',
    ));
    $wp_customize->get_setting('nav_button_url')->transport = 'postMessage';
}
add_action('customize_register', 'chapman_customize');
