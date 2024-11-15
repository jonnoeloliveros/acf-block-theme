<?php
/**
 * Hero Slider Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'slider_section';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

$theme_settings = get_current_theme_settings();
$bottom_padding = !empty( get_field('bottom_padding') ) ? ' layout_padding-bottom' : '';
$top_padding = !empty( get_field('top_padding') ) ? ' layout_padding-top' : '';

$initial_BG = 'unset';
if( have_rows('hero_slider') ):
    // Get the initial background color of the first slide without advancing the row pointer
    $first_slide = get_field('hero_slider')[0];
    $initial_BG = $first_slide['background_color'];

    ?>
    <section <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" style="background-color: <?php echo esc_attr( $initial_BG ); ?>;">
        <div class="slider_section-inner<?php echo $bottom_padding . $top_padding; ?>">
            <?php
            // Main loop to display all slides
            while( have_rows('hero_slider') ) : the_row();
                $background_color = get_sub_field( 'background_color' );
                $title = !empty( get_sub_field( 'title' ) ) ? '<h1>' . get_sub_field( 'title' ) . '</h1>' : '';
                $description = !empty( get_sub_field( 'description' ) ) ? '<p>' . get_sub_field( 'description' ) . '</p>' : '';
                $button = get_sub_field( 'button' );
                $image = get_sub_field( 'image' );
                ?>
                <div class="row hero-slider-item" data-background-color="<?php echo esc_attr( $background_color ); ?>"  style="max-width: <?php echo esc_attr( $theme_settings['wide_size'] ); ?>;">
                    <div class="col-md-6">
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
                                <?php endif;
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php if( !empty( $image ) ): ?>
                            <div class="img-box">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            endwhile;
            ?>
        </div>
    </section>
    <?php
endif;
?>