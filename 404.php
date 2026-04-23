<?php
/**
 * 404 template.
 *
 * @package Katalyst
 */

get_header();
?>
<section class="page-shell page-shell--404">
	<div class="entry-shell reveal-up centered">
		<p class="mono">404</p>
		<h1><?php esc_html_e( 'Diese Seite existiert nicht mehr.', 'katalyst' ); ?></h1>
		<p><?php esc_html_e( 'Nutzen Sie die Startseite oder suchen Sie nach einem Beitrag aus dem Projekt.', 'katalyst' ); ?></p>
		<div class="cta-row center">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn primary"><?php esc_html_e( 'Zur Startseite', 'katalyst' ); ?> <span class="arr">→</span></a>
		</div>
		<div class="search-inline"><?php get_search_form(); ?></div>
	</div>
</section>
<?php
get_footer();
