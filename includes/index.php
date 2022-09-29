<?php
// Plugin base
$src = plugins_url( 'includes/css/courses-EMP.css', __DIR__ );
wp_register_style( 'courses_emp_css', $src );
wp_enqueue_style( 'courses_emp_css', $src);
function add_courses_emp_styles(){
}

$src = plugins_url( 'includes/js/courses-EMP.js', __DIR__ );
wp_register_script( 'courses_emp_js', $src );
wp_enqueue_script( 'courses_emp_js', $src);
?>
