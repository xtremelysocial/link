<?php
/**
 * Theme: Link
 * 
 * Functions file to make changes to the parent theme's functions. 
 *
 * @package link
 */
 
/**
 * SET THEME OPTIONS HERE
 *
 * Theme options can be overriden here. These are all set the same defaults as in the 
 * parent theme except for the navbar_classes. You can change whatever you want.
 * 
 * Parameters:
 * background_color - Hex code for default background color without the #. eg) ffffff
 *
 * content_width - Only for determining "full width" image. Actual width in Bootstrap.css.
 * 		1170 for screens over 1200px resolution, otherwise 970.
 *
 * embed_video_width - Sets the width of videos that use the <embed> tag. This defaults
 * 		to the smallest width of content with a sidebar before the sidebar collapses.
 *		The height is automatically set at a 16:9 ratio unless overridden.
 *
 * embed_video_height - Leave empty to automatically set at a 16:9 ratio to the width
 *
 * post_formats - WordPress extra post formats. i.e. 'aside', 'image', 'video', 'quote',
 * 		'link'
 *
 * touch_support - Whether to load touch support for carousels (sliders)
 *
 * fontawesome - Whether to load font-awesome font set or not
 *
 * bootstrap_gradients - Whether to load Bootstrap "theme" CSS for gradients
 *
 * navbar_classes - One or more of navbar-default, navbar-inverse, navbar-fixed-top, etc.
 * 
 * custom_header_location - If 'header', displays the custom header above the navbar. If
 * 		'content-header', displays it below the navbar in place of the colored content-
 *		header section. If 'both' (or anything else), it will display the header text but
 *		also display the custom header below the navbar.
 *
 * image_keyboard_nav - Whether to load javascript for using the keyboard to navigate
 		image attachment pages
 *
 * sample_widgets - Whether to display sample widgets in the footer and page-bottom widet
 		areas.
 *
 * sample_footer_menu - Whether to display sample footer menu with Top and Home links
 * 
 * testimonials - Whether to activate testimonials custom post type if Jetpack plugin is 
 * 		active
 */
$xsbf_theme_options = array(
	//'background_color' 		=> 'f2f2f2',
	//'content_width' 			=> 1170,
	//'embed_video_width' 		=> 1170,
	//'embed_video_height' 		=> null, // i.e. calculate it automatically
	//'post_formats' 			=> null,
	//'touch_support' 			=> true,
	//'fontawesome' 			=> true,
	//'bootstrap_gradients' 	=> false,
	'navbar_classes'			=> '', //not used in Link theme
	'custom_header_location' 	=> 'content-header',
	//'image_keyboard_nav' 		=> true,
	//'sample_widgets' 			=> true,
	//'sample_footer_menu'		=> true
	//'testimonials'			=> true // requires Jetpack plugin
);

/* 
 * Load the parent theme's stylesheet here for performance reasons instead of using 
 * @include in this theme's stylesheet. Load this after the parent theme's styles.
 */
//add_action( 'wp_enqueue_scripts', 'xsbf_pratt_enqueue_styles', 20 );
add_action( 'wp_enqueue_scripts', 'xsbf_pratt_enqueue_styles' );
function xsbf_pratt_enqueue_styles() {
	wp_enqueue_style( 'flat-bootstrap', 
		get_template_directory_uri() . '/style.css',
		array ( 'bootstrap', 'theme-base', 'theme-flat')
	);

	wp_enqueue_style( 'link', 
		get_stylesheet_directory_uri() . '/style.css', 
		array('flat-bootstrap') 
	);
}

/**
 * Add our javascript for the offcanvas menu (Bootstrap doesn't have this)
 */
add_action( 'wp_enqueue_scripts', 'xsbf_link_scripts' );
function xsbf_link_scripts() {
	//wp_enqueue_script( 'main.js', get_stylesheet_directory_uri() . '/js/main.js', $dependencies = array( 'jquery.js'), '20131120', true );
	wp_enqueue_script( 'main.js', get_stylesheet_directory_uri() . '/js/main.js', '', '20131120', true );
}

/**
 * Add a third menu for social media icons to be added to the offcanvas menu. Note: This 
 * idea is from Justin Tadlock.
 */
if ( !function_exists( 'jetpack_social_menu' ) OR !has_nav_menu( 'jetpack-social-menu' ) ) {
	add_action( 'init', 'xsbf_link_register_menus' );
	function xsbf_link_register_menus() {
		register_nav_menus(
			array(
				'social' 	=> __( 'Social Menu', 'flat-bootstrap' ),
			)
		);
	} //endfunction
}//endif 

/**
 * Override custom logo and header from the parent theme. Note priority 12 to run after
 * the parent theme's setup.
 */
/*add_action( 'after_setup_theme', 'xsbf_link_after_setup_theme' ); 
function xsbf_link_after_setup_theme() {*/
add_action( 'after_setup_theme', 'xsbf_custom_header_setup', 12 ); 
function xsbf_custom_header_setup() {

	/* Remove custom logo support (for now) */
	remove_theme_support( 'custom-logo'); 

	/* Override custom headers */
	add_theme_support( 'custom-header', apply_filters( 'xsbf_custom_header_args', array(
		'header-text' 			=> false, // doesn't allow user to turn off header text
		'default-text-color'	=> 'fff',
		'default-image' => get_stylesheet_directory_uri() . '/images/headers/briefcase-green.jpg',
		'width' 				=> 1600,
		'height' 				=> 750, //large: home 750, other 480; mobile home 480, other 400 mobile; images are 900
		'flex-width'            => true,
		'flex-height'           => true,
		'wp-head-callback'      => 'xsbf_header_style'
	) ) );

	//The %2$s references the child theme directory (ie the stylesheet directory), use 
	// %s to reference the parent directory.
	register_default_headers( array(
		'abstract' => array(
			'url'           => '%2$s/images/headers/abstract-green.jpg',
			'thumbnail_url' => '%2$s/images/headers/abstract-green-thumbnail.jpg',
			'description'   => __( 'Abstract', 'flat-bootstrap' )
		),
		'book' => array(
			'url'           => '%2$s/images/headers/book-green.jpg',
			'thumbnail_url' => '%2$s/images/headers/book-green-thumbnail.jpg',
			'description'   => __( 'Book', 'flat-bootstrap' )
		),
		'briefcase' => array(
			'url'           => '%2$s/images/headers/briefcase-green.jpg',
			'thumbnail_url' => '%2$s/images/headers/briefcase-green-thumbnail.jpg',
			'description'   => __( 'Briefcase', 'flat-bootstrap' )
		),
		'camera' => array(
			'url'           => '%2$s/images/headers/camera-green.jpg',
			'thumbnail_url' => '%2$s/images/headers/camera-green-thumbnail.jpg',
			'description'   => __( 'Camera', 'flat-bootstrap' )
		),
		'city' => array(
			'url'           => '%2$s/images/headers/city-green.jpg',
			'thumbnail_url' => '%2$s/images/headers/city-green-thumbnail.jpg',
			'description'   => __( 'City', 'flat-bootstrap' )
		),
		'desk' => array(
			'url'           => '%2$s/images/headers/desk-green.jpg',
			'thumbnail_url' => '%2$s/images/headers/desk-green-thumbnail.jpg',
			'description'   => __( 'Desk', 'flat-bootstrap' )
		),
		'guitar' => array(
			'url'           => '%2$s/images/headers/guitar-green.jpg',
			'thumbnail_url' => '%2$s/images/headers/guitar-green-thumbnail.jpg',
			'description'   => __( 'Guitar', 'flat-bootstrap' )
		),
		'notepad' => array(
			'url'           => '%2$s/images/headers/notepad-green.jpg',
			'thumbnail_url' => '%2$s/images/headers/notepad-green-thumbnail.jpg',
			'description'   => __( 'Notepad', 'flat-bootstrap' )
		),
		'skyline' => array(
			'url'           => '%2$s/images/headers/skyline-green.jpg',
			'thumbnail_url' => '%2$s/images/headers/skyline-green-thumbnail.jpg',
			'description'   => __( 'Skyline', 'flat-bootstrap' )
		),
	) );
}
