<?php
/**
 * Components section.
 *
 * @package Katalyst
 */

$components = katalyst_data( 'components' );
?>
<section class="cs" id="plattform">
	<?php katalyst_render_section_header( '03 · Plattform', __( 'Sechs Komponenten. Modular kombinierbar.', 'katalyst' ), __( 'Jede Komponente adressiert eine konkrete Herausforderung der Hochschullehre — einzeln nutzbar, im Zusammenspiel stark.', 'katalyst' ) ); ?>
	<div class="comps reveal-up">
		<?php foreach ( $components as $component ) : ?>
			<a class="comp" href="<?php echo esc_url( home_url( '/#plattform' ) ); ?>">
				<div class="topline"><span class="cat"><?php echo esc_html( $component['category'] ); ?></span><span class="mk <?php echo esc_attr( $component['marker'] ); ?>"></span></div>
				<h3><?php echo esc_html( $component['title'] ); ?></h3>
				<p class="lede-s"><?php echo esc_html( $component['body'] ); ?></p>
				<div class="reveal"><div class="chips"><?php foreach ( $component['chips'] as $chip ) : ?><span><?php echo esc_html( $chip ); ?></span><?php endforeach; ?></div></div>
				<span class="go"><?php esc_html_e( 'mehr erfahren', 'katalyst' ); ?> <span class="arr">→</span></span>
			</a>
		<?php endforeach; ?>
	</div>
</section>
