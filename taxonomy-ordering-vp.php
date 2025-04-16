<?php
/**
 * Plugin Name: Taxonomy Ordering
 * Plugin URI:  https://github.com/vishalpadhariya/taxonomy-ordering
 * Description: Enables drag-and-drop ordering for taxonomy terms with a settings page to select taxonomies.
 * Version:     1.0.0
 * Author:      Vishal Padhariya
 * Author URI:  https://vishalpadhariya.github.io
 * License:     GPL2
 * Text Domain: taxonomy-ordering-vp
 *
 * @package Taxonomy_Ordering_VP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define Constants.
define( 'TAXONOMY_ORDERING_VP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'TAXONOMY_ORDERING_VP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Include Required Files.
require_once TAXONOMY_ORDERING_VP_PLUGIN_DIR . 'includes/admin-settings.php';
require_once TAXONOMY_ORDERING_VP_PLUGIN_DIR . 'includes/taxonomy-ordering.php';
