<?php
/**
 * Template Name: Katalyst Narrative Chapters
 *
 * @package Katalyst
 */

get_header();
?>
<main class="chapter-layout">
	<section class="chapter-hero reveal-up"><p class="mono"><?php esc_html_e( 'Direction 03', 'katalyst' ); ?></p><h1><?php the_title(); ?></h1><p><?php esc_html_e( 'Ein erzählerischer Seitenaufbau für Manifest, Forschungsergebnisse oder ausführliche Landing Pages.', 'katalyst' ); ?></p></section>
	<section class="chapter-grid reveal-up"><article class="chapter-card intro"><?php the_content(); ?></article><article class="chapter-card alt"><h2><?php esc_html_e( 'Forschungsfragen', 'katalyst' ); ?></h2><ul><?php foreach ( katalyst_data( 'research' ) as $question ) : ?><li><strong><?php echo esc_html( $question['label'] ); ?></strong> <?php echo esc_html( $question['title'] ); ?></li><?php endforeach; ?></ul></article></section>
	<section class="chapter-grid reveal-up"><?php foreach ( array_slice( katalyst_data( 'components' ), 0, 4 ) as $component ) : ?><article class="chapter-card"><p class="mono"><?php echo esc_html( $component['category'] ); ?></p><h3><?php echo esc_html( $component['title'] ); ?></h3><p><?php echo esc_html( $component['body'] ); ?></p></article><?php endforeach; ?></section>
</main>
<?php
get_footer();
