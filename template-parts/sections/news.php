<?php
/**
 * News section.
 *
 * @package Katalyst
 */

$news  = katalyst_get_news_data();
$items = $news['items'];
?>
<section class="cs" id="news">
	<?php katalyst_render_section_header( '05 · Aktuelles', __( 'Aus dem Projekt.', 'katalyst' ) ); ?>
	<div class="news reveal-up">
		<article class="feat"><div class="placeholder ph">[ <?php esc_html_e( 'Titelbild', 'katalyst' ); ?> ]</div><div class="d"><?php echo esc_html( $news['featured']['date'] ); ?></div><h3><?php echo esc_html( $news['featured']['title'] ); ?></h3><p><?php echo esc_html( $news['featured']['body'] ); ?></p><a href="<?php echo esc_url( $news['featured']['url'] ); ?>" class="btn"><?php esc_html_e( 'weiterlesen', 'katalyst' ); ?> <span class="arr">→</span></a></article>
		<div class="col">
			<?php foreach ( array_slice( $items, 0, 3 ) as $item ) : ?>
				<a class="item" href="<?php echo esc_url( $item['url'] ); ?>"><div class="d"><?php echo esc_html( $item['date'] ); ?></div><h4><?php echo esc_html( $item['title'] ); ?></h4></a>
			<?php endforeach; ?>
		</div>
		<div class="col">
			<?php foreach ( array_slice( $items, 3 ) as $item ) : ?>
				<a class="item" href="<?php echo esc_url( $item['url'] ); ?>"><div class="d"><?php echo esc_html( $item['date'] ); ?></div><h4><?php echo esc_html( $item['title'] ); ?></h4></a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
