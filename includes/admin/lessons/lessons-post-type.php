<?php
function emp_lessons_init() {
  $labels = array(
    'name'               => _x( 'Lecciones', 'Nombre general del tipo de post', 'empralidad' ),
    'singular_name'      => _x( 'Lección', 'Nombre singular', 'empralidad' ),
    'menu_name'          => _x( 'Lecciones', 'admin menu', 'empralidad' ),
    'name_admin_bar'     => _x( 'Lecciones', 'añadir nueva en admin bar', 'empralidad' ),
    'add_new'            => _x( 'Añadir nueva', 'Landing Page', 'empralidad' ),
    'add_new_item'       => __( 'Añadir nueva lección', 'empralidad' ),
    'new_item'           => __( 'Nueva lección', 'empralidad' ),
    'edit_item'          => __( 'Editar lección', 'empralidad' ),
    'view_item'          => __( 'Ver lección', 'empralidad' ),
    'all_items'          => __( 'Lecciones', 'empralidad' ),
    'search_items'       => __( 'Buscar lección', 'empralidad' ),
    'parent_item_colon'  => __( 'Lección:', 'empralidad' ),
    'not_found'          => __( 'No encontrado.', 'empralidad' ),
    'not_found_in_trash' => __( 'No se en contraron en la papelera.', 'empralidad' )
  );

  $args = array(
    'labels'             => $labels,
    'description'        => __( 'Descripción.', 'empralidad' ),
    'menu_icon' 				 => 'dashicons-text-page',
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'lessons' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'show_in_rest'       => true,
    'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'duplicate', 'comments')
  );
  register_post_type( 'lessons', $args );
}
add_action( 'init', 'emp_lessons_init' );
?>
