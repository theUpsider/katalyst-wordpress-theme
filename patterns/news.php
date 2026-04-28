<?php
/**
 * Title: Katalyst News Query
 * Slug: katalyst/news
 * Categories: katalyst-sections, query
 * Description: Dynamic news section powered by WordPress posts.
 * Synced: false
 * Viewport Width: 1360
 */
?>
<!-- wp:group {"tagName":"section","anchor":"news","className":"cs","layout":{"type":"default"}} -->
<section id="news" class="wp-block-group cs"><!-- wp:group {"className":"s-head reveal-up","layout":{"type":"flex","verticalAlignment":"center"}} --><div class="wp-block-group s-head reveal-up"><!-- wp:paragraph {"className":"s-num"} --><p class="s-num">05 · Aktuelles</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"s-h"} --><h2 class="s-h">Aus dem Projekt.</h2><!-- /wp:heading --><!-- wp:html --><span class="s-line"></span><!-- /wp:html --></div><!-- /wp:group --><!-- wp:query {"queryId":1,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"className":"post-grid news-query"} --><div class="wp-block-query post-grid news-query"><!-- wp:post-template --><!-- wp:group {"className":"entry-card reveal-up","layout":{"type":"default"}} --><div class="wp-block-group entry-card reveal-up"><!-- wp:post-date {"className":"mono"} /--><!-- wp:post-title {"level":3,"isLink":true} /--><!-- wp:post-excerpt {"moreText":""} /--><!-- wp:read-more {"content":"weiterlesen →","className":"go"} /--></div><!-- /wp:group --><!-- /wp:post-template --><!-- wp:query-no-results --><!-- wp:paragraph --><p>Veröffentlichen Sie Beiträge, um diesen Bereich automatisch zu füllen.</p><!-- /wp:paragraph --><!-- /wp:query-no-results --></div><!-- /wp:query --></section>
<!-- /wp:group -->
