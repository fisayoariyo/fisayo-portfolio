</main>

<footer class="site-footer">
	<div class="container site-footer__inner">
		<div class="site-footer__brand">
			<p class="site-footer__name"><?php echo esc_html( fisayo_portfolio_mod( 'fisayo_hero_name', get_bloginfo( 'name' ) ) ); ?></p>
			<p class="site-footer__tagline"><?php echo esc_html( fisayo_portfolio_mod( 'fisayo_hero_title', '' ) ); ?></p>
		</div>

		<?php
		$shop_url   = fisayo_portfolio_mod( 'fisayo_shop_url', 'http://localhost/shop/' );
		$shop_label = fisayo_portfolio_mod( 'fisayo_shop_label', 'Visit my gadget shop' );
		if ( $shop_url ) :
			?>
			<div class="site-footer__shop">
				<a href="<?php echo esc_url( $shop_url ); ?>" class="btn btn--primary site-footer__shop-btn">
					<?php echo esc_html( $shop_label ); ?>
				</a>
				<p class="site-footer__shop-note"><?php esc_html_e( 'Phones, laptops & gadgets — feel-at-home shopping.', 'fisayo-portfolio' ); ?></p>
			</div>
		<?php endif; ?>

		<div class="site-footer__links">
			<?php
			$github = fisayo_portfolio_mod( 'fisayo_contact_github', 'https://github.com/fisayoariyo' );
			$email  = fisayo_portfolio_mod( 'fisayo_contact_email', '' );
			if ( $github ) :
				?>
				<a href="<?php echo esc_url( $github ); ?>" class="site-footer__link" target="_blank" rel="noopener noreferrer">GitHub</a>
			<?php endif; ?>
			<?php if ( $email ) : ?>
				<a href="mailto:<?php echo esc_attr( $email ); ?>" class="site-footer__link"><?php esc_html_e( 'Email', 'fisayo-portfolio' ); ?></a>
			<?php endif; ?>
			<?php if ( $shop_url ) : ?>
				<a href="<?php echo esc_url( $shop_url ); ?>" class="site-footer__link"><?php esc_html_e( 'Gadget Shop', 'fisayo-portfolio' ); ?></a>
			<?php endif; ?>
			<a href="#top" class="site-footer__link"><?php esc_html_e( 'Back to top', 'fisayo-portfolio' ); ?></a>
		</div>

		<p class="site-footer__copy">
			&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( fisayo_portfolio_mod( 'fisayo_hero_name', get_bloginfo( 'name' ) ) ); ?>.
			<?php esc_html_e( 'All rights reserved.', 'fisayo-portfolio' ); ?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
