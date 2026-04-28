<?php
/**
 * Title: Katalyst Hero
 * Slug: katalyst/hero
 * Categories: katalyst-sections, featured, banner
 * Description: Editable hero section with intro copy, CTAs, stats, and recent posts.
 * Synced: false
 * Viewport Width: 1360
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"hero","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull hero">
	<!-- wp:group {"className":"hero-grid","layout":{"type":"grid","columnCount":2,"minimumColumnWidth":"24rem"}} -->
	<div class="wp-block-group hero-grid">
		<!-- wp:group {"className":"reveal-up","layout":{"type":"default"}} -->
		<div class="wp-block-group reveal-up">
			<!-- wp:group {"className":"eyebrow","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
			<div class="wp-block-group eyebrow">
				<!-- wp:html --><span class="dot"></span><!-- /wp:html -->
				<!-- wp:paragraph {"className":"mono"} -->
				<p class="mono">Forschungsprojekt · Hochschule Kempten · 2025 – 2028</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:heading {"level":1,"className":"headline"} -->
			<h1 class="headline">Hochschullehre<br>mit <span class="hl">generativer KI</span>:<br><span class="ul">nutzbar.</span> fair.<br><span class="tight">zukunftsfähig.</span></h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"lede"} -->
			<p class="lede">KATALYST entwickelt eine frei verfügbare Plattform für personalisiertes Lernen, effizientere Materialerstellung und moderne, transparente Prüfungsformate — datenschutzkonform, barrierearm, modular integrierbar.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"className":"cta-row"} -->
			<div class="wp-block-buttons cta-row">
				<!-- wp:button {"className":"btn primary"} -->
				<div class="wp-block-button btn primary"><a class="wp-block-button__link wp-element-button" href="#plattform">Plattform entdecken <span class="arr">→</span></a></div>
				<!-- /wp:button -->
				<!-- wp:button {"className":"btn"} -->
				<div class="wp-block-button btn"><a class="wp-block-button__link wp-element-button" href="#projekt">Über das Projekt</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->

			<!-- wp:group {"className":"hero-meta","layout":{"type":"grid","columnCount":4,"minimumColumnWidth":"9rem"}} -->
			<div class="wp-block-group hero-meta">
				<!-- wp:group {"className":"m","layout":{"type":"default"}} --><div class="wp-block-group m"><!-- wp:paragraph {"className":"k"} --><p class="k">Laufzeit</p><!-- /wp:paragraph --><!-- wp:paragraph {"className":"v"} --><p class="v">3 Jahre</p><!-- /wp:paragraph --></div><!-- /wp:group -->
				<!-- wp:group {"className":"m","layout":{"type":"default"}} --><div class="wp-block-group m"><!-- wp:paragraph {"className":"k"} --><p class="k">Plattform</p><!-- /wp:paragraph --><!-- wp:paragraph {"className":"v"} --><p class="v">modular</p><!-- /wp:paragraph --></div><!-- /wp:group -->
				<!-- wp:group {"className":"m","layout":{"type":"default"}} --><div class="wp-block-group m"><!-- wp:paragraph {"className":"k"} --><p class="k">Komponenten</p><!-- /wp:paragraph --><!-- wp:paragraph {"className":"v"} --><p class="v">6</p><!-- /wp:paragraph --></div><!-- /wp:group -->
				<!-- wp:group {"className":"m","layout":{"type":"default"}} --><div class="wp-block-group m"><!-- wp:paragraph {"className":"k"} --><p class="k">Zugang</p><!-- /wp:paragraph --><!-- wp:paragraph {"className":"v"} --><p class="v">frei</p><!-- /wp:paragraph --></div><!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"feed-wrap reveal-up","layout":{"type":"default"}} -->
		<div class="wp-block-group feed-wrap reveal-up">
			<!-- wp:group {"className":"feed","layout":{"type":"default"}} -->
			<div class="wp-block-group feed">
				<!-- wp:group {"className":"feed-head","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"nowrap","verticalAlignment":"center"}} -->
				<div class="wp-block-group feed-head"><!-- wp:html --><span class="pulse"></span><!-- /wp:html --><!-- wp:paragraph {"className":"title"} --><p class="title">Aus dem Projekt</p><!-- /wp:paragraph --><!-- wp:paragraph {"className":"tag"} --><p class="tag">live</p><!-- /wp:paragraph --></div>
				<!-- /wp:group -->

				<!-- wp:shortcode -->[katalyst_hero_feed]<!-- /wp:shortcode -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
