<?php
/**
 * Services Block template.
 *
 * @param array $block The block settings and attributes.
 */

 // Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'service_section';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

$theme_settings = get_current_theme_settings();
$bottom_padding = !empty( get_field('bottom_padding') ) ? ' layout_padding-bottom' : '';
$top_padding = !empty( get_field('top_padding') ) ? ' layout_padding-top' : '';

$heading = !empty( get_field('heading') ) ? '<h2>' . get_field('heading') . '</h2>': '';
$button = get_field('button');
?>
<section <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>">
  <div class="service_section-inner<?php echo $bottom_padding; echo $top_padding; ?>" style="<?php echo 'max-width:' . $theme_settings['wide_size'] . ';';?>">
    <?php
    if ($heading) {
      ?>
      <div class="heading_container heading_center">
        <?php echo $heading; ?>
      </div>
      <?php
    }

    if( have_rows('services') ):
      ?>
      <div class="row">
        <?php
        while ( have_rows('services') ) {
          the_row();
          $image = get_sub_field('image');
          $title = !empty( get_sub_field('title') ) ? '<h5>' . get_sub_field('title') . '</h5>' : '';
          $description = !empty( get_sub_field('description') ) ? '<p>' . get_sub_field('description') . '</p>' : '';
          ?>
          <div class="col-sm-6 col-md-4 mx-auto">
            <div class="box ">
              <?php
                if( !empty( $image ) ): ?>
                  <div class="img-box">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                  </div>
                <?php endif;
              ?>
              <div class="detail-box">
                <?php
                  echo $title;
                  echo $description;
                ?>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
      <?php
    endif;
    ?>
    <div class="btn-box">
      <?php
      if( $button ): 
        $button_url = $button['url'];
        $button_title = $button['title'];
        $button_target = $button['target'] ? $button['target'] : '_self';
        ?>
        <a href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>"><?php echo esc_html( $button_title ); ?></a>
        <?php
      endif;
      ?>
    </div>
  </div>
</section>