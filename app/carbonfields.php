<?php

    namespace App;

    add_action( 'after_setup_theme', __NAMESPACE__ . '\\chapman_load_fields' );
    function chapman_load_fields() {
        require_once(CHAPMAN_DIR . '/vendor/autoload.php');
        \Carbon_Fields\Carbon_Fields::boot();
    }
