<?php
/**
 * Contact form inquiries — custom post type, admin columns, detail meta box.
 *
 * @package Katalyst
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ---------------------------------------------------------------------------
// 1. Custom post type
// ---------------------------------------------------------------------------

/**
 * Register the katalyst_inquiry CPT.
 */
function katalyst_register_inquiry_cpt(): void {
	register_post_type(
		'katalyst_inquiry',
		array(
			'labels'              => array(
				'name'               => __( 'Inquiries', 'katalyst' ),
				'singular_name'      => __( 'Inquiry', 'katalyst' ),
				'menu_name'          => __( 'Inquiries', 'katalyst' ),
				'all_items'          => __( 'All Inquiries', 'katalyst' ),
				'view_item'          => __( 'View Inquiry', 'katalyst' ),
				'search_items'       => __( 'Search Inquiries', 'katalyst' ),
				'not_found'          => __( 'No inquiries found.', 'katalyst' ),
				'not_found_in_trash' => __( 'No inquiries in trash.', 'katalyst' ),
			),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => false,
			'show_in_rest'        => false,
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
			'supports'            => array( 'title' ),
			'menu_icon'           => 'dashicons-email-alt',
			'menu_position'       => 25,
			'has_archive'         => false,
			'rewrite'             => false,
			'query_var'           => false,
			'exclude_from_search' => true,
		)
	);
}
add_action( 'init', 'katalyst_register_inquiry_cpt' );

// ---------------------------------------------------------------------------
// 2. Save a new inquiry
// ---------------------------------------------------------------------------

/**
 * Persist a contact form submission as a katalyst_inquiry post.
 *
 * @param string $name         Sender name.
 * @param string $email        Sender email.
 * @param string $organization Sender organisation (may be empty).
 * @param string $message      Message body.
 * @return int|WP_Error New post ID or WP_Error on failure.
 */
function katalyst_save_inquiry( string $name, string $email, string $organization, string $message ) {
	$post_id = wp_insert_post(
		array(
			'post_type'   => 'katalyst_inquiry',
			'post_title'  => sanitize_text_field( $name ) . ' <' . sanitize_email( $email ) . '>',
			'post_status' => 'publish',
			'post_date'   => current_time( 'mysql' ),
		),
		true
	);

	if ( is_wp_error( $post_id ) ) {
		return $post_id;
	}

	update_post_meta( $post_id, '_katalyst_inquiry_name', sanitize_text_field( $name ) );
	update_post_meta( $post_id, '_katalyst_inquiry_email', sanitize_email( $email ) );
	update_post_meta( $post_id, '_katalyst_inquiry_organization', sanitize_text_field( $organization ) );
	update_post_meta( $post_id, '_katalyst_inquiry_message', sanitize_textarea_field( $message ) );

	return $post_id;
}

// ---------------------------------------------------------------------------
// 3. Admin list table columns
// ---------------------------------------------------------------------------

/**
 * Replace default columns with inquiry-specific ones.
 *
 * @param string[] $columns Default columns.
 * @return string[]
 */
function katalyst_inquiry_columns( array $columns ): array {
	return array(
		'cb'                         => $columns['cb'],
		'title'                      => __( 'Sender', 'katalyst' ),
		'katalyst_inquiry_email'     => __( 'Email', 'katalyst' ),
		'katalyst_inquiry_org'       => __( 'Organisation', 'katalyst' ),
		'katalyst_inquiry_excerpt'   => __( 'Message', 'katalyst' ),
		'date'                       => __( 'Date', 'katalyst' ),
	);
}
add_filter( 'manage_katalyst_inquiry_posts_columns', 'katalyst_inquiry_columns' );

/**
 * Render custom column values.
 *
 * @param string $column  Column slug.
 * @param int    $post_id Post ID.
 */
function katalyst_inquiry_column_content( string $column, int $post_id ): void {
	switch ( $column ) {
		case 'katalyst_inquiry_email':
			$email = get_post_meta( $post_id, '_katalyst_inquiry_email', true );
			if ( $email ) {
				printf( '<a href="mailto:%1$s">%1$s</a>', esc_attr( $email ) );
			}
			break;

		case 'katalyst_inquiry_org':
			$org = get_post_meta( $post_id, '_katalyst_inquiry_organization', true );
			echo esc_html( $org ?: '—' );
			break;

		case 'katalyst_inquiry_excerpt':
			$message = get_post_meta( $post_id, '_katalyst_inquiry_message', true );
			echo esc_html( wp_trim_words( $message, 12, '…' ) );
			break;
	}
}
add_action( 'manage_katalyst_inquiry_posts_custom_column', 'katalyst_inquiry_column_content', 10, 2 );

/**
 * Make the date column sortable.
 *
 * @param string[] $columns Sortable columns.
 * @return string[]
 */
function katalyst_inquiry_sortable_columns( array $columns ): array {
	$columns['date'] = 'date';
	return $columns;
}
add_filter( 'manage_edit-katalyst_inquiry_sortable_columns', 'katalyst_inquiry_sortable_columns' );

// ---------------------------------------------------------------------------
// 4. Meta box — full inquiry detail
// ---------------------------------------------------------------------------

/**
 * Register the detail meta box.
 */
function katalyst_inquiry_meta_box(): void {
	add_meta_box(
		'katalyst_inquiry_detail',
		__( 'Inquiry Detail', 'katalyst' ),
		'katalyst_inquiry_meta_box_render',
		'katalyst_inquiry',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes_katalyst_inquiry', 'katalyst_inquiry_meta_box' );

/**
 * Render the detail meta box.
 *
 * @param WP_Post $post Current post object.
 */
function katalyst_inquiry_meta_box_render( WP_Post $post ): void {
	$name  = get_post_meta( $post->ID, '_katalyst_inquiry_name', true );
	$email = get_post_meta( $post->ID, '_katalyst_inquiry_email', true );
	$org   = get_post_meta( $post->ID, '_katalyst_inquiry_organization', true );
	$msg   = get_post_meta( $post->ID, '_katalyst_inquiry_message', true );

	?>
	<table class="form-table" style="margin:0;">
		<tr>
			<th style="width:120px;"><?php esc_html_e( 'Name', 'katalyst' ); ?></th>
			<td><?php echo esc_html( $name ); ?></td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Email', 'katalyst' ); ?></th>
			<td><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Organisation', 'katalyst' ); ?></th>
			<td><?php echo esc_html( $org ?: '—' ); ?></td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Message', 'katalyst' ); ?></th>
			<td style="white-space:pre-wrap;"><?php echo esc_html( $msg ); ?></td>
		</tr>
	</table>
	<?php
}

// ---------------------------------------------------------------------------
// 5. Hide the editor / publish box clutter on the detail screen
// ---------------------------------------------------------------------------

/**
 * Remove unnecessary meta boxes from the inquiry edit screen.
 */
function katalyst_inquiry_remove_meta_boxes(): void {
	remove_meta_box( 'submitdiv', 'katalyst_inquiry', 'side' );
	remove_meta_box( 'slugdiv', 'katalyst_inquiry', 'normal' );
}
add_action( 'admin_menu', 'katalyst_inquiry_remove_meta_boxes' );

/**
 * Add a lightweight "received on" side box to replace the publish box.
 */
function katalyst_inquiry_received_box(): void {
	add_meta_box(
		'katalyst_inquiry_received',
		__( 'Received', 'katalyst' ),
		static function ( WP_Post $post ): void {
			$date = get_the_date( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), $post );
			echo '<p style="margin:4px 0;">' . esc_html( $date ) . '</p>';
			printf(
				'<p style="margin:12px 0 0;"><a href="%s" class="button button-secondary">%s</a></p>',
				esc_url( admin_url( 'edit.php?post_type=katalyst_inquiry' ) ),
				esc_html__( '← All Inquiries', 'katalyst' )
			);
		},
		'katalyst_inquiry',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes_katalyst_inquiry', 'katalyst_inquiry_received_box' );
