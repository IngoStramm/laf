<?php  
/**
 * Register our sidebars and widgetized areas.
 *
 */
function laf_widgets_init() {

	/*register_sidebar( array(
		'name'          => __('Rodapé', 'laf'),
		'id'            => 'footer_widgets',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s col-xs-12 '. slbd_count_widgets( 'footer_widgets' ) .'">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );*/

}
add_action( 'widgets_init', 'laf_widgets_init' );
?>