<?php
/**
 * About Block template.
 *
 * @param array $block The block settings and attributes.
 */

 // Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'about_section';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

$theme_settings = get_current_theme_settings();

$title = !empty( get_field('title') ) ? '<h2>' . get_field('title') . '</h2>' : '';
$description = !empty( get_field('description') ) ? '<p>' . get_field('description') . '</p>' : '';
$button = get_field('button');
$image = get_field('image');
$bottom_padding = !empty( get_field('bottom_padding') ) ? ' layout_padding-bottom' : '';
$top_padding = !empty( get_field('top_padding') ) ? ' layout_padding-top' : '';
?>
<section <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>">
  <div class="about_section-inner<?php echo $bottom_padding; echo $top_padding; ?>" style="<?php echo 'max-width:' . $theme_settings['wide_size'] . ';';?>">
    <div class="row">
      <div class="col-lg-5 col-md-6">
        <div class="detail-box">
          <?php
            echo $title;
            echo $description;

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
      <div class="col-lg-7 col-md-6">
        <?php
          if( !empty( $image ) ): ?>
            <div class="img-box">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            </div>
          <?php endif;
        ?>
      </div>
    </div>
  </div>
</section>