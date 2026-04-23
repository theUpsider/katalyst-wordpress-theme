<?php
/**
 * Template Name: Katalyst Dashboard Layout
 *
 * @package Katalyst
 */

get_header();
?>
<main class="dashboard-wrap">
	<?php while ( have_posts() ) : the_post(); ?>
		<section class="dashboard-shell reveal-up">
			<div class="dashboard-main entry-shell">
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</div>
		</section>
	<?php endwhile; ?>
</main>
<?php
get_footer();
