<?php
/**
 * The post meta for hiding titles with output.
 */

 namespace HNF\Post_Meta\Hide_Header;

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
	add_filter( 'is_protected_meta', __NAMESPACE__ . '\\hidden', 10, 2 );
	add_filter( 'hnf_partial', __NAMESPACE__ . '\\hide' );
}

/**
 * The supported
 * @return [type] [description]
 */
function sections( $post_type ) {
	return apply_filters(
		'hnf_hide_support',
		[ 'header', 'title', 'byline', 'image' ],
		$post_type
	);
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
	foreach ( sections( get_post_type() ) as $section ) {
	?>
	<div class="misc-pub-section misc-pub-section-last">
		<label>
			<input
				type="checkbox"
				name="hnf_hide_<?php echo $section; ?>"
				value="1"
				<?php checked( get_post()->{"hide_$section"}, '1', true ); ?>
			/>
			<?php echo esc_html( sprintf( __( 'Hide %s', 'hnf' ), $section ) ); ?>
		</label>
	</div>
	<?php
	}
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
	foreach( sections( get_post_type( $post_id ) ) as $section ) {
		if ( isset( $_POST["hnf_hide_${section}"] ) && $_POST["hnf_hide_${section}"] ) {
			update_post_meta( $post_id, "hide_${section}", '1' );
		} else {
			delete_post_meta( $post_id, "hide_${section}" );
		}
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
	foreach( sections( get_post_type() ) as $section ) {
		if ( "hide_${section}" === $meta_key ) {
			$protected = true;
			break;
		}
	}
	return $protected;
}

/**
 * Hide sections as needed when they are being output.
 *
 * @param  array $partial The partial being output.
 * @return array          The partial array, updated as needed.
 */
function hide( $partial ) {
	$slug = str_replace( 'parts/', '', $partial['slug'] );
	if ( in_array( $slug, sections( get_post_type() ) ) ) {
		if ( get_post()->{"hide_$slug"} ) {
			$partial['slug'] = false;
		}
	}
	return $partial;
}

/**
 * Gets the post types that support the hide title post meta checkbox.
 * @return array The post types that support this metabox.
 */
function get_post_types() {
	return apply_filters( 'hnf_meta_hide_title', [] );
}
