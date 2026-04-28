<?php
/**
 * Theme setup and hooks.
 *
 * @package Katalyst
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register theme supports.
 */
function katalyst_setup(): void {
	load_theme_textdomain( 'katalyst', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'block-templates' );
	add_theme_support( 'block-template-parts' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'custom-line-height' );
	add_theme_support( 'custom-spacing' );
	add_theme_support( 'custom-units' );
	add_theme_support( 'custom-logo', array( 'height' => 96, 'width' => 280, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Navigation', 'katalyst' ),
			'footer'  => esc_html__( 'Footer Navigation', 'katalyst' ),
		)
	);

	add_editor_style( 'assets/css/editor.css' );
}
add_action( 'after_setup_theme', 'katalyst_setup' );

/**
 * Register custom block pattern categories.
 */
function katalyst_register_pattern_categories(): void {
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'katalyst-sections',
			array(
				'label' => __( 'Katalyst Sections', 'katalyst' ),
			)
		);
	}
}
add_action( 'init', 'katalyst_register_pattern_categories' );

/**
 * Enqueue frontend assets.
 */
function katalyst_enqueue_assets(): void {
	$theme = wp_get_theme();
	$ver   = $theme->get( 'Version' );

	wp_enqueue_style( 'katalyst-style', get_stylesheet_uri(), array(), $ver );
	wp_enqueue_style( 'katalyst-fonts', 'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap', array(), null );
	wp_enqueue_style( 'katalyst-theme', get_template_directory_uri() . '/assets/css/theme.css', array( 'katalyst-style', 'katalyst-fonts' ), $ver );

	wp_enqueue_script( 'katalyst-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), $ver, true );
	wp_localize_script(
		'katalyst-theme',
		'katalystTheme',
		array(
			'frontPageUrl' => home_url( '/' ),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'katalyst_enqueue_assets' );

/**
 * Add body classes.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function katalyst_body_classes( array $classes ): array {
	$classes[] = 'katalyst-site';

	if ( is_front_page() ) {
		$classes[] = 'grid-on';
	}

	return $classes;
}
add_filter( 'body_class', 'katalyst_body_classes' );

/**
 * Handle the contact form submission.
 */
function katalyst_handle_contact_form(): void {
	if ( ! isset( $_POST['katalyst_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['katalyst_contact_nonce'] ) ), 'katalyst_contact_form' ) ) {
		wp_safe_redirect( add_query_arg( 'contact-status', 'invalid', wp_get_referer() ?: home_url( '/' ) ) . '#kontakt' );
		exit;
	}

	$name         = isset( $_POST['contact_name'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) ) : '';
	$email        = isset( $_POST['contact_email'] ) ? sanitize_email( wp_unslash( $_POST['contact_email'] ) ) : '';
	$organization = isset( $_POST['contact_organization'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_organization'] ) ) : '';
	$message      = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ) ) : '';

	$status = 'error';

	if ( $name && is_email( $email ) && $message ) {
		$admin_email = get_option( 'admin_email' );
		$subject     = sprintf( __( '[Katalyst] New inquiry from %s', 'katalyst' ), $name );
		$body        = implode(
			"\n\n",
			array(
				sprintf( __( 'Name: %s', 'katalyst' ), $name ),
				sprintf( __( 'Email: %s', 'katalyst' ), $email ),
				sprintf( __( 'Organization: %s', 'katalyst' ), $organization ?: __( 'Not provided', 'katalyst' ) ),
				__( 'Message:', 'katalyst' ),
				$message,
			)
		);

		$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );
		$status  = wp_mail( $admin_email, $subject, $body, $headers ) ? 'success' : 'error';
	}

	wp_safe_redirect( add_query_arg( 'contact-status', $status, wp_get_referer() ?: home_url( '/' ) ) . '#kontakt' );
	exit;
}
add_action( 'admin_post_nopriv_katalyst_contact', 'katalyst_handle_contact_form' );
add_action( 'admin_post_katalyst_contact', 'katalyst_handle_contact_form' );

/**
 * Render the contact form shortcode.
 *
 * @return string
 */
function katalyst_contact_form_shortcode(): string {
	$status = function_exists( 'katalyst_get_contact_status' ) ? katalyst_get_contact_status() : '';

	ob_start();
	?>
	<form class="form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<?php if ( 'success' === $status ) : ?>
			<div class="notice-banner success"><?php esc_html_e( 'Danke. Ihre Nachricht wurde gesendet.', 'katalyst' ); ?></div>
		<?php elseif ( 'error' === $status || 'invalid' === $status ) : ?>
			<div class="notice-banner error"><?php esc_html_e( 'Bitte prüfen Sie Ihre Angaben und versuchen Sie es erneut.', 'katalyst' ); ?></div>
		<?php endif; ?>
		<input type="hidden" name="action" value="katalyst_contact">
		<?php wp_nonce_field( 'katalyst_contact_form', 'katalyst_contact_nonce' ); ?>
		<div class="row">
			<div>
				<label for="contact_name"><?php esc_html_e( 'Name', 'katalyst' ); ?></label>
				<input id="contact_name" name="contact_name" type="text" required>
			</div>
			<div>
				<label for="contact_email"><?php esc_html_e( 'E-Mail', 'katalyst' ); ?></label>
				<input id="contact_email" name="contact_email" type="email" required>
			</div>
		</div>
		<div>
			<label for="contact_organization"><?php esc_html_e( 'Organisation (optional)', 'katalyst' ); ?></label>
			<input id="contact_organization" name="contact_organization" type="text">
		</div>
		<div style="margin-top:14px;">
			<label for="contact_message"><?php esc_html_e( 'Nachricht', 'katalyst' ); ?></label>
			<textarea id="contact_message" name="contact_message" required></textarea>
		</div>
		<div class="cta-row">
			<button type="submit" class="btn primary"><?php esc_html_e( 'Senden', 'katalyst' ); ?> <span class="arr">→</span></button>
		</div>
	</form>
	<?php

	return (string) ob_get_clean();
}
add_shortcode( 'katalyst_contact_form', 'katalyst_contact_form_shortcode' );

define( 'KATALYST_SEED_VERSION', '1.3' );

/**
 * Run theme seeding on activation and on every request until the seed version
 * matches, so existing installs get the same setup as fresh ones.
 *
 * Uses a versioned option flag so the seed only re-runs when the theme ships
 * a new seed version, not on every page load.
 * Only persists the version when seeding actually produced a usable nav post.
 */
function katalyst_maybe_seed(): void {
	if ( get_option( 'katalyst_seed_version' ) === KATALYST_SEED_VERSION ) {
		return;
	}
	katalyst_seed_front_page();
	$nav_id  = katalyst_seed_navigation();
	$wired   = $nav_id ? katalyst_seed_header_template_part( $nav_id ) : false;
	if ( $nav_id && $wired ) {
		update_option( 'katalyst_seed_version', KATALYST_SEED_VERSION );
	}
}
add_action( 'after_switch_theme', 'katalyst_maybe_seed' );
add_action( 'init', 'katalyst_maybe_seed' );

/**
 * Build expanded block HTML from pattern files.
 */
function katalyst_build_homepage_content(): string {
	$patterns_dir = get_template_directory() . '/patterns/';
	$order        = array( 'hero', 'about', 'pillars', 'components', 'research', 'news', 'partners', 'contact' );
	$parts        = array();

	foreach ( $order as $slug ) {
		$file = $patterns_dir . $slug . '.php';
		if ( ! file_exists( $file ) ) {
			continue;
		}
		$raw     = file_get_contents( $file ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		$raw     = preg_replace( '/\<\?php.*?\?\>/s', '', $raw );
		$parts[] = trim( $raw );
	}

	return implode( "\n\n", $parts );
}

/**
 * Create or repair the static front page with inline block HTML.
 * Only updates if the page still contains wp:pattern references (frozen content).
 */
function katalyst_seed_front_page(): void {
	$content       = katalyst_build_homepage_content();
	$front_page_id = (int) get_option( 'page_on_front' );

	if ( $front_page_id ) {
		wp_update_post( array(
			'ID'           => $front_page_id,
			'post_content' => $content,
		) );
		return;
	}

	if ( empty( $content ) ) {
		return;
	}

	$page_id = wp_insert_post( array(
		'post_title'   => 'Home',
		'post_content' => $content,
		'post_status'  => 'publish',
		'post_type'    => 'page',
	) );

	if ( $page_id && ! is_wp_error( $page_id ) ) {
		update_option( 'page_on_front', $page_id );
		update_option( 'show_on_front', 'page' );
	}
}

/**
 * Create the primary navigation post with starter anchor links if none exists.
 * Returns the wp_navigation post ID on success, 0 on failure.
 *
 * Does NOT mutate theme files. Navigation wiring is handled via a DB
 * wp_template_part override in katalyst_seed_header_template_part().
 */
function katalyst_seed_navigation(): int {
	$stored_id = (int) get_option( 'katalyst_nav_id' );
	if ( $stored_id ) {
		$post = get_post( $stored_id );
		if ( $post && 'wp_navigation' === $post->post_type && 'publish' === $post->post_status ) {
			return $stored_id;
		}
	}

	$existing = get_posts( array(
		'post_type'      => 'wp_navigation',
		'post_status'    => 'publish',
		'posts_per_page' => 1,
		'title'          => 'Primary Navigation',
	) );

	$nav_content = implode( "\n", array(
		'<!-- wp:navigation-link {"label":"Projekt","url":"/#projekt","kind":"custom","isTopLevelLink":true} /-->',
		'<!-- wp:navigation-link {"label":"Plattform","url":"/#plattform","kind":"custom","isTopLevelLink":true} /-->',
		'<!-- wp:navigation-link {"label":"Forschung","url":"/#forschung","kind":"custom","isTopLevelLink":true} /-->',
		'<!-- wp:navigation-link {"label":"News","url":"/#news","kind":"custom","isTopLevelLink":true} /-->',
		'<!-- wp:navigation-link {"label":"Kontakt","url":"/#kontakt","kind":"custom","isTopLevelLink":true} /-->',
	) );

	if ( ! empty( $existing ) ) {
		$nav_id = $existing[0]->ID;
		if ( str_contains( $existing[0]->post_content, 'wp:page-list' ) ) {
			wp_update_post( array(
				'ID'           => $nav_id,
				'post_content' => $nav_content,
			) );
		}
		update_option( 'katalyst_nav_id', $nav_id );
		return $nav_id;
	}

	$nav_id = wp_insert_post( array(
		'post_title'   => 'Primary Navigation',
		'post_content' => $nav_content,
		'post_status'  => 'publish',
		'post_type'    => 'wp_navigation',
	) );

	if ( $nav_id && ! is_wp_error( $nav_id ) ) {
		update_option( 'katalyst_nav_id', (int) $nav_id );
		return (int) $nav_id;
	}

	return 0;
}

/**
 * Create or update the header wp_template_part DB record so the navigation
 * block references the correct wp_navigation post ID via `ref`.
 *
 * WordPress uses the DB record over the theme file when both exist.
 * Area is registered via the wp_template_part_area taxonomy (core-native).
 * Lookup is by post_name + wp_theme taxonomy to avoid duplicates.
 *
 * @param int $nav_id The wp_navigation post ID to wire into the header.
 * @return bool True on success (record exists and has correct ref), false otherwise.
 */
function katalyst_seed_header_template_part( int $nav_id ): bool {
	$theme     = get_stylesheet();
	$nav_block = '<!-- wp:navigation {"ref":' . $nav_id . ',"overlayMenu":"mobile","className":"nav-menu","layout":{"type":"flex","justifyContent":"left","orientation":"horizontal"}} /-->';

	$header_file  = get_template_directory() . '/parts/header.html';
	$file_content = file_exists( $header_file )
		? file_get_contents( $header_file ) // phpcs:ignore WordPress.WP.AlternativeFunctions
		: '';

	$new_content = (string) preg_replace(
		'/<!--\s*wp:navigation\s*\{.*?\}\s*\/-->/s',
		$nav_block,
		$file_content
	);
	if ( ! $new_content || ! str_contains( $new_content, '"ref":' . $nav_id ) ) {
		return false;
	}

	$existing = get_posts( array(
		'post_type'      => 'wp_template_part',
		'post_status'    => 'publish',
		'posts_per_page' => 1,
		'name'           => 'header',
		'tax_query'      => array(
			array(
				'taxonomy' => 'wp_theme',
				'field'    => 'slug',
				'terms'    => $theme,
			),
		),
	) );

	if ( ! empty( $existing ) ) {
		$part         = $existing[0];
		$part_content = $part->post_content;

		$area_terms = wp_get_object_terms( $part->ID, 'wp_template_part_area', array( 'fields' => 'slugs' ) );
		$needs_area = is_wp_error( $area_terms ) || ! in_array( 'header', (array) $area_terms, true );
		if ( $needs_area ) {
			$area_fix = wp_set_object_terms( $part->ID, 'header', 'wp_template_part_area' );
			if ( is_wp_error( $area_fix ) ) {
				return false;
			}
		}

		if ( str_contains( $part_content, '"ref":' . $nav_id ) ) {
			return true;
		}
		$updated = (string) preg_replace(
			'/<!--\s*wp:navigation\s*\{.*?\}\s*\/-->/s',
			$nav_block,
			$part_content
		);
		if ( $updated && $updated !== $part_content && str_contains( $updated, '"ref":' . $nav_id ) ) {
			$result = wp_update_post( array(
				'ID'           => $part->ID,
				'post_content' => $updated,
			) );
			return $result && ! is_wp_error( $result );
		}
		return false;
	}

	$part_id = wp_insert_post( array(
		'post_title'   => 'Header',
		'post_name'    => 'header',
		'post_content' => $new_content,
		'post_status'  => 'publish',
		'post_type'    => 'wp_template_part',
	) );

	if ( ! $part_id || is_wp_error( $part_id ) ) {
		return false;
	}

	$theme_result = wp_set_object_terms( $part_id, $theme, 'wp_theme' );
	$area_result  = wp_set_object_terms( $part_id, 'header', 'wp_template_part_area' );

	return ! is_wp_error( $theme_result ) && ! is_wp_error( $area_result ) && str_contains( $new_content, '"ref":' . $nav_id );
}
