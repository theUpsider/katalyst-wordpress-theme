<?php
/**
 * Blog index.
 *
 * @package Katalyst
 */

get_header();
?>
<section class="page-shell page-shell--archive">
	<div class="page-head reveal-up">
		<p class="mono"><?php esc_html_e( 'Aktuelles', 'katalyst' ); ?></p>
		<h1><?php echo esc_html( get_the_title( get_option( 'page_for_posts' ) ) ?: __( 'Aus dem Projekt', 'katalyst' ) ); ?></h1>
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
	<?php the_posts_pagination( array( 'prev_text' => __( 'Zurück', 'katalyst' ), 'next_text' => __( 'Weiter', 'katalyst' ) ) ); ?>
</section>
<?php
get_footer();
