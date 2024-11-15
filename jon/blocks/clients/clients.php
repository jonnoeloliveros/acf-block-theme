<?php
/**
 * Clients Block template.
 *
 * @param array $block The block settings and attributes.
 */

 // Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'client_section';
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
?>
<section <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>">
  <div class="client_section-inner<?php echo $bottom_padding; echo $top_padding; ?>" style="<?php echo 'max-width:' . $theme_settings['wide_size'] . ';';?>">
    <?php
      if ($heading) {
        ?>
        <div class="heading_container heading_center">
          <?php echo $heading; ?>
        </div>
        <?php
      }

      $args = array(
          'post_type'      => 'client',
          'post_status'    => 'publish',
          'posts_per_page' => -1,
          'order'          => 'ASC'
      );

      $clients_query = new WP_Query($args);

      if ($clients_query->have_posts()) :
        ?>
        <div class="carousel-wrap layout_padding2-top">
          <div class="slick-carousel">
            <?php
            while ($clients_query->have_posts()) :
              $clients_query->the_post();
              $rating = get_field('rating', get_the_ID());
              $description = !empty( get_field('description', get_the_ID()) ) ? '<p>' . get_field('description', get_the_ID()) . '</p>' : '';
              ?>
              <div class="item">
                <div class="box">
                  <div class="client_id">
                    <?php
                      if (has_post_thumbnail()) {
                        ?>
                        <div class="img-box">
                          <?php the_post_thumbnail('medium'); ?>
                        </div>
                        <?php
                      }
                    ?>
                    <div class="client_detail">
                      <div class="client_info">
                        <?php
                          echo '<h6>' . get_the_title() . '</h6>';
                          
                          for ($i=1; $i <= $rating ; $i++) { 
                            ?>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <?php
                          }
                        ?>
                      </div>
                      <i class="fa fa-quote-left" aria-hidden="true"></i>
                    </div>
                  </div>
                  <?php
                    if ($description) {
                      ?>
                      <div class="client_text">
                        <?php
                          echo $description;
                        ?>
                      </div>
                      <?php
                    }
                  ?>
                </div>
              </div>
            <?php endwhile;
            wp_reset_postdata();
            ?>
            </div>
          </div>
          <div class="client-slick-nav"></div>
        <?php
      endif;
    ?>
  </div>
</section>