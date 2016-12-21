<?php
/**
 * Template Name: Página de contato
 *
 */

get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
		<?php while ( have_posts() ) : the_post(); ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php endwhile; ?>
		</div>
		<!-- /.col-md-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /.container -->

<div class="g-map">
	<?php echo do_shortcode('[wpgmza id="1"]'); ?>
</div>
<!-- /.g-map -->

<div class="container">
	<div class="row">
		
		<div class="col-md-12">

			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<div class="row">
						<div class="col-md-6">
							<h1 class="title title-text-left"><?php echo __('Formulário de contato', ''); ?></h1>
							<?php echo do_shortcode('[contact-form-7 id="72" title="Formulário de contato 1"]'); ?>						
						</div>
						<!-- /.col-md-6 -->
						<div class="col-md-6">
							<h1 class="title title-text-left"><?php echo __('Contato', ''); ?></h1>
							<?php 
								$telefones = laf_get_option( 'telefones' ); 
								$email = laf_get_option( 'email' ); 
							?>
							<ul>
								<li class="telefone telefone-big"><?php echo $telefones[0]; ?></li>
								<li><?php echo '<a href="mailto:' .  $email . '">' .  $email . '</a>' ?></li>
							</ul>
							<h1 class="title title-text-left"><?php echo __('Endereço', ''); ?></h1>
							<?php 
								$rua = laf_get_option( 'rua' );
								$numero = laf_get_option( 'numero' );
								$cidade = laf_get_option( 'cidade' );
								$uf = laf_get_option( 'uf' );
								$cep = laf_get_option( 'cep' );
								$endereco = $rua . ', ' . $numero . ', ' . $cidade . ' - ' . $uf . ', ' . $cep;
							?>
							<p><?php echo $endereco; ?></p>

						</div>
						<!-- /.col-md-6 -->
					</div>
					<!-- /.row -->

				</main><!-- .site-main -->

			</div><!-- .content-area -->

		</div>
		<!-- /.col-md-12 -->

	</div>
	<!-- /.row -->
</div>
<!-- /.container -->

<?php get_footer(); ?>
