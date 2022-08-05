<?php

namespace App;

use \WP_Widget;

class cc_copyright_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'cc_copyright_widget',
            __('Copyright Widget', 'sage'),
            array('description' => __('Widget for adding copyright notice to the site footer.', 'sage'),)
        );
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        echo do_shortcode('[cc-copyright]');
        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        return $instance;
    }
}

function cc_load_widgets()
{
    register_widget(__NAMESPACE__ . '\\cc_copyright_widget');
}

add_action('widgets_init', __NAMESPACE__ . '\\cc_load_widgets');