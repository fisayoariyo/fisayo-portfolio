<?php
/**
 * Project meta boxes.
 *
 * @package Fisayo_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register meta box.
 */
function fisayo_portfolio_add_meta_boxes() {
	add_meta_box(
		'fisayo_project_details',
		__( 'Project Details', 'fisayo-portfolio' ),
		'fisayo_portfolio_render_meta_box',
		'portfolio_project',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'fisayo_portfolio_add_meta_boxes' );

/**
 * Render meta box fields.
 *
 * @param WP_Post $post Post object.
 */
function fisayo_portfolio_render_meta_box( $post ) {
	wp_nonce_field( 'fisayo_project_meta', 'fisayo_project_meta_nonce' );

	$fields = array(
		'stack'       => array( 'label' => __( 'Tech Stack (comma-separated)', 'fisayo-portfolio' ), 'type' => 'text' ),
		'live_url'    => array( 'label' => __( 'Live URL', 'fisayo-portfolio' ), 'type' => 'url' ),
		'repo_url'    => array( 'label' => __( 'Repository URL', 'fisayo-portfolio' ), 'type' => 'url' ),
		'client'      => array( 'label' => __( 'Client / Organization', 'fisayo-portfolio' ), 'type' => 'text' ),
		'role'        => array( 'label' => __( 'Your Role', 'fisayo-portfolio' ), 'type' => 'text' ),
		'year'        => array( 'label' => __( 'Year', 'fisayo-portfolio' ), 'type' => 'text' ),
		'highlight'   => array( 'label' => __( 'Portfolio Highlight (one line)', 'fisayo-portfolio' ), 'type' => 'text' ),
		'accent_color'=> array( 'label' => __( 'Accent Color (hex)', 'fisayo-portfolio' ), 'type' => 'text' ),
	);

	echo '<div class="fisayo-meta-grid">';
	foreach ( $fields as $key => $field ) {
		$value = get_post_meta( $post->ID, '_fisayo_' . $key, true );
		printf(
			'<p><label for="fisayo_%1$s"><strong>%2$s</strong></label><br><input type="%3$s" id="fisayo_%1$s" name="fisayo_%1$s" value="%4$s" class="widefat"></p>',
			esc_attr( $key ),
			esc_html( $field['label'] ),
			esc_attr( $field['type'] ),
			esc_attr( $value )
		);
	}
	echo '</div>';
}

/**
 * Save meta box data.
 *
 * @param int $post_id Post ID.
 */
function fisayo_portfolio_save_meta( $post_id ) {
	if ( ! isset( $_POST['fisayo_project_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['fisayo_project_meta_nonce'] ) ), 'fisayo_project_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$keys = array( 'stack', 'live_url', 'repo_url', 'client', 'role', 'year', 'highlight', 'accent_color' );
	foreach ( $keys as $key ) {
		if ( isset( $_POST[ 'fisayo_' . $key ] ) ) {
			update_post_meta( $post_id, '_fisayo_' . $key, sanitize_text_field( wp_unslash( $_POST[ 'fisayo_' . $key ] ) ) );
		}
	}
}
add_action( 'save_post_portfolio_project', 'fisayo_portfolio_save_meta' );
