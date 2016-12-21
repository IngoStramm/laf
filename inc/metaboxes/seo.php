<?php  
add_action( 'cmb2_admin_init', 'laf_register_metabox' );
function laf_register_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_laf_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb = new_cmb2_box( array(
		'id'            => $prefix . 'seo_metabox',
		'title'         => __( 'Opções de SEO', 'laf' ),
		'object_types'  => array( 'page', 'post' ), // Post type
		'context'      => 'advanced', //  'normal', 'advanced', or 'side'
		'priority'     => 'high',  //  'high', 'core', 'default' or 'low'
	) );

	$cmb->add_field( array(
		'name' => __( '"Title" personalizado', 'laf' ),
		'desc' => __( 'Para gerar um <code>&lt;title&gt;&lt;/title&gt;</code> personalizado, insira o texto no campo acima.', 'laf' ),
		'id'   => $prefix . 'title',
		'type' => 'text',
	) );
	$cmb->add_field( array(
		'name' => __( 'Meta Keyword', 'laf' ),
		'desc' => __( 'Palavra(s) que será(ão) usada(s) na Meta Tag keyword', 'laf' ),
		'id'   => $prefix . 'keywords',
		'type' => 'text',
		'repeatable' => true,
	) );
}

function retorna_meta_keys() {
	$keywords = get_post_meta( get_the_ID(), '_laf_keywords', true );
	$output = [];
	if($keywords) :
		foreach ($keywords as $word) {
			$output[] = $word;
		}
	endif;
	return $output;
}

function exibe_meta_keywords() {
	$keywords = retorna_meta_keys();
	if($keywords) :
		$i = 0;
		$total = count($keywords);
		$output = '<meta name="keywords" content="';
		foreach ($keywords as $word) {
			$output .= $word;
			$output .= ($i < $total-1) ? ', ' : '';
			$i++;
		}
		$output .= '" />';
		echo $output;
	endif;
}

function retorna_alt_primeira_keyword() {
	$custom_title = get_post_meta( get_the_ID(), '_laf_title', true );
	$custom_title = ($custom_title) ? $custom_title : wp_title('', false);
	$alt = explode('|', $custom_title);
	$alt = $alt[1];
	$alt = explode(',', $alt);
	$alt = trim($alt[0]);
	return $alt;
}

add_filter( 'wp_title', 'exibe_title', 99 );

function exibe_title($title) {
	$custom_title = get_post_meta( get_the_ID(), '_laf_title', true );
	if($custom_title)
		return $custom_title;
	else
		return $title;
}
?>