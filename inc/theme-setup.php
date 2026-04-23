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

	add_editor_style( 'assets/css/theme.css' );
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
