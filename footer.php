<?php
/**
 * Footer template.
 *
 * @package Katalyst
 */

if ( function_exists( 'block_template_part' ) ) {
	block_template_part( 'footer' );
} else {
	get_template_part( 'template-parts/site', 'footer' );
}
wp_footer();
?>
</body>
</html>
