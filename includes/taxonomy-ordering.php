<?php
/**
 * Taxonomy Ordering
 *
 *  @package Taxonomy_Ordering_VP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add Order Column for Selected Taxonomies.
 *
 * @param array $columns The columns array.
 * @return array Modified columns array.
 */
function tovp_add_term_order_column( $columns ) {
	$columns['order'] = __( 'Order', 'taxonomy-ordering-vp' );
	return $columns;
}

/**
 * Manage Columns Only for Selected Taxonomies.
 *
 * @param string $taxonomy The taxonomy slug.
 */
function tovp_manage_taxonomy_columns( $taxonomy ) {
	$enabled_taxonomies = get_option( 'tovp_ordered_taxonomies', array() );
	if ( in_array( $taxonomy, $enabled_taxonomies, true ) ) {
		add_filter( "manage_edit-{$taxonomy}_columns", 'tovp_add_term_order_column' );
	}
}
add_action(
	'admin_init',
	function () {
		foreach ( get_option( 'tovp_ordered_taxonomies', array() ) as $taxonomy ) {
			tovp_manage_taxonomy_columns( $taxonomy );
		}
	}
);

/**
 * Populate Order Column for Selected Taxonomies.
 *
 * @param string $content The content of the column.
 * @param string $column_name The name of the column.
 * @param int    $term_id The term ID.
 * @return string The content to display in the column.
 */
function tovp_populate_order_column( $content, $column_name, $term_id ) {
	if ( 'order' === $column_name ) {
		$order    = get_term_meta( $term_id, '_tovp_term_order', true );
		$content  = '<span class="order-handle" style="cursor: move;">☰</span>';
		$content .= '<input type="hidden" class="term-order" value="' . esc_attr( $order ) . '" data-term-id="' . $term_id . '">';
	}
	return $content;
}

/**
 * Manage custom column for the taxonomy.
 *
 * @param string $taxonomy The taxonomy slug.
 */
function tovp_manage_taxonomy_custom_column( $taxonomy ) {
	add_filter( "manage_{$taxonomy}_custom_column", 'tovp_populate_order_column', 10, 3 );
}

add_action(
	'admin_init',
	function () {
		foreach ( get_option( 'tovp_ordered_taxonomies', array() ) as $taxonomy ) {
			tovp_manage_taxonomy_custom_column( $taxonomy );
		}
	}
);

/**
 * Enqueue Scripts.
 *
 * @param string $hook The current admin page.
 */
function tovp_enqueue_admin_scripts( $hook ) {
	if ( 'edit-tags.php' !== $hook ) {
		return;
	}

	$screen             = get_current_screen();
	$enabled_taxonomies = get_option( 'tovp_ordered_taxonomies', array() );

	if ( ! in_array( $screen->taxonomy, $enabled_taxonomies, true ) ) {
		return;
	}

	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'tovp-taxonomy-order', TAXONOMY_ORDERING_VP_PLUGIN_URL . 'assets/taxonomy-order.js', array( 'jquery', 'jquery-ui-sortable' ), filemtime( TAXONOMY_ORDERING_VP_PLUGIN_DIR . 'assets/taxonomy-order.js' ), true );

	wp_localize_script(
		'tovp-taxonomy-order',
		'tovpAjax',
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'tovp_order_nonce' ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'tovp_enqueue_admin_scripts' );


/**
 * Save the custom order of terms.
 *
 * Handles the AJAX request to save the custom order of terms.
 */
function tovp_save_taxonomy_order() {
	check_ajax_referer( 'tovp_order_nonce', 'nonce' );

	if ( ! current_user_can( 'manage_categories' ) ) {
		wp_send_json_error( array( 'message' => 'Unauthorized Access.' ) );
	}

	if ( ! isset( $_POST['order'] ) || ! is_array( $_POST['order'] ) ) {
		wp_send_json_error( array( 'message' => 'Invalid data.' ) );
	}

	$order = array_map( 'sanitize_text_field', wp_unslash( $_POST['order'] ) );
	foreach ( $order as $index => $term_id ) {
		$term_id = intval( sanitize_text_field( $term_id ) );
		update_term_meta( $term_id, '_tovp_term_order', (int) $index + 1 );
	}

	wp_send_json_success( array( 'message' => 'Term Order updated successfully.' ) );
}
add_action( 'wp_ajax_tovp_save_taxonomy_order', 'tovp_save_taxonomy_order' );


/**
 * Filter terms order for selected taxonomies.
 *
 * @param array  $terms    The terms array.
 * @param string $taxonomy The taxonomy slug.
 * @return array Modified terms array.
 */
function tovp_filter_terms_order( $terms, $taxonomy ) {
	$enabled_taxonomies = get_option( 'tovp_ordered_taxonomies', array() );

	// Only apply ordering for selected taxonomies.
	if ( ! array_intersect( (array) $taxonomy, $enabled_taxonomies ) ) {
		return $terms;
	}

	// Fetch custom order from term meta.
	foreach ( $terms as $key => $term ) {
		$order                       = get_term_meta( $term->term_id, '_tovp_term_order', true );
		$terms[ $key ]->custom_order = $order ? (int) $order : PHP_INT_MAX; // Default to high number if no order.
	}

	// Sort terms based on custom order.
	usort(
		$terms,
		function ( $a, $b ) {
			return $a->custom_order <=> $b->custom_order; // Sort in ascending order.
		}
	);

	return $terms;
}
add_filter( 'get_terms', 'tovp_filter_terms_order', 10, 3 );



/**
 * Add a toast container to the admin footer for displaying messages.
 */
function tovp_taxonomy_ordering_admin_footer_toast() {
	?>
	<div id="tovp_taxonomy_ordering-toast-container"></div>
	<style>
		#tovp_taxonomy_ordering-toast-container {
			position: fixed;
			top: 20px;
			right: 20px;
			z-index: 9999;
		}
		.tovp_taxonomy_ordering-toast {
			background: rgba(0, 0, 0, 0.8);
			color: #fff;
			padding: 10px 20px;
			margin-bottom: 10px;
			border-radius: 5px;
			box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
			opacity: 0;
			transform: translateX(100%);
			transition: opacity 0.5s ease, transform 0.5s ease;
			display: flex;
			align-items: center;
		}
		.tovp_taxonomy_ordering-toast.show {
			opacity: 1;
			transform: translateX(0);
		}
		.tovp_taxonomy_ordering-toast.success { background: #28a745; }
		.tovp_taxonomy_ordering-toast.error { background: #dc3545; }
	</style>
	<?php
}
add_action( 'admin_footer', 'tovp_taxonomy_ordering_admin_footer_toast' );
