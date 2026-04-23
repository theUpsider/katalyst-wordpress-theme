<?php
/**
 * Search template.
 *
 * @package Katalyst
 */

get_header();
?>
<section class="page-shell page-shell--archive">
	<div class="page-head reveal-up">
		<p class="mono"><?php esc_html_e( 'Suche', 'katalyst' ); ?></p>
		<h1><?php printf( esc_html__( 'Ergebnisse für „%s“', 'katalyst' ), get_search_query() ); ?></h1>
		<div class="search-inline"><?php get_search_form(); ?></div>
	</div>
	<div class="post-grid">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content/post-card' ); ?>
			<?php endwhile; ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content/none' ); ?>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
