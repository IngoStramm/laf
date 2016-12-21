<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<?php $gallery = get_post_gallery();
        $content = strip_shortcode_gallery( get_the_content() );                                        
        $content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $content ) ); 
        if($gallery) : ?>
			<div class="row">
				<div class="col-md-6">
					<?php echo $gallery; ?>
				</div>
				<!-- /.col-md-6 -->
				<div class="col-md-6">
					<?php echo $content; ?>
				</div>
				<!-- /.col-md-6 -->
			</div>
			<!-- /.row -->
		<?php else : ?>
			<?php echo $content; ?>
		<?php endif; ?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
