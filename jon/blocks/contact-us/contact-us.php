<?php
/**
 * Contact Us Block template.
 *
 * @param array $block The block settings and attributes.
 */

 // Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'contact_us_section';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

$theme_settings = get_current_theme_settings();

$heading = !empty( get_field('heading') ) ? '<h2>' . get_field('heading') . '</h2>' : '';
$contact_form_shortcode = get_field('contact_form_shortcode');
$image_or_map = get_field('image_or_map');
$image = get_field('image');
$map = get_field('map');

$bottom_padding = !empty( get_field('bottom_padding') ) ? ' layout_padding-bottom' : '';
$top_padding = !empty( get_field('top_padding') ) ? ' layout_padding-top' : '';
?>
<section <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>">
  <div class="contact_us_section-inner<?php echo $bottom_padding; echo $top_padding; ?>" style="<?php echo 'max-width:' . $theme_settings['wide_size'] . ';';?>">
    <?php
      if($heading) {
        ?>
        <div class="heading_container">
          <?php echo $heading; ?>
        </div>
        <?php
      }
    ?>
    <div class="row">
      <div class="col-md-6">
        <?php
          if ($contact_form_shortcode) {
            echo do_shortcode($contact_form_shortcode);
          }
        ?>
      </div>
      <div class="col-md-6">
        <div class="map_container">
          <div class="map">
            <?php
              if ($image_or_map == 'image') {
                ?>
                <div class="img-box">
                  <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                </div>
                <?php
              } else {
                echo $map;
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>