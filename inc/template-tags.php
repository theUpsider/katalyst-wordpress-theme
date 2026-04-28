<?php
/**
 * Theme helper functions.
 *
 * @package Katalyst
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get an item from static theme data.
 *
 * @param string $key Data key.
 * @return mixed
 */
function katalyst_data( string $key ) {
	$data = katalyst_get_theme_data();

	return $data[ $key ] ?? array();
}

/**
 * Get asset URL.
 *
 * @param string $path Relative asset path.
 */
function katalyst_asset_url( string $path ): string {
	return esc_url( trailingslashit( get_template_directory_uri() ) . ltrim( $path, '/' ) );
}

/**
 * Get home section URL.
 *
 * @param string $anchor Anchor ID.
 */
function katalyst_section_url( string $anchor ): string {
	return esc_url( home_url( '/#' . ltrim( $anchor, '#' ) ) );
}

/**
 * Return header navigation items.
 *
 * @return array<int,array<string,string>>
 */
function katalyst_get_navigation_items(): array {
	if ( has_nav_menu( 'primary' ) ) {
		$locations = get_nav_menu_locations();
		$menu_id   = $locations['primary'] ?? 0;
		$items     = wp_get_nav_menu_items( $menu_id );

		if ( $items ) {
			return array_map(
				static function ( $item ): array {
					return array(
						'label' => $item->title,
						'url'   => $item->url,
					);
				},
				$items
			);
		}
	}

	return array_map(
		static function ( array $item ): array {
			return array(
				'label' => $item['label'],
				'url'   => katalyst_section_url( $item['anchor'] ),
			);
		},
		katalyst_data( 'nav' )
	);
}

/**
 * Return recent items for the hero feed.
 *
 * @param int $limit Number of items.
 * @return array<int,array<string,string|bool>>
 */
function katalyst_get_feed_items( int $limit = 4 ): array {
	$items = array();

	$posts = get_posts(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => $limit,
			'ignore_sticky_posts' => true,
		)
	);

	foreach ( $posts as $index => $post ) {
		$terms = get_the_category( $post->ID );
		$type  = $terms ? strtolower( $terms[0]->name ) : 'news';

		$items[] = array(
			'day'      => get_the_date( 'd', $post ),
			'month'    => get_the_date( 'M · y', $post ),
			'type'     => $type,
			'title'    => get_the_title( $post ),
			'url'      => get_permalink( $post ),
			'featured' => 0 === $index,
		);
	}

	if ( $items ) {
		return $items;
	}

	$fallback = katalyst_data( 'feed' );

	return array_map(
		static function ( array $item, int $index ): array {
			$item['url']      = home_url( '/blog/' );
			$item['featured'] = 0 === $index;

			return $item;
		},
		$fallback,
		array_keys( $fallback )
	);
}

/**
 * Return news cards.
 *
 * @param int $limit Number of posts.
 * @return array<string,mixed>
 */
function katalyst_get_news_data( int $limit = 7 ): array {
	$posts = get_posts(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => $limit,
			'ignore_sticky_posts' => true,
		)
	);

	if ( $posts ) {
		$featured = array_shift( $posts );
		$items    = array_map(
			static function ( WP_Post $post ): array {
				return array(
					'date' => get_the_date( 'd. M Y', $post ) . ' · ' . ucfirst( get_post_type( $post ) ),
					'title' => get_the_title( $post ),
					'url'  => get_permalink( $post ),
				);
			},
			$posts
		);

		return array(
			'featured' => array(
				'date' => get_the_date( 'd. M Y', $featured ) . ' · ' . ucfirst( get_post_type( $featured ) ),
				'title' => get_the_title( $featured ),
				'body' => get_the_excerpt( $featured ) ?: wp_trim_words( wp_strip_all_tags( $featured->post_content ), 24 ),
				'url' => get_permalink( $featured ),
			),
			'items' => $items,
		);
	}

	$data               = katalyst_data( 'news' );
	$data['featured']['url'] = home_url( '/blog/' );
	$data['items']      = array_map(
		static function ( array $item ): array {
			$item['url'] = home_url( '/blog/' );

			return $item;
		},
		$data['items']
	);

	return $data;
}

/**
 * Render the hero feed widget (chip filter + feed items).
 *
 * Used via [katalyst_hero_feed] shortcode so the seeded block page can include
 * dynamic, server-side rendered output inside a wp:shortcode block.
 *
 * @return string HTML output.
 */
function katalyst_hero_feed_shortcode(): string {
	$feed = katalyst_get_feed_items();
	ob_start();
	?>
	<div class="filter" role="tablist">
		<button class="chip on" data-f="all">alle</button>
		<button class="chip" data-f="news">news</button>
		<button class="chip" data-f="blog">blog</button>
		<button class="chip" data-f="event">events</button>
		<button class="chip" data-f="publ">publikationen</button>
	</div>
	<div class="feed-items">
		<?php foreach ( $feed as $item ) : ?>
			<a class="feed-item<?php echo ! empty( $item['featured'] ) ? ' feat' : ''; ?>"
			   data-cat="<?php echo esc_attr( $item['type'] ); ?>"
			   href="<?php echo esc_url( $item['url'] ); ?>">
				<div class="d"><span class="day"><?php echo esc_html( $item['day'] ); ?></span><?php echo esc_html( $item['month'] ); ?></div>
				<div>
					<div class="type <?php echo esc_attr( $item['type'] ); ?>"><span class="tk"></span><?php echo esc_html( $item['type'] ); ?></div>
					<div class="t"><?php echo esc_html( $item['title'] ); ?></div>
				</div>
				<div class="arr">→</div>
			</a>
		<?php endforeach; ?>
	</div>
	<?php
	return (string) ob_get_clean();
}
add_shortcode( 'katalyst_hero_feed', 'katalyst_hero_feed_shortcode' );

/**
 * Check contact response status.
 */
function katalyst_get_contact_status(): string {
	$status = isset( $_GET['contact-status'] ) ? sanitize_key( wp_unslash( $_GET['contact-status'] ) ) : '';

	return in_array( $status, array( 'success', 'error', 'invalid' ), true ) ? $status : '';
}
