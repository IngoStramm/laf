<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-lg-3">
				<figure class="thumb"><?php the_post_thumbnail('full'); ?></figure>
			</div>
			<!-- /.col-md-6 -->
			<div class="col-sm-6 col-md-8 col-lg-9">
				<?php the_excerpt(); ?>
			</div>
			<!-- /.col-md-6 -->
		</div>
		<!-- /.row -->
	</div><!-- .entry-content -->

</article><!-- #post-## -->
