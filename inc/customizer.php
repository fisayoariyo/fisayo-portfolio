<?php
/**
 * Theme Customizer settings.
 *
 * @package Fisayo_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Customizer panels and settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function fisayo_portfolio_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'fisayo_portfolio',
		array(
			'title'    => __( 'Portfolio Content', 'fisayo-portfolio' ),
			'priority' => 30,
		)
	);

	/* Hero */
	$wp_customize->add_section(
		'fisayo_hero',
		array(
			'title' => __( 'Hero', 'fisayo-portfolio' ),
			'panel' => 'fisayo_portfolio',
		)
	);

	$hero_fields = array(
		'fisayo_hero_greeting'  => array( 'default' => 'Hello, I\'m', 'label' => __( 'Greeting', 'fisayo-portfolio' ) ),
		'fisayo_hero_name'      => array( 'default' => 'Fisayo Ariyo', 'label' => __( 'Name', 'fisayo-portfolio' ) ),
		'fisayo_hero_title'     => array( 'default' => 'Full-Stack Developer & WordPress Engineer', 'label' => __( 'Title', 'fisayo-portfolio' ) ),
		'fisayo_hero_tagline'   => array( 'default' => 'I build modern web apps, headless e-commerce stores, and custom WordPress experiences for clients across consulting, fashion, music, agriculture, and academia.', 'label' => __( 'Tagline', 'fisayo-portfolio' ), 'type' => 'textarea' ),
		'fisayo_hero_cta_label' => array( 'default' => 'View My Work', 'label' => __( 'Primary CTA Label', 'fisayo-portfolio' ) ),
		'fisayo_hero_cta_url'   => array( 'default' => '#work', 'label' => __( 'Primary CTA URL', 'fisayo-portfolio' ) ),
	);

	foreach ( $hero_fields as $id => $field ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $field['default'],
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $field['label'],
				'section' => 'fisayo_hero',
				'type'    => isset( $field['type'] ) ? $field['type'] : 'text',
			)
		);
	}

	/* About */
	$wp_customize->add_section(
		'fisayo_about',
		array(
			'title' => __( 'About', 'fisayo-portfolio' ),
			'panel' => 'fisayo_portfolio',
		)
	);

	$wp_customize->add_setting(
		'fisayo_about_heading',
		array(
			'default'           => 'Building digital products that solve real problems.',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'fisayo_about_heading',
		array(
			'label'   => __( 'Heading', 'fisayo-portfolio' ),
			'section' => 'fisayo_about',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'fisayo_about_body',
		array(
			'default'           => 'I specialize in React, Next.js, WordPress, and WooCommerce — from multi-role SaaS platforms and AgTech enrollment systems to interactive portfolio sites and headless storefronts. Every project is built for performance, maintainability, and a polished user experience.',
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);
	$wp_customize->add_control(
		'fisayo_about_body',
		array(
			'label'   => __( 'Body', 'fisayo-portfolio' ),
			'section' => 'fisayo_about',
			'type'    => 'textarea',
		)
	);

	/* Skills */
	$wp_customize->add_section(
		'fisayo_skills',
		array(
			'title' => __( 'Skills', 'fisayo-portfolio' ),
			'panel' => 'fisayo_portfolio',
		)
	);

	$wp_customize->add_setting(
		'fisayo_skills_list',
		array(
			'default'           => fisayo_portfolio_default_skills_list(),
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);
	$wp_customize->add_control(
		'fisayo_skills_list',
		array(
			'label'       => __( 'Skills (Category: items, one category per line)', 'fisayo-portfolio' ),
			'description' => __( 'Format: Category: item1, item2, item3', 'fisayo-portfolio' ),
			'section'     => 'fisayo_skills',
			'type'        => 'textarea',
		)
	);

	/* Contact */
	$wp_customize->add_section(
		'fisayo_contact',
		array(
			'title' => __( 'Contact', 'fisayo-portfolio' ),
			'panel' => 'fisayo_portfolio',
		)
	);

	$wp_customize->add_setting(
		'fisayo_contact_email',
		array(
			'default'           => 'hello@example.com',
			'sanitize_callback' => 'sanitize_email',
		)
	);
	$wp_customize->add_control(
		'fisayo_contact_email',
		array(
			'label'   => __( 'Email', 'fisayo-portfolio' ),
			'section' => 'fisayo_contact',
			'type'    => 'email',
		)
	);

	$contact_url_fields = array(
		'fisayo_contact_github'   => array( 'default' => 'https://github.com/fisayoariyo', 'label' => __( 'GitHub URL', 'fisayo-portfolio' ) ),
		'fisayo_contact_linkedin' => array( 'default' => '', 'label' => __( 'LinkedIn URL', 'fisayo-portfolio' ) ),
		'fisayo_contact_twitter'  => array( 'default' => '', 'label' => __( 'Twitter/X URL', 'fisayo-portfolio' ) ),
		'fisayo_shop_url'         => array( 'default' => 'http://localhost/shop/', 'label' => __( 'Gadget Shop URL', 'fisayo-portfolio' ) ),
	);

	foreach ( $contact_url_fields as $id => $field ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $field['default'],
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $field['label'],
				'section' => 'fisayo_contact',
				'type'    => 'url',
			)
		);
	}

	$wp_customize->add_setting(
		'fisayo_shop_label',
		array(
			'default'           => 'Visit my gadget shop',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'fisayo_shop_label',
		array(
			'label'   => __( 'Gadget Shop Button Label', 'fisayo-portfolio' ),
			'section' => 'fisayo_contact',
			'type'    => 'text',
		)
	);
}
add_action( 'customize_register', 'fisayo_portfolio_customize_register' );

/**
 * Get theme mod with fallback.
 *
 * @param string $key     Setting key.
 * @param string $default Default value.
 * @return string
 */
function fisayo_portfolio_mod( $key, $default = '' ) {
	$value = get_theme_mod( $key, $default );
	return is_string( $value ) ? $value : $default;
}
