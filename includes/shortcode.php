<?php
// Courses shortcode
if(!shortcode_exists('emp_courses')) {
  function emp_courses_display($atts) {

    $args = array(
      'post_type' => 'courses',
      'post_status' => 'publish',
      'posts_per_page' => 9,
      'orderby' => 'title',
      'order' => 'ASC',
      'category' => get_the_category( $post->ID )
    );

    $loop = new WP_Query( $args );

    while ( $loop->have_posts() ) : $loop->the_post();
    $the_category = get_the_category_list(', ');
    $permalink = get_the_permalink();
    $the_title = get_the_title();
    $the_excerpt = get_the_excerpt();


      if ( has_post_thumbnail() ) {
        $image = get_the_post_thumbnail( '', 'medium', array( 'class' => 'border-30px aspect-ratio-16-9 w-100 h-100') );
      }

      $courses .= '<section class="emp-courses-sliders">
                    <a href="'.$permalink.'">'
                        .$image.
                    '</a>
                  </section>';
      endwhile;

      return '<div class="w-100 overflow-auto my-5"><div class="d-flex w-fit-content">'.$courses.'</div></div>';

  }

  // Add a shortcode
  add_shortcode('emp_courses', 'emp_courses_display');
}
?>
