<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div class="container">
	<div class="row">
		
		<div class="col-md-12">

			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<?php
					// Start the loop.
					while ( have_posts() ) : the_post();

						// Include the single post content template.
						get_template_part( 'template-parts/content', 'single' );

						// End of the loop.
					endwhile;
					?>

				</main><!-- .site-main -->

				<?php get_sidebar( 'content-bottom' ); ?>

			</div><!-- .content-area -->

		</div>
		<!-- /.col-md-8 -->

	</div>
	<!-- /.row -->
</div>
<!-- /.container -->

<?php get_footer(); ?>
