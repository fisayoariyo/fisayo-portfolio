<?php
/**
 * CLI bootstrap for Fisayo Portfolio theme.
 *
 * Usage (from WordPress root):
 *   php wp-content/themes/fisayo-portfolio/setup-site.php
 *
 * Or copy this theme to wp-content/themes/ and run from htdocs root.
 *
 * @package Fisayo_Portfolio
 */

if ( php_sapi_name() !== 'cli' ) {
	exit( 'Run this script from the command line only.' . PHP_EOL );
}

$wp_load = null;
$candidates = array(
	__DIR__ . '/../../../wp-load.php',
	__DIR__ . '/../../../../wp-load.php',
	dirname( __DIR__, 3 ) . '/wp-load.php',
);

foreach ( $candidates as $path ) {
	if ( file_exists( $path ) ) {
		$wp_load = $path;
		break;
	}
}

if ( ! $wp_load ) {
	fwrite( STDERR, "Could not find wp-load.php. Run from a WordPress install root.\n" );
	fwrite( STDERR, "Example: copy theme to wp-content/themes/fisayo-portfolio then:\n" );
	fwrite( STDERR, "  cd C:\\xampp\\htdocs\\your-site\n" );
	fwrite( STDERR, "  php wp-content/themes/fisayo-portfolio/setup-site.php\n" );
	exit( 1 );
}

require_once $wp_load;

$theme_dir = get_theme_root() . '/fisayo-portfolio';
if ( ! is_dir( $theme_dir ) ) {
	fwrite( STDERR, "Theme folder not found at {$theme_dir}\n" );
	exit( 1 );
}

require_once $theme_dir . '/inc/post-types.php';
require_once $theme_dir . '/inc/meta-boxes.php';
require_once $theme_dir . '/inc/customizer.php';
require_once $theme_dir . '/inc/seed-content.php';

switch_theme( 'fisayo-portfolio' );

$result = fisayo_portfolio_seed_content( true );

update_option( 'show_on_front', 'page' );

$front = get_page_by_path( 'home' );
if ( ! $front ) {
	$front_id = wp_insert_post(
		array(
			'post_type'    => 'page',
			'post_title'   => 'Home',
			'post_name'    => 'home',
			'post_status'  => 'publish',
			'post_content' => '',
		)
	);
} else {
	$front_id = $front->ID;
}

if ( $front_id && ! is_wp_error( $front_id ) ) {
	update_option( 'page_on_front', (int) $front_id );
}

$menu_name = 'Primary';
$menu_id   = wp_create_nav_menu( $menu_name );
if ( ! is_wp_error( $menu_id ) ) {
	$items = array(
		array( 'Work', home_url( '/#work' ) ),
		array( 'About', home_url( '/#about' ) ),
		array( 'Skills', home_url( '/#skills' ) ),
		array( 'Contact', home_url( '/#contact' ) ),
	);
	foreach ( $items as $item ) {
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'  => $item[0],
				'menu-item-url'    => $item[1],
				'menu-item-status' => 'publish',
			)
		);
	}
	$locations           = get_theme_mod( 'nav_menu_locations', array() );
	$locations['primary'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}

update_option( 'blogname', 'Fisayo Ariyo' );
update_option( 'blogdescription', 'Full-Stack Developer & WordPress Engineer' );

echo "Fisayo Portfolio setup complete.\n";
echo 'Projects seeded: ' . ( isset( $result['created'] ) ? (int) $result['created'] : 0 ) . "\n";
echo 'Site URL: ' . home_url( '/' ) . "\n";
echo "Next: Appearance → Customize to update hero, about, and contact details.\n";
