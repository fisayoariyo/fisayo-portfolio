<?php
/**
 * Hero section.
 *
 * @package Fisayo_Portfolio
 */
?>
<section class="hero section" id="hero">
	<div class="container hero__inner">
		<div class="hero__content reveal">
			<p class="hero__greeting"><?php echo esc_html( fisayo_portfolio_mod( 'fisayo_hero_greeting', 'Hello, I\'m' ) ); ?></p>
			<h1 class="hero__name"><?php echo esc_html( fisayo_portfolio_mod( 'fisayo_hero_name', 'Fisayo Ariyo' ) ); ?></h1>
			<p class="hero__title"><?php echo esc_html( fisayo_portfolio_mod( 'fisayo_hero_title', 'Full-Stack Developer & WordPress Engineer' ) ); ?></p>
			<p class="hero__tagline"><?php echo esc_html( fisayo_portfolio_mod( 'fisayo_hero_tagline', '' ) ); ?></p>
			<div class="hero__actions">
				<a href="<?php echo esc_url( fisayo_portfolio_mod( 'fisayo_hero_cta_url', '#work' ) ); ?>" class="btn btn--primary">
					<?php echo esc_html( fisayo_portfolio_mod( 'fisayo_hero_cta_label', 'View My Work' ) ); ?>
				</a>
				<a href="#contact" class="btn btn--ghost"><?php esc_html_e( 'Get in Touch', 'fisayo-portfolio' ); ?></a>
			</div>
		</div>
		<div class="hero__visual reveal" aria-hidden="true">
			<div class="hero__orb hero__orb--1"></div>
			<div class="hero__orb hero__orb--2"></div>
			<div class="hero__grid"></div>
		</div>
	</div>
</section>
