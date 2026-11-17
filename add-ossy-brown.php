<?php
/**
 * Add / update Ossy Brown EPK project on the live portfolio site.
 *
 * @package Fisayo_Portfolio
 */

if ( php_sapi_name() !== 'cli' ) {
	exit( 'CLI only.' . PHP_EOL );
}

require_once dirname( __DIR__, 3 ) . '/wp-load.php';

$theme_dir = get_theme_root() . '/fisayo-portfolio';
require_once $theme_dir . '/inc/import-media.php';

$project = array(
	'title'     => 'Ossy Brown EPK',
	'slug'      => 'ossy-brown-epk',
	'category'  => 'wordpress',
	'excerpt'   => 'Storydoc-inspired electronic press kit for Afro-R&B artist Ossy Brown.',
	'content'   => '<p>Custom WordPress EPK for UK-based artist Ossy Brown — designed after a Storydoc pitch layout with sections for bio, discography, live highlights, press photos, dates, and contact.</p><ul><li>Cover, bio, music, live, press, dates, and contact sections</li><li>Album features for <em>LOVE LIKE ME</em> and <em>LED</em></li><li>Press photo gallery and live performance highlights</li><li>Cinematic dark theme with Playfair Display + IBM Plex Sans</li></ul>',
	'stack'     => 'WordPress, PHP, Custom CSS, JavaScript',
	'live_url'  => 'http://localhost/epk/',
	'repo_url'  => '',
	'client'    => 'Ossy Brown',
	'role'      => 'WordPress Developer & Designer',
	'year'      => '2026',
	'highlight' => 'Artist electronic press kit inspired by Storydoc',
	'accent'    => '#831EAC',
	'order'     => 0,
);

$existing = get_page_by_path( $project['slug'], OBJECT, 'portfolio_project' );

if ( $existing ) {
	$post_id = $existing->ID;
	wp_update_post(
		array(
			'ID'           => $post_id,
			'post_title'   => $project['title'],
			'post_excerpt' => $project['excerpt'],
			'post_content' => $project['content'],
			'menu_order'   => $project['order'],
			'post_status'  => 'publish',
		)
	);
	echo "Updated existing project #{$post_id}\n";
} else {
	$post_id = wp_insert_post(
		array(
			'post_type'    => 'portfolio_project',
			'post_title'   => $project['title'],
			'post_name'    => $project['slug'],
			'post_excerpt' => $project['excerpt'],
			'post_content' => $project['content'],
			'post_status'  => 'publish',
			'menu_order'   => $project['order'],
		),
		true
	);
	if ( is_wp_error( $post_id ) ) {
		fwrite( STDERR, $post_id->get_error_message() . "\n" );
		exit( 1 );
	}
	echo "Created project #{$post_id}\n";
}

update_post_meta( $post_id, '_fisayo_stack', $project['stack'] );
update_post_meta( $post_id, '_fisayo_live_url', $project['live_url'] );
update_post_meta( $post_id, '_fisayo_repo_url', $project['repo_url'] );
update_post_meta( $post_id, '_fisayo_client', $project['client'] );
update_post_meta( $post_id, '_fisayo_role', $project['role'] );
update_post_meta( $post_id, '_fisayo_year', $project['year'] );
update_post_meta( $post_id, '_fisayo_highlight', $project['highlight'] );
update_post_meta( $post_id, '_fisayo_accent_color', $project['accent'] );
update_post_meta( $post_id, '_fisayo_display_mode', 'photo' );

$term = term_exists( $project['category'], 'project_category' );
if ( ! $term ) {
	$term = wp_insert_term( 'WordPress & CMS', 'project_category', array( 'slug' => 'wordpress' ) );
}
if ( ! is_wp_error( $term ) ) {
	$term_id = (int) ( is_array( $term ) ? $term['term_id'] : $term );
	wp_set_object_terms( $post_id, array( $term_id ), 'project_category' );
}

$source = 'C:/xampp/htdocs/epk/wp-content/themes/ossy-brown-epk/assets/img/denim-portrait.jpg';
$source = str_replace( '/', DIRECTORY_SEPARATOR, $source );
$attach = fisayo_portfolio_attach_image_from_path( $post_id, $source, 'Ossy Brown EPK cover' );
echo $attach ? "Thumbnail attached (#{$attach})\n" : "Thumbnail missing\n";
echo "Done. View: " . home_url( '/#work' ) . "\n";
