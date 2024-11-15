<?php
/**
 * Feature Block template.
 *
 * @param array $block The block settings and attributes.
 */

 // Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'feature_section';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

$theme_settings = get_current_theme_settings();
$bottom_padding = !empty( get_field('bottom_padding') ) ? ' layout_padding-bottom' : '';
$top_padding = !empty( get_field('top_padding') ) ? ' layout_padding-top' : '';

$count = 0;
if( have_rows('features') ):
  ?>
  <section <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>">
    <div class="feature_section-inner<?php echo $bottom_padding; echo $top_padding; ?>" style="<?php echo 'max-width:' . $theme_settings['wide_size'] . ';';?>">
      <div class="feature_container">
        <?php
        while( have_rows('features') ) : the_row();
            $image = get_sub_field('image');
            $title = !empty( get_sub_field('title') ) ? '<h5 class="name">' . get_sub_field('title') . '</h5>' : '';
            ?>
            <div class="box<?php echo ($count == 1) ? ' active' : ''; ?>">
              <?php
                if( !empty( $image ) ):
                  ?>
                  <div class="img-box">
                    <?php
                    if ( $image['mime_type'] == 'image/svg+xml' ) {
                      echo file_get_contents($image['url']);
                    } else {
                      ?>
                      <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                      <?php
                    }
                    ?>
                  </div>
                  <?php
                endif;

                echo $title;
              ?>
            </div>
            <?php
            $count++;
        endwhile;
        ?>
        </div>
      </div>
  </section>
  <?php
endif;
?>
      