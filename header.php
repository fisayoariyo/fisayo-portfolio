<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="top">
	<div class="site-header__inner container">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<span class="site-brand__mark" aria-hidden="true"></span>
				<span class="site-brand__text"><?php bloginfo( 'name' ); ?></span>
			<?php endif; ?>
		</a>

		<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">
			<span class="nav-toggle__line"></span>
			<span class="nav-toggle__line"></span>
			<span class="sr-only"><?php esc_html_e( 'Menu', 'fisayo-portfolio' ); ?></span>
		</button>

		<div class="site-header__nav" id="primary-nav">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'site-nav__list',
					'fallback_cb'    => 'fisayo_portfolio_nav_fallback',
					'depth'          => 1,
				)
			);
			?>
		</div>
	</div>
</header>

<main id="main" class="site-main">
