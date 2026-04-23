<?php
/**
 * Front page template.
 *
 * @package Katalyst
 */

get_header();
get_template_part( 'template-parts/sections/hero' );
get_template_part( 'template-parts/sections/about' );
get_template_part( 'template-parts/sections/pillars' );
get_template_part( 'template-parts/sections/components' );
get_template_part( 'template-parts/sections/research' );
get_template_part( 'template-parts/sections/news' );
get_template_part( 'template-parts/sections/partners' );
get_template_part( 'template-parts/sections/contact' );
get_footer();
