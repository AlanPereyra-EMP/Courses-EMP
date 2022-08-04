<?php
/*
Plugin Name: Courses EMP
Plugin URI: https://empralidad.com.ar/courses-emp
Description: Courses EMP es un plugin para WordPress que añade un custom post type para crear cursos.
Author: Empralidad
Author URI: https://empralidad.com.ar/
Text Domain: courses_emp
License: Attribution-NonCommercial-NoDerivatives 3.0 IGO
License URI: https://creativecommons.org/licenses/by-nc-nd/3.0/igo/legalcode
Version: 0.0.2
*/
if ( ! defined( 'ABSPATH' ) ){
	exit;
}

require_once plugin_dir_path(__FILE__).'/includes/custom-post-type.php';
require_once plugin_dir_path(__FILE__).'/includes/custom-user-profile.php';
require_once plugin_dir_path(__FILE__).'/includes/index.php';
?>
