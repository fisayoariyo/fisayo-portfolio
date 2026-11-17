<?php
/**
 * Custom post types and taxonomies.
 *
 * @package Fisayo_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register portfolio project CPT and categories.
 */
function fisayo_portfolio_register_post_types() {
	register_post_type(
		'portfolio_project',
		array(
			'labels'       => array(
				'name'               => __( 'Projects', 'fisayo-portfolio' ),
				'singular_name'      => __( 'Project', 'fisayo-portfolio' ),
				'add_new'            => __( 'Add Project', 'fisayo-portfolio' ),
				'add_new_item'       => __( 'Add New Project', 'fisayo-portfolio' ),
				'edit_item'          => __( 'Edit Project', 'fisayo-portfolio' ),
				'new_item'           => __( 'New Project', 'fisayo-portfolio' ),
				'view_item'          => __( 'View Project', 'fisayo-portfolio' ),
				'search_items'       => __( 'Search Projects', 'fisayo-portfolio' ),
				'not_found'          => __( 'No projects found', 'fisayo-portfolio' ),
				'not_found_in_trash' => __( 'No projects in trash', 'fisayo-portfolio' ),
				'all_items'          => __( 'All Projects', 'fisayo-portfolio' ),
				'menu_name'          => __( 'Projects', 'fisayo-portfolio' ),
			),
			'public'       => true,
			'has_archive'  => 'projects',
			'menu_icon'    => 'dashicons-portfolio',
			'show_in_rest' => true,
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
			'rewrite'      => array( 'slug' => 'project' ),
		)
	);

	register_taxonomy(
		'project_category',
		'portfolio_project',
		array(
			'labels'       => array(
				'name'          => __( 'Categories', 'fisayo-portfolio' ),
				'singular_name' => __( 'Category', 'fisayo-portfolio' ),
				'search_items'  => __( 'Search Categories', 'fisayo-portfolio' ),
				'all_items'     => __( 'All Categories', 'fisayo-portfolio' ),
				'edit_item'     => __( 'Edit Category', 'fisayo-portfolio' ),
				'add_new_item'  => __( 'Add Category', 'fisayo-portfolio' ),
			),
			'public'       => true,
			'hierarchical' => true,
			'show_in_rest' => true,
			'rewrite'      => array( 'slug' => 'project-category' ),
		)
	);
}
add_action( 'init', 'fisayo_portfolio_register_post_types' );

/**
 * Flush rewrites once after CPT registration.
 */
function fisayo_portfolio_maybe_flush_rewrites() {
	if ( ! get_option( 'fisayo_portfolio_rewrites_flushed' ) ) {
		flush_rewrite_rules( false );
		update_option( 'fisayo_portfolio_rewrites_flushed', 1 );
	}
}
add_action( 'init', 'fisayo_portfolio_maybe_flush_rewrites', 20 );
