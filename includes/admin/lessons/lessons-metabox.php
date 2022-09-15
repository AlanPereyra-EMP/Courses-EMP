<?php
// Create a custom field to select a teacher's course
function emp_add_teachers_courses_metabox(){
  add_meta_box(
    'lessons_teachers',
    __('Profesor', 'teachers_emp'),
    'emp_lessons_teachers_metabox',
    'lessons',
    'side',
    'default',
    array( 'id' => 'emp_teachers')
  );
}
add_action('admin_init', 'emp_add_teachers_courses_metabox');

function emp_lessons_teachers_metabox($post, $args){
  wp_nonce_field( plugin_basename( __FILE__ ), 'emp_lessons_teachers_nonce' );
  $teachers_id = get_post_meta($post->ID, 'emp_lessons_teachers', true);

  echo "<p>Selecciona el profesor que presenta esta lección</p>";
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

function emp_add_lesson_video_metabox(){
  add_meta_box(
    'lessons_video',
    __('Video', 'courses_emp'),
    'emp_lessons_video_metabox',
    'lessons',
    'normal',
    'default',
    array( 'id' => 'emp_video')
  );
}
add_action("admin_init", "emp_add_lesson_video_metabox");

function emp_lessons_video_metabox($post, $args){
  // This is the value that was saved in the save_amenities function
  $lesson_video = get_post_meta( $post->ID, '_lesson_video', true );

  wp_nonce_field( 'save_video', 'lesson_video_nonce' );

  echo '<label>Pegá el link del video de esta lección:</label><br>';
  echo '<input style="width:100%;" type="text" name="lesson_video" value="' . sanitize_text_field( $lesson_video ) . '" />';
}

function emp_save_video_metabox($post_id){
  // Check if nonce is set
  if ( ! isset( $_POST['lesson_video_nonce'] ) ) {
    return $post_id;
  }

  if ( ! wp_verify_nonce( $_POST['lesson_video_nonce'], 'save_video' ) ) {
    return $post_id;
  }

  // Check that the logged in user has permission to edit this post
  if ( ! current_user_can( 'edit_post' ) ) {
    return $post_id;
  }

  $bed_room = sanitize_text_field( $_POST['lesson_video'] );
  update_post_meta( $post_id, '_lesson_video', $bed_room );
}
add_action('save_post', 'emp_save_video_metabox', 1, 2);

function emp_fill_lessons_courses_columns($column_name, $id) {
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
add_action('manage_lessons_posts_custom_column', 'emp_fill_lessons_courses_columns', 10, 2);

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

add_action('manage_lessons_posts_custom_column', 'emp_fill_lessons_teachers_columns', 10, 2);

// Add column on lessons post type
function emp_add_lessons_a_columns($columns){
  $new_columns['cb'] = '<input type="checkbox" />';

  $new_columns['title'] = _x('Titulo', 'Curso', 'teachers_emp');

  $new_columns['emp_teachers'] = __('Profesor', 'teachers_emp');

  $new_columns['emp_courses'] = __('Curso', 'courses_emp');

  return $new_columns;
}

add_filter('manage_edit-lessons_columns', 'emp_add_lessons_a_columns');
?>
