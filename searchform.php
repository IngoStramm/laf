<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<form role="search" method="get" class="search-form form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<label>
			<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'twentysixteen' ); ?></span>
		</label>
		<input type="search" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'twentysixteen' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'twentysixteen' ); ?>" />
	</div>
	
	<button type="submit" class="search-submit btn btn-primary"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'twentysixteen' ); ?></span></button>
</form>
