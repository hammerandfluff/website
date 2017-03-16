<?php
/**
 * The post meta for hiding titles with output.
 */

 namespace HNF\Post_Meta\Hide_Title;

/**
 * Sets up this file with the WordPress API.
 *
 * @return void
 */
function load() {
	add_action( 'after_setup_theme', __NAMESPACE__ . '\\setup' );
}

/**
 * Register various methods with the WordPress API.
 *
 * @return void
 */
function setup() {
	add_action( 'post_submitbox_misc_actions',  __NAMESPACE__ . '\\checkbox' );
	add_action( 'save_post', __NAMESPACE__ . '\\save' );
	add_filter( 'is_protected_meta', __NAMESPACE__ . 'hidden', 10, 2 );
}

/**
 * Outputs the hide-title checkbox if this the post type supports it.
 *
 * @return void
 */
function checkbox() {
	$post_id = get_the_id();
	// Check post type support
	if ( ! in_array( get_post_type(), get_post_types() ) ) {
		return;
	}
	// Output the checkbox and nonce
	wp_nonce_field( 'hide_title_' . $post_id, 'hnf_ht_nonce' );
	?>
	<div class="misc-pub-section misc-pub-section-last">
		<label>
			<input type="hidden" name="hnf_hide_title" value="0" />
			<input
				type="checkbox"
				name="hnf_hide_title"
				value="1"
				<?php checked( get_post()->hide_title, '1', true); ?>
			/>
			<?php esc_html_e( 'Hide the title', 'hnf' ); ?>
		</label>
	</div>
	<?php
}

/**
 * Save the meta from the hide title checkbox.
 *
 * @param  int $post_id The post ID being saved.
 * @return void.
 */
function save( $post_id ) {
	// Don't save during autosave.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Verify post type
	if ( !in_array( get_post_type( $post_id ), get_post_types() ) ) {
		return;
	}
	// Verify nonce
	$nonce = isset( $_POST[ 'hnf_ht_nonce' ] ) ? $_POST[ 'hnf_ht_nonce' ] : '';
	if ( !wp_verify_nonce( $nonce, 'hide_title_' . $post_id ) ) {
		return;
	}
	// Verify permissions
	if ( !current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	// Save data
	if ( isset( $_POST['hnf_hide_title' ] ) && $_POST['hnf_hide_title' ] ) {
		update_post_meta( $post_id, 'hide_title', 1 );
	} else {
		delete_post_meta( $post_id, 'hide_title' );
	}
}

/**
 * Sets the meta to private so it doesn't show up in custom fields.
 *
 * @param  boolean $protected Whether or not to protect the meta key.
 * @param  string  $meta_key  The meta key potentially being output.
 * @return boolean            Whether or not to protect the meta key.
 */
function hidden( $protected, $meta_key ) {
	if ( 'hide_title' === $meta_key ) {
		$protected = true;
	}
	return $protected;
}

/**
 * Gets the post types that support the hide title post meta checkbox.
 * @return array The post types that support this metabox.
 */
function get_post_types() {
	return apply_filters( 'hnf_meta_hide_title', [] );
}
