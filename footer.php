<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

	</div><!-- .content -->

	<footer id="colophon" class="footer bg-footer" role="contentinfo">

		<div class="container">
			<div class="row">
					<div class="footer-item col-md-4">
						<?php $logo = laf_get_option( 'logo' ); 
						// debug($logo);
						if($logo) : ?>
							<div class="logo footer-logo">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logo ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
							</div><!-- .logo -->
						<?php endif; ?>
					</div>
					<!-- /.col-md-4 -->
					<div class="footer-item col-md-4">
						<h3 class="footer-item-title"><?php echo __('Endereço', 'laf') ?></h3>
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
					<!-- /.col-md-4 -->
					<div class="footer-item col-md-4">
						<h3 class="footer-item-title"><?php echo __('Contato', 'laf') ?></h3>
						<?php 
							$telefones = laf_get_option( 'telefones' ); 
							$email = laf_get_option( 'email' ); 
						?>
						<ul>
							<li><?php echo $telefones[0]; ?></li>
							<li><?php echo __('E-mail:', 'laf') . ' <a href="mailto:' .  $email . '">' .  $email . '</a>' ?></li>
						</ul>
					</div>
					<!-- /.col-md-4 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container -->

	</footer><!-- .footer -->

<?php wp_footer(); ?>
</body>
</html>
