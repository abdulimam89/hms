<?php
/**
 * Plugin Name: HMS Affiliate
 * Description: Lightweight affiliate link shortcode and auto-attribute helper for the HMS homeschooling site.
 * Version: 0.1.0
 * Author: HMS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Shortcode: [aff_link url="https://..." text="Check Price"]
 *
 * Renders an affiliate link with rel="sponsored nofollow noopener" and
 * target="_blank" pre-applied, styled as a button (class .aff-btn in theme).
 *
 * The URL is not validated as "external" beyond a basic scheme check —
 * contributors are trusted to paste their own affiliate links.
 *
 * @param array $atts Shortcode attributes.
 * @return string
 */
function hms_aff_link_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'url'  => '',
			'text' => '',
		),
		$atts,
		'aff_link'
	);

	$url  = esc_url( $atts['url'] );
	$text = $atts['text'] ? sanitize_text_field( $atts['text'] ) : __( 'View Offer', 'hms-affiliate' );

	if ( '' === $url ) {
		return '';
	}

	return sprintf(
		'<a class="aff-btn" href="%s" rel="sponsored nofollow noopener" target="_blank">%s</a>',
		esc_url( $url ),
		esc_html( $text )
	);
}
add_shortcode( 'aff_link', 'hms_aff_link_shortcode' );
