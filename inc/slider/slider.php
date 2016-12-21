<?php
add_action('init', 'shp_init');

function shp_init() {
	$labels = array(
		'name'               => _x( 'Slides', 'post type general name', 'laf' ),
		'singular_name'      => _x( 'Slide', 'post type singular name', 'laf' ),
		'menu_name'          => _x( 'Slides', 'admin menu', 'laf' ),
		'add_new'            => _x( 'Adicionar Novo', 'slide', 'laf' ),
		'add_new_item'       => __( 'Adicionar Novo Slide', 'laf' ),
		'new_item'           => __( 'Novo Slide', 'laf' ),
		'edit_item'          => __( 'Editar Slide', 'laf' ),
		'view_item'          => __( 'Visualizar Slide', 'laf' ),
		'all_items'          => __( 'Todos Slides', 'laf' ),
		'search_items'       => __( 'Pesquisar Slides', 'laf' ),
		'not_found'          => __( 'Nenhum Slide encontrado.', 'laf' ),
		'not_found_in_trash' => __( 'Nenhum Slide encontrado na lixeira.', 'laf' )
	);

    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_position'      => 5,
        'supports' => array(
            'title',
            // 'thumbnail',
            // 'custom-fields'
        )
    );
    register_post_type('slider_homepage', $args);
}

add_action( 'cmb2_admin_init', 'slider_register_metabox' );

function slider_register_metabox() {

	$prefix = '_slider_';

	$cmb = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Opções', 'laf' ),
		'object_types'  => array( 'slider_homepage' ), // Post type
		'context'    => 'normal',
	) );

	$cmb->add_field( array(
		'name'       => __( 'Imagem', 'laf' ),
		'desc'       => __( 'Imagem do slide', 'laf' ),
		'id'         => $prefix . 'image',
		'type'       => 'file',
		'attributes' => array('placeholder' => 'http://'),
		'protocols' => array('http', 'https'), // Array of allowed protocols		
	) );

	$cmb->add_field( array(
		'name'       => __( 'Url', 'laf' ),
		'desc'       => __( 'Link do slide', 'laf' ),
		'id'         => $prefix . 'url',
		'type'       => 'text_url',
		'attributes' => array('placeholder' => 'http://'),
		'protocols' => array('http', 'https'), // Array of allowed protocols		
	) );

	$cmb->add_field( array(
		'name'       => __( 'Ordem', 'laf' ),
		'desc'       => __( 'Ordem do slide (apenas números)', 'laf' ),
		'id'         => $prefix . 'order',
		'type'       => 'text_small',
		'attributes' => array('placeholder' => '1'),
	) );
}

add_shortcode('shp-shortcode', 'shp_function');

add_image_size('shp_function', 600, 280, true);

function shp_function($type='shp_function') {
    $args = array(
        'post_type' 		=> 'slider_homepage',
        'posts_per_page' 	=> -1,
        'meta_key'			=> '_slider_order',
        'orderby'			=> 'meta_value_num',
        'order'				=> 'ASC'
    );
    $result =   '<div class="container">
	    			<div id="slider-home" class="carousel slider slide hidden-xs" data-ride="carousel">
				        <div class="spinner-wrap">
				            <div class="spinner"></div>
				        </div>';
	    //the loop
	    $loop = new WP_Query($args);
		    $result .= '<ol class="carousel-indicators">';
		    for ($i=0; $i < $loop->post_count; $i++) { 
		    	$active = $i == 0 ? ' class="active"' : '';
		    	$result .= '<li data-target="#slider-home" data-slide-to="' . $i . '"' . $active . '></li>';
		    }
			$result .= '</ol>';
			$result .= '<div class="carousel-inner">';
		    while ($loop->have_posts()) {
		        $loop->the_post();
		        $active = $loop->current_post == 0 ? 'active ' : '';
		        $the_src = get_post_meta ( get_the_id(), '_slider_image', true );
		        $the_url = get_post_meta ( get_the_id(), '_slider_url', true );
			        $result .= '<div class="' . $active . 'item" id="slide-' . get_the_id() . '">
						            <a href="' . $the_url . '"><img src="' . $the_src . '" class="img-responsive" /></a>
						        </div>';
		    }
		    wp_reset_postdata();
		    $result  .='</div>
				        <!-- Carousel Inner -->';
			/*$result  .='<!-- Left and right controls -->
				        <a class="left carousel-control" href="#slider-home" role="button" data-slide="prev">
				        	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				            <span class="sr-only">Previous</span>
				        </a>
				        <a class="right carousel-control" href="#slider-home" role="button" data-slide="next">
				            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				            <span class="sr-only">Next</span>
				        </a>';*/
			$result  .='</div>
				    <!-- /#slider-home -->
			    </div>';
    return $result;
} ?>