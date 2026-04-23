<?php
/**
 * Hero section.
 *
 * @package Katalyst
 */

$hero = katalyst_data( 'hero' );
$feed = katalyst_get_feed_items();
?>
<section class="hero">
	<div class="hero-grid">
		<div class="reveal-up">
			<div class="eyebrow"><span class="dot"></span><span class="mono"><?php echo esc_html( $hero['eyebrow'] ); ?></span></div>
			<h1 class="headline"><?php esc_html_e( 'Hochschullehre', 'katalyst' ); ?><br><?php esc_html_e( 'mit', 'katalyst' ); ?> <span class="hl"><?php esc_html_e( 'generativer KI', 'katalyst' ); ?></span>:<br><span class="ul"><?php esc_html_e( 'nutzbar.', 'katalyst' ); ?></span> <?php esc_html_e( 'fair.', 'katalyst' ); ?><br><span class="tight"><?php esc_html_e( 'zukunftsfähig.', 'katalyst' ); ?></span></h1>
			<p class="lede"><?php echo esc_html( $hero['lede'] ); ?></p>
			<div class="cta-row">
				<a href="<?php echo esc_url( home_url( '/#plattform' ) ); ?>" class="btn primary"><?php esc_html_e( 'Plattform entdecken', 'katalyst' ); ?> <span class="arr">→</span></a>
				<a href="<?php echo esc_url( home_url( '/#projekt' ) ); ?>" class="btn"><?php esc_html_e( 'Über das Projekt', 'katalyst' ); ?></a>
			</div>
			<div class="hero-meta">
				<?php foreach ( $hero['stats'] as $stat ) : ?>
					<div class="m"><div class="k"><?php echo esc_html( $stat['label'] ); ?></div><div class="v"><?php echo esc_html( $stat['value'] ); ?></div></div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="feed-wrap reveal-up">
			<div class="shapes" aria-hidden="true"><span class="sh q s1"></span><span class="sh q s2"></span><span class="sh qc s3"></span><span class="sh qc s4"></span></div>
			<div class="feed">
				<div class="feed-head"><span class="pulse"></span><span class="title"><?php esc_html_e( 'Aus dem Projekt', 'katalyst' ); ?></span><span class="tag">live</span></div>
				<div class="filter" role="tablist">
					<button class="chip on" data-f="all">alle</button>
					<button class="chip" data-f="news">news</button>
					<button class="chip" data-f="blog">blog</button>
					<button class="chip" data-f="event">events</button>
					<button class="chip" data-f="publ">publikationen</button>
				</div>
				<div class="feed-items">
					<?php foreach ( $feed as $item ) : ?>
						<a class="feed-item<?php echo ! empty( $item['featured'] ) ? ' feat' : ''; ?>" data-cat="<?php echo esc_attr( $item['type'] ); ?>" href="<?php echo esc_url( $item['url'] ); ?>">
							<div class="d"><span class="day"><?php echo esc_html( $item['day'] ); ?></span><?php echo esc_html( $item['month'] ); ?></div>
							<div><div class="type <?php echo esc_attr( $item['type'] ); ?>"><span class="tk"></span><?php echo esc_html( $item['type'] ); ?></div><div class="t"><?php echo esc_html( $item['title'] ); ?></div></div>
							<div class="arr">→</div>
						</a>
					<?php endforeach; ?>
				</div>
				<div class="feed-foot"><a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ?: home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Alle Beiträge', 'katalyst' ); ?> <span>→</span></a><div class="dots"><span class="on"></span><span></span><span></span></div></div>
			</div>
		</div>
	</div>
</section>
