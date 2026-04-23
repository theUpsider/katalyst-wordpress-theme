<?php
/**
 * Front page fallback template.
 *
 * @package Katalyst
 */

get_header();
?>
<main class="page-shell page-shell--editor-front">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	<?php endif; ?>
</main>
<?php
get_footer();
