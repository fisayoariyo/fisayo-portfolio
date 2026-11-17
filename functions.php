<?php
/**
 * Fisayo Portfolio theme functions.
 *
 * @package Fisayo_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FISAYO_PORTFOLIO_VERSION', '1.2.1' );
define( 'FISAYO_PORTFOLIO_DIR', get_template_directory() );
define( 'FISAYO_PORTFOLIO_URI', get_template_directory_uri() );

require_once FISAYO_PORTFOLIO_DIR . '/inc/post-types.php';
require_once FISAYO_PORTFOLIO_DIR . '/inc/meta-boxes.php';
require_once FISAYO_PORTFOLIO_DIR . '/inc/import-media.php';
require_once FISAYO_PORTFOLIO_DIR . '/inc/customizer.php';
require_once FISAYO_PORTFOLIO_DIR . '/inc/seed-content.php';

/**
 * Theme setup.
 */
function fisayo_portfolio_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'fisayo-portfolio' ),
			'social'  => __( 'Social Links', 'fisayo-portfolio' ),
		)
	);

	add_image_size( 'project-card', 800, 600, true );
}
add_action( 'after_setup_theme', 'fisayo_portfolio_setup' );

/**
 * Allow SVG uploads for project logos.
 *
 * @param array $mimes Mime types.
 * @return array
 */
function fisayo_portfolio_upload_mimes( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'fisayo_portfolio_upload_mimes' );

/**
 * Enqueue assets.
 */
function fisayo_portfolio_assets() {
	wp_enqueue_style(
		'fisayo-google-fonts',
		'https://fonts.googleapis.com/css2?family=Caveat:wght@500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'fisayo-portfolio-style', get_stylesheet_uri(), array( 'fisayo-google-fonts' ), FISAYO_PORTFOLIO_VERSION );
	wp_enqueue_style( 'fisayo-portfolio-theme', FISAYO_PORTFOLIO_URI . '/assets/css/theme.css', array( 'fisayo-portfolio-style' ), FISAYO_PORTFOLIO_VERSION );

	wp_enqueue_script(
		'fisayo-portfolio-main',
		FISAYO_PORTFOLIO_URI . '/assets/js/main.js',
		array(),
		FISAYO_PORTFOLIO_VERSION,
		true
	);

	wp_localize_script(
		'fisayo-portfolio-main',
		'FisayoPortfolio',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'fisayo_portfolio_assets' );

/**
 * Default primary nav when no menu assigned.
 */
function fisayo_portfolio_nav_fallback() {
	$items = array(
		array( __( 'Work', 'fisayo-portfolio' ), '#work' ),
		array( __( 'About', 'fisayo-portfolio' ), '#about' ),
		array( __( 'Skills', 'fisayo-portfolio' ), '#skills' ),
		array( __( 'Contact', 'fisayo-portfolio' ), '#contact' ),
	);

	echo '<nav class="site-nav" aria-label="' . esc_attr__( 'Primary', 'fisayo-portfolio' ) . '"><ul class="site-nav__list">';
	foreach ( $items as $item ) {
		printf(
			'<li class="site-nav__item"><a href="%s" class="site-nav__link">%s</a></li>',
			esc_url( $item[1] ),
			esc_html( $item[0] )
		);
	}
	echo '</ul></nav>';
}

/**
 * Get project meta with defaults.
 *
 * @param int    $post_id Post ID.
 * @param string $key     Meta key suffix.
 * @param string $default Default value.
 * @return string
 */
function fisayo_portfolio_project_meta( $post_id, $key, $default = '' ) {
	$value = get_post_meta( $post_id, '_fisayo_' . $key, true );
	return $value !== '' ? $value : $default;
}

/**
 * Canonical stack filters for the project grid.
 *
 * @return array<string, string> slug => label
 */
function fisayo_portfolio_stack_filters() {
	return array(
		'wordpress'   => 'WordPress',
		'react'       => 'React / Next.js',
		'woocommerce' => 'WooCommerce',
		'specialized' => 'Specialized',
	);
}

/**
 * Map a project's stack string to filter slugs.
 *
 * @param int $post_id Post ID.
 * @return string[]
 */
function fisayo_portfolio_project_stack_slugs( $post_id ) {
	$stack = strtolower( fisayo_portfolio_project_meta( $post_id, 'stack', '' ) );
	$slugs = array();

	if ( false !== strpos( $stack, 'wordpress' ) || false !== strpos( $stack, 'php' ) ) {
		$slugs[] = 'wordpress';
	}
	if ( false !== strpos( $stack, 'react' ) || false !== strpos( $stack, 'next.js' ) || false !== strpos( $stack, 'vite' ) ) {
		$slugs[] = 'react';
	}
	if ( false !== strpos( $stack, 'woocommerce' ) ) {
		$slugs[] = 'woocommerce';
	}
	if (
		false !== strpos( $stack, 'digitalpersona' ) ||
		false !== strpos( $stack, 'sql.js' ) ||
		false !== strpos( $stack, 'peer review' ) ||
		false !== strpos( $stack, 'biometric' )
	) {
		$slugs[] = 'specialized';
	}

	// Fallback: use category taxonomy if stack mapping found nothing.
	if ( empty( $slugs ) ) {
		$terms = get_the_terms( $post_id, 'project_category' );
		if ( $terms && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				if ( 'full-stack' === $term->slug ) {
					$slugs[] = 'react';
				} elseif ( 'ecommerce' === $term->slug ) {
					$slugs[] = 'woocommerce';
				} elseif ( isset( fisayo_portfolio_stack_filters()[ $term->slug ] ) ) {
					$slugs[] = $term->slug;
				}
			}
		}
	}

	return array_values( array_unique( $slugs ) );
}

/**
 * Primary stack label for a project card eyebrow.
 *
 * @param int $post_id Post ID.
 * @return string
 */
function fisayo_portfolio_primary_stack_label( $post_id ) {
	$filters = fisayo_portfolio_stack_filters();
	$slugs   = fisayo_portfolio_project_stack_slugs( $post_id );
	if ( empty( $slugs ) ) {
		return '';
	}
	$labels = array();
	foreach ( $slugs as $slug ) {
		if ( isset( $filters[ $slug ] ) ) {
			$labels[] = $filters[ $slug ];
		}
	}
	return implode( ' · ', $labels );
}

/**
 * Render skill tags for a project.
 *
 * @param int $post_id Post ID.
 */
function fisayo_portfolio_render_stack( $post_id ) {
	$stack = fisayo_portfolio_project_meta( $post_id, 'stack', '' );
	if ( ! $stack ) {
		return;
	}
	$tags = array_map( 'trim', explode( ',', $stack ) );
	echo '<ul class="project-card__stack">';
	foreach ( $tags as $tag ) {
		if ( $tag ) {
			printf( '<li class="project-card__tag">%s</li>', esc_html( $tag ) );
		}
	}
	echo '</ul>';
}
