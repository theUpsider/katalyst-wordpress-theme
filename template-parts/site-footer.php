<?php
/**
 * Site footer partial.
 *
 * @package Katalyst
 */

$footer = katalyst_data( 'footer' );
$nav    = katalyst_data( 'nav' );
?>
<footer>
	<div class="foot-shape" aria-hidden="true"><div class="a"></div><div class="b"></div><div class="c"></div><div class="d"></div></div>
	<div class="foot-inner">
		<div class="foot-top">
			<div class="foot-brand">
				<div class="wm"><?php bloginfo( 'name' ); ?></div>
				<p><?php echo esc_html( $footer['text'] ); ?></p>
			</div>
			<div class="foot-col">
				<h5><?php esc_html_e( 'Projekt', 'katalyst' ); ?></h5>
				<?php foreach ( $nav as $item ) : ?>
					<a href="<?php echo esc_url( home_url( '/#' . $item['anchor'] ) ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
				<?php endforeach; ?>
			</div>
			<div class="foot-col">
				<h5><?php esc_html_e( 'Plattform', 'katalyst' ); ?></h5>
				<?php foreach ( katalyst_data( 'components' ) as $component ) : ?>
					<a href="<?php echo esc_url( home_url( '/#plattform' ) ); ?>"><?php echo esc_html( $component['title'] ); ?></a>
				<?php endforeach; ?>
			</div>
			<div class="foot-col">
				<h5><?php esc_html_e( 'Kontakt', 'katalyst' ); ?></h5>
				<a href="mailto:projekt@katalyst-education.de">projekt@katalyst-education.de</a>
				<a href="https://stiftung-hochschullehre.de/" target="_blank" rel="noopener"><?php esc_html_e( 'Förderung ↗', 'katalyst' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/#kontakt' ) ); ?>"><?php esc_html_e( 'Presse', 'katalyst' ); ?></a>
			</div>
		</div>
		<div class="foot-bottom">
			<span><?php echo esc_html( sprintf( __( '© %s KATALYST · Hochschule Kempten', 'katalyst' ), gmdate( 'Y' ) ) ); ?></span>
			<span class="sp"></span>
			<?php foreach ( $footer['legal'] as $legal ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $legal ); ?></a>
			<?php endforeach; ?>
		</div>
	</div>
</footer>
