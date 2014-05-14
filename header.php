<?php
/**
 * Theme: Link
 * 
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package link
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<?php do_action( 'before' ); ?>
	
	<?php // Set up the navbar as a header ?>
	<header id="masthead" class="site-header" role="banner">

	<?php 
	// Off-canvas menu always displayed even for desktop browser
	$navbar = ''
	.'<nav class="offcanvas-menu" id="theMenu"><!-- menu-open -->'
	.'<div class="menu-wrap">'
	.'<span class="fa fa-arrow-left menu-close"></span>';

	// Add site name with link to home. Otherwise there is no branding in the header
	// anywhere on the site ;-)	
	$navbar .= '<h1 class="logo"><a class="custom-header-text-color" href="'
	.esc_url( home_url( '/' ) )
	.'" rel="home">'
	.get_bloginfo( 'name' )
	.'</a></h1>';

	// Primary navbar menu links
	$navbar .= wp_nav_menu( 
		array(  
		'theme_location' 	=> 'primary',
		'container' 		=> false, //<nav> or <div> class
		'menu_class' 		=> 'offcanvas-links', //<ul> class
		'fallback_cb' 		=> 'wp_page_menu',
		'depth'				=> 1,
		'echo'				=> false
		) 
	);
	
	// Social navbar menu links
	$navbar .= wp_nav_menu( 
		array(  
		'theme_location' 	=> 'social',
		'container' 		=> false, //<nav> or <div> class
		'menu_class' 		=> 'offcanvas-links', //<ul> class
		'fallback_cb' 		=> null,
		'depth'				=> 1,
		'echo'				=> false
		) 
	);

	$navbar .= '</div>';

	// Navbar menu toggle button		
	$navbar .= ''
	.'<!-- Menu button -->'
	.'<div id="menuToggle" class="menu-close"><!-- active -->'
	.'<span class="fa fa-bars"></span>'
	.'</div>'
	.'</nav>';
	
	echo apply_filters( 'xsbf_navbar', $navbar ); 
	?>
	
	</header><!-- #masthead -->

	<?php // Page Top (after header) widget area 
	//get_sidebar( 'pagetop' ); 
	?>

	<?php // Set up the content area (but don't put it in a container) ?>	
	<div id="content" class="site-content">
