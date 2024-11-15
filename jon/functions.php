<?php

/**
 * We use WordPress's init hook to make sure
 * our blocks are registered early in the loading
 * process.
 *
 * @link https://developer.wordpress.org/reference/hooks/init/
 */
function tt4clone_register_acf_blocks() {
    /**
     * We register our block's with WordPress's handy
     * register_block_type();
     *
     * @link https://developer.wordpress.org/reference/functions/register_block_type/
     */
    register_block_type( __DIR__ . '/blocks/testimonial' );
	register_block_type( __DIR__ . '/blocks/hero-slider' );
    register_block_type( __DIR__ . '/blocks/feature' );
    register_block_type( __DIR__ . '/blocks/about' );
    register_block_type( __DIR__ . '/blocks/professional' );
    register_block_type( __DIR__ . '/blocks/services' );
    register_block_type( __DIR__ . '/blocks/clients' );
    register_block_type( __DIR__ . '/blocks/contact-us' );
}
// Here we call our tt4clone_register_acf_block() function on init.
add_action( 'init', 'tt4clone_register_acf_blocks' );


function wpfieldwork_acf_input_colors() {
	?>
	<script type="text/javascript">
		(function($) {
		acf.add_filter('color_picker_args', function( $args, $field ){
			
			// this will create a settings variable with all settings
			const $settings = wp.data.select( "core/editor" ).getEditorSettings();
		
			// pull out the colors from that variable
			let $colors = $settings.colors.map(x => x.color);
			
			// assign those colors to palettes
			$args.palettes = $colors;
			return $args;
		
		});
		})(jQuery);
	</script>
	<?php
}
add_action('acf/input/admin_footer', 'wpfieldwork_acf_input_colors');

// Allow SVG uploads
function allow_svg_uploads($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_uploads');

function enqueue_slick_carousel() {
    // Enqueue Slick CSS
    wp_enqueue_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css');
    wp_enqueue_style('slick-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css');
    
    // Enqueue jQuery (if not already included)
    wp_enqueue_script('jquery');
    
    // Enqueue Slick JS
    wp_enqueue_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('jquery'), null, true);
    
    // Enqueue your custom script to initialize Slick (optional, if needed)
    wp_enqueue_script('slick-init', get_stylesheet_directory_uri() . '/assets/js/slick-init.js', array('slick-js'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_slick_carousel');

function enqueue_slick_slider_assets() {
    // Enqueue Slick CSS and JS for the frontend
    wp_enqueue_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css');
    wp_enqueue_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('jquery'), null, true);

    // Enqueue Slick CSS and JS for the block editor
    if (is_admin()) {
        wp_enqueue_style('slick-editor-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css');
        wp_enqueue_script('slick-editor-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('jquery'), null, true);
    }
}
add_action('enqueue_block_assets', 'enqueue_slick_slider_assets');

function enqueue_slick_initialization() {
    wp_enqueue_script(
        'slick-initialization',
        get_stylesheet_directory_uri() . '/assets/js/slick-init.js',
        array('jquery', 'slick-js'),
        null,
        true
    );
}
add_action('enqueue_block_editor_assets', 'enqueue_slick_initialization');

function my_theme_enqueue_scripts() {
    // Enqueue Bootstrap CSS for frontend
    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css', array(), null, 'all' );

    // Enqueue Bootstrap JS for frontend
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true );
    
    // Enqueue Bootstrap CSS for the editor
    if ( is_admin() ) {
        wp_enqueue_style( 'bootstrap-editor', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css', array(), null, 'all' );
        wp_enqueue_script( 'bootstrap-editor-js', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true );
    }
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_scripts' );
add_action( 'admin_enqueue_scripts', 'my_theme_enqueue_scripts' );  // Also load for editor

// Add Bootstrap styles to the block editor
function my_theme_add_editor_styles() {
    add_theme_support( 'editor-styles' );
    add_editor_style( 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' );
    add_editor_style( get_stylesheet_directory_uri() . '/style.css' );
    add_editor_style( get_stylesheet_directory_uri() . '/responsive.css' );
}
add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );

function my_child_theme_enqueue_styles() {
    // Enqueue child theme styles for frontend
    wp_enqueue_style(
        'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array(),
        filemtime(get_stylesheet_directory() . '/style.css'),
        'all'
    );

    wp_enqueue_style(
        'child-responsive-style',
        get_stylesheet_directory_uri() . '/responsive.css',
        array(),
        filemtime(get_stylesheet_directory() . '/responsive.css'),
        'all'
    );
}
add_action('wp_enqueue_scripts', 'my_child_theme_enqueue_styles');

function my_child_theme_editor_styles() {
    // Enqueue child theme styles for block editor
    wp_enqueue_style(
        'child-editor-style',
        get_stylesheet_directory_uri() . '/style.css',
        array(),
        filemtime(get_stylesheet_directory() . '/style.css'),
        'all'
    );

    wp_enqueue_style(
        'child-responsive-editor-style',
        get_stylesheet_directory_uri() . '/responsive.css',
        array(),
        filemtime(get_stylesheet_directory() . '/responsive.css'),
        'all'
    );
}
add_action('enqueue_block_editor_assets', 'my_child_theme_editor_styles');

/**
 * Enqueue Font Awesome.
 */
function enqueue_font_awesome() {
    wp_enqueue_style(
        'font-awesome-style',
        get_stylesheet_directory_uri() . '/assets/css/font-awesome.min.css',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/css/font-awesome.min.css'),
        'all'
    );
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');

function get_current_theme_settings() {
    // Get the current theme
    $theme = wp_get_theme();
    $theme_settings = [];

    // Get the theme.json path
    $theme_json = get_theme_file_path( 'theme.json' );

    // Decode the theme.json file into a PHP array
    if ( file_exists( $theme_json ) ) {
        $json_data = json_decode( file_get_contents( $theme_json ), true );

        // Check if the 'layout' section exists in the theme.json
        if ( isset( $json_data['settings']['layout']['wideSize'] ) ) {
            $theme_settings['wide_size'] = $json_data['settings']['layout']['wideSize'];
        }

        if ( isset( $json_data['settings']['layout']['contentSize'] ) ) {
            $theme_settings['content_size'] = $json_data['settings']['layout']['contentSize'];
        }
    }

    return $theme_settings;
}

function my_theme_setup() {
    add_theme_support('align-wide');
}
add_action('after_setup_theme', 'my_theme_setup');