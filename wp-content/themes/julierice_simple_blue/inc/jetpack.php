<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package julierice_simple_blue
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function julierice_simple_blue_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'julierice_simple_blue_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function julierice_simple_blue_jetpack_setup
add_action( 'after_setup_theme', 'julierice_simple_blue_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function julierice_simple_blue_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function julierice_simple_blue_infinite_scroll_render
