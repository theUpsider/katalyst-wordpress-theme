<?php
/**
 * Template Name: Katalyst Dashboard Layout
 *
 * @package Katalyst
 */

get_header();
?>
<main class="dashboard-wrap">
	<section class="dashboard-shell reveal-up">
		<aside class="dashboard-side"><p class="mono"><?php esc_html_e( 'Direction 02', 'katalyst' ); ?></p><h1><?php the_title(); ?></h1><p><?php esc_html_e( 'Eine modulare Projektübersicht im Dashboard-Stil für Konsortium, Roadmap und Updates.', 'katalyst' ); ?></p><a class="btn primary" href="<?php echo esc_url( home_url( '/#kontakt' ) ); ?>"><?php esc_html_e( 'Kontakt aufnehmen', 'katalyst' ); ?></a></aside>
		<div class="dashboard-main">
			<div class="dashboard-hero"><div><p class="mono"><?php esc_html_e( 'Projektstatus', 'katalyst' ); ?></p><h2><?php esc_html_e( 'Alle Kernbereiche in einer klaren Arbeitsoberfläche.', 'katalyst' ); ?></h2><p><?php esc_html_e( 'Ideal für Stakeholder-Seiten, Projekt-Hubs oder redaktionelle Übersichten.', 'katalyst' ); ?></p></div><div class="dashboard-art"><span></span><span></span><span></span><span></span><span></span><span></span></div></div>
			<div class="dashboard-stats"><?php foreach ( katalyst_data( 'hero' )['stats'] as $stat ) : ?><div class="stat"><span><?php echo esc_html( $stat['label'] ); ?></span><strong><?php echo esc_html( $stat['value'] ); ?></strong></div><?php endforeach; ?></div>
			<div class="dashboard-grid"><?php foreach ( katalyst_data( 'components' ) as $component ) : ?><article class="dash-card"><p class="mono"><?php echo esc_html( $component['category'] ); ?></p><h3><?php echo esc_html( $component['title'] ); ?></h3><p><?php echo esc_html( $component['body'] ); ?></p></article><?php endforeach; ?></div>
		</div>
	</section>
</main>
<?php
get_footer();
