<?php
function emp_courses_init() {
  $labels = array(
		'name'               => _x( 'Cursos', 'Nombre general del tipo de post', 'empralidad' ),
		'singular_name'      => _x( 'Curso', 'Nombre singular', 'empralidad' ),
		'menu_name'          => _x( 'Cursos', 'admin menu', 'empralidad' ),
		'name_admin_bar'     => _x( 'Cursos', 'añadir nueva en admin bar', 'empralidad' ),
		'add_new'            => _x( 'Añadir nuevo', 'Landing Page', 'empralidad' ),
		'add_new_item'       => __( 'Añadir nuevo curso', 'empralidad' ),
		'new_item'           => __( 'Nuevo curso', 'empralidad' ),
		'edit_item'          => __( 'Editar editar curso', 'empralidad' ),
		'view_item'          => __( 'Ver curso', 'empralidad' ),
		'all_items'          => __( 'Cursos', 'empralidad' ),
		'search_items'       => __( 'Buscar curso', 'empralidad' ),
		'parent_item_colon'  => __( 'Curso:', 'empralidad' ),
		'not_found'          => __( 'No encontrado.', 'empralidad' ),
		'not_found_in_trash' => __( 'No se en contraron en la papelera.', 'empralidad' )
	);

	$args = array(
		'labels'             => $labels,
    'description'        => __( 'Descripción.', 'empralidad' ),
		'menu_icon' 				 => 'dashicons-book-alt',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'emp_courses' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'show_in_rest'       => true,
		'taxonomies'         => array( 'category' ),
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'categories', 'duplicate')
	);

	register_post_type( 'emp_courses', $args );

}
// if ( current_user_can( 'edit_pages' ) ) {
	add_action( 'init', 'emp_courses_init' );
// }
?>
