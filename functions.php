<?php 
/**
 * Função Debug (ferramenta de desenvolvimento)
 * 
 **/
function debug($a) {
	echo '<pre>';
	var_dump($a);
	echo '</pre>';
}

function google_api() {
	return 'AIzaSyAvvX8k90IYFDwQKMtsz8xCbmsT11r_cNc';
}

add_action('wp_head', 'setup_js_api_key');

function setup_js_api_key() {
	$rua = laf_get_option( 'rua' );
	$numero = laf_get_option( 'numero' );
	$complemento = laf_get_option( 'complemento' );
	$bairro = laf_get_option( 'bairro' );
	$cidade = laf_get_option( 'cidade' );
	$uf = laf_get_option( 'uf' );
	$cep = laf_get_option( 'cep' );
	$endereco = $rua . ', ' . $numero . ' - ' . $complemento . ' - CEP:' . $cep . ' - ' . $bairro . ' - ' . $cidade . ' - ' . $uf;
	$site_name = get_bloginfo('name');
	?>
	<script>
		var g_key = "<?php echo google_api(); ?>";
		var lat = Number("<?php echo laf_get_option('lat'); ?>");
		var long = Number("<?php echo laf_get_option('long'); ?>");
		var endereco = "<?php echo $endereco; ?>";
		var site_name = "<?php echo $site_name; ?>";
	</script>
	<?php
}


/**
 * Remove o estilos e scripts do Twenty Sixteen.
 *
 **/
function laf_dequeue_script() {
	wp_dequeue_style( 'twentysixteen-fonts');
	wp_dequeue_style( 'genericons' );
	wp_dequeue_style( 'twentysixteen-style' );
	wp_dequeue_style( 'twentysixteen-ie' );
	wp_dequeue_style( 'twentysixteen-ie8' );
	wp_dequeue_style( 'twentysixteen-ie7' );
	wp_dequeue_script( 'twentysixteen-html5' );
	wp_dequeue_script( 'twentysixteen-skip-link-focus-fix' );
	wp_dequeue_script( 'twentysixteen-script' );
}
add_action( 'wp_enqueue_scripts', 'laf_dequeue_script', 9999 );
add_action( 'wp_print_scripts', 'laf_dequeue_script', 9999 );

/**
 * Adiciona os estilos do tema LAF
 * 
 **/
function theme_enqueue_styles() {
	// fonts <link href='https://fonts.googleapis.com/css?family=Advent+Pro:400,500,600,700,300,200,100|PT+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
	wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Advent+Pro:400,500,600,700,300,200,100|PT+Sans:400,400italic,700,700italic', false );
	// styles
    wp_enqueue_style( 'bootstrap-style', get_stylesheet_directory_uri() . '/inc/bootstrap/css/bootstrap.min.css', array(), '3.3.7' );
    wp_enqueue_style( 'font-awesome-style', get_stylesheet_directory_uri() . '/inc/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
    wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/style.css' );
    wp_enqueue_style( 'laf-style', get_stylesheet_directory_uri() . '/css/main.css' );
    // scripts
	wp_enqueue_script( 'bootstrap-script', get_stylesheet_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js', array('jquery'), '3.3.7', true );
	wp_enqueue_script( 'jquery-masked-input-script', get_stylesheet_directory_uri() . '/inc/jquery-masked-input/jquery.maskedinput.min.js', array('jquery'), '1.4.1', true );
	wp_enqueue_script( 'jquery-masked-input-masks', get_stylesheet_directory_uri() . '/inc/jquery-masked-input/masks.js', array('jquery'), null, true );
} 
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/**
 * Conta o número de widgets em um sidebar
 * Usado para adicionar classes CSS de coluna às widgets baseado no Bootstrap, organizando os widgets em colunas
 * @link https://gist.github.com/slobodan/6156076
 **/
function slbd_count_widgets( $sidebar_id ) {
	// If loading from front page, consult $_wp_sidebars_widgets rather than options
	// to see if wp_convert_widget_settings() has made manipulations in memory.
	global $_wp_sidebars_widgets;
	if ( empty( $_wp_sidebars_widgets ) ) :
		$_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
	endif;
	
	$sidebars_widgets_count = $_wp_sidebars_widgets;
	
	if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
		$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
		$widget_classes = 'widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] );
		if ( $widget_count % 4 == 0 ) :
			// Four widgets er row if there are exactly four or more than six
			$widget_classes .= ' col-md-3 col-sm-6';
		elseif ( $widget_count % 3 == 0 ) :
			// Three widgets per row if there's three or more widgets 
			$widget_classes .= ' col-md-4';
		elseif ( $widget_count % 2 == 0  ) :
			// Otherwise show two widgets per row
			$widget_classes .= ' col-sm-6';
		else :
			// Otherwise show one widget per row
			$widget_classes .= ' col-md-12';
		endif; 
		return $widget_classes;
	endif;
}

/**
 * Widgets
 * 
 **/

// Remove os sidebars do twentysixteen
function remove_some_widgets(){
	unregister_sidebar( 'sidebar-2' );
	unregister_sidebar( 'sidebar-3' );
}
add_action( 'widgets_init', 'remove_some_widgets', 11 );


/**
 * Formata os horários salvos no CMB2 para o padrão brasileiro (24h)
 *
 * @return string
 * @param id cmb2 laf_get_option
 **/
function formata_horario($time) {
	return date("H:i", strtotime(laf_get_option($time)));
}

/**
 * Modifica o html das galerias
 * 
 **/
function my_post_gallery($output, $attr) {
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';

    // Here's your actual output, you may customize it to your need
    $output = '<div id="carousel-' . $post->ID . '" class="carousel slide" data-ride="carousel">';
	    // Now you loop through each attachment
    	$slide = 0;
    	$output .= '<!-- Indicators -->';
        $output .= '<ol class="carousel-indicators">';
	    foreach ($attachments as $attach) :
	    	$active = $slide == 0 ? ' class="active"' : '';
	        $output .= '<li data-target="#carousel-' . $post->ID . '" data-slide-to="' . $slide . '"' . $active . '></li>';
	        $slide++;
	    endforeach;
        $output .= '</ol>';
    	$output .= '<!-- /.carousel-indicators -->';

        $output .= '<!-- Wrapper for slides -->';
        $output .= '<div class="carousel-inner" role="listbox">';
        $slide = 0;
	    foreach ($attachments as $id => $attachment) :
	     	$img = wp_get_attachment_image_src($id, 'full');
	    	$caption = $attachment->post_excerpt;
	    	$active = $slide == 0 ? ' active' : '';
	        $output .= '<div class="item' . $active . '">';
		        $output .= '<img src="' . $img[0] . '" class="img-responsive center-block" alt="' . $caption . '"/>';
	        $output .= '</div>';
	        $slide++;
	    endforeach;
        $output .= '</div>';
    	$output .= '<!-- /.carousel-inner -->';
    $output .= '</div>';
    $output .= '<!-- /.carousel -->';

    return $output;
}

add_filter('post_gallery', 'my_post_gallery', 10, 2);

/**
 * Remove o shortcode da galeria do conteúdo
 * 
 **/
function strip_shortcode_gallery( $content ) {
    preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );

    if ( ! empty( $matches ) ) {
        foreach ( $matches as $shortcode ) {
            if ( 'gallery' === $shortcode[2] ) {
                $pos = strpos( $content, $shortcode[0] );
                if( false !== $pos ) {
                    return substr_replace( $content, '', $pos, strlen( $shortcode[0] ) );
                }
            }
        }
    }

    return $content;
}

/**
 * Adiciona as classes e estrutura do Bootstrap ao wp-pagenavi
 * 
 **/

//attach our function to the wp_pagenavi filter
if(function_exists('wp_pagenavi'))
	add_filter( 'wp_pagenavi', 'ik_pagination', 10, 2 );
  
//customize the PageNavi HTML before it is output
function ik_pagination($html) {
    $out = '';
  
    //wrap a's and span's in li's
    $out = str_replace("<div","",$html);
    $out = str_replace("class='wp-pagenavi'>","",$out);
    $out = str_replace("<a","<li><a",$out);
    $out = str_replace("</a>","</a></li>",$out);
    $out = str_replace("<span","<li><span",$out);  
    $out = str_replace("</span>","</span></li>",$out);
    $out = str_replace("</div>","",$out);
  
    return '<ul class="pagination pagination-centered">'.$out.'</ul>';
}


/**
 * Replaces the excerpt "more" text by a link
 *
 **/
function new_excerpt_more($more) {
	global $post;
	return '...<br /><a class="btn btn-primary pull-right" href="'. get_permalink($post->ID) . '">' . __('Veja mais') . '</a>';
}

add_filter('excerpt_more', 'new_excerpt_more', 11);

require_once('inc/init.php');