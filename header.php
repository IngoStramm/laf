<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php exibe_meta_keywords(); ?>
	<meta name='robots' content='index,follow' />
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class('agua-bg'); ?>>

	<header id="masthead" class="header" role="banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					
					<div class="header-main">
						<div class="col-md-3">							
							<?php $logo = laf_get_option( 'logo' ); 
							// debug($logo);
							if($logo) : ?>
								<div class="logo header-logo">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logo ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
								</div><!-- .logo -->
							<?php endif; 
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="description"><?php echo $description; ?></p>
							<?php endif; ?>
						</div>
						<!-- /.col-md-3 -->

						<div class="col-md-9">							
							<?php if ( has_nav_menu( 'primary' ) ) : ?>

								<div class="navbar" role="navigation">
									<?php if ( has_nav_menu( 'primary' ) ) : ?>
											<div class="navbar-header">
	                                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
	                                                <span class="sr-only">Toggle navigation</span>
	                                                <span class="icon-bar"></span>
	                                                <span class="icon-bar"></span>
	                                                <span class="icon-bar"></span>
	                                            </button>
	                                        </div>
											<nav id="navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentysixteen' ); ?>">
												<?php
													$defaults = array(
														'theme_location'  => 'primary',
														'container'       => 'div', 
														'container_class' => 'collapse navbar-collapse', 
														'container_id'    => 'navbar-collapse-1',
														'menu_class'      => 'nav navbar-nav navbar-left', 
														'menu_id'         => 'primary-menu',
														// 'before'          => ,
														// 'after'           => ,
														// 'link_before'     => ,
														// 'link_after'      => ,
														// 'items_wrap'      => '<ul id=\"%1$s\" class=\"%2$s\">%3$s</ul>',
														// 'walker'          => 
													);
													wp_nav_menu( $defaults );
												?>
											</nav><!-- .main-navigation -->
									<?php endif; ?>

								</div><!-- .header-menu -->
							<?php endif; ?>
						</div>
						<!-- /.col-md-9 -->

					</div><!-- .header-main -->

				</div>
				<!-- /.col-md-12 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container -->
	</header><!-- .header -->

	<div id="content" class="content">
