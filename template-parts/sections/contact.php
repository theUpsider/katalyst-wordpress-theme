<?php
/**
 * Contact section.
 *
 * @package Katalyst
 */

$contact = katalyst_data( 'contact' );
$status  = katalyst_get_contact_status();
?>
<section class="cs" id="kontakt">
	<?php katalyst_render_section_header( '07 · Kontakt', __( 'Mitreden. Mitbauen.', 'katalyst' ) ); ?>
	<div class="contact">
		<div class="reveal-up"><div class="big"><?php echo esc_html( $contact['lead'] ); ?></div><?php foreach ( $contact['lines'] as $line ) : ?><div class="line"><span class="mk <?php echo esc_attr( $line['marker'] ); ?>"></span><span><?php echo esc_html( $line['text'] ); ?></span><span class="l"><?php echo esc_html( $line['label'] ); ?></span></div><?php endforeach; ?></div>
		<form class="form reveal-up" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php if ( 'success' === $status ) : ?><div class="notice-banner success"><?php esc_html_e( 'Danke. Ihre Nachricht wurde gesendet.', 'katalyst' ); ?></div><?php elseif ( 'error' === $status || 'invalid' === $status ) : ?><div class="notice-banner error"><?php esc_html_e( 'Bitte prüfen Sie Ihre Angaben und versuchen Sie es erneut.', 'katalyst' ); ?></div><?php endif; ?>
			<input type="hidden" name="action" value="katalyst_contact">
			<?php wp_nonce_field( 'katalyst_contact_form', 'katalyst_contact_nonce' ); ?>
			<div class="row"><div><label for="contact_name"><?php esc_html_e( 'Name', 'katalyst' ); ?></label><input id="contact_name" name="contact_name" type="text" required></div><div><label for="contact_email"><?php esc_html_e( 'E-Mail', 'katalyst' ); ?></label><input id="contact_email" name="contact_email" type="email" required></div></div>
			<div><label for="contact_organization"><?php esc_html_e( 'Organisation (optional)', 'katalyst' ); ?></label><input id="contact_organization" name="contact_organization" type="text"></div>
			<div style="margin-top:14px;"><label for="contact_message"><?php esc_html_e( 'Nachricht', 'katalyst' ); ?></label><textarea id="contact_message" name="contact_message" required></textarea></div>
			<div class="cta-row"><button type="submit" class="btn primary"><?php esc_html_e( 'Senden', 'katalyst' ); ?> <span class="arr">→</span></button></div>
		</form>
	</div>
</section>
