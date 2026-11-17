<?php
/**
 * About section.
 *
 * @package Fisayo_Portfolio
 */
?>
<section class="about section" id="about">
	<div class="container about__inner">
		<div class="section-head reveal">
			<p class="section-head__label"><?php esc_html_e( 'About', 'fisayo-portfolio' ); ?></p>
			<h2 class="section-head__title"><?php echo esc_html( fisayo_portfolio_mod( 'fisayo_about_heading', 'Building digital products that solve real problems.' ) ); ?></h2>
		</div>
		<div class="about__body reveal">
			<p><?php echo esc_html( fisayo_portfolio_mod( 'fisayo_about_body', '' ) ); ?></p>
		</div>
		<div class="about__stats reveal">
			<div class="stat">
				<span class="stat__number">12+</span>
				<span class="stat__label"><?php esc_html_e( 'Projects Delivered', 'fisayo-portfolio' ); ?></span>
			</div>
			<div class="stat">
				<span class="stat__number">4</span>
				<span class="stat__label"><?php esc_html_e( 'Industry Verticals', 'fisayo-portfolio' ); ?></span>
			</div>
			<div class="stat">
				<span class="stat__number">2</span>
				<span class="stat__label"><?php esc_html_e( 'Open Source Repos', 'fisayo-portfolio' ); ?></span>
			</div>
		</div>
	</div>
</section>
