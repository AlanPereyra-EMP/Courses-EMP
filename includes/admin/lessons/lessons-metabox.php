<?php
function emp_add_lesson_video_metabox(){
  add_meta_box(
    'lessons_video',
    __('Video', 'courses_emp'),
    'emp_lessons_video_metabox',
    'lessons',
    'side',
    'default',
    array( 'id' => 'emp_video')
  );
}
add_action("admin_init", "emp_add_lesson_video_metabox");

function emp_lessons_video_metabox($post, $args){
  $post_id = null;
  if ( isset( $_GET['post'] ) ) {
    $post_id = intval( $_GET['post'] );
  } elseif ( isset( $_POST['post_ID'] ) ) {
    $post_id = intval( $_POST['post_ID'] );
  }

  // This is the value that was saved in the save_amenities function
  wp_nonce_field( plugin_basename( __FILE__ ), 'lesson_video_nonce' );
  $lesson_video = get_post_meta( $post_id, '_lesson_video', true );


  echo '<label>Pegá el link del video de esta lección:</label><br>';
  echo '<input style="width:100%;" type="text" id="lesson_video" name="lesson_video" value="' . $lesson_video . '" />';

}

function emp_save_video_metabox($post_id){
  // Check if autosave is not working
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  return;
  if ( !isset( $_POST['lesson_video_nonce'] ) )
  return;
  if ( !wp_verify_nonce( $_POST['lesson_video_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  $key = '_lesson_video';
  $value = $_POST['lesson_video'];

  if ( get_post_meta( $post_id, $key, FALSE ) ) { // If the custom field already has a value
    update_post_meta( $post_id, $key, $value );
  } else { // If the custom field doesn't have a value
    add_post_meta( $post_id, $key, $value );
  }
  if ( !$value ) delete_post_meta( $post_id, $key ); // Delete if blank
}
add_action('save_post', 'emp_save_video_metabox', 1, 2);

function emp_fill_lessons_courses_columns($column_name, $id) {
  global $wpdb;
  switch ($column_name) {
    case 'emp_course':
    $courses_id = get_post_meta($id, '_lessons_course', true);
    $courses = get_post($courses_id);
    $permalink = get_permalink($courses_id);
    echo "<a href='" . $permalink . "'>" . $courses->post_title . "</a>";
    break;
    default:
    break;
  }
}
add_action('manage_lessons_posts_custom_column', 'emp_fill_lessons_courses_columns', 10, 2);
//
// function emp_fill_lessons_teachers_columns($column_name, $id) {
//   global $wpdb;
//   switch ($column_name) {
//     case 'emp_teachers':
//     $teachers_id = get_post_meta($id, 'emp_lessons_teachers', true);
//     $teachers = get_post($teachers_id);
//     $permalink = get_permalink($teachers_id);
//     echo "<a href='" . $permalink . "'>" . $teachers->post_title . "</a>";
//     break;
//     default:
//     break;
//   }
// }

// add_action('manage_lessons_posts_custom_column', 'emp_fill_lessons_teachers_columns', 10, 2);

// Add column on lessons post type
function emp_add_lessons_a_columns($columns){
  $new_columns['cb'] = '<input type="checkbox" />';

  $new_columns['title'] = _x('Titulo', 'Curso', 'courses_emp');

  $new_columns['emp_course'] = __('Curso', 'courses_emp');

  return $new_columns;
}

add_filter('manage_edit-lessons_columns', 'emp_add_lessons_a_columns');

// Create a custom field to select a teacher's course
function emp_add_lesson_course_metabox(){
  add_meta_box(
    'lesson_course',
    __('Curso', 'teachers_emp'),
    'emp_lesson_course_metabox',
    'lessons',
    'side',
    'default',
    array( 'id' => 'emp_course')
  );
}
add_action('admin_init', 'emp_add_lesson_course_metabox');

function emp_lesson_course_metabox($post, $args){
  wp_nonce_field( plugin_basename( __FILE__ ), 'emp_lesson_course_nonce' );
  $course_id = get_post_meta($post->ID, '_lesson_course', true);

  echo "<p>Selecciona el curso del cual forma parte esta lección</p>";
  echo "<select id='emp_lesson_course' name='emp_lesson_course'>";

  echo '<option value="">No incluido</option>';

  // Get teachers
  $query = new WP_Query( 'post_type=courses' );
  while ( $query->have_posts() ) {
    $query->the_post();
    $id = get_the_ID();
    $selected = "";

    if($id == $course_id){
      $selected = ' selected="selected"';
    }
    echo '<option' . $selected . ' value=' . $id . '>' . get_the_title() . '</option>';
  }
  echo "</select>";
}

// Save course selected
function emp_save_lesson_course_metabox($post_id, $post){
  // Check if autosave is not working
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  return;
  if ( !isset( $_POST['emp_lesson_course_nonce'] ) )
  return;
  if ( !wp_verify_nonce( $_POST['emp_lesson_course_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  // We do want to save? Ok!
  $key = '_lesson_course';
  $value = $_POST["emp_lesson_course"];
  if ( get_post_meta( $post->ID, $key, FALSE ) ) { // If the custom field already has a value
    update_post_meta( $post->ID, $key, $value );
  } else { // If the custom field doesn't have a value
    add_post_meta( $post->ID, $key, $value );
  }
  if ( !$value ) delete_post_meta( $post->ID, $key ); // Delete if blank
}

add_action('save_post', 'emp_save_lesson_course_metabox', 1, 2);
?>
