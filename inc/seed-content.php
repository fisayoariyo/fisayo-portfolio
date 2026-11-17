<?php
/**
 * Seed default project categories and portfolio projects.
 *
 * @package Fisayo_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Default project categories.
 *
 * @return array
 */
function fisayo_portfolio_default_categories() {
	return array(
		'full-stack'    => 'Full-Stack Apps',
		'wordpress'     => 'WordPress & CMS',
		'ecommerce'     => 'E-Commerce',
		'specialized'   => 'Specialized Platforms',
	);
}

/**
 * Default projects data.
 *
 * @return array
 */
function fisayo_portfolio_default_projects() {
	return array(
		array(
			'title'    => 'Ossy Brown EPK',
			'slug'     => 'ossy-brown-epk',
			'category' => 'wordpress',
			'excerpt'  => 'Storydoc-inspired electronic press kit for Afro-R&B artist Ossy Brown.',
			'content'  => '<p>Custom WordPress EPK for UK-based artist Ossy Brown — designed after a Storydoc pitch layout with sections for bio, discography, live highlights, press photos, dates, and contact.</p><ul><li>Cover, bio, music, live, press, dates, and contact sections</li><li>Album features for <em>LOVE LIKE ME</em> and <em>LED</em></li><li>Press photo gallery and live performance highlights</li><li>Cinematic dark theme with Playfair Display + IBM Plex Sans</li></ul>',
			'stack'    => 'WordPress, PHP, Custom CSS, JavaScript',
			'live_url' => 'http://localhost/epk/',
			'repo_url' => '',
			'client'   => 'Ossy Brown',
			'role'     => 'WordPress Developer & Designer',
			'year'     => '2026',
			'highlight'=> 'Artist electronic press kit inspired by Storydoc',
			'accent'   => '#831EAC',
			'order'    => 0,
		),
		array(
			'title'    => 'DotCharis Consult',
			'slug'     => 'dotcharis-consult',
			'category' => 'full-stack',
			'excerpt'  => 'Multi-role consultancy platform for real estate, travel, construction, and agent onboarding.',
			'content'  => '<p>Built a premium consultancy platform with separate portals for admins, agents, and clients. Includes property listing management, travel applications, construction project dashboards, and a full Supabase-powered authentication system.</p><ul><li>Agent onboarding with identity and location verification</li><li>Admin dashboard for listings, inquiries, and reported issues</li><li>Client and travel dashboards</li><li>Blog and success stories</li></ul>',
			'stack'    => 'Next.js, React, TypeScript, Tailwind, Supabase, Radix UI, GSAP',
			'live_url' => '',
			'repo_url' => 'https://github.com/fisayoariyo/cc',
			'client'   => 'DotCharis Consult',
			'role'     => 'Full-Stack Developer',
			'year'     => '2025',
			'highlight'=> 'Multi-role SaaS consultancy platform with Supabase auth',
			'accent'   => '#06B6D4',
			'order'    => 1,
		),
		array(
			'title'    => 'HFEI CropEx',
			'slug'     => 'hfei-cropex',
			'category' => 'specialized',
			'excerpt'  => 'Mobile-first AgTech enrollment app with biometric verification for farmers and field agents.',
			'content'  => '<p>Agricultural enrollment system with separate Farmer and Agent flows. Agents register farmers via OTP, identity verification (facial and fingerprint), and location selection across Nigeria.</p><ul><li>DigitalPersona fingerprint SDK integration</li><li>Farmer registration wizard</li><li>OTP phone verification</li><li>CropEx REST API integration</li></ul>',
			'stack'    => 'React, Vite, Tailwind, DigitalPersona SDK, REST API',
			'live_url' => '',
			'repo_url' => 'https://github.com/fisayoariyo/hashp',
			'client'   => 'HFEI / CropEx',
			'role'     => 'Frontend Developer',
			'year'     => '2025',
			'highlight'=> 'AgTech enrollment with biometric verification',
			'accent'   => '#22C55E',
			'order'    => 2,
		),
		array(
			'title'    => 'CropEx Admin Console',
			'slug'     => 'cropex-admin',
			'category' => 'specialized',
			'excerpt'  => 'Offline-first admin dashboard for managing farmers, agents, and verifications.',
			'content'  => '<p>Desktop-first admin console companion to CropEx. Manage farmers, agents, verifications, and reported issues with offline-first local storage and sync outbox.</p><ul><li>Farmer and agent management</li><li>Agent verification workflow</li><li>Reported issues tracking</li><li>SQLite in browser via sql.js</li></ul>',
			'stack'    => 'React 19, Vite, TypeScript, Tailwind, sql.js',
			'live_url' => '',
			'repo_url' => '',
			'client'   => 'HFEI / CropEx',
			'role'     => 'Frontend Developer',
			'year'     => '2025',
			'highlight'=> 'Offline-first admin dashboard with local sync',
			'accent'   => '#84CC16',
			'order'    => 3,
		),
		array(
			'title'    => 'Clicks Aladire',
			'slug'     => 'clicks-aladire',
			'category' => 'ecommerce',
			'excerpt'  => 'Headless WooCommerce storefront for Afrocentric fashion.',
			'content'  => '<p>Decoupled e-commerce experience — React SPA frontend with WordPress/WooCommerce backend. Custom gallery plugin for content management.</p><ul><li>Shop, cart, checkout, and order tracking</li><li>Customer account and order history</li><li>Custom WordPress gallery plugin</li><li>Image optimization pipeline</li></ul>',
			'stack'    => 'React, Vite, TypeScript, TanStack Query, WooCommerce, GSAP',
			'live_url' => '',
			'repo_url' => '',
			'client'   => 'Clicks Aladire',
			'role'     => 'Full-Stack Developer',
			'year'     => '2025',
			'highlight'=> 'Headless WooCommerce with React frontend',
			'accent'   => '#EC4899',
			'order'    => 4,
		),
		array(
			'title'    => 'BSHP Portfolio',
			'slug'     => 'bshp-portfolio',
			'category' => 'wordpress',
			'excerpt'  => 'Interactive PM portfolio with Matter.js physics hero and GSAP scroll effects.',
			'content'  => '<p>Personal portfolio for a Product Manager featuring a physics-based hero, custom cursor, case studies CMS, newsletter system, and digital resources with Selar integration.</p><ul><li>Matter.js floating skill pills</li><li>GSAP scroll blur effects</li><li>Case studies custom post type</li><li>Newsletter subscriber management</li></ul>',
			'stack'    => 'WordPress, Tailwind, Matter.js, GSAP, PHP',
			'live_url' => 'https://pelumioluwaseun.cc',
			'repo_url' => '',
			'client'   => 'BSHP',
			'role'     => 'WordPress Developer',
			'year'     => '2025',
			'highlight'=> 'Interactive portfolio with physics hero',
			'accent'   => '#A855F7',
			'order'    => 5,
		),
		array(
			'title'    => 'OKAL Music',
			'slug'     => 'okal-music',
			'category' => 'wordpress',
			'excerpt'  => 'Standalone artist website for Nigerian songwriter OKAL — no page builder dependency.',
			'content'  => '<p>Official site for OKAL ("The Million Dollar Girl"). Continuous one-pager with discography, journey timeline, media gallery, and newsletter — migrated off Elementor to a custom standalone theme.</p><ul><li>Hero image carousel</li><li>Music discography with album art</li><li>Journey timeline and press gallery</li><li>Hash-based section navigation</li></ul>',
			'stack'    => 'WordPress, Custom CSS, JavaScript, PHP',
			'live_url' => 'https://www.iamokal.com',
			'repo_url' => '',
			'client'   => 'OKAL / Million Dollar Ideas Ltd',
			'role'     => 'WordPress Developer',
			'year'     => '2025',
			'highlight'=> 'Custom artist one-pager without page builders',
			'accent'   => '#F59E0B',
			'order'    => 6,
		),
		array(
			'title'    => 'MDI Consults',
			'slug'     => 'mdi-consults',
			'category' => 'wordpress',
			'excerpt'  => 'Corporate consulting site with GTV visa packages and CMS-driven content.',
			'content'  => '<p>Strategic solutions agency site for MDI Consults — brand, digital marketing, business analysis, and Global Talent Visa advisory with GBP/NGN pricing tiers.</p><ul><li>Custom CPTs for Work, Services, Team, FAQs, GTV Packages</li><li>Extensive WP Customizer panel</li><li>Hero water-ripple canvas effect</li><li>FluentForm integration</li></ul>',
			'stack'    => 'WordPress, PHP, Custom CSS, JavaScript',
			'live_url' => 'https://mdiconsults.com',
			'repo_url' => '',
			'client'   => 'MDI Consults',
			'role'     => 'WordPress Developer',
			'year'     => '2025',
			'highlight'=> 'Corporate site with GTV product tiers',
			'accent'   => '#EAB308',
			'order'    => 7,
		),
		array(
			'title'    => 'Million Dollar Ideas Ltd',
			'slug'     => 'million-dollar-ideas',
			'category' => 'wordpress',
			'excerpt'  => 'Creative growth agency site with dark glassmorphism aesthetic.',
			'content'  => '<p>Agency website for MillionDollar Ideas Ltd — partners with African creatives and brands. YouTube Music-inspired dark aesthetic with gold and emerald accents.</p><ul><li>Artists roster and services showcase</li><li>Partners, testimonials, and team sections</li><li>Custom post types for content management</li><li>Blog: "The Independent Artist Brief"</li></ul>',
			'stack'    => 'WordPress, PHP, Custom CSS, Glassmorphism',
			'live_url' => 'https://milliondollarideasltd.com',
			'repo_url' => '',
			'client'   => 'Million Dollar Ideas Ltd',
			'role'     => 'WordPress Developer',
			'year'     => '2025',
			'highlight'=> 'Dark editorial agency site for creatives',
			'accent'   => '#10B981',
			'order'    => 8,
		),
		array(
			'title'    => 'JASE Peer Review',
			'slug'     => 'jase-peer-review',
			'category' => 'specialized',
			'excerpt'  => 'Academic journal platform with multi-role peer review workflow.',
			'content'  => '<p>Journal management platform for University of Ibadan. Authors submit articles; editors, reviewers, and publishers manage editions, reviews, and approvals.</p><ul><li>Role-based dashboards (Author, Reviewer, Editor, Publisher)</li><li>Article submission and revision workflow</li><li>Edition management</li><li>Invoice system</li></ul>',
			'stack'    => 'WordPress, PHP, Peer Review Plugin',
			'live_url' => '',
			'repo_url' => '',
			'client'   => 'University of Ibadan Journal Team',
			'role'     => 'WordPress Developer',
			'year'     => '2025',
			'highlight'=> 'Academic peer-review workflow platform',
			'accent'   => '#6366F1',
			'order'    => 9,
		),
		array(
			'title'    => 'Miyaki Store Theme',
			'slug'     => 'miyaki-theme',
			'category' => 'ecommerce',
			'excerpt'  => 'Editorial minimal WooCommerce theme for fashion with dark mode.',
			'content'  => '<p>WooCommerce theme for miyaki.store — warm typography, scroll animations, quick-view, mega menu, and demo import support.</p><ul><li>Elementor-compatible layouts</li><li>Dark mode support</li><li>Quick-view and mega menu</li><li>One Click Demo Import ready</li></ul>',
			'stack'    => 'WordPress, WooCommerce, PHP, Elementor',
			'live_url' => '',
			'repo_url' => '',
			'client'   => 'Miyaki',
			'role'     => 'Theme Developer',
			'year'     => '2025',
			'highlight'=> 'Editorial fashion WooCommerce theme',
			'accent'   => '#F472B6',
			'order'    => 10,
		),
		array(
			'title'    => 'Vela Store Theme',
			'slug'     => 'vela-store',
			'category' => 'ecommerce',
			'excerpt'  => 'Clean editorial WooCommerce theme — mobile-first product store.',
			'content'  => '<p>Minimal e-commerce theme with editorial design. Custom templates for about, contact, FAQ, and product archives.</p><ul><li>Mobile-first responsive design</li><li>WooCommerce template overrides</li><li>About, FAQ, and contact page templates</li></ul>',
			'stack'    => 'WordPress, WooCommerce, PHP 8+',
			'live_url' => '',
			'repo_url' => '',
			'client'   => 'Internal / Reusable',
			'role'     => 'Theme Developer',
			'year'     => '2025',
			'highlight'=> 'Reusable editorial WooCommerce theme',
			'accent'   => '#64748B',
			'order'    => 11,
		),
	);
}

/**
 * Seed categories and projects on theme activation.
 */
function fisayo_portfolio_seed_on_activation() {
	fisayo_portfolio_seed_content( false );
}
add_action( 'after_switch_theme', 'fisayo_portfolio_seed_on_activation' );

/**
 * Seed portfolio content.
 *
 * @param bool $force Reseed even if already done.
 * @return array Result counts.
 */
function fisayo_portfolio_seed_content( $force = false ) {
	if ( ! $force && get_option( 'fisayo_portfolio_seeded' ) ) {
		return array( 'skipped' => true );
	}

	$cat_ids = array();
	foreach ( fisayo_portfolio_default_categories() as $slug => $name ) {
		$existing = term_exists( $slug, 'project_category' );
		if ( $existing ) {
			$cat_ids[ $slug ] = (int) ( is_array( $existing ) ? $existing['term_id'] : $existing );
		} else {
			$result = wp_insert_term( $name, 'project_category', array( 'slug' => $slug ) );
			if ( ! is_wp_error( $result ) ) {
				$cat_ids[ $slug ] = (int) $result['term_id'];
			}
		}
	}

	$created = 0;
	foreach ( fisayo_portfolio_default_projects() as $project ) {
		$existing = get_page_by_path( $project['slug'], OBJECT, 'portfolio_project' );
		if ( $existing && ! $force ) {
			continue;
		}

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
			continue;
		}

		update_post_meta( $post_id, '_fisayo_stack', $project['stack'] );
		update_post_meta( $post_id, '_fisayo_live_url', $project['live_url'] );
		update_post_meta( $post_id, '_fisayo_repo_url', $project['repo_url'] );
		update_post_meta( $post_id, '_fisayo_client', $project['client'] );
		update_post_meta( $post_id, '_fisayo_role', $project['role'] );
		update_post_meta( $post_id, '_fisayo_year', $project['year'] );
		update_post_meta( $post_id, '_fisayo_highlight', $project['highlight'] );
		update_post_meta( $post_id, '_fisayo_accent_color', $project['accent'] );

		if ( isset( $cat_ids[ $project['category'] ] ) ) {
			wp_set_object_terms( $post_id, array( (int) $cat_ids[ $project['category'] ] ), 'project_category' );
		}

		++$created;
	}

	update_option( 'fisayo_portfolio_seeded', 1 );
	flush_rewrite_rules( false );

	return array(
		'created'    => $created,
		'categories' => count( $cat_ids ),
	);
}

/**
 * Admin notice after seeding.
 */
function fisayo_portfolio_seed_admin_notice() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( get_option( 'fisayo_portfolio_seeded' ) ) {
		return;
	}
	echo '<div class="notice notice-info"><p>';
	echo esc_html__( 'Fisayo Portfolio: Activate this theme to auto-import your projects, or run setup-site.php from the command line.', 'fisayo-portfolio' );
	echo '</p></div>';
}
add_action( 'admin_notices', 'fisayo_portfolio_seed_admin_notice' );
