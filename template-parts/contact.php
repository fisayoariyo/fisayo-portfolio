<?php
/**
 * Contact section.
 *
 * @package Fisayo_Portfolio
 */

$email    = fisayo_portfolio_mod( 'fisayo_contact_email', '' );
$github   = fisayo_portfolio_mod( 'fisayo_contact_github', 'https://github.com/fisayoariyo' );
$linkedin = fisayo_portfolio_mod( 'fisayo_contact_linkedin', '' );
$twitter  = fisayo_portfolio_mod( 'fisayo_contact_twitter', '' );
?>
<section class="contact section" id="contact">
	<div class="container contact__inner">
		<div class="section-head reveal">
			<p class="section-head__label"><?php esc_html_e( 'Contact', 'fisayo-portfolio' ); ?></p>
			<h2 class="section-head__title"><?php esc_html_e( 'Let\'s Build Something Together', 'fisayo-portfolio' ); ?></h2>
			<p class="section-head__desc"><?php esc_html_e( 'Open to freelance projects, collaborations, and full-time opportunities.', 'fisayo-portfolio' ); ?></p>
		</div>

		<div class="contact__links reveal">
			<?php if ( $email ) : ?>
				<a href="mailto:<?php echo esc_attr( $email ); ?>" class="contact__link contact__link--primary">
					<span class="contact__link-label"><?php esc_html_e( 'Email', 'fisayo-portfolio' ); ?></span>
					<span class="contact__link-value"><?php echo esc_html( $email ); ?></span>
				</a>
			<?php endif; ?>
			<?php if ( $github ) : ?>
				<a href="<?php echo esc_url( $github ); ?>" class="contact__link" target="_blank" rel="noopener noreferrer">
					<span class="contact__link-label">GitHub</span>
					<span class="contact__link-value"><?php echo esc_html( preg_replace( '#^https?://(www\.)?#', '', $github ) ); ?></span>
				</a>
			<?php endif; ?>
			<?php if ( $linkedin ) : ?>
				<a href="<?php echo esc_url( $linkedin ); ?>" class="contact__link" target="_blank" rel="noopener noreferrer">
					<span class="contact__link-label">LinkedIn</span>
					<span class="contact__link-value"><?php esc_html_e( 'Connect', 'fisayo-portfolio' ); ?></span>
				</a>
			<?php endif; ?>
			<?php if ( $twitter ) : ?>
				<a href="<?php echo esc_url( $twitter ); ?>" class="contact__link" target="_blank" rel="noopener noreferrer">
					<span class="contact__link-label">X / Twitter</span>
					<span class="contact__link-value"><?php esc_html_e( 'Follow', 'fisayo-portfolio' ); ?></span>
				</a>
			<?php endif; ?>
		</div>
	</div>
</section>
