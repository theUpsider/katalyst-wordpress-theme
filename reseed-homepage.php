<?php
/**
 * One-time helper: reseed the static front page with expanded block HTML.
 * Run once via browser while logged in as admin: /?katalyst_reseed=1
 * Delete this file afterwards.
 */

add_action( 'init', function () {
	if ( empty( $_GET['katalyst_reseed'] ) ) {
		return;
	}
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Not allowed.' );
	}

	$patterns_dir = get_template_directory() . '/patterns/';
	$order        = array( 'hero', 'about', 'pillars', 'components', 'research', 'news', 'partners', 'contact' );

	$parts = array();
	foreach ( $order as $slug ) {
		$file = $patterns_dir . $slug . '.php';
		if ( ! file_exists( $file ) ) {
			wp_die( 'Pattern file missing: ' . esc_html( $file ) );
		}
		$raw     = file_get_contents( $file ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		$raw     = preg_replace( '/\<\?php.*?\?\>/s', '', $raw );
		$parts[] = trim( $raw );
	}

	$content = implode( "\n\n", $parts );

	$front_page_id = (int) get_option( 'page_on_front' );
	if ( ! $front_page_id ) {
		wp_die( 'No static front page configured (page_on_front is empty).' );
	}

	$result = wp_update_post(
		array(
			'ID'           => $front_page_id,
			'post_content' => $content,
		),
		true
	);

	if ( is_wp_error( $result ) ) {
		wp_die( 'Update failed: ' . esc_html( $result->get_error_message() ) );
	}

	wp_die(
		'<p style="font-family:monospace;padding:2rem;font-size:1.1rem;">Done. Front page (ID ' . $front_page_id . ') reseeded with expanded block HTML from ' . count( $parts ) . ' patterns.<br><br><strong>Delete reseed-homepage.php from the theme folder now.</strong></p>',
		'Reseed complete',
		array( 'response' => 200 )
	);
} );
