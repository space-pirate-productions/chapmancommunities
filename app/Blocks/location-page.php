<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function add_location_page()
{
    Block::make(__('Locations'))
        ->add_fields(array(
            Field::make('text', 'location_heading', __('Heading'))
                ->set_width(50)
                ->set_classes('heading'),
            Field::make('rich_text', 'location_subtext', __('Text'))
                ->set_width(50)
                ->set_classes('text'),
            Field::make('complex', 'location_locations', __('Locations'))
                ->add_fields(array(
                    Field::make('image', 'location_image', __('Image')),
                    Field::make('text', 'location_name', __('Name')),
                    Field::make('text', 'location_text', __('Button Text'))
                        ->set_help_text(\__('Defaults to "Register" if nothing provided.'))
                        ->set_width(50),
                    Field::make('text', 'location_url', __('Button URL'))
                        ->set_width(50),
                ))
                ->set_classes('locations')
                ->set_layout('tabbed-vertical')
                ->setup_labels(array(
                    'plural_name' => 'Locations',
                    'singular_name' => 'Location'
                ))
                ->set_header_template('<%- location_name ? location_name : $_index + 1 %>'),
            Field::make('complex', 'location_markers', __('Map Markers'))
                ->add_fields(array(
                    Field::make('text', 'marker_name', __('Marker Name/Popup')),
                    Field::make('text', 'marker_lat', __('Latitude'))
                        ->set_attribute('type', 'number')
                        ->set_width(50),
                    Field::make('text', 'marker_long', __('Longitude'))
                        ->set_attribute('type', 'number')
                        ->set_width(50),
                ))
                ->set_layout('tabbed-vertical')
                ->setup_labels(array(
                    'plural_name' => 'Map Markers',
                    'singular_name' => 'Map Marker'
                ))
                ->set_header_template('<%- marker_name ? marker_name : $_index + 1 %>'),
        ))
        ->set_icon('location-alt')
        ->set_category('layout')
        ->set_keywords([\__('custom'), \__('map'), \__('layout'), \__('location')])
        ->set_description(\__('Renders the location page contents.'))
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            $heading = \sanitize_text_field($fields['location_heading']);
            $subtext = \apply_filters('the_content', $fields['location_subtext']);
            $locations = $fields['location_locations'];
            $mapMarkers = $fields['location_markers'];
            $mapMarkerData = array();
            if ($mapMarkers) {
                foreach ($mapMarkers as $mapMarker) {
                    $addMarker = array(
                        "name" => $mapMarker['marker_name'],
                        "lat" => $mapMarker['marker_lat'],
                        "long" => $mapMarker['marker_long']
                    );
                    array_push($mapMarkerData, $addMarker);
                }
            }
            $mapMarkerJson = json_encode($mapMarkerData);
?>
        <section class="cc-locations-map">
            <div class="cc-locations-map__map" id="cc-locations-map" data-locations='<?php echo $mapMarkerJson; ?>'></div>
        </section>
        <section class="cc-locations">
            <div class="cc-locations__container">
                <div class="cc-locations__class-list">
                    <?php if ($heading) : ?>
                        <h2 class="cc-locations__class-list-heading"><?php echo $heading; ?></h2>
                    <?php endif; ?>

                    <?php if ($subtext) : ?>
                        <div class="cc-locations__class-list-sub-text"><?php echo $subtext; ?></div>
                    <?php endif; ?>

                    <?php if ($locations) : ?>
                        <div class="cc-locations__class-list-list">
                            <?php foreach ($locations as $location) :
                                $image = wp_get_attachment_image($location['location_image'], 'homepage-image-cta', \false);
                                $name = \sanitize_text_field($location['location_name']);
                                $buttonText = (\sanitize_text_field($location['location_text'])) ?: "Register";
                                $buttonUrl = \sanitize_text_field($location['location_url']);
                            ?>
                                <div class="cc-locations__class">
                                    <div class="cc-locations__class-wrap">
                                        <?php if ($image) : ?>
                                            <div class="cc-locations__class-image"><?php echo $image; ?></div>
                                        <?php endif; ?>

                                        <div class="cc-locations__class-info">
                                            <?php if ($name) : ?>
                                                <h4 class="cc-locations__class-name"><?php echo $name; ?></h4>
                                            <?php endif; ?>

                                            <?php if ($buttonUrl) : ?>
                                                <div class="cc-locations__class-button">
                                                    <a href="<?php echo $buttonUrl; ?>" class="btn"><?php echo $buttonText; ?></a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
<?php
        });
}

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\add_location_page');
?>
