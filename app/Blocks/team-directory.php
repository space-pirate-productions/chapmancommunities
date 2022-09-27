<?php

namespace App\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function add_team_directory_block()
{
  Block::make(__('Team Directory'))
    ->add_fields(array(
      Field::make('complex', 'locations', __('Locations'))
        ->add_fields(array(
          Field::make('text', 'location', __('Location')),
          Field::make('complex', 'people', __('Team Members'))
            ->add_fields(array(
              Field::make('image', 'picture', __('Picture')),
              Field::make('text', 'name', __('Name')),
              Field::make('text', 'title', __('Title')),
            ))
            ->set_layout('tabbed-vertical')
            ->setup_labels(array(
              'plural_name' => 'Team Members',
              'singular_name' => 'Team Member'
            ))
            ->set_header_template('<%- name ? name : $_index + 1 %>'),
        ))
        ->set_layout('tabbed-horizontal')
        ->setup_labels(array(
          'plural_name' => 'Locations',
          'singular_name' => 'Location'
        ))
        ->set_header_template('<%- location ? location : $_index + 1 %>'),
    ))
    ->set_description(__('Renders the team member directory for the "Our Team" page template.'))
    ->set_category('our-team', __('Our Team'), 'groups')
    ->set_icon('groups')
    ->set_keywords([__('team'), __('directory'), __('template')])
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {

      function unique_multidim_array($array, $key, $concat)
      {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($array as $val) {
          if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
          } else {
            $temp_array[$i - 1][$concat] .= " & " . $val[$concat];
          }
          $i++;
        }
        return $temp_array;
      }

      $locations = $fields['locations'];
      $everyone = array();
      // Get all team members
      foreach ($locations as $location) {
        $people = $location['people'];
        $everyone = \array_merge($everyone, $people);
      }
      // Sort all team members
      $everyName = array_column($everyone, 'name');
      $everyNormalName = array_map('strtolower', $everyName);
      array_multisort($everyNormalName, SORT_ASC, $everyone);
      $everyoneUnique = unique_multidim_array($everyone, 'name', 'title');
      // Sort locations
      $everyLocation = array_column($locations, 'location');
      $normalizedLocations = array_map('strtolower', $everyLocation);
      array_multisort($normalizedLocations, \SORT_ASC, $locations);
      if (!empty($locations)) : ?>
<section class="cc-team-directory">
  <div class="cc-team-directory__container">
    <div id="cc-team-locations" class="cc-team-directory__locations splide">
      <div class="splide__track">
        <div class="splide__list">
          <div class="cc-team-directory__location splide__slide">
            <div class="cc-team-directory__location-wrap">
              <strong class="cc-team-directory__location-name cc-copy--large">All Locations</strong>
            </div>
          </div>
          <?php foreach ($locations as $location) : ?>
          <div class="cc-team-directory__location splide__slide">
            <div class="cc-team-directory__location-wrap">
              <strong class="cc-team-directory__location-name cc-copy--large">
                <?php echo $location['location']; ?>
              </strong>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <div id="cc-team-members" class="cc-team-directory__teams splide">
      <div class="splide__track">
        <div class="splide__list">
          <div class="cc-team-directory__team cc-team-directory__team--all-locations splide__slide">
            <div class="cc-team-directory__team-container row">
              <?php foreach ($everyoneUnique as $person) :
                      $image = wp_get_attachment_image($person['picture'], 'team-member-headshot', \false);
                      $name = \sanitize_text_field($person['name']);
                      $title = \sanitize_text_field($person['title']);
                    ?>
              <div class="cc-team-directory__team-member col-sm-6 col-md-4 col-lg-3 g-md-5">
                <div class="cc-team-directory__team-member-wrap">
                  <div class="cc-team-directory__headshot">
                    <?php if ($image) : ?>
                    <?php echo $image; ?>
                    <?php else : ?>
                    <div class="cc-team-directory__placeholder">
                      <i class="fa-solid fa-user"></i>
                    </div>
                    <?php endif; ?>
                  </div>
                  <div class="cc-team-directory__info">
                    <?php if ($name) : ?>
                    <h5 class="cc-team-directory__name"><?php echo $name; ?></h5>
                    <?php endif; ?>
                    <?php if ($title) : ?>
                    <p class="cc-team-directory__title cc-copy--large"><?php echo $title; ?></p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <?php foreach ($locations as $location) :
                  $locationName = $location['location'];
                  $people = $location['people'];
                  $name = array_column($people, 'name');
                  $normalName = array_map('strtolower', $name);
                  array_multisort($normalName, SORT_ASC, $people);
                ?>
          <div class="cc-team-directory__team cc-team-directory__team--<?php echo $locationName ?> splide__slide">
            <div class="cc-team-directory__team-container row">
              <?php foreach ($people as $person) :
                        $image = wp_get_attachment_image($person['picture'], 'team-member-headshot', \false);
                        $name = \sanitize_text_field($person['name']);
                        $title = \sanitize_text_field($person['title']);
                      ?>
              <div class="cc-team-directory__team-member col-sm-6 col-md-4 col-lg-3 g-md-5">
                <div class="cc-team-directory__team-member-wrap">
                  <div class="cc-team-directory__headshot">
                    <?php if ($image) : ?>
                    <?php echo $image; ?>
                    <?php else : ?>
                    <div class="cc-team-directory__placeholder">
                      <i class="fa-solid fa-user"></i>
                    </div>
                    <?php endif; ?>
                  </div>
                  <div class="cc-team-directory__info">
                    <?php if ($name) : ?>
                    <h5 class="cc-team-directory__name"><?php echo $name; ?></h5>
                    <?php endif; ?>
                    <?php if ($title) : ?>
                    <p class="cc-team-directory__title cc-copy--large"><?php echo $title; ?></p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif;
    });
};

add_action('carbon_fields_register_fields', __NAMESPACE__ . '\\add_team_directory_block');