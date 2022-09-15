<?php
function emp_teachers_init() {
  $labels = array(
    'name'               => _x( 'Profesores', 'Nombre general del tipo de post', 'empralidad' ),
    'singular_name'      => _x( 'Profesor', 'Nombre singular', 'empralidad' ),
    'menu_name'          => _x( 'Profesores', 'admin menu', 'empralidad' ),
    'name_admin_bar'     => _x( 'Profesores', 'añadir nueva en admin bar', 'empralidad' ),
    'add_new'            => _x( 'Añadir nuevo', 'Landing Page', 'empralidad' ),
    'add_new_item'       => __( 'Añadir nuevo Profesor', 'empralidad' ),
    'new_item'           => __( 'Nuevo Profesor', 'empralidad' ),
    'edit_item'          => __( 'Editar Profesor', 'empralidad' ),
    'view_item'          => __( 'Ver Profesor', 'empralidad' ),
    'all_items'          => __( 'Profesores', 'empralidad' ),
    'search_items'       => __( 'Buscar Profesor', 'empralidad' ),
    'parent_item_colon'  => __( 'Profesor:', 'empralidad' ),
    'not_found'          => __( 'No encontrado.', 'empralidad' ),
    'not_found_in_trash' => __( 'No se en contraron en la papelera.', 'empralidad' )
  );

  $args = array(
    'labels'             => $labels,
    'description'        => __( 'Descripción.', 'empralidad' ),
    'menu_icon' 				 => 'dashicons-businessman',
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'teachers' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'show_in_rest'       => true,
    'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'duplicate', 'comments')
  );
  register_post_type( 'teachers', $args );
}
add_action( 'init', 'emp_teachers_init' );
?>
