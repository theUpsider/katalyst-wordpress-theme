<?php
/**
 * Page content partial.
 *
 * @package Katalyst
 */
?>
<article <?php post_class( 'entry-shell reveal-up' ); ?>>
	<p class="mono"><?php esc_html_e( 'Seite', 'katalyst' ); ?></p>
	<h1 class="entry-title"><?php the_title(); ?></h1>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>
