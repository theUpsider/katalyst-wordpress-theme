<?php
/**
 * Post card partial.
 *
 * @package Katalyst
 */
?>
<article <?php post_class( 'entry-card reveal-up' ); ?>>
	<a href="<?php the_permalink(); ?>">
		<p class="mono"><?php echo esc_html( get_the_date() ); ?></p>
		<h2><?php the_title(); ?></h2>
		<p><?php echo esc_html( get_the_excerpt() ?: wp_trim_words( wp_strip_all_tags( get_the_content() ), 22 ) ); ?></p>
		<span class="go"><?php esc_html_e( 'weiterlesen', 'katalyst' ); ?> <span class="arr">→</span></span>
	</a>
</article>
