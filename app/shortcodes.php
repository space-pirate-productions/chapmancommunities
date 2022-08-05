<?php
namespace App;

function cc_copyright_shortcode(){
    $output = '<p class="cc-copyright">&#169; ' . date("Y") . ' Chapman Foundation for Caring Communities</p>';
    return $output;
}
add_shortcode( 'cc-copyright', __NAMESPACE__ . '\\cc_copyright_shortcode' );
?>
