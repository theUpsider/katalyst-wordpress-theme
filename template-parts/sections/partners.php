<?php
/**
 * Partners section.
 *
 * @package Katalyst
 */

$partners = katalyst_data( 'partners' );
?>
<section class="cs bordered" id="partner"><div class="inner">
	<?php katalyst_render_section_header( '06 · Partner', __( 'Wer KATALYST möglich macht.', 'katalyst' ) ); ?>
	<div class="partners reveal-up"><?php foreach ( $partners as $partner ) : ?><div class="p"><?php echo esc_html( $partner ); ?></div><?php endforeach; ?></div>
	<div class="funder reveal-up"><div class="placeholder ph">Stiftung-Logo</div><div class="t"><div class="k"><?php esc_html_e( 'Förderung', 'katalyst' ); ?></div><h3><?php esc_html_e( 'Gefördert von der Stiftung Innovation in der Hochschullehre', 'katalyst' ); ?></h3><a href="https://stiftung-hochschullehre.de/" target="_blank" rel="noopener">stiftung-hochschullehre.de ↗</a></div><a href="https://stiftung-hochschullehre.de/" target="_blank" rel="noopener" class="btn"><?php esc_html_e( 'Zur Förderseite', 'katalyst' ); ?> <span class="arr">→</span></a></div>
</div></section>
