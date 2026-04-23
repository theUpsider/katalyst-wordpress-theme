<?php
/**
 * Site header partial.
 *
 * @package Katalyst
 */

$nav_items = katalyst_get_navigation_items();
?>
<header class="nav">
	<div class="nav-inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand" aria-label="<?php esc_attr_e( 'Katalyst home', 'katalyst' ); ?>">
			<?php katalyst_render_logo(); ?>
			<span><?php bloginfo( 'name' ); ?></span>
		</a>
		<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-menu">
			<span></span><span></span>
		</button>
		<nav class="nav-menu" id="site-menu" aria-label="<?php esc_attr_e( 'Primary Navigation', 'katalyst' ); ?>">
			<?php foreach ( $nav_items as $item ) : ?>
				<a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
			<?php endforeach; ?>
		</nav>
		<div class="nav-right">
			<div class="lang" aria-hidden="true"><span class="on">DE</span><span>EN</span></div>
			<a href="<?php echo esc_url( home_url( '/#kontakt' ) ); ?>" class="btn primary"><?php esc_html_e( 'Kontakt', 'katalyst' ); ?> <span class="arr">→</span></a>
		</div>
	</div>
</header>
