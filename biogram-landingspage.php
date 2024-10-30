<?php
/*
Plugin Name:       Biogram Linkpage - A link in bio solution
Plugin URI:        https://juist.nl/insta-link-in-bio/
Description:       Meerdere links in je Instagram bio willen plaatsen? Deze plug-in voegt een makkelijk aan te passen landingspagina toe die je in je Instagram bio kunt plaatsen.
Version:           1.4
Author:            Juist
Author URI:        https://juist.nl
License:           GPL-2.0+
License URI:       http://www.gnu.org/licenses/gpl-2.0.txt

Biogram Linkpage is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Biogram Linkpage is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
*/

/******************************************* 
 * If this file is called directly, abort. *
 *******************************************/
if ( ! defined( 'ABSPATH' ) ) exit;

/********************************************************************
 * Creates the Biogram Linkpage upon activating this plug-in. *
 ********************************************************************/
function activate_biogram_landingspage() {

	$biogram_page_args = array(
		'post_title'   => __( 'Biogram Linkpage' ),
		'post_name'    => 'instagram',
		'post_status'  => 'publish',
		'post_type'    => 'page'
	);

	$biogram_page_id = wp_insert_post( $biogram_page_args );
	add_option( 'juist_biogram_page_id', $biogram_page_id );

}
register_activation_hook( __FILE__, 'activate_biogram_landingspage' );

/********************************************************************** 
 * Removes the Biogram Linkpage upon deactivating this plug-in. *
 **********************************************************************/
function deactivate_biogram_landingspage() {

	$biogram_page_id = get_option( 'juist_biogram_page_id' );

	if ( $biogram_page_id ) {

		wp_delete_post( $biogram_page_id, true );
		delete_option( 'juist_biogram_page_id' );

	}

}
register_deactivation_hook( __FILE__, 'deactivate_biogram_landingspage' );

/********************************
 * Includes all necessary files *
 ********************************/
require plugin_dir_path( __FILE__ ) . 'includes/biogram-landingspage-acf.php';
require plugin_dir_path( __FILE__ ) . 'includes/biogram-landingspage-template.php';

/************************************** 
 * Enqueue all necessary script files *
 **************************************/
function add_biogram_plugin_scripts() {
	wp_enqueue_style( 'plugin-styles', plugins_url('assets/css/biogram-landingspage.css', __FILE__ ) );
}

add_action( 'wp_enqueue_scripts', 'add_biogram_plugin_scripts' );

/************************************* 
 * Add ACF Pro notification in admin *
 *************************************/
if( !function_exists( 'the_field' ) ) {
  add_action( 'admin_notices', 'my_acf_notice' );
}

function my_acf_notice() {
  ?>
  <div class="notice notice-warning is-dismissible">
      <p><?php _e( 'Biogram requires <a href="https://www.advancedcustomfields.com/pro/" target="_blank"><b>Advanced Custom Fields PRO</b></a> to be installed! Otherwise this plugin is not going to work.' ); ?></p>
  </div>
  <?php
}

?>