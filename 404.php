<?php
/**
 * 404 template.
 *
 * @package Fisayo_Portfolio
 */

get_header();
?>

<div class="container section not-found reveal">
	<p class="section-head__label">404</p>
	<h1 class="section-head__title"><?php esc_html_e( 'Page not found', 'fisayo-portfolio' ); ?></h1>
	<p class="section-head__desc"><?php esc_html_e( 'The page you are looking for does not exist or has moved.', 'fisayo-portfolio' ); ?></p>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary"><?php esc_html_e( 'Back Home', 'fisayo-portfolio' ); ?></a>
</div>

<?php
get_footer();
