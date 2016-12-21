<?php
/**
 * Template Name: Página de produtos
 *
 */

get_header(); ?>

<div class="produtos-lista">
	
	<div class="container">
		<div class="row">
			
			<div class="col-md-12">

				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">

						<?php
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$args = array(
						  'post_type'		=> 'produto',
						  'post_status'		=> 'publish',
						  'posts_per_page'	=> 6,
						  'meta_key'		=> '_produto_order',
						  'orderby'			=> 'meta_value_num',
						  'order'			=> 'ASC',
						  'paged'			=> $paged
						 );

						$loop = new WP_Query($args);
						if( $loop->have_posts() ) : ?>
							<div class="row">
								<?php while ($loop->have_posts()) : $loop->the_post(); ?>
									<div class="col-md-4 col-sm-6 produto-item">
										<a href="<?php the_permalink(); ?>"><figure class="thumb"><?php the_post_thumbnail(); ?></figure></a>
										<h2 class="title produto-title"><?php the_title(); ?></h2>
										<a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo __('Veja mais', 'laf'); ?></a>
									</div>
									<!-- /.col-md-4 -->
								<?php endwhile; ?>
							</div>
							<!-- /.row -->
						<?php endif; ?>
						<div class="row">
							<div class="col-md-12 text-center">
								<?php if(function_exists('wp_pagenavi'))
									wp_pagenavi(array( 'query' => $loop )); ?>
								<?php /*the_posts_pagination();*/ ?>
							</div>
						</div>
						<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>

					</main><!-- .site-main -->

				</div><!-- .content-area -->

			</div>
			<!-- /.col-md-12 -->

		</div>
		<!-- /.row -->
	</div>
	<!-- /.container -->

</div>
<!-- /.produtos -->

<?php get_footer(); ?>
