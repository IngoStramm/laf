<?php
/**
 * The template part for displaying single posts
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
		<div class="row">
			<div class="col-md-6">
				<figure class="thumb"><?php the_post_thumbnail('full'); ?></figure>
			</div>
			<!-- /.col-md-6 -->
			<div class="col-md-6">
				<?php the_content(); ?>
			</div>
			<!-- /.col-md-6 -->
		</div>
		<!-- /.row -->
	</div><!-- .entry-content -->

</article><!-- #post-## -->
