<?php
/**
 * Template Name: Katalyst Narrative Chapters
 *
 * @package Katalyst
 */

get_header();
?>
<main class="chapter-layout">
	<?php while ( have_posts() ) : the_post(); ?>
		<section class="chapter-hero reveal-up">
			<h1><?php the_title(); ?></h1>
		</section>
		<section class="chapter-grid reveal-up">
			<article class="chapter-card intro"><?php the_content(); ?></article>
		</section>
	<?php endwhile; ?>
</main>
<?php
get_footer();
