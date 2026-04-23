<?php
/**
 * Render helpers for complex theme sections.
 *
 * @package Katalyst
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render the Katalyst logo motif.
 */
function katalyst_render_logo(): void {
	?>
	<span class="logo" aria-hidden="true"><span class="s1"></span><span class="s2"></span><span class="s3"></span><span class="s4"></span></span>
	<?php
}

/**
 * Render common section heading.
 *
 * @param string $number Number label.
 * @param string $title  Section title.
 * @param string $subtitle Subtitle.
 * @param bool   $dark   Dark mode.
 */
function katalyst_render_section_header( string $number, string $title, string $subtitle = '', bool $dark = false ): void {
	?>
	<div class="s-head reveal-up<?php echo $dark ? ' dark' : ''; ?>">
		<span class="s-num"><?php echo esc_html( $number ); ?></span>
		<h2 class="s-h"><?php echo esc_html( $title ); ?></h2>
		<span class="s-line"></span>
	</div>
	<?php if ( $subtitle ) : ?>
		<p class="s-sub reveal-up"><?php echo esc_html( $subtitle ); ?></p>
	<?php endif; ?>
	<?php
}
