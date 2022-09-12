<?php
namespace App;

function cc_copyright_shortcode(){
    $output = '<p class="cc-copyright">&#169; ' . date("Y") . ' Chapman Foundation for Caring Communities</p>';
    return $output;
}
add_shortcode( 'cc-copyright', __NAMESPACE__ . '\\cc_copyright_shortcode' );

function cc_button_shortcode($atts) {
    $a = shortcode_atts(array(
        "element" => "anchor",
        "type" => "",
        "href" => "",
        "text" => "",
    ), $atts);

    if ($a['element'] == "anchor") {
        return "<a class='btn cc-button' href='" . $a['href'] . "'>" . $a['text'] . "</a>";
    } else {
        return "<button class='btn cc-button' type='" . $a['type'] . "'>" . $a['text'] . "</button>";
    }
}
add_shortcode('cc-button',__NAMESPACE__ . '\\cc_button_shortcode' );
?>
