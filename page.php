<?php
/**
 * Page template.
 *
 * @package Katalyst
 */

get_header();
?>
<main class="page-shell">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content/page-content' ); ?>
		<?php endwhile; ?>
	<?php endif; ?>
</main>
<?php
get_footer();
