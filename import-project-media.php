<?php
/**
 * Import project thumbnails and refresh skills.
 *
 * Usage (from WordPress root):
 *   php wp-content/themes/fisayo-portfolio/import-project-media.php
 *
 * @package Fisayo_Portfolio
 */

if ( php_sapi_name() !== 'cli' ) {
	exit( 'Run this script from the command line only.' . PHP_EOL );
}

$wp_load = null;
$candidates = array(
	__DIR__ . '/../../../wp-load.php',
	dirname( __DIR__, 3 ) . '/wp-load.php',
);

foreach ( $candidates as $path ) {
	if ( file_exists( $path ) ) {
		$wp_load = $path;
		break;
	}
}

if ( ! $wp_load ) {
	fwrite( STDERR, "Could not find wp-load.php.\n" );
	exit( 1 );
}

require_once $wp_load;

$theme_dir = get_theme_root() . '/fisayo-portfolio';
require_once $theme_dir . '/inc/import-media.php';

$results = fisayo_portfolio_import_project_media();

echo "Project media import complete.\n";
echo 'Attached: ' . count( $results['attached'] ) . "\n";
if ( $results['attached'] ) {
	echo '  - ' . implode( "\n  - ", $results['attached'] ) . "\n";
}
if ( $results['missing'] ) {
	echo 'Missing: ' . implode( ', ', $results['missing'] ) . "\n";
}
echo "Skills updated to match all portfolio projects.\n";
