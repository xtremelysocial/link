<?php
/**
 * Theme: Link
 * 
 * The "sidebar" for the bottom of the page (before the widgetized footer area). If no 
 * widgets added AND preivewing the theme, then display some widgets as samples. Once the
 * theme is actually in use, it will be empty until the user adds some actual widgets.
 *
 * @package link
 */
?>

<?php 
/* If page bottom "sidebar" has widgets, then retrieve them */
$sidebar_pagebottom = get_dynamic_sidebar( 'Page Bottom' );

/* If not, then display sample widgets unless turned off in theme options */
global $xsbf_theme_options;
if ( $xsbf_theme_options['sample_widgets'] != false AND ! $sidebar_pagebottom ) {

	$sidebar_pagebottom = '<aside id="sample-text" class="widget widget_text section bg-lightgray centered clearfix">'
		.'<div class="container">'
		.'<h2 class="widget-title">' . _x( 'SOME OF OUR AWESOME CLIENTS', null, 'flat-bootstrap' ) . '</h2>'
		.'<div class="textwidget">'
		.'<div class="row" style="color:#768282;">'
		.'<div class="col-xs-6 col-md-3">
		<i class="fa fa-apple fa-5x padding-top-bottom"></i>
		</div>
		<div class="col-xs-6 col-md-3">
		<i class="fa fa-pagelines fa-5x padding-top-bottom"></i>
		</div>
		<div class="col-xs-6 col-md-3">
		<i class="fa fa-instagram fa-5x padding-top-bottom"></i>
		</div>
		<div class="col-xs-6 col-md-3">
		<i class="fa fa-bitcoin fa-5x padding-top-bottom"></i>
		</div>'
		.'</div><!-- row -->'
		.'</div><!-- textwidget -->'
		.'</div><!-- container -->'
		.'</aside>';

	$sidebar_pagebottom .= '<aside id="sample-text-2" class="widget widget_text section bg-almostblack centered clearfix">'
		.'<div class="container">'
		.'<h2 class="widget-title">' . _x( 'THIS IS A CALL TO ACTION AREA', null, 'flat-bootstrap' ) . '</h2>'
		.'<div class="textwidget">'
		.'<div class="row">'
		.'<div class="col-lg-8 col-lg-offset-2">'
		.'<p>' . _x( "This is just an example text widget. You can add text widgets here to put whatever you'd like.", null, 'flat-bootstrap' ) . '</p>'
		.'<p><button type="button" class="btn btn-primary btn-lg">' . _x( 'Call To Action Button', null, 'flat-bootstrap' ) . '</button></p>'
		.'</div><!-- col-lg-8 -->'
		.'</div><!-- row -->'
		.'</div><!-- textwidget -->'
		.'</div><!-- container -->'
		.'</aside>';

	$sidebar_pagebottom .= '<aside id="sample-text-3" class="widget widget_text section clearfix">'
		.'<div class="container">'
		.'<h2 class="widget-title">' . _x( 'Stay Connected', null, 'flat-bootstrap' ) . '</h2>'
		.'<div class="textwidget">'
		.'<p>' . _x( "Join us on our social networks for all the latest updates, product/service announcements and more.", null, 'flat-bootstrap' ) . '</p>'
		.'</div><!-- textwidget -->'
		.'</div><!-- container -->'
		.'</aside>';

	$sidebar_pagebottom .= '<aside id="sample-text-4" class="widget widget_text section nopadding fullwidth clearfix">'
		.'<div id="sf" class="textwidget social-footer">'
		.'<div class="row">'
		.'<div class="col-md-4 bg-darkgreen padding-top-bottom">
			<h4 class="ml">FACEBOOK</h4>
			<p class="centered aligncenter"><a href="#"><i class="fa fa-facebook icon-lg"></i></a></p>
			<p class="ml">> Follow Us</p>
		</div>'
		.'<div class="col-md-4 bg-lightgreen padding-top-bottom">
			<h4 class="ml">TWITTER</h4>
			<p class="centered aligncenter"><a href="#"><i class="fa fa-twitter icon-lg"></i></a></p>
			<p class="ml">> Follow Us</p>
		</div>'
		.'<div class="col-md-4 bg-darkgreen padding-top-bottom">
			<h4 class="ml">GOOGLE+</h4>
			<p class="centered aligncenter"><a href="#"><i class="fa fa-google-plus icon-lg"></i></a></p>
			<p class="ml">> Add Us to Your Circle</p>
		</div>'
		.'</div><!-- row -->'
		.'</div><!-- textwidget -->'
		.'</div><!-- container -->'
		.'</aside>';

	$sidebar_pagebottom .= '<div class="contact-footer">
				<div class="container">
				<div class="col-md-8">
		        	<div id="mapwrap">
						<iframe height="400" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.es/maps?t=m&amp;ie=UTF8&amp;ll=52.752693,22.791016&amp;spn=67.34552,156.972656&amp;z=6&amp;output=embed"></iframe>
					</div>	
				</div><!--col-md-8-->
				<div class="col-md-4">
					<h4>ADDRESS<br/>Minsk - Head Office</h4>
					<br>
					<p>
						Business Center 
						SomeAve 987,<br/>
						Minsk, Belarus.
					</p>
					<p>
						P: +55 4839-4390<br/>
						F: +55 4333-4345<br/>
						E: <a href="mailto:#">hello@linkagency.com</a>
					</p>
					<p>This is just a sample widget that you can place in the Page Bottom or Footer widget areas of this theme. Once you set your first widget, the samples will no longer appear.</p>
				</div><!--col-md-4-->
				</div><!-- container -->
			</div><!-- contact-footer -->';

}

/* Apply filters and display the footer widgets */
if ( $sidebar_pagebottom ) :
?>
	<div id="sidebar-pagebottom" class="sidebar-pagebottom">
		<?php echo apply_filters( 'xsbf_pagebottom', $sidebar_pagebottom ); ?>
	</div><!-- .sidebar-pagebottom -->
<?php endif;?>
