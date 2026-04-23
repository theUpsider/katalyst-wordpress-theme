<?php
/**
 * Main fallback template.
 *
 * @package Katalyst
 */

get_header();

if ( have_posts() ) {
	if ( is_home() && ! is_front_page() ) {
		?>
		<section class="page-shell page-shell--archive">
			<div class="page-head reveal-up">
				<p class="mono"><?php esc_html_e( 'Newsroom', 'katalyst' ); ?></p>
				<h1><?php single_post_title(); ?></h1>
			</div>
			<div class="post-grid">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content/post-card' );
				}
				?>
			</div>
		</section>
		<?php
	} else {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content/page-content' );
		}
	}
} else {
	get_template_part( 'template-parts/content/none' );
}

get_footer();
