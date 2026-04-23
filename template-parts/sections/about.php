<?php
/**
 * About section.
 *
 * @package Katalyst
 */

$about = katalyst_data( 'about' );
?>
<section class="cs" id="projekt">
	<?php katalyst_render_section_header( '01 · Projekt', __( 'Was ist KATALYST?', 'katalyst' ) ); ?>
	<div class="about">
		<div class="reveal-up">
			<div class="big"><?php echo esc_html( $about['lead'] ); ?></div>
			<p><?php echo esc_html( $about['body'] ); ?></p>
			<div class="tags"><?php foreach ( $about['tags'] as $tag ) : ?><span class="tag"><?php echo esc_html( $tag ); ?></span><?php endforeach; ?></div>
		</div>
		<div class="reveal-up"><div class="placeholder" style="aspect-ratio:4/3">[ <?php esc_html_e( 'Abbildung · Projekt-Kontext', 'katalyst' ); ?> ]</div></div>
	</div>
</section>
