<?php
/**
 * Import project thumbnails from source repositories.
 *
 * @package Fisayo_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Map project slugs to source image paths on this machine.
 *
 * @return array<string, string>
 */
function fisayo_portfolio_project_image_sources() {
	$home = getenv( 'USERPROFILE' ) ? str_replace( '\\', '/', getenv( 'USERPROFILE' ) ) : '';

	$paths = array(
		'dotcharis-consult'    => $home . '/Documents/cc-main/src/assets/CC Logo Lockup (color).png',
		'hfei-cropex'          => $home . '/Documents/hashp-main/hashp-main/public/brand/HFEI_Primary_Logo_Green.png',
		'cropex-admin'         => $home . '/Documents/hashadmin-main/hashadmin-main/public/brand/HFEI_Primary_Logo_.png',
		'clicks-aladire'       => $home . '/Documents/clks-/public/logo/logo1.png',
		'bshp-portfolio'       => 'C:/xampp/htdocs/bshp/wp-content/themes/bshp/assets/img/bishop.svg',
		'okal-music'           => 'C:/xampp/htdocs/imokl/wp-content/uploads/okal-assets/okal-promo-5.jpg',
		'ossy-brown-epk'       => 'C:/xampp/htdocs/epk/wp-content/themes/ossy-brown-epk/assets/img/denim-portrait.jpg',
		'mdi-consults'         => 'C:/xampp/htdocs/mdic/wp-content/themes/mdi-consults/assets/images/mdi-logo.png',
		'million-dollar-ideas' => 'C:/xampp/htdocs/imokl/wp-content/uploads/okal-assets/million-dollar-something---single.jpg',
		'jase-peer-review'     => $home . '/Documents/jj/jj/jounalo-main-files/jasedgh/assets/images/jase-dept-logo.png',
		'miyaki-theme'         => $home . '/Documents/Miyaki/miyaki/screenshot.png',
		'vela-store'           => $home . '/Documents/clks-/public/logo/logo1.png',
	);

	$mapped = array();
	foreach ( $paths as $slug => $path ) {
		$mapped[ $slug ] = str_replace( '/', DIRECTORY_SEPARATOR, $path );
	}

	return $mapped;
}

/**
 * Projects that should keep existing photos (skip re-import).
 *
 * @return string[]
 */
function fisayo_portfolio_preserve_media_slugs() {
	return array( 'okal-music', 'miyaki-theme' );
}

/**
 * Projects displayed with logo-style thumbnails.
 *
 * @return string[]
 */
function fisayo_portfolio_logo_display_slugs() {
	return array(
		'dotcharis-consult',
		'hfei-cropex',
		'cropex-admin',
		'clicks-aladire',
		'bshp-portfolio',
		'mdi-consults',
		'million-dollar-ideas',
		'jase-peer-review',
		'vela-store',
	);
}

/**
 * Whether a project uses logo-style media presentation.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function fisayo_portfolio_uses_logo_display( $post_id ) {
	$mode = get_post_meta( $post_id, '_fisayo_display_mode', true );
	if ( 'logo' === $mode ) {
		return true;
	}
	if ( 'photo' === $mode ) {
		return false;
	}
	$slug = get_post_field( 'post_name', $post_id );
	return in_array( $slug, fisayo_portfolio_logo_display_slugs(), true );
}

/**
 * Skills list derived from portfolio projects.
 *
 * @return string
 */
function fisayo_portfolio_default_skills_list() {
	return implode(
		"\n",
		array(
			'Full-Stack Development: Next.js 15, React 18/19, TypeScript, Vite, JavaScript, Supabase, REST APIs',
			'WordPress Engineering: Custom themes, CPTs, taxonomies, WP Customizer, plugins, FluentForm, Elementor migrations',
			'E-Commerce: WooCommerce, headless storefronts, TanStack Query, Zustand, cart & checkout flows',
			'Frontend & Motion: Tailwind CSS, GSAP, ScrollTrigger, Framer Motion, Matter.js, canvas effects',
			'AgTech & Specialized: DigitalPersona SDK, biometric verification, sql.js, peer-review workflows, Nigeria LGA data',
			'Design & UX: Figma, UI/UX design, wireframing, editorial layouts, responsive design, soft UI, accessibility',
			'DevOps & Deploy: XAMPP, Hostinger, cPanel, WP Migration, CLI setup scripts',
		)
	);
}

/**
 * Attach a local file as the featured image for a post.
 *
 * @param int    $post_id   Post ID.
 * @param string $file_path Absolute file path.
 * @param string $title     Attachment title.
 * @return int|false Attachment ID or false.
 */
function fisayo_portfolio_attach_image_from_path( $post_id, $file_path, $title ) {
	if ( ! file_exists( $file_path ) ) {
		return false;
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$filename = sanitize_file_name( basename( $file_path ) );
	$theme_dir = FISAYO_PORTFOLIO_DIR . '/assets/images/projects';
	if ( ! is_dir( $theme_dir ) ) {
		wp_mkdir_p( $theme_dir );
	}

	$slug      = get_post_field( 'post_name', $post_id );
	$extension = pathinfo( $filename, PATHINFO_EXTENSION );
	$dest_name = $slug . '.' . $extension;
	$dest_path = $theme_dir . '/' . $dest_name;

	if ( ! file_exists( $dest_path ) ) {
		copy( $file_path, $dest_path );
	}

	$upload = wp_upload_bits( $dest_name, null, file_get_contents( $dest_path ) );
	if ( ! empty( $upload['error'] ) ) {
		return false;
	}

	$filetype = wp_check_filetype( $dest_name, null );
	$attachment = array(
		'post_mime_type' => $filetype['type'],
		'post_title'     => $title,
		'post_content'   => '',
		'post_status'    => 'inherit',
	);

	$attach_id = wp_insert_attachment( $attachment, $upload['file'], $post_id );
	if ( is_wp_error( $attach_id ) ) {
		return false;
	}

	$metadata = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
	wp_update_attachment_metadata( $attach_id, $metadata );
	set_post_thumbnail( $post_id, $attach_id );

	return $attach_id;
}

/**
 * Import all project thumbnails and refresh skills.
 *
 * @return array
 */
function fisayo_portfolio_import_project_media() {
	$sources  = fisayo_portfolio_project_image_sources();
	$results  = array(
		'attached' => array(),
		'missing'  => array(),
	);

	$query = new WP_Query(
		array(
			'post_type'      => 'portfolio_project',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		)
	);

	while ( $query->have_posts() ) {
		$query->the_post();
		$slug   = get_post_field( 'post_name', get_the_ID() );
		$title  = get_the_title();

		if ( in_array( $slug, fisayo_portfolio_preserve_media_slugs(), true ) ) {
			update_post_meta( get_the_ID(), '_fisayo_display_mode', 'photo' );
			continue;
		}

		$source = isset( $sources[ $slug ] ) ? $sources[ $slug ] : '';

		if ( ! $source || ! file_exists( $source ) ) {
			$results['missing'][] = $slug;
			continue;
		}

		$attach_id = fisayo_portfolio_attach_image_from_path( get_the_ID(), $source, $title . ' cover' );

		if ( ! $attach_id && 'bshp-portfolio' === $slug ) {
			$fallback = str_replace( '/', DIRECTORY_SEPARATOR, getenv( 'USERPROFILE' ) . '/Documents/bshp/Frame 14.png' );
			$attach_id = fisayo_portfolio_attach_image_from_path( get_the_ID(), $fallback, $title . ' cover' );
		}

		if ( $attach_id ) {
			$display = in_array( $slug, fisayo_portfolio_logo_display_slugs(), true ) ? 'logo' : 'photo';
			update_post_meta( get_the_ID(), '_fisayo_display_mode', $display );
			$results['attached'][] = $slug;
		} else {
			$results['missing'][] = $slug;
		}
	}

	wp_reset_postdata();

	set_theme_mod( 'fisayo_skills_list', fisayo_portfolio_default_skills_list() );

	return $results;
}
