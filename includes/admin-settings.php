<?php
/**
 * Admin settings for Taxonomy Ordering.
 *
 * @package Taxonomy_Ordering_VP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the submenu page for taxonomy order settings.
 */
function tovp_register_taxonomy_order_settings() {
	add_menu_page(
		__( 'Taxonomy Order Settings', 'taxonomy-ordering-vp' ),
		__( 'Taxonomy Order', 'taxonomy-ordering-vp' ),
		'manage_options',
		'taxonomy-order-settings',
		'tovp_taxonomy_order_settings_page',
		'dashicons-sort',
		90
	);
}
add_action( 'admin_menu', 'tovp_register_taxonomy_order_settings' );

/**
 * Register Settings.
 */
function tovp_register_settings() {
	register_setting( 'tovp_taxonomy_order_group', 'tovp_ordered_taxonomies', 'tovp_sanitize_ordered_taxonomies' );
}
add_action( 'admin_init', 'tovp_register_settings' );

/**
 * Sanitization callback for ordered taxonomies.
 *
 * @param array $input The input array to sanitize.
 * @return array Sanitized array.
 */
function tovp_sanitize_ordered_taxonomies( $input ) {
	if ( ! is_array( $input ) ) {
		return array();
	}

	return array_map( 'sanitize_text_field', $input );
}


/**
 * Settings Page HTML.
 */
function tovp_taxonomy_order_settings_page() {
	$taxonomies         = get_taxonomies( array( 'public' => true ), 'objects' );
	$enabled_taxonomies = get_option( 'tovp_ordered_taxonomies', array() );

	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Taxonomy Order Settings', 'taxonomy-ordering-vp' ); ?></h1>
		<hr/>
		<form method="post" action="options.php">
			<?php settings_fields( 'tovp_taxonomy_order_group' ); ?>
			<?php do_settings_sections( 'tovp_taxonomy_order_group' ); ?>
			<table class="form-table">
				<tr>
					<th><?php esc_html_e( 'Enable Ordering for Taxonomies:', 'taxonomy-ordering-vp' ); ?></th>
					<td>
						<?php foreach ( $taxonomies as $taxonomy ) : ?>
							<label>
								<input type="checkbox" name="tovp_ordered_taxonomies[]" value="<?php echo esc_attr( $taxonomy->name ); ?>" <?php checked( in_array( $taxonomy->name, $enabled_taxonomies, true ) ); ?> />
								<?php echo esc_html( $taxonomy->label ); ?>
							</label><br>
						<?php endforeach; ?>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
