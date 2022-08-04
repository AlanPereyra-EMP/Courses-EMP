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
    'rewrite'            => array( 'slug' => 'courses' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'show_in_rest'       => true,
    'taxonomies'         => array( 'category' ),
    'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'categories', 'duplicate')
  );

  register_post_type( 'courses', $args );

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
add_action( 'init', 'emp_courses_init' );

// Create a custom field to select a parent course
function emp_add_courses_metabox(){
  add_meta_box(
    'lessons_courses',
    __('Curso padre', 'courses_emp'),
    'emp_lessons_courses_metabox',
    'lessons',
    'side',
    'default',
    array( 'id' => 'emp_courses')
  );
}
add_action('admin_init', 'emp_add_courses_metabox');

function emp_lessons_courses_metabox($post, $args){
  wp_nonce_field( plugin_basename( __FILE__ ), 'emp_lessons_courses_nonce' );
  $courses_id = get_post_meta($post->ID, 'emp_lessons_courses', true);

  echo "<p>Selecciona el curso al cual pertenece esta lección</p>";
  echo "<select id='emp_lessons_courses' name='emp_lessons_courses'>";

  // Get courses
  $query = new WP_Query( 'post_type=courses' );
  while ( $query->have_posts() ) {
    $query->the_post();
    $id = get_the_ID();
    $selected = "";

    if($id == $courses_id){
      $selected = ' selected="selected"';
    }
    echo '<option' . $selected . ' value=' . $id . '>' . get_the_title() . '</option>';
  }
  echo "</select>";
}

// Save course selected
function emp_save_courses_metabox($post_id, $post){
  // Check if autosave is not working
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  return;
  if ( !isset( $_POST['emp_lessons_courses_nonce'] ) )
  return;
  if ( !wp_verify_nonce( $_POST['emp_lessons_courses_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  // We do want to save? Ok!
  $key = 'emp_lessons_courses';
  $value = $_POST["emp_lessons_courses"];
  if ( get_post_meta( $post->ID, $key, FALSE ) ) { // If the custom field already has a value
    update_post_meta( $post->ID, $key, $value );
  } else { // If the custom field doesn't have a value
    add_post_meta( $post->ID, $key, $value );
  }
  if ( !$value ) delete_post_meta( $post->ID, $key ); // Delete if blank
}

add_action('save_post', 'emp_save_courses_metabox', 1, 2);

// Add column on lessons post type
function emp_add_lessons_columns($columns){
  $new_columns['cb'] = '<input type="checkbox" />';

  $new_columns['title'] = _x('Title', 'Curso', 'courses_emp');

  $new_columns['emp_courses'] = __('Curso', 'courses_emp');

  return $new_columns;
}

add_filter('manage_edit-lessons_columns', 'emp_add_lessons_columns');

function emp_fill_lessons_columns($column_name, $id) {
  global $wpdb;
  switch ($column_name) {
    case 'emp_courses':
    $courses_id = get_post_meta($id, 'emp_lessons_courses', true);
    $courses = get_post($courses_id);
    $permalink = get_permalink($courses_id);
    echo "<a href='" . $permalink . "'>" . $courses->post_title . "</a>";
    break;
    default:
    break;
  }
}

add_action('manage_lessons_posts_custom_column', 'emp_fill_lessons_columns', 10, 2);

// Create a custom field to select a parent course
function emp_add_teachers_metabox(){
  add_meta_box(
    'lessons_teachers',
    __('Profesor', 'courses_emp'),
    'emp_lessons_teachers_metabox',
    'lessons',
    'side',
    'default',
    array( 'id' => 'emp_teachers')
  );
}
add_action('admin_init', 'emp_add_teachers_metabox');

function emp_lessons_teachers_metabox($post, $args){
  wp_nonce_field( plugin_basename( __FILE__ ), 'emp_lessons_teachers_nonce' );
  $teachers_id = get_post_meta($post->ID, 'emp_lessons_teachers', true);

  echo "<p>Selecciona el profesor que presenta este curso</p>";
  echo "<select id='emp_lessons_teachers' name='emp_lessons_teachers'>";

  // Get teachers
  $query = new WP_Query( 'post_type=teachers' );
  while ( $query->have_posts() ) {
    $query->the_post();
    $id = get_the_ID();
    $selected = "";

    if($id == $teachers_id){
      $selected = ' selected="selected"';
    }
    echo '<option' . $selected . ' value=' . $id . '>' . get_the_title() . '</option>';
  }
  echo "</select>";
}

// Save course selected
function emp_save_teachers_metabox($post_id, $post){
  // Check if autosave is not working
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  return;
  if ( !isset( $_POST['emp_lessons_teachers_nonce'] ) )
  return;
  if ( !wp_verify_nonce( $_POST['emp_lessons_teachers_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  // We do want to save? Ok!
  $key = 'emp_lessons_teachers';
  $value = $_POST["emp_lessons_teachers"];
  if ( get_post_meta( $post->ID, $key, FALSE ) ) { // If the custom field already has a value
    update_post_meta( $post->ID, $key, $value );
  } else { // If the custom field doesn't have a value
    add_post_meta( $post->ID, $key, $value );
  }
  if ( !$value ) delete_post_meta( $post->ID, $key ); // Delete if blank
}

add_action('save_post', 'emp_save_teachers_metabox', 1, 2);

// Add column on lessons post type
function emp_add_lessons_teachers_columns($columns){
  $new_teacher_columns['cb'] = '<input type="checkbox" />';

  $new_teacher_columns['title'] = _x('Title', 'Profesor', 'courses_emp');

  $new_teacher_columns['emp_teachers'] = __('Profesor', 'courses_emp');

  return $new_teacher_columns;
}

add_filter('manage_edit-lessons_teachers_columns', 'emp_add_lessons_teachers_columns');

function emp_fill_lessons_teachers_columns($column_name, $id) {
  global $wpdb;
  switch ($column_name) {
    case 'emp_teachers':
    $teachers_id = get_post_meta($id, 'emp_lessons_teachers', true);
    $teachers = get_post($teachers_id);
    $permalink = get_permalink($teachers_id);
    echo "<a href='" . $permalink . "'>" . $teachers->post_title . "</a>";
    break;
    default:
    break;
  }
}

add_action('manage_lessons_teachers_posts_custom_column', 'emp_fill_lessons_teachers_columns', 10, 2);
?>
