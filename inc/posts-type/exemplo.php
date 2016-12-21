<?php
add_action( 'init', 'exemplos_init' );
/**
 * Register a Exemplo post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function exemplos_init() {
	$labels = array(
		'name'               => _x( 'Exemplos', 'post type general name', 'laf' ),
		'singular_name'      => _x( 'Exemplo', 'post type singular name', 'laf' ),
		'menu_name'          => _x( 'Exemplos', 'admin menu', 'laf' ),
		'name_admin_bar'     => _x( 'Exemplo', 'Adicionar Novo on admin bar', 'laf' ),
		'add_new'            => _x( 'Adicionar Novo', 'Exemplo', 'laf' ),
		'add_new_item'       => __( 'Adicionar Novo Exemplo', 'laf' ),
		'new_item'           => __( 'Novo Exemplo', 'laf' ),
		'edit_item'          => __( 'Editar Exemplo', 'laf' ),
		'view_item'          => __( 'Visualizar Exemplo', 'laf' ),
		'all_items'          => __( 'Todos Exemplos', 'laf' ),
		'search_items'       => __( 'Pesquisar Exemplos', 'laf' ),
		'parent_item_colon'  => __( 'Exemplos Pai:', 'laf' ),
		'not_found'          => __( 'Nenhum Exemplo encontrado.', 'laf' ),
		'not_found_in_trash' => __( 'Nenhum Exemplo encontrado na lixeira.', 'laf' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Descrição.', 'laf' ),
		'public'             => true,
		'menu_position'      => 6,
		'supports'           => array( 'title' )
	);

	register_post_type( 'exemplo', $args );

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

	register_taxonomy( 'categoria', array( 'exemplo' ), $tax_args );
}