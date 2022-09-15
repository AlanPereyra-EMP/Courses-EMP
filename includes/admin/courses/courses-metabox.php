<?php
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
?>
