<?php
function emp_add_product_courses_metabox(){
  add_meta_box(
    'product_courses',
    __('Producto vinculado', 'courses_emp'),
    'emp_product_courses_metabox',
    'courses',
    'side',
    'default',
    array( 'id' => 'emp_courses_product')
  );
}
add_action('admin_init', 'emp_add_product_courses_metabox');

function emp_product_courses_metabox($post, $args){
  wp_nonce_field( plugin_basename( __FILE__ ), 'emp_product_courses_nonce' );
  $product_courses_id = get_post_meta($post->ID, 'emp_product_courses', true);

  echo "<p>Selecciona el producto que se deba comprar para adquirir este curso</p>";
  echo "<select id='emp_product_courses' name='emp_product_courses'>";

  echo '<option value="">Gratis</option>';


  // Get products
  $query = new WP_Query( 'post_type=product' );
  while ( $query->have_posts() ) {
    $query->the_post();
    $id = get_the_ID();
    $selected = "";

    if($id == $product_courses_id){
      $selected = ' selected="selected"';
    }
    echo '<option' . $selected . ' value=' . $id . '>' . get_the_title() . '</option>';
  }
  echo "</select>";
}

// Save course selected
function emp_save_product_courses_metabox($post_id, $post){
  // Check if autosave is not working
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  return;
  if ( !isset( $_POST['emp_product_courses_nonce'] ) )
  return;
  if ( !wp_verify_nonce( $_POST['emp_product_courses_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  // We do want to save? Ok!
  $key = 'emp_product_courses';
  $value = $_POST["emp_product_courses"];
  if ( get_post_meta( $post->ID, $key, FALSE ) ) { // If the custom field already has a value
    update_post_meta( $post->ID, $key, $value );
  } else { // If the custom field doesn't have a value
    add_post_meta( $post->ID, $key, $value );
  }
  if ( !$value ) delete_post_meta( $post->ID, $key ); // Delete if blank
}

add_action('save_post', 'emp_save_product_courses_metabox', 1, 2);

function emp_add_course_dificulty_metabox(){
  add_meta_box(
    'course_dificulty',
    __('Dificultad', 'courses_emp'),
    'emp_course_dificulty_metabox',
    'courses',
    'side',
    'default',
    array( 'id' => 'emp_dificulty')
  );
}
add_action("admin_init", "emp_add_course_dificulty_metabox");

function emp_course_dificulty_metabox($post, $args){
  // This is the value that was saved in the save_amenities function
  wp_nonce_field( plugin_basename( __FILE__ ), 'course_dificulty_nonce' );
  $course_dificulty = get_post_meta( $post->ID, '_course_dificulty', true );

  echo '<label>Selecciona la dificultad correspondiente</label><br>';
  echo '<select id="course_dificulty" name="course_dificulty" >';

  $title = ['Fácil', 'Intermedio', 'Avanzado'];

  for ($i=0; $i < 3; $i++) {
    $selected = "";

    if($title[$i] == $course_dificulty){
      $selected = ' selected="selected"';
    }
    echo '<option' . $selected . ' value=' . $title[$i] . '>' . $title[$i].'</option>';
  }
  echo '</select>';
}

function emp_save_dificulty_metabox($post_id, $post){
  // Check if autosave is not working
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  return;
  if ( !isset( $_POST['course_dificulty_nonce'] ) )
  return;
  if ( !wp_verify_nonce( $_POST['course_dificulty_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  // We do want to save? Ok!
  $key = '_course_dificulty';
  $value = $_POST["course_dificulty"];
  if ( get_post_meta( $post->ID, $key, FALSE ) ) { // If the custom field already has a value
    update_post_meta( $post->ID, $key, $value );
  } else { // If the custom field doesn't have a value
    add_post_meta( $post->ID, $key, $value );
  }
  if ( !$value ) delete_post_meta( $post->ID, $key ); // Delete if blank
}
add_action('save_post', 'emp_save_dificulty_metabox', 1, 2);

function emp_add_lessons_position_metabox(){
  add_meta_box(
    'lessons_position',
    __('Lecciones inluidas', 'courses_emp'),
    'emp_lessons_position_metabox',
    'courses',
    'normal',
    'high',
    array( 'id' => 'emp_lessons_position')
  );
}
add_action("admin_init", "emp_add_lessons_position_metabox");

function emp_lessons_position_metabox($post) {
  $post_id = null;
  if ( isset( $_GET['post'] ) ) {
    $post_id = intval( $_GET['post'] );
  } elseif ( isset( $_POST['post_ID'] ) ) {
    $post_id = intval( $_POST['post_ID'] );
  }

  wp_nonce_field( plugin_basename( __FILE__ ), 'lessons_position_nonce' );
  $lessons_position = get_post_meta( $post_id, '_lessons_position', true );

  $lessons_position = explode(",", $lessons_position);

  $list_posts = get_posts([
    'post_type' => 'lessons',
    'posts_per_page' => -1,
    'meta_query' => array(
      array(
        'key'     => '_lesson_course',
        'value'   => $post_id,
        'compare' => 'IN'
      )
    )
  ]);

	// HTML
  echo '<label>Editá el orden de las lecciones de este curso arrastrándolas</label><br><br><br>
  <form class="container">';

  foreach ($lessons_position as $position) {
    $lessons_position_formated .= ','.$position;
  }

  // Save the lesson position order
  echo '<input type="hidden" id="lessons_container_position" name="lessons_position" value="'.$lessons_position_formated.'">';

  // Container in
  echo '<div id="list" class="container in">
  <h3>Inludas en el temario:</h3>';
  foreach( $lessons_position as $lesson_id) {
    if($lesson_id){
      $lesson_title = get_the_title($lesson_id);
      echo "<input readonly class='draggable' draggable='true' data-id='".$lesson_id."' data-draggable-order='' value='".$lesson_title." '/>";
    }
  }
	echo '</div>';

  // Container out
  echo '<div class="container out">
  <h3>No inluidas aún:</h3>';
  foreach( $list_posts as $post ) {
    if (!in_array($post->ID, $lessons_position)) {
      echo "<input readonly class='draggable' draggable='true' data-id='".$post->ID."' data-draggable-order='' value='".$post->post_title." '/>";
    }
  }
  echo '</div>
  </form>';
}

function emp_save_lessons_position_metabox($post_id, $post){
  // Check if autosave is not working
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  return;
  if ( !isset( $_POST['lessons_position_nonce'] ) )
  return;
  if ( !wp_verify_nonce( $_POST['lessons_position_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  // We do want to save? Ok!
  $key = '_lessons_position';
  $value = $_POST["lessons_position"];

  if ( get_post_meta( $post_id, $key, FALSE ) ) { // If the custom field already has a value
    update_post_meta( $post_id, $key, $value );
  } else { // If the custom field doesn't have a value
    add_post_meta( $post_id, $key, $value );
  }
  if ( !$value ) delete_post_meta( $post_id, $key ); // Delete if blank
}
add_action('save_post', 'emp_save_lessons_position_metabox', 1, 2);

function emp_add_course_video_metabox(){
  add_meta_box(
    'courses_video',
    __('Video', 'courses_emp'),
    'emp_courses_video_metabox',
    'courses',
    'normal',
    'default',
    array( 'id' => 'emp_courses_video')
  );
}
add_action("admin_init", "emp_add_course_video_metabox");

function emp_courses_video_metabox($post, $args){
  $post_id = null;
  if ( isset( $_GET['post'] ) ) {
    $post_id = intval( $_GET['post'] );
  } elseif ( isset( $_POST['post_ID'] ) ) {
    $post_id = intval( $_POST['post_ID'] );
  }

  // This is the value that was saved in the save_amenities function
  wp_nonce_field( plugin_basename( __FILE__ ), 'course_video_nonce' );
  $course_video = get_post_meta( $post_id, '_course_video_a', true );


  echo '<label>Pegá el link del video de este curso:</label><br>';
  echo '<input style="width:100%;" type="text" id="course_video" name="course_video" value="'.$course_video.'" />';
}

function emp_save_course_video_metabox($post_id){
  // Check if autosave is not working
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  return;
  if ( !isset( $_POST['course_video_nonce'] ) )
  return;
  if ( !wp_verify_nonce( $_POST['course_video_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  $key = '_course_video_a';
  $value = $_POST['course_video'];

  if ( get_post_meta( $post_id, $key, FALSE ) ) { // If the custom field already has a value
    update_post_meta( $post_id, $key, $value );
  } else { // If the custom field doesn't have a value
    add_post_meta( $post_id, $key, $value );
  }
  if ( !$value ) delete_post_meta( $post_id, $key ); // Delete if blank
}
add_action('save_post', 'emp_save_course_video_metabox', 1, 2);

// Create a custom field to select a teacher's course
function emp_add_teachers_courses_metabox(){
  add_meta_box(
    'course_teacher',
    __('Profesor', 'teachers_emp'),
    'emp_course_teachers_metabox',
    'courses',
    'side',
    'default',
    array( 'id' => 'emp_teachers')
  );
}
add_action('admin_init', 'emp_add_teachers_courses_metabox');

function emp_course_teachers_metabox($post, $args){
  wp_nonce_field( plugin_basename( __FILE__ ), 'emp_course_teachers_nonce' );
  $teachers_id = get_post_meta($post->ID, 'emp_course_teachers', true);

  echo "<p>Selecciona el profesor que presenta esta lección</p>";
  echo "<select id='emp_course_teachers' name='emp_course_teachers'>";

  echo '<option value="">No incluir</option>';

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
  if ( !isset( $_POST['emp_course_teachers_nonce'] ) )
  return;
  if ( !wp_verify_nonce( $_POST['emp_course_teachers_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  // We do want to save? Ok!
  $key = 'emp_course_teachers';
  $value = $_POST["emp_course_teachers"];
  if ( get_post_meta( $post->ID, $key, FALSE ) ) { // If the custom field already has a value
    update_post_meta( $post->ID, $key, $value );
  } else { // If the custom field doesn't have a value
    add_post_meta( $post->ID, $key, $value );
  }
  if ( !$value ) delete_post_meta( $post->ID, $key ); // Delete if blank
}

add_action('save_post', 'emp_save_teachers_metabox', 1, 2);
?>
