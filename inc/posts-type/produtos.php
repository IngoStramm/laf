<?php
add_action( 'init', 'produtos_init' );
/**
 * Register a Produto post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function produtos_init() {
	$post_labels = array(
		'name'               => _x( 'Produtos', 'post type general name', 'laf' ),
		'singular_name'      => _x( 'Produto', 'post type singular name', 'laf' ),
		'menu_name'          => _x( 'Produtos', 'admin menu', 'laf' ),
		'name_admin_bar'     => _x( 'Produto', 'Adicionar Novo on admin bar', 'laf' ),
		'add_new'            => _x( 'Adicionar Novo', 'Produto', 'laf' ),
		'add_new_item'       => __( 'Adicionar Novo Produto', 'laf' ),
		'new_item'           => __( 'Novo Produto', 'laf' ),
		'edit_item'          => __( 'Editar Produto', 'laf' ),
		'view_item'          => __( 'Visualizar Produto', 'laf' ),
		'all_items'          => __( 'Todos Produtos', 'laf' ),
		'search_items'       => __( 'Pesquisar Produtos', 'laf' ),
		'parent_item_colon'  => __( 'Produtos Pai:', 'laf' ),
		'not_found'          => __( 'Nenhum Produto encontrado.', 'laf' ),
		'not_found_in_trash' => __( 'Nenhum Produto encontrado na lixeira.', 'laf' )
	);

	$post_args = array(
		'labels'             => $post_labels,
        'description'        => __( 'Descrição.', 'laf' ),
		'public'             => true,
		'menu_position'      => 7,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'produto', $post_args );

	// Add new taxonomy, make it hierarchical (like categories)
	$tax_labels = array(
		'name'              => _x( 'Categorias', 'taxonomy general name' ),
		'singular_name'     => _x( 'Categoria', 'taxonomy singular name' ),
		'search_items'      => __( 'Pesquisar Categorias' ),
		'all_items'         => __( 'Todas Categorias' ),
		'parent_item'       => __( 'Categoria Pai' ),
		'parent_item_colon' => __( 'Categoria Pai:' ),
		'edit_item'         => __( 'Editar Categoria' ),
		'update_item'       => __( 'Atualizar Categoria' ),
		'add_new_item'      => __( 'Adicionar nova Categoria' ),
		'new_item_name'     => __( 'Nome da nova Categoria' ),
		'menu_name'         => __( 'Categoria' ),
	);

	$tax_args = array(
		'hierarchical'      => true,
		'public'            => true,
		'label'				=> __('Categorias'),
		'labels'            => $tax_labels,
		'rewrite'           => array( 'slug' => 'categoria' ),
	);

	// register_taxonomy( 'categoria', array( 'produto' ), $tax_args );
}