<?php
/**
 * Pillars section.
 *
 * @package Katalyst
 */

$pillars = katalyst_data( 'pillars' );
?>
<section class="cs bordered" id="ansatz"><div class="inner">
	<?php katalyst_render_section_header( '02 · Ansatz', __( 'Drei Säulen. Eine Plattform.', 'katalyst' ) ); ?>
	<div class="pillars reveal-up">
		<?php foreach ( $pillars as $pillar ) : ?>
			<div class="pillar"><div class="mk <?php echo esc_attr( $pillar['marker'] ); ?>"></div><div class="pn"><?php echo esc_html( $pillar['label'] ); ?></div><h3><?php echo esc_html( $pillar['title'] ); ?></h3><p><?php echo esc_html( $pillar['body'] ); ?></p></div>
		<?php endforeach; ?>
	</div>
</div></section>
