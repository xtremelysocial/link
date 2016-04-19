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
 * Force the site title to display in the navbar and add our custom header images
 */
/*add_action( 'after_setup_theme', 'xsbf_link_after_setup_theme' ); 
function xsbf_link_after_setup_theme() {*/
add_action( 'after_setup_theme', 'xsbf_custom_header_setup' ); 
function xsbf_custom_header_setup() {

	add_theme_support( 'custom-header', apply_filters( 'xsbf_custom_header_args', array(
		'header-text' 			=> false, // doesn't allow user to turn off header text
		'default-text-color'	=> 'fff',
		'default-image' => get_stylesheet_directory_uri() . '/images/headers/briefcase-green.jpg',
		'width' 				=> 1600,
		'height' 				=> 700, //large: home 700, other 400; mobile home 480, other 340 mobile; images are 900
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

/*
 * Set the CSS for the Appearance > Header admin panel 
 */
function xsbf_admin_header_style() {
	$header_image = get_header_image();
?>
	<style type="text/css" id="xsbf-admin-header-css">

	.appearance_page_custom-header #headimg {
		border: none;
		-webkit-box-sizing: border-box;
		-moz-box-sizing:    border-box;
		box-sizing:         border-box;
		<?php
		if ( ! empty( $header_image ) ) {
			echo 'background: url(' . esc_url( $header_image ) . ') no-repeat scroll; background-size: 1600px auto; background-position: center center;';
			echo 'height: 480px;';
		} else {
			echo 'height: 200px;';
		}
		?>
		padding: 0 40px;
	}
	#headimg .home-link {
		-webkit-box-sizing: border-box;
		-moz-box-sizing:    border-box;
		box-sizing:         border-box;
		margin: 0 auto;
		max-width: 1040px;
		<?php
		if ( ! empty( $header_image ) ) {
			echo 'height: 480px;';
		} else {
			echo 'height: 200px;';
		}
		?>
		width: 100%;
	}

	#headimg h1 {
		font: 700 41px/45px Raleway, Arial, 'Helvetica Neue', sans-serif;
		<?php
		if ( ! empty( $header_image ) ) {
			echo 'margin: 200px 0 11px;';
		} else {
			echo 'margin: 50px 0 11px;';
		}
		?>
		text-align: center;
	}
	#headimg h2 {
		font: 300 24px/26px Raleway, Arial, 'Helvetica Neue', sans-serif;
		margin: 10px 0 25px;
		text-align: center;
		/*text-shadow: none;*/
	}
	#headimg h1, #headimg h2 {
		color: white !important;
	}
	</style>
<?php
}

/* 
 * Display the header image in the Appearance > Header and Appearance > Customize
 */
function xsbf_admin_header_image() {
	?>
	<div id="headimg" style="background: #1abc9c url(<?php header_image(); ?>) no-repeat scroll top; background-size: 1600px auto; background-position: center center;">
	<div class="section-image-overlay">
		<?php $style = ' style="color:#' . get_header_textcolor() . ';"'; ?>
		<div class="home-link">
			<h1 class="displaying-header-text" <?php echo $style; ?>><?php bloginfo('name'); ?></h1>
			<h2 id="desc" class="displaying-header-text"<?php echo $style; ?>><?php bloginfo('description'); ?></h2>
		</div>
	</div>
	</div>
<?php 
} 
