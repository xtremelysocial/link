<?php
/**
 * Theme: Link
 * 
 * The "sidebar" for the widgetized footer area. If no widgets added AND just preivewing
 * the theme, then display some widgets as samples. Once the theme is actually in use,
 * it will be empty until the user adds some actual widgets.
 *
 * @package link
 */
?>

<?php 
/* If footer "sidebar" has widgets, then retreive them */
$sidebar_footer = get_dynamic_sidebar( 'Footer' );

/* If not, then display sample widgets, unless turned off in theme options */
/*
global $xsbf_theme_options;
if ( $xsbf_theme_options['sample_widgets'] != false AND ! $sidebar_footer ) {
	$sidebar_footer = '<div id="cf">
				<div class="col-lg-8">
		        	<div id="mapwrap">
						<iframe height="400" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.es/maps?t=m&amp;ie=UTF8&amp;ll=52.752693,22.791016&amp;spn=67.34552,156.972656&amp;z=6&amp;output=embed"></iframe>
					</div>	
				</div><!--col-lg-8-->
				<div class="col-lg-4">
					<h4>ADDRESS<br/>Minsk - Head Office</h4>
					<br>
					<p>
						Business Center, SomeAve 987,<br/>
						Minsk, Belarus.
					</p>
					<p>
						P: +55 4839-4390<br/>
						F: +55 4333-4345<br/>
						E: <a href="mailto:#">hello@linkagency.com</a>
					</p>
					<p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using "Content here, content here", making it look like readable English.</p>
				</div><!--col-lg-4-->
			</div><!-- cf -->';
}
*/

/* Apply filters and display the footer widgets */
if ( $sidebar_footer ) :
?>
	<div class="sidebar-footer clearfix">
	<div class="container">
		<div class="row">
		<?php echo apply_filters( 'xsbf_footer', $sidebar_footer ); ?>
		</div><!-- .row -->
	</div><!-- .container -->
	</div><!-- .sidebar-footer -->

<?php endif;?>