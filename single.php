<?php
/**
 * Single post template.
 *
 * @package Katalyst
 */

get_header();
?>
<main class="page-shell page-shell--single">
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class( 'entry-shell' ); ?>>
			<p class="mono"><?php echo esc_html( get_the_date() ); ?></p>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-meta"><?php echo esc_html( get_the_author() ); ?></div>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="entry-media"><?php the_post_thumbnail( 'full' ); ?></div>
			<?php endif; ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; ?>
</main>
<?php
get_footer();
