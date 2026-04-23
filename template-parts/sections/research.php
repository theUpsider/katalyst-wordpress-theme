<?php
/**
 * Research section.
 *
 * @package Katalyst
 */

$research = katalyst_data( 'research' );
?>
<section class="cs bordered dark" id="forschung"><div class="inner">
	<?php katalyst_render_section_header( '04 · Forschung', __( 'Worauf wir Antworten suchen.', 'katalyst' ), '', true ); ?>
	<div class="qgrid reveal-up">
		<?php foreach ( $research as $question ) : ?>
			<div class="q"><span class="qn"><?php echo esc_html( $question['label'] ); ?></span><div><h4><?php echo esc_html( $question['title'] ); ?></h4><p><?php echo esc_html( $question['body'] ); ?></p></div></div>
		<?php endforeach; ?>
	</div>
</div></section>
