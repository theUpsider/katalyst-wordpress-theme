<?php
/**
 * Search form.
 *
 * @package Katalyst
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Suche nach:', 'katalyst' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr__( 'Suche …', 'katalyst' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	</label>
	<button type="submit" class="btn primary"><?php esc_html_e( 'Suchen', 'katalyst' ); ?></button>
</form>
