<?php
/**
 * MATRO theme bootstrap.
 *
 * @package Matro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MATRO_THEME_VERSION', '0.1.0' );

require_once get_template_directory() . '/inc/content.php';
require_once get_template_directory() . '/inc/post-types.php';
require_once get_template_directory() . '/inc/admin.php';

/**
 * Register theme capabilities and editor features.
 */
function matro_theme_setup() {
	load_theme_textdomain( 'matro', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_image_size( 'matro-product-card', 900, 675, true );
	add_image_size( 'matro-product-detail', 1400, 1120, true );

	register_nav_menus(
		array(
			'primary' => __( 'Hlavní navigace', 'matro' ),
			'footer'  => __( 'Navigace v patičce', 'matro' ),
		)
	);
}
add_action( 'after_setup_theme', 'matro_theme_setup' );

/**
 * Load the public assets.
 */
function matro_enqueue_assets() {
	wp_enqueue_style( 'matro-style', get_stylesheet_uri(), array(), MATRO_THEME_VERSION );
	wp_enqueue_script(
		'matro-theme',
		get_template_directory_uri() . '/assets/js/theme.js',
		array(),
		MATRO_THEME_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'matro_enqueue_assets' );

/**
 * Create the two content pages expected by the theme on first activation.
 */
function matro_after_switch_theme() {
	matro_register_content_types();

	$pages = array(
		'about'   => 'O společnosti',
		'contact' => 'Kontakt',
	);

	foreach ( $pages as $slug => $title ) {
		if ( ! get_page_by_path( $slug ) ) {
			wp_insert_post(
				array(
					'post_type'   => 'page',
					'post_status' => 'publish',
					'post_title'  => $title,
					'post_name'   => $slug,
				)
			);
		}
	}

	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'matro_after_switch_theme' );

/**
 * Keep archive and single product URLs stable after theme changes.
 */
function matro_flush_rewrites_on_deactivation() {
	flush_rewrite_rules();
}
add_action( 'switch_theme', 'matro_flush_rewrites_on_deactivation' );

/**
 * Make the product image useful in the media modal and editor.
 */
function matro_product_thumbnail_label( $content, $post_id ) {
	if ( 'matro_product' !== get_post_type( $post_id ) ) {
		return $content;
	}

	return $content . '<p>' . esc_html__( 'Použije se na kartě i detailu produktu. Doporučený poměr stran je 4:3.', 'matro' ) . '</p>';
}
add_filter( 'admin_post_thumbnail_html', 'matro_product_thumbnail_label', 10, 2 );

