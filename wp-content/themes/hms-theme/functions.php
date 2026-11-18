<?php
/**
 * HMS Theme functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'HMS_THEME_VERSION', '0.1.0' );

/**
 * Theme setup: title tag, feeds, nav menu, thumbnails.
 */
function hms_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'hms-theme' ),
			'footer'  => __( 'Footer Menu', 'hms-theme' ),
		)
	);
}
add_action( 'after_setup_theme', 'hms_theme_setup' );

/**
 * Enqueue theme stylesheet.
 */
function hms_theme_assets() {
	wp_enqueue_style( 'hms-theme-style', get_stylesheet_uri(), array(), HMS_THEME_VERSION );
}
add_action( 'wp_enqueue_scripts', 'hms_theme_assets' );

/**
 * On theme activation, create the legally/AdSense-required pages as drafts
 * if they don't already exist, so nothing gets silently duplicated.
 */
function hms_theme_create_required_pages() {
	$pages = array(
		'Privacy Policy'      => 'This page describes what data this site collects, how cookies and third-party advertising (e.g. Google AdSense) are used, and how visitors can control their preferences. Replace this placeholder with your full privacy policy before launch.',
		'Affiliate Disclosure' => 'This site participates in affiliate programs (such as Amazon Associates). We may earn a commission on qualifying purchases made through links on this site, at no extra cost to you. Replace this placeholder with your full disclosure before launch.',
		'About'               => 'Tell your readers who you are, your homeschooling background/experience, and why this site exists. Replace this placeholder before launch.',
		'Contact'             => 'Add a contact form or email address here. Replace this placeholder before launch.',
	);

	foreach ( $pages as $title => $content ) {
		$existing = get_page_by_title( $title, OBJECT, 'page' );
		if ( $existing ) {
			continue;
		}
		wp_insert_post(
			array(
				'post_title'   => $title,
				'post_content' => $content,
				'post_status'  => 'draft',
				'post_type'    => 'page',
			)
		);
	}
}
add_action( 'after_switch_theme', 'hms_theme_create_required_pages' );

/**
 * Register a simple footer widget area for disclosure/copyright text.
 */
function hms_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'hms-theme' ),
			'id'            => 'footer-1',
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
		)
	);
}
add_action( 'widgets_init', 'hms_theme_widgets_init' );

/**
 * Heuristic: does this post contain an affiliate link shortcode or a link
 * marked rel="sponsored"? Used to decide whether to show the disclosure box.
 *
 * @param int $post_id Optional. Defaults to the current post.
 * @return bool
 */
function hms_post_has_affiliate_links( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	if ( ! $post_id ) {
		return false;
	}
	$content = get_post_field( 'post_content', $post_id );
	if ( ! is_string( $content ) ) {
		return false;
	}
	return ( false !== strpos( $content, '[aff_link' ) || false !== strpos( $content, 'rel="sponsored"' ) );
}
