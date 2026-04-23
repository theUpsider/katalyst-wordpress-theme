<?php
/**
 * Header template.
 *
 * @package Katalyst
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php
if ( function_exists( 'block_template_part' ) ) {
	block_template_part( 'header' );
} else {
	get_template_part( 'template-parts/site', 'header' );
}
